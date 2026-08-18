# -*- coding: utf-8 -*-
"""
BLN 評價工具（倍數參與率連結固定收益證券不保本結構型商品）
依據：250106-BLN新種商品計畫書_20250220修改_.docx

評價公式（評價條件 / 現金結算價格）：
    價格 = Max[ 1 + P*((Vt-S0)/S0 + 應計息率) - (P-1)*Σ Hi*避險天數i/N2 - ND , G ]
      應計息率 = (100/S0) * Ci * 計息天數i / N1        (N1 = Act/365)
      Hi      = Max[ 浮動利率指標 + 加碼1.00% , 下限0.1% ]   逐季計算期間
      ND      = 累計連續負值配息金額 / 剩餘契約名目本金
      G       = 到期本金保本率 0%
    觸發事件：契約價格 <= 期初契約價格 * 觸發價格比率(30%)

僅使用 Python 標準庫（tkinter / datetime），內網可直接執行：
    python BLN_pricer.py            # 開啟 GUI
    python BLN_pricer.py --selftest # 以計畫書情境分析數字驗證核心邏輯
"""

import sys
import datetime as dt

# ---------------------------------------------------------------
# 日期工具
# ---------------------------------------------------------------

def parse_date(s):
    """接受 2025/4/24、2025-04-24、20250424 三種格式；失敗丟 ValueError。"""
    s = (s or "").strip()
    for fmt in ("%Y/%m/%d", "%Y-%m-%d", "%Y%m%d"):
        try:
            return dt.datetime.strptime(s, fmt).date()
        except ValueError:
            pass
    raise ValueError(u"日期格式錯誤：%r（請用 YYYY/M/D）" % s)


def add_months(d, n):
    """加 n 個月，日對日；若目標月無該日則取月底。"""
    y = d.year + (d.month - 1 + n) // 12
    m = (d.month - 1 + n) % 12 + 1
    # 該月最後一天
    if m == 12:
        last = 31
    else:
        last = (dt.date(y, m + 1, 1) - dt.timedelta(days=1)).day
    return dt.date(y, m, min(d.day, last))


# ---------------------------------------------------------------
# 核心計算
# ---------------------------------------------------------------

N1 = 365.0  # 票面利率計算基礎 Act/365
N2 = 365.0  # 避險資金成本計算基礎 Act/365


def coupon_dates(issue_date, maturity_date):
    """連結標的付息日：自發行日起每年一次（含到期日）。"""
    out = []
    d = add_months(issue_date, 12)
    while d <= maturity_date:
        out.append(d)
        d = add_months(d, 12)
    return out


def accrued_rate(val_date, issue_date, maturity_date, s0, coupon_pct):
    """
    應計息率 = (100/S0) * Ci * 計息天數/N1
    計息天數：評價日所在計息期間起始日(含)至評價日(不含)。
    回傳 (應計息率, 計息期間起始日, 計息天數)
    """
    if val_date < issue_date:
        raise ValueError(u"評價日早於連結標的發行日")
    period_start = issue_date
    d = add_months(issue_date, 12)
    while d <= val_date and d <= maturity_date:
        period_start = d
        d = add_months(d, 12)
    days = (val_date - period_start).days
    rate = (100.0 / s0) * coupon_pct / 100.0 * days / N1
    return rate, period_start, days


def hedge_periods(start_date, val_date):
    """自 start_date(含) 起逐季切分至 val_date(不含)。回傳 [(起, 迄, 天數)]。"""
    out = []
    a = start_date
    while a < val_date:
        b = add_months(a, 3)
        e = min(b, val_date)
        out.append((a, e, (e - a).days))
        a = b
    return out


def hedge_rate(taibor_pct, spread_pct=1.0, floor_pct=0.1):
    """Hi = Max[TAIBOR + 加碼, 下限]，單位 %。"""
    return max(taibor_pct + spread_pct, floor_pct)


