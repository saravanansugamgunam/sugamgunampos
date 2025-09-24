<?php include 'header.php'; ?>
<?php include('navfixed.php');?>
    <div class="container-fluid">
      <div class="row-fluid">
	
	 
			 
			 
<div id="mainmain">
	<?php
	$CurrentDate = date("Y-m-d");
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='Cashier') {
?>
 <a class='box'  href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i><br> Sales</a>
<a class='box'  href="customer.php"><i class="icon-group icon-2x"></i><br> Customers</a>  

<a class='box'  href="../index.php"><i class="icon-signout icon-2x"></i><br>Logout</a>   
<?php
}

if($position=='Location') {
?>
<a class='box' href="index.php"><i class="icon-dashboard icon-2x"></i><br> Dashboard</a>  
 <a class='box'  href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i><br> Sales</a>
 <a class='box'  href="salesreport.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-bar-chart icon-2x"></i><br> Sales Report</a> 
 <a class='box'  href="StockReport.php?t1=0"><i class="icon-table icon-2x"></i><br> Stock Report</a>
 <a class='box'   href="TransferIN.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-share-alt icon-2x"></i><br> Transfer IN</a>          
<a class='box'   href="StockTransferRegister.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-reply icon-2x"></i><br> Transfer OUT</a>
<a class='box'   href="DaySummary.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-book icon-2x"></i><br> Day Summary</a>
 
<a class='box'  href="../index.php"><i class="icon-signout icon-2x"></i><br>Logout</a>   
<?php
}

if($position=='admin') {
?>
<a class='box' href="index.php"><i class="icon-dashboard icon-2x"></i><br> Dashboard</a>                
<a class='box'  href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><i class="icon-shopping-cart icon-2x"></i><br> Sales</a>               
                           
<a class='box'  href="products.php"><i class="icon-tags icon-2x"></i><br> Purchase Entry</a>                
<a class='box'  href="cat.php"><i class="icon-list-alt icon-2x"></i><br> Categories</a>     
<a class='box'  href="ProductMaster.php"><i class="icon-list-alt icon-2x"></i><br> Product Master</a>    
<a  class='box' href="supplier.php"><i class="icon-group icon-2x"></i><br> Supplier Master</a> 
<!-- <a href="customer.php"><i class="icon-user icon-2x"></i><br> Customers</a>     -->

<a  class='box' href="purchasereport.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-list-alt icon-2x"></i><br> Purchase Report</a> 
<a  class='box' href="StockReport.php?t1=0"><i class="icon-table icon-2x"></i><br> Stock Report</a>
<a  class='box' href="salesreport.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-bar-chart icon-2x"></i><br> Sales Report</a>         
<a  class='box'  href="TransferIN.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-share-alt icon-2x"></i><br> Transfer IN</a>         
<a  class='box' href="StockTransferRegister.php?d1=0&d2=0"><i class="icon-reply icon-2x"></i><br> Transfer OUT</a>       
<a  class='box' href="DaySummary.php?d1=<?php echo $CurrentDate; ?>&d2=<?php echo $CurrentDate; ?>"><i class="icon-book icon-2x"></i><br> Day Summary</a>         
<!-- <a href="admin-settings.php"><i class="icon-cogs icon-2x"></i><br> User Manager</a>   -->
 
<?php 
    }                   
    ?>
<div class="clearfix"></div>
</div>
</div>
</div>
</body>

<?php include('footer.php'); ?>
</html>
