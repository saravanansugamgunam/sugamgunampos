<?php $PAGE_TITLE='Staff Attendance'; $ACTIVE='staff'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-calendar-exclamation"></i></div><div><div class="sub">No. of Staffs Leave</div><h3>7</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-alarm"></i></div><div><div class="sub">No. of Staffs Late</div><h3>12</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-7"><div class="card p-3"><h5>Late Arrivals (Daily)</h5><div id="st1"></div></div></div>
<div class="col-xl-5"><div class="card p-3"><h5>Leave Type Split</h5><div id="st2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#st1'),{chart:{type:'bar',height:330},series:[{name:'Late',data:[1,0,3,2,1,4,1]}],xaxis:{categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#st2'),{chart:{type:'donut',height:330},labels:['Sick','Casual','PL','Unpaid'],series:[4,6,2,1],legend:{position:'bottom'},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>