def hedge_sum(start_date, val_date, taibor_default_pct, taibor_override,
              spread_pct=1.0, floor_pct=0.1):
    """
    Σ Hi * 天數i / N2。
    taibor_override: {計算期間起始日(date): TAIBOR%}，無覆寫者用 default。
    回傳 (合計小數, 明細list)；明細 = (起, 迄, 天數, TAIBOR%, Hi%, 貢獻)
    """
    total = 0.0
    detail = []
    for a, e, days in hedge_periods(start_date, val_date):
        tb = taibor_override.get(a, taibor_default_pct)
        hi = hedge_rate(tb, spread_pct, floor_pct)
        c = hi / 100.0 * days / N2
        total += c
        detail.append((a, e, days, tb, hi, c))
    return total, detail


def price_bln(vt, s0, p_pct, accr, hsum, nd, g_pct):
    """
    契約價格/現金結算價格（以 1 = 100% 表示）。
    回傳 (價格, 未取Max前之raw值)
    """
    p = p_pct / 100.0
    raw = 1.0 + p * ((vt - s0) / s0 + accr) - (p - 1.0) * hsum - nd
    return max(raw, g_pct / 100.0), raw


# ---------------------------------------------------------------
# 自我測試：以計畫書「情境分析」數字驗證
# ---------------------------------------------------------------

def selftest():
    ok = True

    # (1) 前手息：面額100萬*2張*3.7%*91/365 = 18,449
    issue = dt.date(2024, 4, 24)
    eff = dt.date(2024, 7, 24)
    days = (eff - issue).days
    fh = round(1000000 * 2 * 0.037 * days / 365.0)
    print(u"[1] 前手息  天數=%d  計算=%s  (計畫書=18,449)" % (days, format(fh, ",")))
    ok &= (fh == 18449)

    # (2) 第一年配息：2,000,000*(3.7%*5 - 2.5%*4*274/365) = 219,863
    cpn_date = dt.date(2025, 4, 24)
    hs, _ = hedge_sum(eff, cpn_date, 1.5, {})   # TAIBOR 1.5% → Hi=2.5%
    coupon = 10 * 1000000 * 0.037 * 365 / 365.0 - 2000000 * 4 * hs
    print(u"[2] 第一年配息  Σ避險=%.6f  計算=%s  (計畫書=219,863)"
          % (hs, format(int(round(coupon)), ",")))
    ok &= (abs(coupon - 219863) < 2)

    # (3) 觸發判斷：付息日當日 Vt=85.5，應計息率=0、避險累計=0
    accr, ps, d = accrued_rate(cpn_date, issue, dt.date(2034, 4, 24), 100.0, 3.7)
    px, raw = price_bln(85.5, 100.0, 500.0, accr, 0.0, 0.0, 0.0)
    print(u"[3] Vt=85.5  應計息率=%.4f  契約價格=%.4f  (0.275 ≤ 0.30 → 觸發)"
          % (accr, px))
    ok &= (abs(px - 0.275) < 1e-9)

    print(u"\n自我測試：%s" % (u"全部通過" if ok else u"有誤，請檢查"))
    return 0 if ok else 1


# ---------------------------------------------------------------
# GUI
# ---------------------------------------------------------------

