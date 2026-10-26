<?php
/* Central Screening Dashboard */
sample_notice('central-screening.php');

kpis([
    ['label' => 'Applications received', 'value' => '326'],
    ['label' => 'Approved',              'value' => '214', 'note' => '65.6%'],
    ['label' => 'Denied',                'value' => '58',  'note' => '17.8%'],
    ['label' => 'Avg decision time',     'value' => '1.8 days', 'note' => '-0.4 days vs last month', 'trend' => 'up'],
]);

echo '<div class="grid-2">';
chart_panel('scStatus', 'Applications by decision', 'doughnut',
    ['Approved', 'Approved with conditions', 'Denied', 'Pending'],
    [['label' => 'Applications', 'data' => [174, 40, 58, 54]]]);
chart_panel('scWeek', 'Applications by week', 'line',
    ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
    [
        ['label' => 'Received', 'data' => [78, 92, 81, 75]],
        ['label' => 'Decided',  'data' => [70, 84, 79, 39]],
    ]);
echo '</div>';

table_panel('Pending applications',
    ['Application', 'Property', 'Submitted', 'Waiting on'],
    [
        ['APP-10482', 'Property A', '21 Oct', 'Income documents'],
        ['APP-10491', 'Property C', '22 Oct', 'Background check'],
        ['APP-10503', 'Property B', '24 Oct', 'Guarantor form'],
        ['APP-10510', 'Property D', '25 Oct', 'Reviewer decision'],
    ]);
