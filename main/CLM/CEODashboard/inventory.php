<?php $PAGE_TITLE='Inventory & Stock'; $ACTIVE='inventory'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-clock-hourglass"></i></div><div><div class="sub">Stocks nearing expiry (≤60d)</div><h3>58</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-alert-triangle"></i></div><div><div class="sub">Expired</div><h3>9</h3></div></div></div></div>
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-truck-delivery"></i></div><div><div class="sub">New Orders Released</div><h3>14</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-6"><div class="card p-3"><h5>Medicines Received at Godown (Weekly)</h5><div id="inv1"></div></div></div>
<div class="col-xl-6"><div class="card p-3"><h5>Special Medicines Prepared</h5><div id="inv2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#inv1'),{chart:{type:'area',height:320},series:[{name:'Batches',data:[3,5,4,6,7,5,8]}],xaxis:{categories:['W1','W2','W3','W4','W5','W6','W7']},stroke:{curve:'smooth',width:3},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#inv2'),{chart:{type:'bar',height:320},series:[{name:'Qty',data:[12,18,10,8,16]}],xaxis:{categories:['Choornam','Lehyam','Thailam','Kashayam','Others']},plotOptions:{bar:{borderRadius:6,columnWidth:'45%'}},theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>