<?php $PAGE_TITLE='Call Logs & Leads'; $ACTIVE='calls'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-phone"></i></div><div><div class="sub">Total Calls</div><h3>318</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-bulb"></i></div><div><div class="sub">Leads</div><h3>112</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-rotate-clockwise"></i></div><div><div class="sub">Follow‑ups</div><h3>74</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-message-dots"></i></div><div><div class="sub">Enquiries</div><h3>86</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-7"><div class="card p-3"><h5>Calls by Category (Daily)</h5><div id="cl1"></div></div></div>
<div class="col-xl-5"><div class="card p-3"><h5>Lead Funnel</h5><div id="cl2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#cl1'),{chart:{type:'bar',height:330,stacked:true},series:[{name:'Leads',data:[12,14,16,13,18,20,19]},{name:'Follow‑up',data:[7,8,6,9,10,12,11]},{name:'General',data:[10,12,9,11,8,7,10]},{name:'Enquiries',data:[8,7,10,9,12,14,13]}],xaxis:{categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#cl2'),{chart:{type:'bar',height:330},series:[{name:'Count',data:[318,112,68,41]}],xaxis:{categories:['Calls','Leads','Qualified','Converted']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>