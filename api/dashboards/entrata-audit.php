<?php
/* Entrata Dashboard Audit */
sample_notice('entrata-audit.php');

kpis([
    ['label' => 'Issues found',     'value' => '96'],
    ['label' => 'Resolved',         'value' => '61', 'note' => '63.5%'],
    ['label' => 'Open',             'value' => '35'],
    ['label' => 'High priority',    'value' => '8',  'note' => 'Needs action this week', 'trend' => 'down'],
]);

echo '<div class="grid-2">';
chart_panel('auType', 'Issues by type', 'bar',
    ['Missing lease dates', 'Wrong rent amount', 'Duplicate resident', 'Unit status mismatch', 'Missing contact info'],
    [['label' => 'Issues', 'data' => [22, 17, 9, 26, 22]]]);
chart_panel('auProp', 'Open issues by property', 'doughnut',
    ['Property A', 'Property B', 'Property C', 'Property D'],
    [['label' => 'Open issues', 'data' => [11, 7, 12, 5]]]);
echo '</div>';

table_panel('Open audit items',
    ['Issue', 'Property', 'Record', 'Priority', 'Owner'],
    [
        ['Unit status mismatch', 'Property C', 'Unit 305',     'High',   'Site manager'],
        ['Wrong rent amount',    'Property A', 'Lease 88214',  'High',   'Accounting'],
        ['Missing lease dates',  'Property B', 'Lease 87650',  'Medium', 'Leasing'],
        ['Duplicate resident',   'Property D', 'Resident 4471','Low',    'Leasing'],
    ]);
