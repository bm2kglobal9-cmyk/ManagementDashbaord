<?php
/* Marketing Dashboard */
sample_notice('marketing.php');

kpis([
    ['label' => 'Leads this month',  'value' => '1,284', 'note' => '+12% vs last month', 'trend' => 'up'],
    ['label' => 'Marketing spend',   'value' => '$18,600'],
    ['label' => 'Cost per lead',     'value' => '$14.49', 'note' => '-$1.20 vs last month', 'trend' => 'up'],
    ['label' => 'Cost per lease',    'value' => '$212',  'note' => '88 leases signed'],
]);

echo '<div class="grid-2">';
chart_panel('mkSource', 'Leads by source', 'doughnut',
    ['Website', 'ILS listings', 'Google Ads', 'Social media', 'Referral', 'Walk-in'],
    [['label' => 'Leads', 'data' => [412, 356, 228, 154, 82, 52]]]);
chart_panel('mkMonthly', 'Leads and leases by month', 'bar',
    ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
    [
        ['label' => 'Leads',  'data' => [980, 1102, 1240, 1185, 1146, 1284]],
        ['label' => 'Leases', 'data' => [71, 80, 94, 86, 79, 88]],
    ]);
echo '</div>';

table_panel('Campaign performance',
    ['Campaign', 'Spend', 'Leads', 'Leases', 'Cost per lease'],
    [
        ['Google Search – Brand', '$4,200', '228', '24', '$175'],
        ['ILS Premium Listing',   '$6,800', '356', '27', '$252'],
        ['Facebook Lookalike',    '$3,100', '154', '11', '$282'],
        ['Resident Referral',     '$1,500', '82',  '14', '$107'],
    ]);
