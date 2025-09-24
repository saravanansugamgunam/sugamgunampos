  
<?php /* Shared header: Bootstrap + ApexCharts + dark theme */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($PAGE_TITLE ?? 'Dashboard') ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet"/>
<style>
:root{--surface:#101a2b;--bg:#0b1220;--muted:#9bb0d3;--border:#1c2a42;}
body{background:var(--bg); color:#e8eefc}
.card{border:0; border-radius:1rem; background:var(--surface); box-shadow:0 10px 30px rgba(0,0,0,.25)}
.sub{color:var(--muted)}
.kpi .icon{width:44px;height:44px;display:grid;place-items:center;border-radius:12px;background:#0e2a47}
.table thead th,.table tbody td{border-color:var(--border)}
a.nav-link{color:#e8eefc}
a.nav-link.active{color:#fff;font-weight:600}
 
    body{ background:#0b1220; }
    .app { min-height:100vh; }
    .card{ border:0; border-radius:1rem; background:#101a2b; color:#e8eefc; box-shadow:0 10px 30px rgba(0,0,0,.25); }
    .kpi { display:flex; align-items:center; gap:.75rem; }
    .kpi .icon { width:44px; height:44px; display:grid; place-items:center; border-radius:12px; background:#0e2a47; }
    .kpi h3{ margin:0; font-size:1.8rem; }
    .kpi small{ color:#9bb0d3; }
    .subtle{ color:#9bb0d3; }
    .table thead th{ color:#9bb0d3; border-color:#1c2a42; }
    .table tbody td{ color:#e8eefc; border-color:#1c2a42; }
    .form-select, .form-control{ background:#0f1a2c; color:#e8eefc; border-color:#1c2a42; }
    .badge.rounded-pill{ padding:.5rem .75rem; }
 
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background:#0d172a;">
<div class="container-fluid">
<a class="navbar-brand text-white" href="index.php">Clinic Ops Dashboards</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
<div id="nav" class="collapse navbar-collapse">
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='index'?'active':'' ?>" href="index.php">Business Flow</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='revenue'?'active':'' ?>" href="revenue.php">Revenue</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='collection'?'active':'' ?>" href="collection.php">Collections</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='expenses'?'active':'' ?>" href="expenses.php">Expenses</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='pl'?'active':'' ?>" href="profit_loss.php">P & L</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='staff'?'active':'' ?>" href="staff.php">Staff</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='inventory'?'active':'' ?>" href="inventory.php">Inventory</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='marketing'?'active':'' ?>" href="marketing.php">Marketing</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='calls'?'active':'' ?>" href="calls_leads.php">Calls & Leads</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='ads'?'active':'' ?>" href="ads_conversion.php">Ads & Conversion</a></li>
<li class="nav-item"><a class="nav-link <?= ($ACTIVE??'')==='admin'?'active':'' ?>" href="admin_legal.php">Admin & Legal</a></li>
</ul>
<span class="sub">Date <?= date('d/m/Y') ?></span>
</div>
</div>
</nav>
<div class="container py-4">
<div class="d-flex justify-content-between align-items-end mb-3">
<div><h2 class="mb-1"><?= htmlspecialchars($PAGE_TITLE ?? '') ?></h2><div class="sub"></div></div>
<div class="d-flex gap-2"><input type="date" class="form-control"><input type="date" class="form-control"><button class="btn btn-primary">Apply</button></div>
</div>
<?php /* page content starts */ ?>