def run_gui():
    try:
        import tkinter as tk
        from tkinter import ttk, scrolledtext, messagebox
    except ImportError:
        print(u"本機無 tkinter，請改用 --selftest 或於有 tkinter 之環境執行。")
        sys.exit(1)

    root = tk.Tk()
    root.title(u"BLN 評價工具（倍數參與率連結固定收益）")
    root.geometry("1120x760")

    frm = ttk.Frame(root, padding=8)
    frm.pack(side=tk.LEFT, fill=tk.Y)

    fields = []

    def add_field(label, default, row, hint=""):
        ttk.Label(frm, text=label).grid(row=row, column=0, sticky="w", pady=2)
        v = tk.StringVar(value=default)
        e = ttk.Entry(frm, textvariable=v, width=16)
        e.grid(row=row, column=1, sticky="w", pady=2)
        if hint:
            ttk.Label(frm, text=hint, foreground="#777").grid(
                row=row, column=2, sticky="w", padx=4)
        fields.append(v)
        return v

    r = 0
    ttk.Label(frm, text=u"── 商品條件 ──").grid(row=r, column=0, columnspan=3, sticky="w"); r += 1
    v_issue = add_field(u"連結標的發行日", "2024/4/24", r); r += 1
    v_eff   = add_field(u"交易生效日",     "2024/7/24", r); r += 1
    v_mat   = add_field(u"到期日",         "2034/4/24", r); r += 1
    v_s0    = add_field(u"期初價格 S0",    "100",       r, u"百元價"); r += 1
    v_p     = add_field(u"參與率 P (%)",   "500",       r); r += 1
    v_cpn   = add_field(u"票面利率 C (%)", "3.70",      r, u"年付一次 Act/365"); r += 1
    v_ntl   = add_field(u"剩餘契約名目本金", "2000000", r, u"元"); r += 1
    v_lots  = add_field(u"剩餘連結標的張數", "2",       r, u"表彰可結算=張數×P"); r += 1
    v_face  = add_field(u"每張面額",       "1000000",   r, u"元"); r += 1
    v_trig  = add_field(u"觸發價格比率 (%)", "30",      r, u"期初契約價格之比率"); r += 1
    v_g     = add_field(u"保本率 G (%)",   "0",         r); r += 1

    ttk.Label(frm, text=u"── 避險資金成本 ──").grid(row=r, column=0, columnspan=3, sticky="w"); r += 1
    v_tb    = add_field(u"TAIBOR 預設 (%)", "1.50",     r, u"未覆寫期間適用"); r += 1
    v_sprd  = add_field(u"加碼 (%)",        "1.00",     r); r += 1
    v_floor = add_field(u"下限 (%)",        "0.10",     r); r += 1
    ttk.Label(frm, text=u"逐期TAIBOR覆寫\n(每行 起始日=利率%)").grid(row=r, column=0, sticky="nw", pady=2)
    txt_ovr = tk.Text(frm, width=24, height=4)
    txt_ovr.grid(row=r, column=1, columnspan=2, sticky="w", pady=2); r += 1

    ttk.Label(frm, text=u"── 評價輸入 ──").grid(row=r, column=0, columnspan=3, sticky="w"); r += 1
    v_val   = add_field(u"評價日",          "2025/7/24", r); r += 1
    v_vt    = add_field(u"每日價格 Vt",     "100",       r, u"百元除息價"); r += 1
    v_ndamt = add_field(u"累計連續負值配息", "0",        r, u"元；ND=÷剩餘本金"); r += 1
    v_tax   = add_field(u"證交稅率 (%)",    "0",         r, u"0=停徵，手續費不收"); r += 1

    ttk.Label(frm, text=u"事件類型").grid(row=r, column=0, sticky="w")
    v_evt = tk.StringVar(value=u"到期/發行機構提前贖回")
    cb_evt = ttk.Combobox(frm, textvariable=v_evt, width=22, state="readonly",
                          values=[u"到期/發行機構提前贖回",
                                  u"觸發事件/特殊事件",
                                  u"交易人提前終止"])
    cb_evt.grid(row=r, column=1, columnspan=2, sticky="w", pady=2); r += 1

    out = scrolledtext.ScrolledText(root, font=("Consolas", 10))
    out.pack(side=tk.RIGHT, fill=tk.BOTH, expand=True, padx=6, pady=6)

    def parse_override(text):
        ovr = {}
        for ln in text.splitlines():
            ln = ln.strip()
            if not ln:
                continue
            if "=" not in ln:
                raise ValueError(u"覆寫格式錯誤（缺 =）：%r" % ln)
            k, val = ln.split("=", 1)
            ovr[parse_date(k)] = float(val.replace("%", "").strip())
        return ovr

    def calc():
        out.delete("1.0", tk.END)
        try:
            issue = parse_date(v_issue.get())
            eff   = parse_date(v_eff.get())
            mat   = parse_date(v_mat.get())
            vald  = parse_date(v_val.get())
            s0    = float(v_s0.get());    vt = float(v_vt.get())
            p     = float(v_p.get());     c  = float(v_cpn.get())
            ntl   = float(v_ntl.get());   lots = float(v_lots.get())
            face  = float(v_face.get())
            trig  = float(v_trig.get());  g  = float(v_g.get())
            tbd   = float(v_tb.get());    sprd = float(v_sprd.get())
            flr   = float(v_floor.get())
            ndamt = float(v_ndamt.get()); tax = float(v_tax.get())
            ovr   = parse_override(txt_ovr.get("1.0", tk.END))

            # ---- 防呆檢查（條件失敗時明確顯示，不靜默） ----
            errs = []
            if s0 <= 0: errs.append(u"S0 必須 > 0")
            if ntl <= 0: errs.append(u"剩餘契約名目本金必須 > 0")
            if not (issue <= eff <= mat): errs.append(u"日期順序須為 發行日 ≤ 生效日 ≤ 到期日")
            if not (eff <= vald <= mat): errs.append(u"評價日須介於生效日與到期日之間")
            if p < 100: errs.append(u"參與率應 ≥ 100%（本商品為500%）")
            if errs:
                out.insert(tk.END, u"【輸入檢核未通過】\n" + u"\n".join(u"‧ " + e for e in errs))
                return

            L = []
            L.append(u"=" * 68)
            L.append(u"BLN 評價明細   評價日 %s" % vald.strftime("%Y/%m/%d"))
            L.append(u"=" * 68)

            # ---- 應計息率 ----
            accr, pstart, adays = accrued_rate(vald, issue, mat, s0, c)
            L.append(u"")
            L.append(u"[1] 應計息率 = (100/S0) × C × 計息天數/365")
            L.append(u"    計息期間起始日 %s，計息天數 %d" % (pstart.strftime("%Y/%m/%d"), adays))
            L.append(u"    = (100/%.4f) × %.2f%% × %d/365 = %.6f (%.4f%%)"
                     % (s0, c, adays, accr, accr * 100))

            # ---- 避險資金成本 ----
            cpns = coupon_dates(issue, mat)
            last_pay = issue
            for d in cpns:
                if d <= vald:
                    last_pay = d
            hstart = max(last_pay, eff)   # 首年自生效日起算（與情境分析一致）
            hsum, hdet = hedge_sum(hstart, vald, tbd, ovr, sprd, flr)
            L.append(u"")
            L.append(u"[2] 避險資金成本 Σ Hi×天數/365   起算日 %s（前次付息日/生效日取晚者）"
                     % hstart.strftime("%Y/%m/%d"))
            L.append(u"    %-11s %-11s %4s  %7s  %7s  %10s"
                     % (u"起始(含)", u"終止(不含)", u"天數", u"TAIBOR", u"Hi", u"貢獻"))
            for a, e, dd, tb, hi, contrib in hdet:
                L.append(u"    %-11s %-11s %4d  %6.3f%%  %6.3f%%  %10.6f"
                         % (a.strftime("%Y/%m/%d"), e.strftime("%Y/%m/%d"),
                            dd, tb, hi, contrib))
            L.append(u"    合計 Σ = %.6f (%.4f%%)" % (hsum, hsum * 100))

            # ---- ND ----
            nd = ndamt / ntl if ntl else 0.0
            L.append(u"")
            L.append(u"[3] ND = 累計連續負值配息 / 剩餘名目本金 = %s / %s = %.6f"
                     % (format(int(ndamt), ","), format(int(ntl), ","), nd))

            # ---- 契約價格 ----
            px, raw = price_bln(vt, s0, p, accr, hsum, nd, g)
            px_r = round(px, 4)   # 期末價格計算至小數第4位
            L.append(u"")
            L.append(u"[4] 契約價格 = Max[ 1 + P×((Vt−S0)/S0 + 應計息率) − (P−1)×Σ − ND , G ]")
            L.append(u"    = Max[ 1 + %.0f%%×((%.4f−%.4f)/%.4f + %.6f)" % (p, vt, s0, s0, accr))
            L.append(u"            − (%.0f%%−1)×%.6f − %.6f , %.0f%% ]" % (p, hsum, nd, g))
            L.append(u"    未取Max前 = %.6f  →  契約價格 = %.4f (%.2f%%)" % (raw, px_r, px_r * 100))

            # ---- 觸發判斷 ----
            trig_px = 1.0 * trig / 100.0   # 期初契約價格=100%
            L.append(u"")
            if px_r <= trig_px:
                L.append(u"[5] 觸發判斷：%.4f ≤ 觸發價格 %.4f  ⇒ ★發生觸發事件★（提前到期）"
                         % (px_r, trig_px))
            else:
                L.append(u"[5] 觸發判斷：%.4f ＞ 觸發價格 %.4f  ⇒ 未觸發" % (px_r, trig_px))

            # ---- 結算手續費（證交稅開徵時才收） ----
            evt = v_evt.get()
            settle_lots = lots * p / 100.0     # 剩餘/提前終止表彰可結算張數
            taxr = tax / 100.0
            if taxr > 0:
                d_cash = px_r * s0 / 100.0 * settle_lots * face / 100.0 * taxr  # 以期末價概算
                if evt != u"到期/發行機構提前贖回":
                    d_cash += 0.05 * ntl       # D1 另加 5%×名目本金
                d_phys = s0 * settle_lots * face / 100.0 / 100.0 * taxr        # D3/D4 用期初價
            else:
                d_cash = d_phys = 0.0

            # ---- 現金結算 ----
            cash = ntl * px_r - d_cash
            L.append(u"")
            L.append(u"[6] 現金結算（S1 以上述契約價格代入；實際以計算代理人決定之期末價格為準）")
            L.append(u"    領回 = 剩餘名目本金 × 現金結算價格 − 結算手續費")
            L.append(u"    = %s × %.4f − %s = %s 元"
                     % (format(int(ntl), ","), px_r,
                        format(int(round(d_cash)), ","),
                        format(int(round(max(cash, 0))), ",")))
            if cash < 0:
                L.append(u"    ※ 計算結果為負（%s），依計畫書：無法領回任何金額"
                         % format(int(round(cash)), ","))

            # ---- 實物交割 ----
            hs_phys = hsum  # 應付避險資金成本口徑同 Σ（以剩餘名目本金計）
            phys_pay = ntl * (p / 100.0 - 1.0) + ntl * (p / 100.0 - 1.0) * hs_phys + d_phys
            L.append(u"")
            L.append(u"[7] 實物交割（取得 %.0f 張債券）" % settle_lots)
            L.append(u"    應付 = 剩餘名目本金×(P−100%) × (1+Σ避險) + 結算手續費")
            L.append(u"    = %s × %.0f%% × (1+%.6f) + %s = %s 元"
                     % (format(int(ntl), ","), p - 100, hs_phys,
                        format(int(round(d_phys)), ","),
                        format(int(round(phys_pay)), ",")))

            # ---- 配息試算（評價日若為付息日） ----
            if vald in cpns:
                cp_start = add_months(vald, -12)
                cp_days = (vald - max(cp_start, issue)).days
                cp_amt = settle_lots * face * c / 100.0 * cp_days / N1 \
                         - ntl * (p / 100.0 - 1.0) * hsum
                L.append(u"")
                L.append(u"[8] 本日為連結標的付息日，配息試算：")
                L.append(u"    = 可配息張數×面額×C×天數/365 − 剩餘本金×(P−1)×Σ避險")
                L.append(u"    = %.0f×%s×%.2f%%×%d/365 − %s×%.0f%%×%.6f = %s 元"
                         % (settle_lots, format(int(face), ","), c, cp_days,
                            format(int(ntl), ","), p - 100, hsum,
                            format(int(round(cp_amt)), ",")))
                if cp_amt < 0:
                    L.append(u"    ※ 配息為負值 → 應累計入 ND（負值配息總計差額）")

            L.append(u"")
            L.append(u"※ 稅率=0 視為證交稅停徵，各項結算手續費(D1~D4)不收。")
            L.append(u"※ 期末價格 S1 實務上由計算代理人決定；本工具以輸入之 Vt 依評價公式試算供核對。")
            out.insert(tk.END, u"\n".join(L))

        except Exception as ex:
            out.insert(tk.END, u"【計算失敗】\n%s: %s" % (type(ex).__name__, ex))

    ttk.Button(frm, text=u"計  算", command=calc).grid(
        row=r, column=0, columnspan=3, sticky="we", pady=10)

    root.mainloop()


if __name__ == "__main__":
    if "--selftest" in sys.argv:
        sys.exit(selftest())
    run_gui()
