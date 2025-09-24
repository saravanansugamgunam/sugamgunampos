<?php $PAGE_TITLE='Revenue Summary'; $ACTIVE='revenue'; include __DIR__.'/inc/header.php'; ?>
<?php // DUMMY: replace with SQL sums by head (consulting, therapy, medicine, lab)
$kpis=[
['label'=>'Total Revenue', 'value'=>642000, 'icon'=>'ti-currency-rupee'],
['label'=>'Consulting', 'value'=>172000, 'icon'=>'ti-stethoscope'],
['label'=>'Therapy', 'value'=>248000, 'icon'=>'ti-heartbeat'],
['label'=>'Medicine', 'value'=>186000, 'icon'=>'ti-pill'],
['label'=>'Lab', 'value'=>36000, 'icon'=>'ti-test-pipe'],
['label'=>'Discount Bills','value'=>58, 'icon'=>'ti-discount-2'],
['label'=>'Discount Amount','value'=>-23000,'icon'=>'ti-discount-check'],
]; ?>
<div class="row g-3">
<?php foreach($kpis as $k): ?>
<div class="col-6 col-xl-3"><div class="card p-3"><div class="kpi d-flex align-items-center gap-2"><div class="icon"><i class="ti <?= $k['icon'] ?>"></i></div><div><div class="sub"><?= $k['label'] ?></div><h3><?= ($k['label']==='Discount Bills')? number_format($k['value']) : '₹ '.number_format($k['value']) ?></h3></div></div></div></div>
<?php endforeach; ?>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-8"><div class="card p-3"><h5>Daily Revenue Trend (Last 14 days)</h5><div id="rev1"></div></div></div>
<div class="col-xl-4"><div class="card p-3"><h5>Revenue by Head (MTD)</h5><div id="rev2"></div></div></div>
</div>
<script>
const revDays=[...Array(14)].map((_,i)=>new Date(Date.now()- (13-i)*86400000)).map(d=>d.toLocaleDateString('en-GB',{day:'2-digit',month:'short'}));
new ApexCharts(document.querySelector('#rev1'),{chart:{type:'line',height:330,toolbar:{show:false}},stroke:{curve:'smooth',width:3},series:[{name:'Revenue',data:[22,28,24,30,26,31,34,29,33,35,38,36,40,42].map(x=>x*1000)}],xaxis:{categories:revDays},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#rev2'),{chart:{type:'donut',height:330},labels:['Consulting','Therapy','Medicine','Lab'],series:[172,248,186,36],theme:{mode:'dark'},legend:{position:'bottom'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>