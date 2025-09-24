<?php $PAGE_TITLE='Admin, Maintenance & Legal'; $ACTIVE='admin'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-tools"></i></div><div><div class="sub">Breakdown / Maintenance Tasks</div><h3>11</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-license"></i></div><div><div class="sub">Renewals Due (30d)</div><h3>4</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-building-warehouse"></i></div><div><div class="sub">Assets Purchased (MTD)</div><h3>₹ 1,25,000</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-report"></i></div><div><div class="sub">Total Outstanding</div><h3>₹ 2,10,000</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-7"><div class="card p-3"><h5>Crucial Incidents (Last 5)</h5>
<div class="table-responsive"><table class="table align-middle mb-0">
<thead><tr><th>Date</th><th>Category</th><th>Summary</th><th>Status</th></tr></thead>
<tbody>
<tr><td>01/09/2025</td><td>Electrical</td><td>UPS failure at therapy room</td><td><span class="badge text-bg-warning rounded-pill">In‑Progress</span></td></tr>
<tr><td>03/09/2025</td><td>Legal</td><td>License renewal query</td><td><span class="badge text-bg-info rounded-pill">Awaiting Docs</span></td></tr>
<tr><td>05/09/2025</td><td>Facility</td><td>AC gas recharge – OPD</td><td><span class="badge text-bg-success rounded-pill">Closed</span></td></tr>
<tr><td>07/09/2025</td><td>Pharmacy</td><td>Damaged shipment return</td><td><span class="badge text-bg-success rounded-pill">Closed</span></td></tr>
<tr><td>10/09/2025</td><td>Insurance</td><td>Policy endorsement update</td><td><span class="badge text-bg-warning rounded-pill">In‑Progress</span></td></tr>
</tbody></table></div>
</div></div>
<div class="col-xl-5"><div class="card p-3"><h5>Outstanding Aging (₹)</h5><div id="admn1"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#admn1'),{chart:{type:'bar',height:330},series:[{name:'Amount',data:[65000,52000,42000,21000]}],xaxis:{categories:['0‑15d','16‑30d','31‑60d','>60d']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>