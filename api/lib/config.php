<?php
/*
 * DASHBOARD LIST
 * -----------------------------------------------------------------
 * Every entry here becomes a button on the home page.
 *
 *   key      → the web address:  your-site.vercel.app/<key>
 *   title    → button and page heading
 *   summary  → one line shown under the title on the home page
 *   embed    → OPTIONAL. If the dashboard already lives on another
 *              site (e.g. an existing Vercel app), put its URL here
 *              and it will be shown inside the portal. Leave it ''
 *              to use the PHP file in api/_dashboards/<key>.php
 *
 * To add a dashboard: add a line here + create api/_dashboards/<key>.php
 * To remove one: delete its line here.
 */

$SITE_NAME = 'Ashford';

$DASHBOARDS = [
    'dq' => [
        'title'   => 'DQ Dashboard',
        'summary' => 'Delinquent balances, aging and collections by property',
        'embed'   => '',
    ],
    'marketing' => [
        'title'   => 'Marketing Dashboard',
        'summary' => 'Lead sources, campaign spend and cost per lease',
        'embed'   => '',
    ],
    'call-center' => [
        'title'   => 'Call Center Dashboard',
        'summary' => 'Call volume, answer rate and handling time',
        'embed'   => '',
    ],
    'central-screening' => [
        'title'   => 'Central Screening',
        'summary' => 'Applications received, approved, denied and pending',
        'embed'   => '',
    ],
    'work-orders' => [
        'title'   => 'Work Order',
        'summary' => 'Open, completed and overdue maintenance requests',
        'embed'   => '',
    ],
    'entrata-audit' => [
        'title'   => 'Entrata Dashboard Audit',
        'summary' => 'Data issues found in Entrata and their status',
        'embed'   => '',
    ],
    'move-out' => [
        'title'   => 'Move-Out Dashboard',
        'summary' => 'Upcoming move-outs, reasons and final account status',
        'embed'   => '',
    ],
    'ticket-satisfaction' => [
        'title'   => 'Ticket Satisfaction Dashboard',
        'summary' => 'Resident ratings and feedback on closed tickets',
        'embed'   => '',
    ],
];
