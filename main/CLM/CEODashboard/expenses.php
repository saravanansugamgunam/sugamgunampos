<?php $PAGE_TITLE='Expense Summary'; $ACTIVE='expenses'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-receipt"></i></div><div><div class="sub">Total Expenses</div><h3>₹ 3,48,000</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-cash"></i></div><div><div class="sub">Cash</div><h3>₹ 1,45,000</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-file-invoice"></i></div><div><div class="sub">Non‑Cash</div><h3>₹ 2,03,000</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-7"><div class="card p-3"><h5>Expense by Category</h5><div id="exp1"></div></div></div>
<div class="col-xl-5"><div class="card p-3"><h5>Weekly Expense Trend</h5><div id="exp2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#exp1'),{chart:{type:'bar',height:330},series:[{name:'Amount',data:[80,62,48,38,22,28]}],xaxis:{categories:['Salary','Rent','Inventory','Marketing','Utilities','Maintenance']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#exp2'),{chart:{type:'area',height:330},series:[{name:'Expenses',data:[36,42,41,45,44,46,49]}],xaxis:{categories:['W1','W2','W3','W4','W5','W6','W7']},stroke:{curve:'smooth',width:3},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>