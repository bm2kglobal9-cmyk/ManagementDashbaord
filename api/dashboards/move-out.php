<?php
/* Move-Out Dashboard */
sample_notice('move-out.php');

kpis([
    ['label' => 'Move-outs next 30 days', 'value' => '64'],
    ['label' => 'Move-outs this month',   'value' => '51'],
    ['label' => 'Units already pre-leased','value' => '29', 'note' => '45% of upcoming'],
    ['label' => 'Unpaid final balances',  'value' => '$22,840', 'note' => '17 accounts', 'trend' => 'down'],
]);

echo '<div class="grid-2">';
chart_panel('moReason', 'Move-out reasons', 'doughnut',
    ['Bought a home', 'Relocating for work', 'Rent increase', 'Need more space', 'Eviction', 'Other'],
    [['label' => 'Residents', 'data' => [14, 11, 9, 8, 3, 6]]]);
chart_panel('moTrend', 'Move-outs by month', 'bar',
    ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    [['label' => 'Move-outs', 'data' => [44, 58, 63, 55, 47, 51]]]);
echo '</div>';

table_panel('Upcoming move-outs',
    ['Property', 'Unit', 'Move-out date', 'Reason', 'Pre-leased'],
    [
        ['Property A', '112', '01 Nov', 'Relocating for work', 'Yes'],
        ['Property C', '407', '03 Nov', 'Bought a home',       'No'],
        ['Property B', '230', '05 Nov', 'Rent increase',       'Yes'],
        ['Property D', '021', '08 Nov', 'Need more space',     'No'],
    ]);
