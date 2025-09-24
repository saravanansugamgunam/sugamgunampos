 <?php
  include('../../../connect.php');
  session_cache_limiter(FALSE);
  session_start();
  //insert.php
  if (isset($_POST['Invoice'])) {

    $Invoice = mysqli_real_escape_string($connection, $_POST['Invoice']);


    // echo '1';

    $currentdate = date('Y-m-d H:i:s');
    echo "<table class='table table-border'   width='100%'>
  <thead style='font-family: arial; font-size: 12px;	 padding: 8px; '>
      <tr style='font-family: arial; font-size: 12px;	 padding: 8px; '>

          <th style='font-family: arial; font-size: 12px; padding: 2px;'>S. No</th>
          <th style='font-family: arial; font-size: 12px; padding: 2px;'> ID </th>
          <th style='font-family: arial; font-size: 12px; padding: 2px;'> Mode </th>
          <th style='font-family: arial; font-size: 12px; padding: 2px;'> Amount </th>
      </tr>
  </thead>
  <tbody> ";

    $result = mysqli_query($connection, " 
SELECT paymentid,concat(DATE_FORMAT(DATE,'%d-%m-%Y'),' - ',b.paymentmode),a.amount FROM salepaymentdetails AS a JOIN 
paymentmodemaster AS b ON a.paymentmode=b.paymentmodecode 
WHERE invoiceno='$Invoice'  ; ");


    $Sno = 1;
    while ($row = mysqli_fetch_row($result)) {

  ?>
 <tr style='font-family: arial; font-size: 12px; padding: 2px;'>
     <td style='font-family: arial; font-size: 12px; padding: 2px; '><?php echo $Sno; ?>
     </td>
     <td style='font-family: arial; font-size: 12px; padding: 2px; '>
         <?php echo $row[0]; ?></td>
     <td style='font-family: arial; font-size: 12px; padding: 2px; '>
         <?php echo $row[1]; ?></td>
     <td style='font-family: arial; font-size: 12px; padding: 2px; ' align=right>
         <?php echo $row[2]; ?></td>

     <td style='font-family: arial; font-size: 12px; padding: 2px; ' align=right>
         <button onclick='LoadModeDetails(<?php echo $row[0];?>)'>Modify</button>

     </td>

 </tr>

 <?php
      $Sno = $Sno + 1;
    }
    echo '<tr> </tbody>
</table> ';
  }
  ?>