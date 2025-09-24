<?php $PAGE_TITLE='Collection Summary'; $ACTIVE='collection'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-cash"></i></div><div><div class="sub">Cash</div><h3>₹ 2,70,000</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-credit-card"></i></div><div><div class="sub">Card/UPI</div><h3>₹ 2,95,700</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-building-bank"></i></div><div><div class="sub">Others</div><h3>₹ 40,000</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-7"><div class="card p-3"><h5>Collections by Mode (Daily)</h5><div id="col1"></div></div></div>
<div class="col-xl-5"><div class="card p-3"><h5>Dues vs Collected</h5><div id="col2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#col1'),{chart:{type:'bar',height:330,stacked:true},series:[{name:'Cash',data:[20,24,22,28,26,30,32]},{name:'Card/UPI',data:[18,20,21,22,23,25,27]},{name:'Others',data:[3,2,3,4,3,4,5]}],xaxis:{categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#col2'),{chart:{type:'radialBar',height:330},series:[86],labels:['Collection %'],theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>