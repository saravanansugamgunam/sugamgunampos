<form action="" method="post">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>


    <?php
	// Start the buffering //
	ob_start();

	include("../../connect.php");

	session_cache_limiter(FALSE);
	session_start();
	$position = $_SESSION["SESS_LAST_NAME"];
	$LocationCode = $_SESSION['SESS_LOCATION'];

    function sanitize_my_email($field) {
        $field = filter_var($field, FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
     

    $MobileNo = mysqli_real_escape_string($connection, $_POST["MobileNo"]);
    $PaitentName = mysqli_real_escape_string($connection, $_POST["PaitentName"]); 
    $eInvoiceNo = mysqli_real_escape_string($connection, $_POST["eInvoiceNo"]); 
   
  
     
    $Message1='Dear ';
    $Message2=', Thank you for Visiting Sugamgunam.To view your e-invoice Click : ';
    $Message3= 'https://sugamgunam.com/e-invoicet/?i=';  
    $Message4= ' We would love to hear your feedback Click :';  
    $Message5= 'https://tinyurl.com/myv246da';  
    $Message6= '                                                                                                         '; 
    $Message7= '
    *சிகிச்சை பெற வருபவர்களின் கவனத்திற்கு:*
    *	மருத்துவரிடம் ஆலோசனை (Consulting) பெற இணைய தளம் வழியாக பணம் செலுத்தி, முன்பதிவு Online Appointment - Prebooking) மூலமாக, டோக்கன் பெற்றுக் கொள்ளவும். 
    * 	நோயாளிகள் கண்டிப்பாக டோக்கன் வரிசைபடிதான் மருத்துவ ஆலோசனைக்கு அனுமதிக்க படுவார்கள்.
    * 	நேரடியாக கிளினிக் வந்து, டோக்கன் பெற்று காத்திருக்கும் பட்சத்தில், ஆன்லைன் மூலமாக (Prebooking) முன்பதிவு செய்தவர்களுக்கு முன்னுரிமை அளிக்கப்படும்.
    * 	நோயாளிகள் காத்திருக்காமல் குறிப்பிட்ட நேரத்துக்கு மருத்துவரை ஆலோசனை செய்ய சிறப்பு ஆலோசனை (Special Consulting) முன்பதிவு செய்ய வேண்டும். இதற்கு சிறப்பு கட்டணம் வசூலிக்க படும்.
    * 	முழுமையான ஆரோக்கியம் பெற சிகிச்சை (Therapy) அவசியமானது. சிகிச்சையை முன்பதிவு (Advance booking) செய்தால்தான் சிகிச்சையாளர்களும் (Therapists), சிகிச்சைக்கான நேரமும் (Therapy time) ஏற்பாடு செய்யப்படும். அதனால் பணம் செலுத்தி, சிகிச்சையை முன்பதிவு செய்வது அவசியம்.
    * 	நாடி பார்ப்பதற்கு வசதியாக தளர்வான ஆடைகளை அணிந்து வரவும். மேலும் கைக்கடிகாரம், பிரேஸ்லெட், கயிறுகள், பெல்ட் தவிர்த்தல் நலம்.
    *	பார்க்கிங் சம்பந்தமாக நிர்வாகம் பொறுப்பு ஏற்காது.
    *   எங்களுடைய மருந்துகளை இணையதளம் மூலம்  பெற்று கொள்ள https://sugamgunam.com/shop-2/ கிளிக் செய்யவும்.
   
    *சுகம்குணத்தின் நோக்கம்: நோயின் தன்மை மற்றும் நோயாளியின் தன்மைக்கேற்ப இயற்கை முறையிலும் சித்த வைத்திய முறையிலும் சிகிச்சை அளிக்கப்படும்.*'; 
   
    
    $MessageOriginal =  $Message1.$PaitentName.$Message2.$Message3.$eInvoiceNo.$Message4.$Message5.$Message6.$Message7;
     
    // Medicine
    
 
   $InstanceID = '67CBE49D4241E';
  $AccessCode='67cabaed8eae1';
    
    // Consulting
    // $InstanceID = '665ADDF3AD53E';
    // $AccessCode='6631db3426f4c'; 

    
   // https://getleadconnector.com/api/send?.Dear+%2C+Thank+you+for+Visiting+Sugamgunam.To+view+your+e-invoice+Click+%3A+https%3A%2F%2Ftinyurl.com%2Fyc3dbn8c+We+would+love+to+hear+your+feedback+Click+%3Ahttps%3A%2F%2Ftinyurl.com%2Fmyv246da%26instance_id%3D663C91FF8C10B%26access_token%3D6631db3426f4c.
    $Message = urlencode($MessageOriginal);
    $MobileNumbers='91'.$MobileNo; 

    // echo "https://getleadconnector.com/api/send?number=".$MobileNumbers."&type=text&message=".$Message."&instance_id=".$InstanceID."&access_token=".$AccessCode."";

    // $UR = "https://api.mylogin.co.in/api/v2/SendSMS?ApiKey=".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers."";
    // $ch = curl_init("https://getleadconnector.com/api/send?".$ApiKey."&ClientId=".$ClientId."&SenderId=".$SenderId."&Message=".$Message."&MobileNumbers=".$MobileNumbers.""); 
    //  $URL = "https://getleadconnector.com/api/send?number=".$MobileNumbers."&type=text&message=".$Message."&instance_id=".$InstanceID."&access_token=".$AccessCode."";
    
    $ch = curl_init("https://wa.funnelsdone.com/api/send?number=".$MobileNumbers."&type=text&message=".$Message."&instance_id=".$InstanceID."&access_token=".$AccessCode.""); 
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);      
        curl_close($ch);  
    
 
    ?>