<?php $PAGE_TITLE='Ads & Conversion'; $ACTIVE='ads'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-ad"></i></div><div><div class="sub">Ads Running</div><h3>8</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-user-check"></i></div><div><div class="sub">Leads Generated</div><h3>226</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-coin"></i></div><div><div class="sub">Conversions</div><h3>64</h3></div></div></div></div>
<div class="col-md-3"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-percentage"></i></div><div><div class="sub">Conversion Rate</div><h3>28.3%</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-7"><div class="card p-3"><h5>Leads & Conversions by Campaign</h5><div id="ad1"></div></div></div>
<div class="col-xl-5"><div class="card p-3"><h5>CPL (Cost per Lead) – Mock</h5><div id="ad2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#ad1'),{chart:{type:'bar',height:330},series:[{name:'Leads',data:[80,60,40,46,32]},{name:'Conversions',data:[22,18,10,8,6]}],xaxis:{categories:['FB‑A','FB‑B','IG‑A','YT‑A','Search']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#ad2'),{chart:{type:'line',height:330},series:[{name:'CPL (₹)',data:[120,140,110,160,180]}],xaxis:{categories:['FB‑A','FB‑B','IG‑A','YT‑A','Search']},stroke:{curve:'smooth',width:3},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>