# Ashford Dashboards Portal

One link, one home page, a button for every dashboard. Built with PHP and hosted on Vercel.

## Dashboards

| Button | Address | File |
|---|---|---|
| DQ Dashboard | `/dq` | `api/_dashboards/dq.php` |
| Marketing Dashboard | `/marketing` | `api/_dashboards/marketing.php` |
| Call Center Dashboard | `/call-center` | `api/_dashboards/call-center.php` |
| Central Screening | `/central-screening` | `api/_dashboards/central-screening.php` |
| Work Order | `/work-orders` | `api/_dashboards/work-orders.php` |
| Entrata Dashboard Audit | `/entrata-audit` | `api/_dashboards/entrata-audit.php` |
| Move-Out Dashboard | `/move-out` | `api/_dashboards/move-out.php` |
| Ticket Satisfaction Dashboard | `/ticket-satisfaction` | `api/_dashboards/ticket-satisfaction.php` |

## Project structure

```
ashford-portal/
├── api/
│   ├── index.php              Main entry: home page + loads dashboards (no edits needed)
│   ├── _lib/
│   │   ├── config.php         List of dashboards (edit this to add/remove buttons)
│   │   ├── layout.php         Page design, colors, home page and top bar
│   │   └── components.php     KPI cards, charts, tables
│   └── _dashboards/           One file per dashboard
├── vercel.json                Runs PHP on Vercel and routes all addresses to index.php
├── .gitignore
└── README.md
```

Folders starting with `_` inside `api/` are not turned into separate Vercel functions, so they stay private.

## Deploy

1. Create a new repository on GitHub (e.g. `ashford-portal`).
2. Upload all files, keeping the folder structure. Or from a terminal:
   ```bash
   git init
   git add .
   git commit -m "Initial portal"
   git branch -M main
   git remote add origin https://github.com/<your-username>/ashford-portal.git
   git push -u origin main
   ```
3. In Vercel: **Add New → Project → Import** the repository. Leave Framework Preset as **Other** and click **Deploy**.
4. Open the Vercel URL. That one link is the portal.

Every push to `main` redeploys automatically.

## Add your real data

Each dashboard file currently shows **sample data**. Replace the arrays in each file with real numbers, and delete the `sample_notice(...)` line when done.

Keep API keys out of the code. Add them in Vercel under **Settings → Environment Variables** (e.g. `ENTRATA_API_KEY`) and read them in PHP:

```php
$apiKey = getenv('ENTRATA_API_KEY');
```

## Use a dashboard that's already hosted elsewhere

If a dashboard already exists on another site, set its `embed` URL in `api/_lib/config.php`:

```php
'dq' => [
    'title'   => 'DQ Dashboard',
    'summary' => 'Delinquent balances, aging and collections by property',
    'embed'   => 'https://your-dq-dashboard.vercel.app',
],
```

The portal shows it inside the page. That other site must allow being embedded (no `X-Frame-Options: DENY`; a `frame-ancestors` rule must include this portal's domain).

## Add a new dashboard

1. Add a line to `$DASHBOARDS` in `api/_lib/config.php`.
2. Create `api/_dashboards/<key>.php` (copy any existing one as a starting point).
3. Push to GitHub.

## Building blocks for dashboard files

```php
kpis([
    ['label' => 'Open items', 'value' => '42', 'note' => '+5 vs last week', 'trend' => 'down'],
]);

chart_panel('uniqueId', 'Chart title', 'bar',        // bar, line, doughnut or pie
    ['Jan', 'Feb', 'Mar'],
    [['label' => 'Series name', 'data' => [10, 20, 15]]]);

table_panel('Table title', ['Col 1', 'Col 2'], [['a', 'b'], ['c', 'd']]);
```

Wrap two panels in `<div class="grid-2">…</div>` to show them side by side.
