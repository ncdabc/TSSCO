<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>投資溝通協調會議</title>
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/myBtn.css">
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/huBtn20180110.css">
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/HuTable.css">
  <link rel="stylesheet" href="http://172.24.26.42:80/myCss/myDiv20180331.css">
  <script src="plotly-latest.min.js"></script>
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
      background: #ED7D31 !important;
      border-right: 1px solid rgba(255,255,255,0.14) !important; border-bottom: none !important;
      position: sticky; top: 0; z-index: 2;
    }
    .pivot-table th:first-child {
      text-align: left; position: sticky; left: 0; z-index: 3; background: #ED7D31 !important;
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
    .pv-total td { font-weight: 700 !important; background: #ED7D31 !important; color: #fff !important; border-top: 2px solid var(--border-strong) !important; }
    .pv-total td.pv-label { background: #ED7D31 !important; color: #fff !important; }
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
      background: #ED7D31 !important; color: #fff !important; white-space: nowrap;
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
// ── 資料庫連線 & 資料日期清單（提前處理，供右上角與下拉選單使用）──
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


// ── 權限 ──────────────────────────────────────────

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


$dataDates = array();  // value(Y-m-d) => label(顯示用)
if ($conn) {
    $mdSql = "select distinct 資料日期 from [MDoutput].[dbo].[投資溝通協調會議_Table] where 資料日期 is not null order by 資料日期 desc";
    $mdRes = sqlsrv_query($conn, $mdSql);
    if ($mdRes) {
        while ($mdRow = sqlsrv_fetch_array($mdRes, SQLSRV_FETCH_ASSOC)) {
            $mdVal = $mdRow['資料日期'];
            if ($mdVal instanceof DateTime) {
                $val = $mdVal->format('Y-m-d');
                $lab = $mdVal->format('Y/n/j');
            } else {
                $val = trim((string)$mdVal);
                $lab = $val;
            }
            if ($val !== '' && !isset($dataDates[$val])) { $dataDates[$val] = $lab; }
        }
    }
}

$selecteddataDate = isset($_GET['data_date']) ? trim($_GET['data_date']) : '';
if ($selecteddataDate === '' || !isset($dataDates[$selecteddataDate])) {
    $mdKeys = array_keys($dataDates);
    $selecteddataDate = isset($mdKeys[0]) ? $mdKeys[0] : '';  // 預設取最新一筆（已依日期倒序排列）
}
$currentdataLabel = ($selecteddataDate !== '' && isset($dataDates[$selecteddataDate]))
    ? $dataDates[$selecteddataDate] : '無資料';

 echo '<body>';
echo '<div id="top-header">';
echo '  <div class="brand">POS<span>Monitor</span> &nbsp;/&nbsp;投資溝通協調會議</div>';
echo '  <div class="header-right">';
echo '    <div class="header-data-date">資料日期：<strong>'.htmlspecialchars($currentdataLabel).'</strong></div>';
echo '    <div class="header-meta" id="live-clock"></div>';
echo '  </div>';
echo '</div>';


if(!empty($_SERVER['HTTP_CLIENT_IP'])){
   $myip = $_SERVER['HTTP_CLIENT_IP'];
}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
   $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
   $myip= $_SERVER['REMOTE_ADDR'];
}
/*
<a class="nav-btn accent" href="http://172.24.26.42:80/Future_Warning.php">期貨警示</a>
<a class="nav-btn accent" href="http://172.24.26.42:80/PosMonitor_Warrant.php">衍商權證</a>
<a class="nav-btn" href="http://172.24.26.42:80/CBAS_OPTION_limit.php">CBAS_ASO控管</a>
<a class="nav-btn" href="http://172.24.26.42:80/Bond_CBAS_check.php">CBAS折現率查詢</a> 
<a class="nav-btn" href="http://172.24.26.42:80/Cht_Deri_IndexRet.php">日指標報酬率</a>
 <a class="nav-btn" href="http://172.24.26.42:80/Cht_Deri_Button.php">內網頁面權限統計</a>
 <a class="nav-btn" href="http://172.24.26.42:80/Cht_Deri_Button_outside.php">外網權限表</a>
<a class="nav-btn" href="http://172.24.26.42:80/Country_Limit.php">國家風險限額</a>
<a class="nav-btn" href="http://172.24.26.42:80/dividendusa.php">美股除息資訊</a>
<a class="nav-btn" href="http://172.24.26.42:80/PosMonitor_AccountRemain.php">外幣交易帳戶餘額查詢</a>
<a class="nav-btn" href="http://172.24.26.42:80/Cht_QuarterlyTurnoverRatio.php">季周轉倍數</a>

<a class="nav-btn accent" href="http://172.24.26.42:80/DayEndReport.php">盤後報表簽核</a>
<a class="nav-btn accent" href="http://172.24.26.42:80/DayEndReportSignRecord.php">盤後報表簽核紀錄</a>
<a class="nav-btn" href="http://172.24.26.42:80/PosMonitor_RealTimePLMATnew.php">即時損益MAT預警</a>
<a class="nav-btn" href="http://172.24.26.42:80/PosMonitor_RealTimeGreeks.php">即時風險值預警</a>
<a class="nav-btn" href="http://172.24.26.42:80/Predict_Exdiv_Index.php">除息點數估計</a>
<a class="nav-btn" href="http://172.24.26.42:80/Cht_Deri_DailyPLReport.php">單檔區間日損益</a>

<a class="nav-btn" href="http://172.24.26.42:80/PosMonitor_RemainDetail.php">交易員剩餘金額明細</a>
<a class="nav-btn" href="http://172.24.26.42:80/MarginRequirement_Trader.php">期貨保證金表</a>
<a class="nav-btn" href="http://172.24.26.42:80/TSSCO_fut_pos.php">母帳保證金</a>
<a class="nav-btn" href="http://172.24.26.42:80/PosMonitor_ViewUpload_FFRule.php">海期交易所重要規範</a>
<a class="nav-btn accent" href="http://172.24.26.42:80/TraderSPWeb.php">交易員網頁區</a>
<a class="nav-btn accent" href="http://172.24.26.42:80/mdrequisition_insert_v2.php">中台需求申請單</a>
<a class="nav-btn" href="http://172.24.26.42:80/Cht_Bond_SecUnd.php">承銷期間案件</a>


if($myip=='172.24.26.106' or $myip=='172.24.26.101' or $myip=='172.24.26.195' or $myip=='172.24.26.102' or $myip=='172.24.26.42'   or  $myip=='172.24.26.128' or  $myip=='172.24.26.167' or  $myip=='172.24.26.105' or  $myip=='172.24.26.109'){ #or $myip=='172.24.26.142'
?>
<a class="nav-btn accent" href="http://172.24.26.42:80/PosMonitor_DeriTrade_InvestTrustLS.php">投信強弱勢策略檢視</a>

<?php
}

*/


//echo '<META http-equiv = "Refresh" content = "180">';
//date_default_timezone_set("Etc/GMT-8");
//echo date("Y-m-d H:i:s");


//echo date("Y-m-d H:i:s",time()+8*60*60);
//解決時差另外一種方法

echo '</nav>';  // close sidebar
echo '<div id="main-content">';
$switchUrl = 'Investment_Meeting_U.php'.($selecteddataDate !== '' ? '?data_date='.urlencode($selecteddataDate) : '');
echo '<div id="page-title"><h1>投資溝通協調會議</h1><span class="subtitle">Investment Meeting</span><a href="'.htmlspecialchars($switchUrl).'" class="btn-title-nav">← 回「投資溝通協調會議(by標的)」</a></div>';
echo '<div class="page-note">單位：台幣億元　｜　點擊列首 ⊟ / ⊞ 可摺疊或展開明細列</div>';

// ── 資料日期下拉選單（$dataDates、$selecteddataDate 已於頁首建立）──
echo '<form method="get" action="" class="data-filter">';
echo '  <label for="data_date">資料日期：</label>';
echo '  <select name="data_date" id="data_date">';
foreach ($dataDates as $val => $lab) {
    $sel = ($val === $selecteddataDate) ? ' selected' : '';
    echo '<option value="'.htmlspecialchars($val).'"'.$sel.'>'.htmlspecialchars($lab).'</option>';
}
echo '  </select>';
echo '  <button type="submit" class="btn-query">送出</button>';
echo '</form>';

// ── 讀取資料（僅撈取所選資料日期）───────────────────────
$rows = array();
if ($conn && $selecteddataDate !== '') {
    $sql = "select 日期,Tag1,Tag2,Tag3,Tag4,策略,[金額(佰萬)],部位分類
            from [MDoutput].[dbo].[投資溝通協調會議_Table]
            where 資料日期 = CONVERT(date, ?)";
    $result = sqlsrv_query($conn, $sql, array($selecteddataDate));
} else {
    $result = false;
}

if ($result) {
    while ($r = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $rawDate = $r['日期'];
        if ($rawDate instanceof DateTime) {
            $dateLabel = $rawDate->format('Y/n/j');
            $sortKey   = $rawDate->format('Ymd');
            $isSpecial = false;
        } else {
            $s  = trim((string)$rawDate);
            $ts = strtotime($s);
            if ($ts !== false && preg_match('/^\d{4}[-\/]\d{1,2}[-\/]\d{1,2}/', $s)) {
                $dateLabel = date('Y/n/j', $ts);
                $sortKey   = date('Ymd', $ts);
                $isSpecial = false;
            } else {
                $dateLabel = $s;      // 例如「月變動」
                $sortKey   = $s;
                $isSpecial = true;
            }
        }
        $rows[] = array(
            'date'      => $dateLabel,
            'sortkey'   => $sortKey,
            'special'   => $isSpecial,
            'tag1'      => (string)$r['Tag1'],
            'tag2'      => (string)$r['Tag2'],
            'tag3'      => (string)$r['Tag3'],
            'tag4'      => (string)$r['Tag4'],
            'strategy'  => (trim((string)$r['策略']) !== '') ? trim((string)$r['策略']) : '(無)',
            'amt'       => (float)$r['金額(佰萬)'],
            'pos'       => (string)$r['部位分類'],
        );
    }
}

// ── 決定日期欄位順序（特殊欄如「月變動」在前，其餘依日期由舊到新）──
$dateSeen = array();  // label => sortkey（僅記錄第一次出現）
$dateSpecial = array();
foreach ($rows as $r) {
    if (!isset($dateSeen[$r['date']])) {
        $dateSeen[$r['date']] = $r['sortkey'];
        $dateSpecial[$r['date']] = $r['special'];
    }
}
$specialCols = array();
$normalCols  = array();
foreach ($dateSeen as $label => $key) {
    if ($dateSpecial[$label]) { $specialCols[$label] = $key; }
    else { $normalCols[$label] = $key; }
}
asort($normalCols);
$colOrder = array_merge(array_keys($normalCols), array_keys($specialCols));
$normalColKeys = array_keys($normalCols);

// ── 建立 Tag1~Tag4~策略 五層樹狀彙總 ──────────────────────────
$tree = array();
foreach ($rows as $r) {
    $path = array($r['tag1'], $r['tag2'], $r['tag3'], $r['tag4'], $r['strategy']);
    $node = &$tree;
    foreach ($path as $key) {
        if (!isset($node[$key])) {
            $node[$key] = array('__order' => count($node), '__values' => array(), '__children' => array());
        }
        if (!isset($node[$key]['__values'][$r['date']])) { $node[$key]['__values'][$r['date']] = 0; }
        $node[$key]['__values'][$r['date']] += $r['amt'];
        $node = &$node[$key]['__children'];
    }
    unset($node);
}

// ── 建立 部位分類～策略 雙層樹狀彙總 ─────────────────────────
$posTree = array();
foreach ($rows as $r) {
    $path = array($r['pos'], $r['strategy']);
    $node = &$posTree;
    foreach ($path as $key) {
        if (!isset($node[$key])) {
            $node[$key] = array('__order' => count($node), '__values' => array(), '__children' => array());
        }
        if (!isset($node[$key]['__values'][$r['date']])) { $node[$key]['__values'][$r['date']] = 0; }
        $node[$key]['__values'][$r['date']] += $r['amt'];
        $node = &$node[$key]['__children'];
    }
    unset($node);
}

// ── 共用：數字格式化（佰萬 → 億，取至小數點第二位）───────────
function pv_fmt($v) {
    $v = round($v / 100, 2);
    $cls = ($v < 0) ? ' class="pv-neg"' : '';
    return '<td'.$cls.'>'.number_format($v, 2).'</td>';
}

// ── 月變動欄位：資料格維持白底，>0 加▲、<0 加▼（用 inline style 確保不受階層配色影響）──
function pv_fmt_delta($v) {
    $v = round($v / 100, 2);
    $arrow = '';
    if ($v > 0) { $arrow = '▲'; }
    elseif ($v < 0) { $arrow = '▼'; }
    $color = ($v < 0) ? '#c0392b' : '#0f172a';
    return '<td style="background:#ffffff !important;color:'.$color.' !important;">'.$arrow.number_format($v, 2).'</td>';
}
function pv_is_delta_col($c) { return $c === '月變動'; }

// ── 取得節點的「月變動」值；若無該欄，改用最近兩期日期相減 ──
$pv_delta_col = null;
$pv_prev_col  = null;
$pv_curr_col  = null;
foreach ($colOrder as $cc) { if (pv_is_delta_col($cc)) { $pv_delta_col = $cc; break; } }
if ($pv_delta_col === null && count($normalColKeys) >= 2) {
    $pv_prev_col = $normalColKeys[count($normalColKeys) - 2];
    $pv_curr_col = $normalColKeys[count($normalColKeys) - 1];
}
function pv_delta_of($values) {
    global $pv_delta_col, $pv_prev_col, $pv_curr_col;
    if ($pv_delta_col !== null) {
        return isset($values[$pv_delta_col]) ? (float)$values[$pv_delta_col] : 0;
    }
    if ($pv_prev_col !== null && $pv_curr_col !== null) {
        $p = isset($values[$pv_prev_col]) ? (float)$values[$pv_prev_col] : 0;
        $q = isset($values[$pv_curr_col]) ? (float)$values[$pv_curr_col] : 0;
        return $q - $p;
    }
    return 0;
}

// ── Tag2 自訂排序（依 Tag1 決定子項排序優先順序）─────────────
$tag2Order = array(
    '交易目的(市值)' => array('股權', '債票券'),
    '非交易目的'     => array('股權', 'FVPL債券', 'OCI債票券(市值)'),
);

// ── Tag1（第一個表格階層一）自訂排序 ─────────────────────
$tag1Order = array('交易目的(市值)' => 0, '非交易目的' => 1);

// ── 策略名稱依括號內部門自訂排序 ─────────────────────────
$strategyDeptOrder = array('自營部', '衍生商品部', '計量交易部', '債券交易部', '債券承銷部', '債券商品部');

// 擷取字串結尾括號內的文字（支援全形/半形括號），取不到則回傳空字串
function pv_extract_trailing_paren($s) {
    if (preg_match('/^\s*[\(（]\s*([^\(\)（）]*?)\s*[\)）]/u', $s, $m)) {
        return $m[1];
    }
    return '';
}

// ── 遞迴輸出樹狀列（帶展開/摺疊）──────────────────────────
// $collapseDepth：哪一層預設收合其子項（第一張表的策略層在depth=3之下，第二張表在depth=0之下）
$pv_initial_collapsed = array();
$pv_collapsed_set = array();
function pv_render_tree(&$html, $node, $colOrder, $tableId, $depth, $ancestors, $parentLabel = '', $collapseDepth = 3, $strategyDepth = null, $nameSortDepth = null, $equityCheckDepth = null) {
    global $tag1Order, $tag2Order, $pv_initial_collapsed, $pv_collapsed_set, $strategyDeptOrder;
    // ── 排序：一律依「月變動」絕對值由大到小 ──────────────────
    // 若要恢復 Tag1 自訂順序，把下面這段換回原本的 if/elseif 判斷即可
    uasort($node, function($a, $b) {
        $da = abs(pv_delta_of($a['__values']));
        $db = abs(pv_delta_of($b['__values']));
        if ($da != $db) { return ($db > $da) ? 1 : -1; }
        return $a['__order'] - $b['__order'];   // 平手時維持原始順序
    });
    foreach ($node as $label => $data) {
        $idSrc = $tableId.'|'.$depth.'|'.$label.'|'.implode('/', $ancestors);
        $id    = $tableId.'_'.substr(md5($idSrc), 0, 10);
        $hasChildren = !empty($data['__children']);
        $collapseByDefault = $hasChildren && (is_array($collapseDepth) ? in_array($depth, $collapseDepth, true) : $depth === $collapseDepth);
        $isStrategyRow = ($strategyDepth !== null && $depth === $strategyDepth);
        $ancAttr = implode(',', $ancestors);
        $eqClass = '';
        if ($equityCheckDepth !== null && $depth === $equityCheckDepth) {
            $eqClass = (strpos($label, '股權') !== false) ? ' pv-eq' : ' pv-noneq';
        }
        $lvClass = 'pv-lv'.min($depth, 4).($isStrategyRow ? ' pv-strategy' : '').$eqClass;
        $hiddenInit = false;
        foreach ($ancestors as $aid) {
            if (isset($pv_collapsed_set[$aid])) { $hiddenInit = true; break; }
        }

        $html .= '<tr class="'.$lvClass.'" data-anc="'.$ancAttr.'"'.($hiddenInit ? ' style="display:none"' : '').'>';
        $html .= '<td class="pv-label">';
        if ($hasChildren) {
            $btnGlyph = $collapseByDefault ? '＋' : '－';
            $html .= '<button type="button" class="pv-toggle" id="btn_'.$id.'" onclick="togglePivotRow(\''.$id.'\')">'.$btnGlyph.'</button>';
            if ($collapseByDefault) { $pv_initial_collapsed[] = $id; $pv_collapsed_set[$id] = true; }
        } else {
            $html .= '<span class="pv-leaf-spacer"></span>';
        }
        $html .= htmlspecialchars($label).'</td>';
        foreach ($colOrder as $c) {
            $v = isset($data['__values'][$c]) ? $data['__values'][$c] : 0;
            $html .= pv_is_delta_col($c) ? pv_fmt_delta($v) : pv_fmt($v);
        }
        $html .= '</tr>';

        if ($hasChildren) {
            $childAncestors = array_merge($ancestors, array($id));
            pv_render_tree($html, $data['__children'], $colOrder, $tableId, $depth + 1, $childAncestors, $label, $collapseDepth, $strategyDepth, $nameSortDepth, $equityCheckDepth);
        }
    }
}

// ── 輸出第一個樞紐分析表：Tag1~Tag4 ──────────────────────
echo '<div class="section-block">';
echo '<div class="section-header"><h2>交易目的別彙總表</h2><div class="section-divider"></div><span class="section-badge">交易目的別</span></div>';
echo '<div class="table-card"><div class="pv-scroll">';
echo '<table class="pivot-table pv-table-tag"><thead><tr><th>資料日期</th>';
foreach ($colOrder as $c) { echo '<th>'.htmlspecialchars($c).'</th>'; }
echo '</tr></thead><tbody>';

$html1 = '';
pv_render_tree($html1, $tree, $colOrder, 'p1', 0, array(), '', array(2, 3), 4, 2, 1);
echo $html1;

// 總計列
echo '<tr class="pv-total"><td class="pv-label"><span class="pv-leaf-spacer"></span>總計</td>';
foreach ($colOrder as $c) {
    $sum = 0;
    foreach ($tree as $top) { $sum += isset($top['__values'][$c]) ? $top['__values'][$c] : 0; }
    echo pv_is_delta_col($c) ? pv_fmt_delta($sum) : pv_fmt($sum);
}
echo '</tr>';

echo '</tbody></table>';
echo '</div></div></div>'; // pv-scroll, table-card, section-block

// ── 輸出第二個樞紐分析表：部位分類 ─────────────────────
echo '<div class="section-block">';
echo '<div class="section-header"><h2>部位分類彙總表</h2><div class="section-divider"></div><span class="section-badge">部位分類</span></div>';
echo '<div class="table-card"><div class="pv-scroll">';
echo '<table class="pivot-table pv-table-pos"><thead><tr><th>資料日期</th>';
foreach ($colOrder as $c) { echo '<th>'.htmlspecialchars($c).'</th>'; }
echo '</tr></thead><tbody>';

$html2 = '';
pv_render_tree($html2, $posTree, $colOrder, 'p2', 0, array(), '', 0, 1, null, 0);
echo $html2;

$posSum = array();
foreach ($posTree as $top) {
    foreach ($colOrder as $c) {
        if (!isset($posSum[$c])) { $posSum[$c] = 0; }
        $posSum[$c] += isset($top['__values'][$c]) ? $top['__values'][$c] : 0;
    }
}
echo '<tr class="pv-total"><td class="pv-label"><span class="pv-leaf-spacer"></span>總計</td>';
foreach ($colOrder as $c) {
    $v = isset($posSum[$c]) ? $posSum[$c] : 0;
    echo pv_is_delta_col($c) ? pv_fmt_delta($v) : pv_fmt($v);
}
echo '</tr>';

echo '</tbody></table>';
echo '</div></div></div>'; // pv-scroll, table-card, section-block

// ── 各分類「月變動」絕對值 Top 5 策略 ─────────────────────
// 分類 = Tag1 / Tag2；項目 = 策略
echo '<div class="section-block">';
echo '<div class="section-header"><h2>各分類「月變動」絕對值 Top 5 策略</h2>'
   . '<div class="section-divider"></div>'
   . '<span class="section-badge">TOP 5</span></div>';

$calcDelta = ($pv_delta_col === null && $pv_prev_col !== null && $pv_curr_col !== null);

if (empty($rows)) {
    echo '<div class="table-card"><div class="top5-empty">'
       . '本次查詢無資料，無法計算 Top 5。</div></div>';
} elseif ($pv_delta_col === null && !$calcDelta) {
    echo '<div class="table-card"><div class="top5-empty">'
       . '找不到「月變動」欄位，且日期欄位不足兩期，無法計算變動。目前欄位：'
       . htmlspecialchars(implode('、', $colOrder))
       . '</div></div>';
} else {
try {

    // 聚合：分類 => 策略 => 各日期欄位金額
    $t5agg = array();
    foreach ($rows as $r) {
        $g = $r['tag1'].'||'.$r['tag2'];
        $u = trim($r['strategy']);
        if ($u === '') { $u = '(無)'; }
        if (!isset($t5agg[$g])) {
            $t5agg[$g] = array('tag1' => $r['tag1'], 'tag2' => $r['tag2'], 'items' => array());
        }
        if (!isset($t5agg[$g]['items'][$u])) { $t5agg[$g]['items'][$u] = array(); }
        if (!isset($t5agg[$g]['items'][$u][$r['date']])) { $t5agg[$g]['items'][$u][$r['date']] = 0; }
        $t5agg[$g]['items'][$u][$r['date']] += $r['amt'];
    }

    // 分類本身也依「月變動」絕對值由大到小
    $t5sum = array();
    foreach ($t5agg as $k => $grp) {
        $tot = array();
        foreach ($grp['items'] as $vals) {
            foreach ($vals as $col => $amt) {
                if (!isset($tot[$col])) { $tot[$col] = 0; }
                $tot[$col] += $amt;
            }
        }
        $t5sum[$k] = abs(pv_delta_of($tot));
    }
    uksort($t5agg, function($a, $b) use ($t5sum) {
        $va = isset($t5sum[$a]) ? $t5sum[$a] : 0;
        $vb = isset($t5sum[$b]) ? $t5sum[$b] : 0;
        if ($va == $vb) { return strcmp($a, $b); }
        return ($vb > $va) ? 1 : -1;
    });

    echo '<div class="top5-grid">';

    foreach ($t5agg as $grp) {

        $ranked = array();
        foreach ($grp['items'] as $nm => $vals) {
            $ranked[] = array('name' => $nm, 'delta' => pv_delta_of($vals), 'vals' => $vals);
        }
        usort($ranked, function($a, $b) {
            $da = abs($a['delta']); $db = abs($b['delta']);
            if ($da == $db) { return strcmp($a['name'], $b['name']); }
            return ($db > $da) ? 1 : -1;
        });
        $ranked = array_slice($ranked, 0, 5);

        echo '<div class="top5-card">';
        echo '<div class="top5-card-head"><span>'
           . htmlspecialchars($grp['tag1']).' &rsaquo; '.htmlspecialchars($grp['tag2'])
           . '</span><span class="t5-sub">TOP '.count($ranked).'</span></div>';

        if (empty($ranked)) {
            echo '<div class="top5-empty">此分類無資料。</div>';
        } else {
            echo '<table class="top5-table"><thead><tr>';
            echo '<th class="t5-rank">#</th><th class="t5-name">策略</th>';
            foreach ($colOrder as $cc) { echo '<th>'.htmlspecialchars($cc).'</th>'; }
            if ($calcDelta) { echo '<th>月變動</th>'; }
            echo '</tr></thead><tbody>';

            $rank = 0;
            foreach ($ranked as $item) {
                $rank++;
                $badgeCls = ($rank <= 3) ? ' r'.$rank : '';
                echo '<tr>';
                echo '<td class="t5-rank"><span class="t5-badge'.$badgeCls.'">'.$rank.'</span></td>';
                echo '<td class="t5-name">'.htmlspecialchars($item['name']).'</td>';
                foreach ($colOrder as $cc) {
                    $vv = isset($item['vals'][$cc]) ? $item['vals'][$cc] : 0;
                    echo pv_is_delta_col($cc) ? pv_fmt_delta($vv) : pv_fmt($vv);
                }
                if ($calcDelta) { echo pv_fmt_delta($item['delta']); }
                echo '</tr>';
            }
            echo '</tbody></table>';
        }
        echo '</div>'; // top5-card
    }

    echo '</div>';  // top5-grid

} catch (\Throwable $ex) {
    echo '<div style="background:#fff3cd;border:2px solid #d97706;color:#7c2d12;'
       . 'padding:16px;border-radius:8px;margin:16px 0;font-size:15px;">'
       . '<b>Top5 區塊發生錯誤：</b><br>'
       . htmlspecialchars($ex->getMessage())
       . '<br><small>第 '.$ex->getLine().' 行</small></div>';
}
}

echo '</div>';  // section-block

if (!$conn) { echo '<div class="page-note">資料庫連線失敗：'.htmlspecialchars($serverName).'</div>'; }

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

