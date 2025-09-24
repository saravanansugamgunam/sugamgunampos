<?php
// patient_therapy_dashboard.php
// Demo dashboard with dummy data. Replace arrays/sections marked TODO with your MySQL queries.

// ---------- DUMMY DATA (replace with SQL results) ----------
$today = date('d/m/Y');
$kpis = [
  'total_patients' => 42,
  'new_patients'   => 17,
  'old_patients'   => 25,
  'therapies'      => 31,
];

// Therapies: booked vs recommended (per therapy type)
$therapyTypes = ['Acupuncture','Varmam','Pizhichil','Nasya','Kizhi'];
$recommended  = [12, 18, 10, 8, 16];
$booked       = [10, 15, 6, 7, 12];

// Daily trend for the last 10 days (new vs old patients)
$days = [];
for ($i=9; $i>=0; $i--) { $days[] = date('d M', strtotime("-$i days")); }
$newTrend = [3,4,2,1,5,2,4,3,5,6];
$oldTrend = [2,5,3,4,6,3,5,4,6,7];

// Follow-up vs Visited (this week)
$followupPlanned = 28;
$followupVisited = 19;

// Recent follow-up table (last 10)
$recentFollowups = [
  ['date' => '01/'.date('m/Y'), 'patient' => 'Ramesh K', 'doctor' => 'Dr. Sheba', 'status' => 'Visited'],
  ['date' => '02/'.date('m/Y'), 'patient' => 'Lakshmi S', 'doctor' => 'Dr. Jagan', 'status' => 'Pending'],
  ['date' => '03/'.date('m/Y'), 'patient' => 'Suresh P', 'doctor' => 'Dr. Sheba', 'status' => 'Visited'],
  ['date' => '04/'.date('m/Y'), 'patient' => 'Anitha R', 'doctor' => 'Dr. Jagan', 'status' => 'Cancelled'],
  ['date' => '05/'.date('m/Y'), 'patient' => 'Karthik M', 'doctor' => 'Dr. Sheba', 'status' => 'Visited'],
  ['date' => '06/'.date('m/Y'), 'patient' => 'Priya D',   'doctor' => 'Dr. Jagan', 'status' => 'Visited'],
  ['date' => '07/'.date('m/Y'), 'patient' => 'Arun V',    'doctor' => 'Dr. Sheba', 'status' => 'Pending'],
  ['date' => '08/'.date('m/Y'), 'patient' => 'Meena I',   'doctor' => 'Dr. Jagan', 'status' => 'Visited'],
  ['date' => '09/'.date('m/Y'), 'patient' => 'Rahul N',   'doctor' => 'Dr. Sheba', 'status' => 'Visited'],
  ['date' => '10/'.date('m/Y'), 'patient' => 'Divya L',   'doctor' => 'Dr. Jagan', 'status' => 'Visited'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Patient Flow & Therapy Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.47.0/tabler-icons.min.css" rel="stylesheet"/>
  <style>
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
<?php $PAGE_TITLE='Overview'; $ACTIVE=''; include __DIR__.'/inc/header.php'; ?>
  <div class="app container py-4">
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
      <div>
        <h1 class="text-white mb-1">Patient Flow & Therapy Dashboard</h1>
        <div class="subtle">Updated: <?php echo $today; ?> · Demo data</div>
      </div>
      <div class="d-flex gap-2">
        <input type="date" class="form-control" style="min-width:200px" title="From">
        <input type="date" class="form-control" style="min-width:200px" title="To">
        <button class="btn btn-primary">Apply</button>
      </div>
    </div>

    <!-- KPI CARDS -->
    <div class="row g-3">
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card p-3">
          <div class="kpi">
            <div class="icon"><i class="ti ti-stethoscope"></i></div>
            <div>
              <small class="subtle">Total Patients – Consulting</small>
              <h3><?php echo number_format($kpis['total_patients']); ?></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card p-3">
          <div class="kpi">
            <div class="icon"><i class="ti ti-user-plus"></i></div>
            <div>
              <small class="subtle">New Patients</small>
              <h3><?php echo number_format($kpis['new_patients']); ?></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card p-3">
          <div class="kpi">
            <div class="icon"><i class="ti ti-user-check"></i></div>
            <div>
              <small class="subtle">Old Patients</small>
              <h3><?php echo number_format($kpis['old_patients']); ?></h3>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6 col-xl-3">
        <div class="card p-3">
          <div class="kpi">
            <div class="icon"><i class="ti ti-heartbeat"></i></div>
            <div>
              <small class="subtle">No. of Therapies</small>
              <h3><?php echo number_format($kpis['therapies']); ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CHARTS ROW 1 -->
    <div class="row g-3 mt-1">
      <div class="col-12 col-xl-7">
        <div class="card p-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">New vs Old Patients – 10 Day Trend</h5>
            <span class="badge rounded-pill text-bg-dark border">Line</span>
          </div>
          <div id="trendChart"></div>
        </div>
      </div>
      <div class="col-12 col-xl-5">
        <div class="card p-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Follow-up Planned vs Visited</h5>
            <span class="badge rounded-pill text-bg-dark border">Donut</span>
          </div>
          <div id="followupChart"></div>
        </div>
      </div>
    </div>

    <!-- CHARTS ROW 2 -->
    <div class="row g-3 mt-1">
      <div class="col-12">
        <div class="card p-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Therapies Booked vs Recommended</h5>
            <span class="badge rounded-pill text-bg-dark border">Bar</span>
          </div>
          <div id="therapyChart"></div>
        </div>
      </div>
    </div>

    <!-- TABLE: Recent Follow-ups -->
    <div class="row g-3 mt-1">
      <div class="col-12">
        <div class="card p-3">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">Recent Follow-ups</h5>
            <span class="subtle">Last 10</span>
          </div>
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th style="width:140px;">Date</th>
                  <th>Patient</th>
                  <th>Doctor</th>
                  <th style="width:130px;">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($recentFollowups as $r): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($r['date']); ?></td>
                    <td><?php echo htmlspecialchars($r['patient']); ?></td>
                    <td><?php echo htmlspecialchars($r['doctor']); ?></td>
                    <td>
                      <?php
                        $status = $r['status'];
                        $map = [
                          'Visited'  => 'success',
                          'Pending'  => 'warning',
                          'Cancelled'=> 'danger',
                        ];
                        $variant = $map[$status] ?? 'secondary';
                      ?>
                      <span class="badge rounded-pill text-bg-<?php echo $variant; ?>"><?php echo $status; ?></span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center subtle mt-4">© <?php echo date('Y'); ?> Sugamgunam Health Centre · Demo UI</div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    // ---------- PHP → JS Bridges ----------
    const days            = <?php echo json_encode($days); ?>;
    const newTrend        = <?php echo json_encode($newTrend); ?>;
    const oldTrend        = <?php echo json_encode($oldTrend); ?>;
    const therapyTypes    = <?php echo json_encode($therapyTypes); ?>;
    const recommended     = <?php echo json_encode($recommended); ?>;
    const booked          = <?php echo json_encode($booked); ?>;
    const followupPlanned = <?php echo (int)$followupPlanned; ?>;
    const followupVisited = <?php echo (int)$followupVisited; ?>;

    // ---------- Chart 1: Line (New vs Old) ----------
    new ApexCharts(document.querySelector('#trendChart'), {
      chart: { type: 'line', height: 330, toolbar: { show: false } },
      stroke: { width: 3, curve: 'smooth' },
      series: [
        { name: 'New', data: newTrend },
        { name: 'Old', data: oldTrend }
      ],
      xaxis: { categories: days, axisBorder: { show:false }, axisTicks: { show:false } },
      yaxis: { labels:{ }, decimalsInFloat: 0 },
      grid: { borderColor: '#1c2a42' },
      legend: { labels: { colors: '#9bb0d3' } },
      theme: { mode: 'dark' }
    }).render();

    // ---------- Chart 2: Donut (Follow-up) ----------
    new ApexCharts(document.querySelector('#followupChart'), {
      chart: { type: 'donut', height: 330 },
      labels: ['Planned', 'Visited'],
      series: [followupPlanned, followupVisited],
      dataLabels: { enabled: true },
      legend: { position: 'bottom', labels: { colors: '#9bb0d3' } },
      theme: { mode: 'dark' }
    }).render();

    // ---------- Chart 3: Bar (Therapies Booked vs Recommended) ----------
    new ApexCharts(document.querySelector('#therapyChart'), {
      chart: { type: 'bar', height: 360, toolbar: { show: false } },
      series: [
        { name: 'Recommended', data: recommended },
        { name: 'Booked', data: booked }
      ],
      xaxis: { categories: therapyTypes, axisBorder:{ show:false }, axisTicks:{ show:false } },
      plotOptions: { bar: { columnWidth: '45%', borderRadius: 6 } },
      dataLabels: { enabled: false },
      grid: { borderColor: '#1c2a42' },
      legend: { labels: { colors: '#9bb0d3' } },
      theme: { mode: 'dark' }
    }).render();
  </script>
</body>
</html>




