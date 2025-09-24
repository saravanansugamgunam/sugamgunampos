<?php $PAGE_TITLE='Digital Marketing'; $ACTIVE='marketing'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-brush"></i></div><div><div class="sub">Posters Designed</div><h3>42</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-photo"></i></div><div><div class="sub">Posters Posted</div><h3>36</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-video"></i></div><div><div class="sub">Videos Shot</div><h3>12</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-brand-youtube"></i></div><div><div class="sub">Videos Posted</div><h3>9</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-6"><div class="card p-3"><h5>Reviews Received</h5><div id="mk1"></div></div></div>
<div class="col-xl-6"><div class="card p-3"><h5>Testimonials Received</h5><div id="mk2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#mk1'),{chart:{type:'bar',height:320},series:[{name:'Reviews',data:[5,7,6,12,14,10,9]}],xaxis:{categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#mk2'),{chart:{type:'line',height:320},series:[{name:'Testimonials',data:[1,0,2,1,3,2,1]}],xaxis:{categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun']},stroke:{curve:'smooth',width:3},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>