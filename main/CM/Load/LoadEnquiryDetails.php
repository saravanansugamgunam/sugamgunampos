   
<div class="panel panel-inverse">
                         
                        
                        <div class="panel-body">
                            <div class="table-responsive">
							
							<?php
  
  include("../../connect.php");
session_cache_limiter(FALSE);
session_start(); 
   
  $currentdate =date("Y-m-d"); 			
  
$EnquiryType = $_POST['EnquiryType'];				
				 


				$result = mysqli_query($connection, " 

 
 SELECT a.id ,a.name, a.mobileno,b.enquiry,a.emailid,c.enquirytype,a.address,a.remarks FROM enquirydetails AS a 
 JOIN enquirymaster AS b ON a.enquiredbyid = b.enquiryid
 JOIN enquirytypemaster AS c ON a.enquirytypeid = c.enquirytypeid
 JOIN referencemaster AS d ON a.referenceid  = d.referenceid  where a.enquiredbyid like '$EnquiryType'  and
 a.enquirystatus = 'Active'");
 
				?>
                                <table id="data-table"  class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>          
		<th hidden width='%'> Unique No </th>    
		<th width='%'> Name </th>    
		<th  width='%'> Mobile</a></th>    
		<th  width='%'> Enquiry  </th>     
		<th width='%'> Email</th>           
		<th style="white-space:nowrap" width='%'> Enquiry Thru </th>        
		<th width='%'> Address </th>        
		<th width='%'> Remarks </th>   
		<th hidden></th>   
		<th hidden></th>   
		<th width='%'></th>   
  		
		 
		  
		  
		</tr> </thead>   
                                    <tbody>
                                         <?php
										 $SerialNo = 1;
									while($data = mysqli_fetch_row($result))
									{
									  echo "
									  <tr>
									  <td>$SerialNo</td>
									  <td hidden id='EnquiryID' > $data[0]</td>
									   
									   <td  width='%' id='EnquiryName' >$data[1]</td>   
									   <td  width='%' ><a href='#modalSMS'  data-toggle='modal'>$data[2]
									   </a></td> 
									   <td width='%'>$data[3]</td>     
									   <td  width='%' ><a href='#modalEmail'  data-toggle='modal'>$data[4]
									   </a></td> 
									   
									   
								   <td width='%'>$data[5]</td>           
								   <td width='%' id='EnquiryAddress' >$data[6]</td>            
								   <td width='%' id='EnquiryRemarks' >$data[7]</td> 
								   
								   <td hidden id='EnquiryEmail' >$data[4]</td> 
								   <td hidden id='EnquiryMobile' >$data[2]</td>          
								   
									  <td  onclick='GetRowID(this);'><a href='#myModalReturn' class='btn btn-sm btn-danger btn-xs' data-toggle='modal'>Edit</a></td>  
									  
									  </tr>";   
										 $SerialNo=$SerialNo+1; 
										}
										?>
																			   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
					
 
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/DataTables/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/js/dataTables.fixedColumns.js"></script>
	<script src="assets/js/table-manage-fixed-columns.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>
	<script>
            $(document).ready(function() {
            	App.init();
            	TableManageFixedColumns.init();
            });
         </script>