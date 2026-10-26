<?php
/*
 * Page layout: <head>, styles, home page, dashboard header and footer.
 * Change colors in the :root block below.
 */

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function page_start($title) {
    global $SITE_NAME;
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?> | <?= e($SITE_NAME) ?> Dashboards</title>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📊</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <style>
    :root {
      --ink:      #1d2b2a;
      --ink-soft: #2c3e3c;
      --moss:     #4f7a63;
      --moss-lt:  #e4eee8;
      --paper:    #f3f5f2;
      --surface:  #ffffff;
      --text:     #1f2726;
      --muted:    #5f6b69;
      --line:     #dde3df;
      --warn-bg:  #fbf3e2;
      --warn:     #7a5a12;
    }
    * { box-sizing: border-box; }
    html, body { margin: 0; }
    body {
      font-family: "Public Sans", "Segoe UI", Arial, sans-serif;
      background: var(--paper);
      color: var(--text);
      line-height: 1.5;
      min-height: 100vh;
    }
    a { color: inherit; }
    :focus-visible { outline: 2px solid var(--moss); outline-offset: 2px; }

    /* ---------- Home ---------- */
    .home-head {
      background: var(--ink);
      color: #eef3f1;
      padding: 56px 24px 72px;
    }
    .wrap { max-width: 1180px; margin: 0 auto; }
    .home-head h1 { margin: 0; font-size: clamp(30px, 5vw, 46px); font-weight: 700; letter-spacing: -0.02em; line-height: 1.1; }
    .home-head p  { margin: 10px 0 0; color: #a9bab4; font-size: 17px; }

    .tiles {
      list-style: none;
      margin: -40px auto 48px;
      padding: 0 24px;
      max-width: 1228px;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 16px;
    }
    .tile {
      display: flex;
      flex-direction: column;
      height: 100%;
      padding: 22px 22px 20px;
      background: var(--surface);
      border: 1px solid var(--line);
      border-top: 4px solid var(--moss);
      border-radius: 6px;
      text-decoration: none;
    }
    .tile:hover { border-color: var(--moss); background: #fbfdfc; }
    .tile h2 { margin: 0 0 6px; font-size: 18px; font-weight: 600; }
    .tile p  { margin: 0 0 18px; color: var(--muted); font-size: 14px; }
    .tile .open { margin-top: auto; font-size: 14px; font-weight: 600; color: var(--moss); }

    /* ---------- Dashboard page ---------- */
    .bar {
      position: sticky; top: 0; z-index: 10;
      background: var(--ink);
      color: #eef3f1;
    }
    .bar .wrap {
      display: flex; align-items: center; gap: 16px; flex-wrap: wrap;
      padding: 12px 24px;
    }
    .back {
      display: inline-flex; align-items: center; gap: 6px;
      color: #cfdcd6; text-decoration: none; font-size: 14px; font-weight: 500;
      padding: 6px 10px; border-radius: 6px;
    }
    .back:hover { background: var(--ink-soft); color: #fff; }
    .bar h1 { margin: 0; font-size: 18px; font-weight: 600; flex: 1; min-width: 160px; }
    .switch {
      font: inherit; font-size: 14px;
      background: var(--ink-soft); color: #eef3f1;
      border: 1px solid #44595a; border-radius: 6px; padding: 7px 10px;
    }

    .content { max-width: 1180px; margin: 0 auto; padding: 24px; }
    .lead { margin: 0 0 20px; color: var(--muted); }

    .notice {
      background: var(--warn-bg); color: var(--warn);
      border-radius: 6px; padding: 10px 14px; font-size: 14px; margin-bottom: 20px;
    }
    .notice code { font-size: 13px; }

    .kpis { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 20px; }
    .kpi { background: var(--surface); border: 1px solid var(--line); border-radius: 6px; padding: 16px 18px; }
    .kpi .label { font-size: 13px; color: var(--muted); }
    .kpi .value { font-size: 28px; font-weight: 700; letter-spacing: -0.01em; margin-top: 2px; }
    .kpi .note  { font-size: 13px; color: var(--muted); }
    .kpi .note.up   { color: #2f7a4b; }
    .kpi .note.down { color: #a3392f; }

    .grid-2 { display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 16px; margin-bottom: 20px; }
    .panel { background: var(--surface); border: 1px solid var(--line); border-radius: 6px; padding: 18px; margin-bottom: 20px; }
    .grid-2 .panel { margin-bottom: 0; }
    .panel h3 { margin: 0 0 12px; font-size: 16px; font-weight: 600; }
    .chart-box { position: relative; height: 280px; }

    .table-scroll { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    th, td { text-align: left; padding: 10px 12px; border-bottom: 1px solid var(--line); white-space: nowrap; }
    th { color: var(--muted); font-weight: 600; background: #f8faf9; }
    tr:last-child td { border-bottom: none; }

    .embed { width: 100%; height: calc(100vh - 64px); border: 0; display: block; background: var(--surface); }

    .empty {
      max-width: 520px; margin: 48px auto; padding: 32px; text-align: center;
      background: var(--surface); border: 1px dashed var(--line); border-radius: 6px;
    }
    .empty h2 { margin: 0 0 8px; font-size: 18px; }
    .empty p  { margin: 0; color: var(--muted); }
    .empty a  { color: var(--moss); font-weight: 600; }

    footer { text-align: center; color: var(--muted); font-size: 13px; padding: 24px; }

    @media (max-width: 640px) {
      .home-head { padding: 40px 20px 64px; }
      .tiles { padding: 0 16px; }
      .content { padding: 16px; }
      .grid-2 { grid-template-columns: 1fr; }
      .bar h1 { order: 3; flex-basis: 100%; }
      .switch { margin-left: auto; }
    }
  </style>
</head>
<body>
<?php
}

function page_end() {
    global $SITE_NAME;
    echo '<footer>' . e($SITE_NAME) . ' Dashboards</footer></body></html>';
}

/* Home page: one button per dashboard */
function render_home($dashboards) {
    global $SITE_NAME;
    ?>
  <header class="home-head">
    <div class="wrap">
      <h1><?= e($SITE_NAME) ?> Dashboards</h1>
      <p>Choose a dashboard to open.</p>
    </div>
  </header>
  <ul class="tiles">
    <?php foreach ($dashboards as $key => $d): ?>
      <li>
        <a class="tile" href="/<?= e($key) ?>">
          <h2><?= e($d['title']) ?></h2>
          <p><?= e($d['summary']) ?></p>
          <span class="open">Open dashboard</span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php
}

/* Top bar on every dashboard: back button, title, quick switcher */
function render_bar($current, $dashboards) {
    ?>
  <header class="bar">
    <div class="wrap">
      <a class="back" href="/">
        <svg width="16" height="16" viewBox="0 0 16 16" aria-hidden="true"><path d="M10 3 5 8l5 5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
        All dashboards
      </a>
      <h1><?= e($dashboards[$current]['title']) ?></h1>
      <label class="sr" for="switch" style="position:absolute;left:-9999px">Switch dashboard</label>
      <select id="switch" class="switch" onchange="location.href='/' + this.value">
        <?php foreach ($dashboards as $key => $d): ?>
          <option value="<?= e($key) ?>" <?= $key === $current ? 'selected' : '' ?>><?= e($d['title']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </header>
<?php
}
