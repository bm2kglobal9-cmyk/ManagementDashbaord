<?php
/* DQ (Delinquency) Dashboard
 * Replace the sample arrays below with real data (e.g. from the Entrata API).
 */
sample_notice('dq.php');

kpis([
    ['label' => 'Total delinquent balance', 'value' => '$184,250', 'note' => '-6.2% vs last month', 'trend' => 'up'],
    ['label' => 'Delinquent residents',     'value' => '142',      'note' => '8.4% of occupied units'],
    ['label' => 'Over 60 days',             'value' => '$61,900',  'note' => '+3.1% vs last month', 'trend' => 'down'],
    ['label' => 'Collected this month',     'value' => '$72,480',  'note' => '39% of opening balance'],
]);

echo '<div class="grid-2">';
chart_panel('dqAging', 'Balance by aging bucket', 'bar',
    ['0–30 days', '31–60 days', '61–90 days', '90+ days'],
    [['label' => 'Balance ($)', 'data' => [78400, 43950, 28700, 33200]]]);
chart_panel('dqTrend', 'Delinquent balance, last 6 months', 'line',
    ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    [['label' => 'Balance ($)', 'data' => [201000, 195400, 188900, 192300, 196400, 184250]]]);
echo '</div>';

table_panel('Delinquency by property',
    ['Property', 'Units', 'Delinquent', 'Balance', 'Over 60 days'],
    [
        ['Property A', '320', '38', '$48,900', '$15,200'],
        ['Property B', '280', '31', '$41,300', '$14,100'],
        ['Property C', '410', '44', '$57,650', '$19,800'],
        ['Property D', '190', '29', '$36,400', '$12,800'],
    ]);
