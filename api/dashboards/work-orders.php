<?php
/* Work Order Dashboard */
sample_notice('work-orders.php');

kpis([
    ['label' => 'Open work orders',    'value' => '187'],
    ['label' => 'Completed this month','value' => '642'],
    ['label' => 'Overdue',             'value' => '23', 'note' => '-9 vs last week', 'trend' => 'up'],
    ['label' => 'Avg completion time', 'value' => '2.6 days'],
]);

echo '<div class="grid-2">';
chart_panel('woCat', 'Open work orders by category', 'bar',
    ['Plumbing', 'HVAC', 'Electrical', 'Appliance', 'Pest control', 'General'],
    [['label' => 'Open', 'data' => [46, 38, 21, 29, 14, 39]]]);
chart_panel('woTrend', 'Created vs completed, last 6 weeks', 'line',
    ['W1', 'W2', 'W3', 'W4', 'W5', 'W6'],
    [
        ['label' => 'Created',   'data' => [158, 171, 149, 166, 160, 172]],
        ['label' => 'Completed', 'data' => [150, 168, 161, 158, 170, 165]],
    ]);
echo '</div>';

table_panel('Overdue work orders',
    ['Work order', 'Property', 'Unit', 'Category', 'Days open'],
    [
        ['WO-55812', 'Property B', '214', 'HVAC',      '9'],
        ['WO-55840', 'Property A', '108', 'Plumbing',  '7'],
        ['WO-55877', 'Property C', '322', 'Appliance', '6'],
        ['WO-55901', 'Property D', '017', 'Electrical','5'],
    ]);
