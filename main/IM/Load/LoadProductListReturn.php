<style>
table.blueTable {
    border: 1px solid #1C6EA4;
    background-color: #EEEEEE;
    width: 100%;
    text-align: left;
    border-collapse: collapse;
}

table.blueTable td,
table.blueTable th {
    border: 1px solid #AAAAAA;
    padding: 1px 1px;
    text-align: center;
}

table.blueTable tbody td {
    font-size: 13px;
    text-align: center;
}

table.blueTable tr:nth-child(even) {
    background: #D0E4F5;
}

table.blueTable thead {
    background: #83b3e4;
    background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
    border-bottom: 1px solid #444444;
}

table.blueTable thead th {
    font-size: 12px;
    font-weight: normal;
    color: #FFFFFF;
    border-left: 1px solid #D0E4F5;
    padding: 5px 10px;

}

table.blueTable thead th:first-child {
    border-left: none;
}

table.blueTable tfoot {
    font-size: 12px;
    font-weight: bold;
    color: #FFFFFF;
    background: #D0E4F5;
    background: -moz-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: -webkit-linear-gradient(top, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    background: linear-gradient(to bottom, #dcebf7 0%, #d4e6f6 66%, #D0E4F5 100%);
    border-top: 2px solid #444444;
}

table.blueTable tfoot td {
    font-size: 12px;
}

table.blueTable tfoot .links {
    text-align: right;
}

table.blueTable tfoot .links a {
    display: inline-block;
    background: #1C6EA4;
    color: #FFFFFF;
    padding: 2px 5px;
    border-radius: 5px;
}
</style>

<script type="text/javascript">
function LoadReturnItems() {
    //Assign Click event to Button. 
    var message = '';
    var Value = 0;

    //Loop through all checked CheckBoxes in GridView.
    $("#tblReturnItems input[type=checkbox]:checked").each(function() {
        var row = $(this).closest("tr")[0];
        message += "'";
        message += row.cells[1].innerHTML;
        message += "',";

        Value += parseFloat(row.cells[8].innerHTML);

    });

    // $("#tblReturnItems input[type=checkbox]:checked").each(function () {
    // var row = $(this).closest("tr")[0]; 
    // /* Value += row.cells[2].innerHTML;   */
    // Value += parseFloat(row.cells[2].text());
    // });

    //Display selected Row data in Alert Box.
    var str = message;
    var ItemId = str.substring(0, str.length - 1);

    document.getElementById("txtItemId").value = ItemId;
    document.getElementById("txtGrossTotalReturn").value = Value;
    document.getElementById("txtTotalReturn").value = Value;
    // return false;


}

function LoadReturnItemsTotal() {
    var ReturnInvoiceNo = document.getElementById("txtReturnInvoiceNo").value;
    var ItemId = document.getElementById("txtItemId").value;
    var datas = "&Invoice=" + Invoice;
    alert(datas);
    $.ajax({
        url: "Load/LoadProductListReturn.php",
        method: "POST",
        data: datas,
        success: function(data) {

            $('#DivProductListReturn').html(data);


        }
    });


}

function CalculateFinalValue() {
    var GrossReturn = document.getElementById("txtGrossTotalReturn").value;
    var PercentageDeductged = document.getElementById("txtPercentageDeducted").value;

    var DeductedValue = (GrossReturn * 1 * (PercentageDeductged / 100));
    var FinalValue = GrossReturn * 1 - DeductedValue * 1; //(GrossReturn*1 * (ConsideredPercentage/100));

    document.getElementById("txtTotalReturn").value = FinalValue;
}
</script>
<?php

session_cache_limiter(FALSE);
session_start();

if (isset($_POST["Invoice"])) {

  // echo "1";
  include("../../../connect.php");
  $currentdate = date("Y-m-d H:i:s");
  $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]);

  $result = mysqli_query($connection, " 
SELECT saleid,barcode, shortcode,batchcode,expirydate,saleqty, mrp,discountamount,((saleqty* mrp) - discountamount) AS Total
  FROM newsaleitems WHERE  invoiceno ='$Invoice' and returnstatus=0 ");

  //echo "<table id='tblProject' class='tblMasters'>";
  echo " <table id='tblReturnItems' class='blueTable'>";
  echo " <thead><tr>  
		<th>Select </th> 
		<th>S.No</th>     

		<th  width='%'> Barcode</th>  
		<th width='%'> Code </th>    
		<th width='%'> Batch </th>    
		<th width='%'> Exp.Dt </th> 
           
		<th width='%'> Qty </th>    
		<th width='%'> MRP </th>    
		<th width='%'> Disc. </th>    
		<th width='%'> Total </th>      
		</tr> </thead> <tbody id='ProjectTable'>";

  $SerialNo = 1;
  while ($data = mysqli_fetch_row($result)) {
    echo "
  <tr>
  <td width='10%'><input type='checkbox'/ onclick='LoadReturnItems();'></td>
   <td  hidden>$data[1]</td>
  <td width='10%'>$SerialNo</td>
 
  <td  width='%' >$data[1]</td>       
  <td  width='%' >$data[2]</td>       
  <td  width='%' >$data[3]</td>       
  <td  width='%' >$data[4]</td>       
  <td  width='%' >$data[5]</td>        
  <td  width='%' >$data[6]</td>        
  <td  width='%' >$data[7]</td>        
  <td  width='%' >$data[8]</td>        
    
    
    
  </tr>";


    //echo "<tr><td>"  $data[0] "</td></tr>"; echo "<tr>" $data[1] "</tr>";
    //echo "<br>";
    $SerialNo = $SerialNo + 1;
  }
  echo "</tbody></table>";
}
echo "<br>";

echo "<label>Return Value &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; </label>";
echo "<input style='border-radius: 4px; padding: 5px;  text-align: right;'
      id='txtGrossTotalReturn' name ='txtGrossTotalReturn' disabled />";
echo "<br>";
echo "<label>% Deducted &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;    </label>";

echo "<input style='border-radius: 4px; padding: 5px;  text-align: right;'  id='txtPercentageDeducted' 
    name ='txtPercentageDeducted' onblur='CalculateFinalValue();' value='0' />%";

echo "<input hidden style='border-radius: 4px; padding: 5px;  text-align: right;'  id='txtConsideredPercentage' 
    name ='txtConsideredPercentage' onblur='CalculateFinalValue();' />";


echo "<br>";
echo "<label>Final Return Value &nbsp;&nbsp;&nbsp;&nbsp;  </label>";
echo "<input style='border-radius: 4px; padding: 5px;  text-align: right;'  id='txtTotalReturn' 
    name ='txtTotalReturn' disabled />";
echo "<br>";

echo "<input type ='text' id='txtItemId' name ='txtItemId' />";
echo "<hr>";


?>