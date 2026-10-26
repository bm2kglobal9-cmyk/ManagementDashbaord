<?php
/*
 * Ashford Dashboards – main entry point.
 * Vercel sends every web address here (see vercel.json).
 *
 *   /                  → home page with a button for each dashboard
 *   /dq, /marketing…   → that dashboard
 *
 * You normally don't need to edit this file.
 * Add or remove dashboards in api/_lib/config.php.
 */

require __DIR__ . '/_lib/config.php';
require __DIR__ . '/_lib/layout.php';
require __DIR__ . '/_lib/components.php';

$key = strtolower(trim($_GET['d'] ?? '', "/ \t\n"));

/* ---------- Home page ---------- */
if ($key === '' || $key === 'index' || $key === 'home') {
    page_start('Home');
    render_home($DASHBOARDS);
    page_end();
    exit;
}

/* ---------- Unknown address ---------- */
if (!array_key_exists($key, $DASHBOARDS)) {      // only listed keys can load (security)
    http_response_code(404);
    page_start('Not found');
    echo '<div class="empty"><h2>This dashboard doesn\'t exist</h2>'
       . '<p>Check the address, or <a href="/">go back to all dashboards</a>.</p></div>';
    page_end();
    exit;
}

/* ---------- Dashboard page ---------- */
$dash = $DASHBOARDS[$key];
page_start($dash['title']);
render_bar($key, $DASHBOARDS);

if (!empty($dash['embed'])) {
    // Dashboard hosted elsewhere – shown inside the portal
    echo '<iframe class="embed" src="' . e($dash['embed']) . '" title="' . e($dash['title']) . '" loading="lazy"></iframe>';
} else {
    $file = __DIR__ . '/_dashboards/' . $key . '.php';
    echo '<main class="content">';
    echo '<p class="lead">' . e($dash['summary']) . '</p>';
    if (is_file($file)) {
        include $file;
    } else {
        echo '<div class="empty"><h2>This dashboard isn\'t set up yet</h2>'
           . '<p>Create <code>api/_dashboards/' . e($key) . '.php</code> and push to GitHub.</p></div>';
    }
    echo '</main>';
}

page_end();
