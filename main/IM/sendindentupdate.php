<?php
  
  $Message1='Hi Pharmacist, Your indent is ready you can pickup the stock from Godown'; 

//   $GroupID='919488228603-1568893499@g.us'; 
  $GroupID='919003078603-1589298946@g.us';
  $MessageOriginal =  $Message1;
   
  // Medicine
  $InstanceID = '67CBE41CD5B13';
  $AccessCode='67cabaed8eae1'; 
   
  $Message = urlencode($MessageOriginal); 

  $ch = curl_init("https://wa.funnelsdone.com/api/send_group?group_id=".$GroupID."&type=text&message=".$Message."&instance_id=".$InstanceID."&access_token=".$AccessCode.""); 
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $output = curl_exec($ch);      
      curl_close($ch); 
       

  ?>