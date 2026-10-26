<?php
/* Ticket Satisfaction Dashboard */
sample_notice('ticket-satisfaction.php');

kpis([
    ['label' => 'Average rating',     'value' => '4.3 / 5', 'note' => '+0.2 vs last month', 'trend' => 'up'],
    ['label' => 'Surveys answered',   'value' => '418',     'note' => '38% response rate'],
    ['label' => 'Satisfied (4–5)',    'value' => '81%'],
    ['label' => 'Unhappy (1–2)',      'value' => '27',      'note' => 'Follow-up needed', 'trend' => 'down'],
]);

echo '<div class="grid-2">';
chart_panel('tsDist', 'Ratings breakdown', 'bar',
    ['1 star', '2 stars', '3 stars', '4 stars', '5 stars'],
    [['label' => 'Responses', 'data' => [12, 15, 52, 128, 211]]]);
chart_panel('tsTrend', 'Average rating by month', 'line',
    ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    [['label' => 'Average rating', 'data' => [4.0, 4.1, 3.9, 4.2, 4.1, 4.3]]]);
echo '</div>';

table_panel('Recent low ratings',
    ['Ticket', 'Property', 'Category', 'Rating', 'Comment'],
    [
        ['TK-30211', 'Property B', 'HVAC',      '1', 'Took a week to fix'],
        ['TK-30245', 'Property A', 'Plumbing',  '2', 'Had to call twice'],
        ['TK-30260', 'Property C', 'Appliance', '2', 'Part still on order'],
    ]);
