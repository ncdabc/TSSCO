<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>原始保證金彙總</title>
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/myBtn.css">
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/huBtn20180110.css">
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/HuTable.css">
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/myDiv20180331.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --bg:           #f1f4f8;
      --surface:      #ffffff;
      --surface2:     #f8fafc;
      --border:       #e2e8f0;
      --border-strong:#c8d3df;
      --header-bg:    #0f2744;
      --header-hi:    #1a3f6f;
      --sidebar-bg:   #1a2e4a;
      --sidebar-w:    196px;
      --c-grey:       #5a6272;
      --c-green:      #0e8a52;
      --c-purple:     #7c3d8e;
      --c-orange:     #c94000;
      --c-cyan:       #0891b2;
      --bg-green:     #f0faf4;
      --bg-purple:    #f7f0f9;
      --bg-orange:    #fff5ee;
      --bg-cyan:      #e8f8fb;
      --bg-grey:      #f9fafb;
      --text:         #0f172a;
      --text-muted:   #5a6a80;
      --radius:       10px;
      --shadow:       0 1px 4px rgba(0,0,0,0.07), 0 4px 16px rgba(0,0,0,0.05);
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      background: var(--bg); color: var(--text);
      font-family: 'Noto Sans TC', sans-serif; font-size: 17px !important;
      display: flex; flex-direction: column; min-height: 100vh;
    }

    /* ── Top Header ── */
    #top-header {
      position: sticky; top: 0; z-index: 300;
      background: var(--header-bg); height: 52px;
      display: flex; align-items: center; justify-content: space-between;
      padding: 0 24px; box-shadow: 0 2px 12px rgba(0,0,0,0.25); flex-shrink: 0;
    }
    #top-header .brand {
      font-family: 'JetBrains Mono', monospace; font-size: 14px !important; font-weight: 600;
      color: #e2ecf8; letter-spacing: 0.08em;
    }
    #top-header .brand span { color: #4d88c4; }
    #top-header .header-right { display: flex; align-items: center; gap: 10px; }
    #top-header .header-meta {
      font-family: 'JetBrains Mono', monospace; font-size: 13px !important; color: #6a90b8;
    }
    #top-header .header-data-date {
      font-family: 'Noto Sans TC', sans-serif; font-size: 15px !important; color: #cfe0f2;
      padding: 4px 12px; background: rgba(255,255,255,0.08); border-radius: 6px;
      border: 1px solid rgba(255,255,255,0.14); white-space: nowrap;
    }
    #top-header .header-data-date strong { color: #7dd3c8; font-weight: 700; }
    .btn-back {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 5px 13px; border-radius: 6px; font-size: 14px !important;
      font-family: 'Noto Sans TC', sans-serif; font-weight: 500;
      text-decoration: none; cursor: pointer;
      background: rgba(255,255,255,0.1); color: #c8ddf0;
      border: 1px solid rgba(255,255,255,0.18);
      transition: background 0.15s, color 0.15s;
    }
    .btn-back:hover { background: rgba(255,255,255,0.22); color: #fff; }

    /* ── Layout ── */
    #layout { display: flex; flex: 1; min-height: 0; }

    /* ── Sidebar ── */
    #sidebar {
      width: var(--sidebar-w); background: var(--sidebar-bg);
      flex-shrink: 0; display: flex; flex-direction: column;
      padding: 16px 10px 24px; gap: 4px; overflow-y: auto;
      position: sticky; top: 52px; height: calc(100vh - 52px);
    }
    #sidebar .sidebar-label {
      font-family: 'JetBrains Mono', monospace; font-size: 11px !important; font-weight: 600;
      letter-spacing: 0.14em; text-transform: uppercase;
      color: #3d6a9e; padding: 10px 6px 4px;
    }
    #sidebar .nav-btn {
      display: block; width: 100%; padding: 8px 10px;
      background: transparent; border: none; border-radius: 7px;
      color: #a8c4e0; font-size: 14px !important; font-family: 'Noto Sans TC', sans-serif;
      text-align: left; cursor: pointer; text-decoration: none;
      transition: background 0.14s, color 0.14s; line-height: 1.4;
    }
    #sidebar .nav-btn:hover  { background: rgba(255,255,255,0.09); color: #e2ecf8; }
    #sidebar .nav-btn.accent { color: #7dd3c8; }
    #sidebar .nav-btn.accent:hover { background: rgba(125,211,200,0.12); color: #a7ede8; }
    #sidebar .nav-divider { height: 1px; background: rgba(255,255,255,0.06); margin: 6px 0; }

    /* ── Main content ── */
    #main-content { flex: 1; padding: 24px 28px 56px; overflow-x: auto; min-width: 0; }

    /* ── Page title ── */
    #page-title { display: flex; align-items: baseline; gap: 12px; margin-bottom: 6px; }
    #page-title h1 { font-size: 28px !important; font-weight: 700; color: var(--header-bg); }
    #page-title .subtitle {
      font-family: 'JetBrains Mono', monospace; font-size: 13px !important; color: var(--text-muted);
    }
    /* ── 切換頁面按鈕（標題列最右邊）── */
    .btn-title-nav {
      margin-left: auto; display: inline-flex; align-items: center; gap: 6px;
      padding: 7px 16px; border-radius: 7px;
      font-size: 14px !important; font-weight: 600;
      font-family: 'Noto Sans TC', sans-serif; text-decoration: none;
      color: #fff; background: var(--header-bg); border: 1px solid var(--header-bg);
      transition: background 0.14s;
    }
    .btn-title-nav:hover { background: var(--header-hi); }
    .page-note {
      font-size: 14px !important; color: var(--text-muted); margin-bottom: 20px;
      padding: 6px 12px; background: #fff8e1; border-left: 3px solid #f59e0b;
      border-radius: 0 6px 6px 0; display: inline-flex; align-items: center; gap: 8px;
    }

    /* ── Section ── */
    .section-block { margin-bottom: 32px; }
    .section-header { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
    .section-header h2 { font-size: 19px !important; font-weight: 700; color: var(--header-bg); }
    .section-divider {
      flex: 1; height: 2px;
      background: linear-gradient(90deg, var(--border-strong) 0%, transparent 100%);
    }
    .section-badge {
      font-family: 'JetBrains Mono', monospace; font-size: 11px !important; font-weight: 700;
      letter-spacing: 0.12em; text-transform: uppercase;
      padding: 2px 8px; border-radius: 20px;
      background: var(--header-bg); color: #fff; opacity: 0.65;
    }

    /* ── Table card ── */
    .table-card {
      background: var(--surface); border: 1px solid var(--border);
      border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden;
    }
    .table-scroll { overflow-x: auto; }

    /* ── Table ── */
    .pm-table { width: 100%; border-collapse: collapse; font-size: 16px !important; }
    .pm-table th {
      padding: 10px 13px !important; font-size: 15px !important; font-weight: 700 !important;
      letter-spacing: 0.03em; white-space: nowrap; text-align: center; color: #fff !important;
      border-right: 1px solid rgba(255,255,255,0.14) !important; border-bottom: none !important;
    }
    .pm-table th:last-child { border-right: none !important; }
    .pm-table th[style*="#7D7D7D"],.pm-table th[style*="7D7D7D"] { background: var(--c-grey)   !important; }
    .pm-table th[style*="#01B468"],.pm-table th[style*="01B468"] { background: var(--c-green)  !important; }
    .pm-table th[style*="#AE57A4"],.pm-table th[style*="AE57A4"] { background: var(--c-purple) !important; }
    .pm-table th[style*="#D94600"],.pm-table th[style*="D94600"] { background: var(--c-orange) !important; }
    .pm-table th[style*="#45FFFF"],.pm-table th[style*="45FFFF"] { background: var(--c-cyan)   !important; }
    .pm-table tbody tr { border-bottom: 1px solid var(--border) !important; transition: filter 0.1s; }
    .pm-table tbody tr:last-child { border-bottom: none !important; }
    .pm-table tbody tr:nth-child(even) { background: var(--surface2); }
    .pm-table tbody tr:hover { filter: brightness(0.95); }
    .pm-table td {
      padding: 7px 11px !important;
      font-family: 'JetBrains Mono', monospace; font-size: 15px !important;
      border-right: 1px solid var(--border) !important; border-bottom: none !important;
      white-space: nowrap; text-align: right; vertical-align: middle;
    }
    .pm-table td:last-child { border-right: none !important; }
    .pm-table td[style*="#FAFAFA"] {
      background: var(--bg-grey) !important;
      font-family: 'Noto Sans TC', sans-serif !important;
      font-weight: 500 !important; color: var(--header-bg) !important;
      text-align: left !important;
    }
    /* Trader name cell — slightly more prominent */
    .pm-table td.trader-cell {
      background: var(--bg-grey) !important;
      font-family: 'Noto Sans TC', sans-serif !important;
      font-weight: 700 !important; color: var(--header-bg) !important;
      text-align: left !important;
    }
    .pm-table td.trader-cell a {
      color: #1d5fa6; text-decoration: none; font-weight: 700;
    }
    .pm-table td.trader-cell a:hover { text-decoration: underline; color: var(--c-orange); }
    .pm-table td[style*="#F5FFE8"] { background: var(--bg-green)  !important; }
    .pm-table td[style*="#EBD3E8"] { background: var(--bg-purple) !important; }
    .pm-table td[style*="#FFF3EE"] { background: var(--bg-orange) !important; }
    .pm-table td[style*="#DEFFFF"] { background: var(--bg-cyan)   !important; }

    /* ── Pivot table (樞紐分析表) ── */
    .pivot-table { width: auto; min-width: 100%; border-collapse: collapse; font-size: 16px !important; }
    .pivot-table th {
      padding: 11px 16px !important; font-size: 15px !important; font-weight: 700 !important;
      white-space: nowrap; text-align: center; color: #fff !important;
      background: #2E5C8A !important;
      border-right: 1px solid rgba(255,255,255,0.14) !important; border-bottom: none !important;
      position: sticky; top: 0; z-index: 2;
    }
    .pivot-table th:first-child {
      text-align: left; position: sticky; left: 0; z-index: 3; background: #2E5C8A !important;
      min-width: 260px;
    }
    .pivot-table th:last-child { border-right: none !important; }
    .pivot-table tbody tr { border-bottom: 1px solid var(--border) !important; }
    .pivot-table tbody tr:last-child { border-bottom: none !important; }
    .pivot-table td {
      padding: 9px 16px !important;
      font-family: 'JetBrains Mono', monospace; font-size: 15px !important;
      border-right: 1px solid var(--border) !important; border-bottom: none !important;
      white-space: nowrap; text-align: right; vertical-align: middle;
    }
    .pivot-table td:last-child { border-right: none !important; }
    .pivot-table td.pv-label {
      font-family: 'Noto Sans TC', sans-serif !important; text-align: left !important;
      color: var(--text); background: var(--surface);
      position: sticky; left: 0; z-index: 1;
      display: flex; align-items: center; gap: 6px;
    }
    /* 已移除斑馬紋，改用各階層固定底色（見下方 .pv-lv0 ~ .pv-lv4） */
    .pv-toggle {
      display: inline-flex; align-items: center; justify-content: center;
      width: 20px; height: 20px; flex: 0 0 20px; border-radius: 4px;
      background: var(--header-bg); color: #fff; font-size: 13px !important; font-weight: 700;
      line-height: 1; cursor: pointer; user-select: none; border: none;
    }
    .pv-toggle:hover { background: var(--header-hi); }
    .pv-leaf-spacer { display: inline-block; width: 20px; flex: 0 0 20px; }
    .pv-lv0 td.pv-label { font-weight: 700; color: var(--header-bg); }
    .pv-lv0, .pv-lv0 td { background: #ffffff !important; }
    .pv-lv1, .pv-lv1 td { background: #ffffff !important; }
    .pv-lv1 td.pv-label { padding-left: 22px !important; font-weight: 600; }
    .pv-lv2, .pv-lv2 td { background: #ffffff !important; }
    .pv-lv2 td.pv-label { padding-left: 40px !important; }
    .pv-lv3, .pv-lv3 td { background: #ffffff !important; }
    .pv-lv3 td.pv-label { padding-left: 58px !important; color: var(--text-muted); }
    .pv-lv4, .pv-lv4 td { background: #ffffff !important; }
    .pv-lv4 td.pv-label { padding-left: 76px !important; color: var(--text-muted); font-style: italic; }
    .pv-strategy td.pv-label { color: var(--text-muted) !important; font-style: italic !important; }
    .pv-total td { font-weight: 700 !important; background: #2E5C8A !important; color: #fff !important; border-top: 2px solid var(--border-strong) !important; }
    .pv-total td.pv-label { background: #2E5C8A !important; color: #fff !important; }
    .pv-neg { color: #c0392b !important; }

    /* ── 月變動 Top5 ── */
    .top5-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(520px, 1fr)); gap: 18px; }
    .top5-card {
      background: var(--surface); border: 1px solid var(--border);
      border-radius: var(--radius); box-shadow: var(--shadow); overflow: hidden;
    }
    .top5-card-head {
      background: var(--header-bg); color: #fff;
      padding: 10px 16px; font-size: 15px !important; font-weight: 700;
      font-family: 'Noto Sans TC', sans-serif;
      display: flex; align-items: center; justify-content: space-between; gap: 10px;
    }
    .top5-card-head .t5-sub {
      font-family: 'JetBrains Mono', monospace; font-size: 11px !important;
      font-weight: 600; opacity: 0.7; letter-spacing: 0.06em;
    }
    .top5-table { width: 100%; border-collapse: collapse; font-size: 15px !important; }
    .top5-table th {
      padding: 8px 12px !important; font-size: 13px !important; font-weight: 700 !important;
      background: #2E5C8A !important; color: #fff !important; white-space: nowrap;
      text-align: right; border-right: 1px solid rgba(255,255,255,0.16) !important;
    }
    .top5-table th:last-child { border-right: none !important; }
    .top5-table th.t5-rank { width: 46px; text-align: center; }
    .top5-table th.t5-name { text-align: left; min-width: 200px; }
    .top5-table tbody tr { border-bottom: 1px solid var(--border); }
    .top5-table tbody tr:last-child { border-bottom: none; }
    .top5-table tbody tr:hover { background: var(--surface2); }
    .top5-table td {
      padding: 8px 12px !important;
      font-family: 'JetBrains Mono', monospace; font-size: 15px !important;
      text-align: right; white-space: nowrap;
      border-right: 1px solid var(--border) !important;
    }
    .top5-table td:last-child { border-right: none !important; }
    .top5-table td.t5-rank { text-align: center; }
    .top5-table td.t5-name {
      font-family: 'Noto Sans TC', sans-serif !important;
      text-align: left !important; color: var(--header-bg); font-weight: 500;
    }
    .t5-badge {
      display: inline-flex; align-items: center; justify-content: center;
      width: 24px; height: 24px; border-radius: 50%;
      background: var(--border); color: var(--text-muted);
      font-family: 'JetBrains Mono', monospace; font-size: 12px !important; font-weight: 700;
    }
    .t5-badge.r1 { background: #d97706; color: #fff; }
    .t5-badge.r2 { background: #94a3b8; color: #fff; }
    .t5-badge.r3 { background: #b45309; color: #fff; opacity: 0.8; }
    .top5-empty { padding: 18px; color: var(--text-muted); font-size: 14px !important; }

    /* ── 自訂表格配色（依需求指定）── */
    /* 第一個表格（交易目的別）：階層一固定配色 */
    .pv-table-tag .pv-lv0, .pv-table-tag .pv-lv0 td { background: #C5B171 !important; color: #fff !important; }
    /* 階層二（第一個表格）／階層一（第二個表格）：依標籤是否含「股權」決定配色 */
    .pv-table-tag .pv-lv1.pv-eq, .pv-table-tag .pv-lv1.pv-eq td,
    .pv-table-pos .pv-lv0.pv-eq, .pv-table-pos .pv-lv0.pv-eq td { background: #FCE4D6 !important; }
    .pv-table-tag .pv-lv1.pv-noneq, .pv-table-tag .pv-lv1.pv-noneq td,
    .pv-table-pos .pv-lv0.pv-noneq, .pv-table-pos .pv-lv0.pv-noneq td { background: #D9E1F2 !important; }
    .pv-scroll { overflow: auto; max-height: 640px; }

    /* ── 資料日期篩選 ── */
    .data-filter {
      display: flex; align-items: center; gap: 10px; margin: 4px 0 20px;
      padding: 10px 14px; background: var(--surface); border: 1px solid var(--border);
      border-radius: var(--radius); box-shadow: var(--shadow); width: fit-content;
    }
    .data-filter label {
      font-size: 14px !important; font-weight: 600; color: var(--header-bg);
    }
    .data-filter select {
      font-family: 'Noto Sans TC', sans-serif; font-size: 14px !important; color: var(--text);
      padding: 6px 10px; border: 1px solid var(--border-strong); border-radius: 6px;
      background: var(--surface2); min-width: 160px; cursor: pointer;
    }
    .data-filter select:focus { outline: 2px solid var(--header-hi); outline-offset: 1px; }
    .btn-query {
      font-family: 'Noto Sans TC', sans-serif; font-size: 14px !important; font-weight: 600;
      padding: 6px 18px; border: none; border-radius: 6px; cursor: pointer;
      background: var(--header-bg); color: #fff; transition: background 0.15s;
    }
    .btn-query:hover { background: var(--header-hi); }
  </style>
</head>
  <?php 
// ═══════════════════════════════════════════════════════════════════
//  原始保證金彙總（Margin_initial.php）
//  架構複製自 Investment_Meeting.php：權限檢查 / 日期篩選 / 樞紐表 / 展開收合
//  ★ 唯一差異：資料來源改讀 D:\WebData\Margin.csv（非 SQL Server）
//     欄位：日期, Tag, 部門, 姓名, 原始保證金
//     樞紐：列 = 部門 ▸ 姓名，欄 = Tag（期貨商）＋總計，值 = 原始保證金加總
// ═══════════════════════════════════════════════════════════════════

// ── 資料庫連線（僅供權限檢查使用；資料改讀 CSV）──
$serverName = "172.24.26.41"; //serverName\instanceName
$connectionInfo = array( "Database"=>"MDoutput", "UID"=>"sa", "PWD"=>"TsscojblMD!", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if(!empty($_SERVER['HTTP_CLIENT_IP'])){

   $myip = $_SERVER['HTTP_CLIENT_IP'];

}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

   $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];

}else{

   $myip= $_SERVER['REMOTE_ADDR'];

}

$path_parts = pathinfo($_SERVER['PHP_SELF']); 


// ── 權限（同 Investment_Meeting.php：IfYouCanSee_合併 依檔名比對）──

$home_sql =  sqlsrv_query($conn, "
	select * from DBMain.dbo.IfYouCanSee_合併 a
	left join [DailyInsert].[dbo].[IPList合併] b on a.[User] = b.台新編號
	where a.[NameOfPHP] = '". $path_parts['filename'] ."' and b.[IP] = '". $myip ."'
");

$i=0;

$user=array();

 while($row = sqlsrv_fetch_array($home_sql, SQLSRV_FETCH_ASSOC)){
  	$arrcnt=0;
	foreach ($row as $value )
       {
			$user[$arrcnt][$i]=$value;
			$arrcnt=$arrcnt+1;
       }
 $i++;
 }



if ($i == 0) { // 用回傳筆數判斷是否有權限
	echo '<script language="javascript">';
    echo 'alert("您沒有此頁面權限哦，請向中台確認");';
    echo '</script>';
    exit; // 顯示提示後整個畫面留白，不導頁、網址維持不變
}  


// ═══════════════════════════════════════════════════════════════════
// ★ 資料層（與 Investment_Meeting.php 不同處從這裡開始）
//   讀取 D:\WebData\Margin.csv；讀不到時退到同目錄 Margin.csv（測試用）
// ═══════════════════════════════════════════════════════════════════

$csvPathPrimary  = 'D:\\WebData\\Margin.csv';
$csvPathFallback = __DIR__ . DIRECTORY_SEPARATOR . 'Margin.csv';
$csvPath  = '';
$csvError = '';

if (is_readable($csvPathPrimary))       { $csvPath = $csvPathPrimary; }
elseif (is_readable($csvPathFallback))  { $csvPath = $csvPathFallback; }
else {
    $csvError = '找不到資料檔：'.$csvPathPrimary.'（備援 '.$csvPathFallback.' 亦不存在）';
}

// ── 讀檔＋編碼防呆：非 UTF-8（如 Big5）自動轉碼；去除 BOM ──
$csvRows      = array();   // 每筆：array(sortkey(Ymd), tag, dept, name, amt)
$csvSkipped   = 0;         // 金額非數字或欄位不足而略過的列數
$dateLabels   = array();   // sortkey(Ymd) => 顯示標籤(Y/n/j)

if ($csvError === '') {
    $raw = file_get_contents($csvPath);
    if ($raw === false) {
        $csvError = '資料檔無法讀取：'.$csvPath;
    } else {
        if (substr($raw, 0, 3) === "\xEF\xBB\xBF") { $raw = substr($raw, 3); }  // UTF-8 BOM
        if (!mb_check_encoding($raw, 'UTF-8')) {
            $conv = @iconv('CP950', 'UTF-8//IGNORE', $raw);   // Big5 轉 UTF-8
            if ($conv !== false && $conv !== '') { $raw = $conv; }
        }
        $lines  = preg_split('/\r\n|\r|\n/', $raw);
        $header = null;
        $colIdx = array();   // 欄名 => 索引
        foreach ($lines as $line) {
            if (trim($line) === '') { continue; }
            $cells = str_getcsv($line);
            foreach ($cells as $k => $v) { $cells[$k] = trim((string)$v); }
            if ($header === null) {
                $header = $cells;
                foreach ($header as $k => $h) { $colIdx[$h] = $k; }
                $need = array('日期', 'Tag', '部門', '姓名', '原始保證金');
                $miss = array();
                foreach ($need as $n) { if (!isset($colIdx[$n])) { $miss[] = $n; } }
                if (!empty($miss)) {
                    $csvError = '資料檔欄位不符，缺少：'.implode('、', $miss)
                              .'（實際表頭：'.implode(', ', $header).'）';
                    break;
                }
                continue;
            }
            if (count($cells) < count($header)) { $csvSkipped++; continue; }

            // 日期正規化：支援 20260813 / 20260813.0 / 2026-08-13 / 2026/8/13 / 2026.8.13
            $dRaw = $cells[$colIdx['日期']];
            if (preg_match('/^(\d{8})(?:\.0+)?$/', $dRaw, $dm)) {
                $sortkey = $dm[1];                          // 純 8 碼（含 Excel 匯出的 .0 尾巴）
            } elseif (preg_match('/^(\d{4})[.\/-](\d{1,2})[.\/-](\d{1,2})$/', $dRaw, $dm)) {
                $sortkey = $dm[1]                           // 年/月/日（分隔符 - / .）明確組合
                         . str_pad($dm[2], 2, '0', STR_PAD_LEFT)
                         . str_pad($dm[3], 2, '0', STR_PAD_LEFT);
            } else {
                $ts = strtotime($dRaw);                     // 其餘格式交給 strtotime 最後嘗試
                if ($ts === false) { $csvSkipped++; continue; }
                $sortkey = date('Ymd', $ts);
            }
            if (!checkdate((int)substr($sortkey,4,2), (int)substr($sortkey,6,2), (int)substr($sortkey,0,4))) {
                $csvSkipped++; continue;                    // 8 碼但不是合法日期（防呆）
            }

            $amtRaw = str_replace(',', '', $cells[$colIdx['原始保證金']]);
            if ($amtRaw === '' || !is_numeric($amtRaw)) { $csvSkipped++; continue; }

            $csvRows[] = array(
                'sortkey' => $sortkey,
                'tag'     => $cells[$colIdx['Tag']],
                'dept'    => $cells[$colIdx['部門']],
                'name'    => $cells[$colIdx['姓名']],
                'amt'     => (float)$amtRaw,
            );
            if (!isset($dateLabels[$sortkey])) {
                $dt = DateTime::createFromFormat('Ymd', $sortkey);
                $dateLabels[$sortkey] = $dt ? $dt->format('Y/n/j') : $sortkey;
            }
        }
    }
}

// ── 日期清單（新 → 舊）＋選定日期（同 Investment_Meeting.php 邏輯：預設最新）──
krsort($dateLabels);
$dataDates = $dateLabels;   // value(Ymd) => label

$selecteddataDate = isset($_GET['data_date']) ? trim($_GET['data_date']) : '';
if ($selecteddataDate === '' || !isset($dataDates[$selecteddataDate])) {
    $mdKeys = array_keys($dataDates);
    // 注意：PHP 會把數字字串 key 自動轉成 int，這裡強制轉回字串，
    //       後續與 GET 參數（字串）及 sortkey（字串）做 === 比較才會成立
    $selecteddataDate = isset($mdKeys[0]) ? (string)$mdKeys[0] : '';  // 預設取最新一筆（已依日期倒序排列）
}
$currentdataLabel = ($selecteddataDate !== '' && isset($dataDates[$selecteddataDate]))
    ? $dataDates[$selecteddataDate] : '無資料';

 echo '<body>';
echo '<div id="top-header">';
echo '  <div class="brand">POS<span>Monitor</span> &nbsp;/&nbsp;原始保證金彙總</div>';
echo '  <div class="header-right">';
echo '    <div class="header-data-date">資料日期：<strong>'.htmlspecialchars($currentdataLabel).'</strong></div>';
echo '    <div class="header-meta" id="live-clock"></div>';
echo '  </div>';
echo '</div>';

echo '</nav>';  // close sidebar
echo '<div id="main-content">';
echo '<div id="page-title"><h1>原始保證金彙總</h1><span class="subtitle">Initial Margin</span></div>';
echo '<div class="page-note">單位：台幣元　｜　點擊列首 ⊟ / ⊞ 可摺疊或展開明細列</div>';

// ── 資料檔錯誤（防呆：明確顯示，不留白畫面）──
if ($csvError !== '') {
    echo '<div style="background:#fff3cd;border:2px solid #d97706;color:#7c2d12;'
       . 'padding:16px;border-radius:8px;margin:16px 0;font-size:15px;">'
       . '<b>資料讀取失敗：</b><br>'.htmlspecialchars($csvError).'</div>';
    echo '</div></div>';  // main-content, layout
    if ($conn) { sqlsrv_close($conn); }
    echo '</body></html>';
    exit;
}

// ── 資料日期下拉選單（$dataDates、$selecteddataDate 已於上方建立）──
echo '<form method="get" action="" class="data-filter">';
echo '  <label for="data_date">資料日期：</label>';
echo '  <select name="data_date" id="data_date">';
foreach ($dataDates as $val => $lab) {
    $val = (string)$val;   // key 轉回字串，selected 比對才會成立
    $sel = ($val === $selecteddataDate) ? ' selected' : '';
    echo '<option value="'.htmlspecialchars($val).'"'.$sel.'>'.htmlspecialchars($lab).'</option>';
}
echo '  </select>';
echo '  <button type="submit" class="btn-query">送出</button>';
echo '</form>';

if ($csvSkipped > 0) {
    echo '<div class="page-note">提醒：資料檔中有 '.$csvSkipped.' 列因欄位不足或金額非數字而未納入。</div>';
}

// ── 篩選選定日期 → 建立樞紐：部門 ▸ 姓名 × Tag ──────────────
$pivot     = array();   // dept => name => tag => 金額加總
$tagSet    = array();   // 出現過的 Tag（僅限選定日期）
foreach ($csvRows as $r) {
    if ($r['sortkey'] !== $selecteddataDate) { continue; }
    $dept = ($r['dept'] !== '') ? $r['dept'] : '(未填部門)';
    $name = ($r['name'] !== '') ? $r['name'] : '(未填姓名)';
    $tag  = ($r['tag']  !== '') ? $r['tag']  : '(未填Tag)';
    if (!isset($pivot[$dept]))               { $pivot[$dept] = array(); }
    if (!isset($pivot[$dept][$name]))        { $pivot[$dept][$name] = array(); }
    if (!isset($pivot[$dept][$name][$tag]))  { $pivot[$dept][$name][$tag] = 0; }
    $pivot[$dept][$name][$tag] += $r['amt'];
    $tagSet[$tag] = true;
}

// ── 欄位順序：期貨自營商固定放第一欄（緊接部門/姓名），其餘 Tag 照排序 ──
$tagCols = array_keys($tagSet);
sort($tagCols);
$mgSelfIdx = array_search('期貨自營商', $tagCols, true);
if ($mgSelfIdx !== false) {
    unset($tagCols[$mgSelfIdx]);
    array_unshift($tagCols, '期貨自營商');
}

// ── 部門順序：沿用既有部門排序，未列到的接在後面 ──
$deptOrder = array('自營部', '衍生商品部', '計量交易部', '債券交易部', '債券承銷部', '債券商品部');
$deptSorted = array();
foreach ($deptOrder as $d) { if (isset($pivot[$d])) { $deptSorted[] = $d; } }
foreach ($pivot as $d => $x) { if (!in_array($d, $deptSorted, true)) { $deptSorted[] = $d; } }

// ── 共用：數字格式化（原始保證金為台幣元，整數千分位；無值 → 空白格）──
function mg_fmt($v, $hasValue) {
    if (!$hasValue) { return '<td></td>'; }
    $cls = ($v < 0) ? ' class="pv-neg"' : '';
    return '<td'.$cls.'>'.number_format($v, 0).'</td>';
}

// ── 輸出樞紐分析表：部門 ▸ 姓名 × Tag ─────────────────────
echo '<div class="section-block">';
echo '<div class="section-header"><h2>原始保證金彙總表</h2><div class="section-divider"></div><span class="section-badge">部門 × 期貨商</span></div>';
echo '<div class="table-card"><div class="pv-scroll">';
echo '<table class="pivot-table"><thead><tr><th>部門／姓名</th>';
foreach ($tagCols as $c) { echo '<th>'.htmlspecialchars($c).'</th>'; }
echo '<th>總計</th>';
echo '</tr></thead><tbody>';

$pv_initial_collapsed = array();   // 預設全部「摺疊」：下方部門迴圈會把每個部門 id 加進來
$grand = array();                  // tag => 總計
$grandAll = 0;

foreach ($deptSorted as $dept) {
    // 修改 2：姓名依「總計」欄由大到小排序
    $nameTotals = array();
    foreach ($pivot[$dept] as $name => $tv) {
        $s = 0;
        foreach ($tv as $v) { $s += $v; }
        $nameTotals[$name] = $s;
    }
    arsort($nameTotals);
    $names = array_keys($nameTotals);

    // 部門小計
    $deptTot = array();
    $deptAll = 0;
    foreach ($pivot[$dept] as $name => $tv) {
        foreach ($tv as $t => $v) {
            if (!isset($deptTot[$t])) { $deptTot[$t] = 0; }
            $deptTot[$t] += $v;
            $deptAll     += $v;
            if (!isset($grand[$t])) { $grand[$t] = 0; }
            $grand[$t]   += $v;
            $grandAll    += $v;
        }
    }

    $id = 'd_'.substr(md5($dept), 0, 10);
    $pv_initial_collapsed[] = $id;   // 修改 1：預設摺疊此部門

    // ── 部門列（階層一，可收合；預設摺疊故按鈕顯示＋）──
    echo '<tr class="pv-lv0">';
    echo '<td class="pv-label">';
    echo '<button type="button" class="pv-toggle" id="btn_'.$id.'" onclick="togglePivotRow(\''.$id.'\')">＋</button>';
    echo htmlspecialchars($dept).'</td>';
    foreach ($tagCols as $t) { echo mg_fmt(isset($deptTot[$t]) ? $deptTot[$t] : 0, isset($deptTot[$t])); }
    echo mg_fmt($deptAll, true);
    echo '</tr>';

    // ── 姓名列（階層二）──
    foreach ($names as $name) {
        $tv = $pivot[$dept][$name];
        $rowAll = 0;
        foreach ($tv as $v) { $rowAll += $v; }
        echo '<tr class="pv-lv1" data-anc="'.$id.'" style="display:none">';
        echo '<td class="pv-label"><span class="pv-leaf-spacer"></span>'.htmlspecialchars($name).'</td>';
        foreach ($tagCols as $t) { echo mg_fmt(isset($tv[$t]) ? $tv[$t] : 0, isset($tv[$t])); }
        echo mg_fmt($rowAll, true);
        echo '</tr>';
    }
}

// ── 總計列 ──
echo '<tr class="pv-total"><td class="pv-label"><span class="pv-leaf-spacer"></span>總計</td>';
foreach ($tagCols as $t) { echo mg_fmt(isset($grand[$t]) ? $grand[$t] : 0, isset($grand[$t])); }
echo mg_fmt($grandAll, true);
echo '</tr>';

echo '</tbody></table>';
echo '</div></div></div>'; // pv-scroll, table-card, section-block

if (empty($pivot)) {
    echo '<div class="table-card"><div class="top5-empty">所選日期（'
       . htmlspecialchars($currentdataLabel).'）無任何資料。</div></div>';
}

if (!$conn) { echo '<div class="page-note">資料庫連線失敗（權限檢查用）：'.htmlspecialchars($serverName).'</div>'; }

echo '</div>';  // main-content
echo '</div>';  // layout

$initialCollapsedJs = '';
foreach ($pv_initial_collapsed as $cid) {
    $initialCollapsedJs .= 'window.pivotCollapsed["'.$cid.'"] = true;'."\n";
}

echo '<script>
function applyPivotVisibility(){
  document.querySelectorAll("tr[data-anc]").forEach(function(tr){
    var anc = tr.getAttribute("data-anc");
    var ancestors = anc ? anc.split(",").filter(Boolean) : [];
    var hidden = ancestors.some(function(a){ return window.pivotCollapsed && window.pivotCollapsed[a]; });
    tr.style.display = hidden ? "none" : "";
  });
}
function togglePivotRow(id){
  window.pivotCollapsed = window.pivotCollapsed || {};
  window.pivotCollapsed[id] = !window.pivotCollapsed[id];
  var btn = document.getElementById("btn_"+id);
  if (btn) { btn.textContent = window.pivotCollapsed[id] ? "＋" : "－"; }
  applyPivotVisibility();
}
window.pivotCollapsed = window.pivotCollapsed || {};
'.$initialCollapsedJs.'
applyPivotVisibility();
</script>';

// Close the connection.



if ($conn) { sqlsrv_close($conn); }



?>

 </body>

</html>
