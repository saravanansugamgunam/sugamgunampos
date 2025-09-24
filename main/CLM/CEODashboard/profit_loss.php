<?php $PAGE_TITLE='Profit & Loss'; $ACTIVE='pl'; include __DIR__.'/inc/header.php'; ?>
<div class="row g-3">
<div class="col-md-4"><div class="card p-3"><div class="kpi d-flex gap-2 align-items-center"><div class="icon"><i class="ti ti-report-money"></i></div><div><div class="sub">Total Profit (MTD)</div><h3>₹ 2,94,000</h3></div></div></div></div>
</div>
<div class="row g-3 mt-1">
<div class="col-xl-8"><div class="card p-3"><h5>Profit Trend (Daily)</h5><div id="pl1"></div></div></div>
<div class="col-xl-4"><div class="card p-3"><h5>Gross Margin by Head</h5><div id="pl2"></div></div></div>
</div>
<script>
new ApexCharts(document.querySelector('#pl1'),{chart:{type:'line',height:330},series:[{name:'Profit',data:[34,28,30,36,32,38,42,40,44,48,46,49,52,54]}],xaxis:{categories:Array.from({length:14},(_,i)=>i+1)},stroke:{curve:'smooth',width:3},theme:{mode:'dark'}}).render();
new ApexCharts(document.querySelector('#pl2'),{chart:{type:'radar',height:330},series:[{name:'Margin %',data:[62,58,45,30]}],labels:['Consulting','Therapy','Medicine','Lab'],theme:{mode:'dark'}}).render();
</script>
<?php include __DIR__.'/inc/footer.php'; ?>