 
<style>
  .calendar {
    display: flex;
    flex-flow: column;
}
.calendar .header .month-year {
    font-size: 20px;
    font-weight: bold;
    color: #636e73;
    padding: 10px 0;
}
.calendar .days {
    display: flex;
    flex-flow: wrap;
}
.calendar .days .day_name {
    width: calc(100% / 7);
    border-right: 1px solid #2c7aca;
    padding: 10px;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: bold;
    color: #818589;
    color: #fff;
    background-color: #448cd6;
}
.calendar .days .day_name:nth-child(7) {
    border: none;
}
.calendar .days .day_num {
    display: flex;
    flex-flow: column;
    width: calc(100% / 7);
    border-right: 1px solid #e6e9ea;
    border-bottom: 1px solid #e6e9ea;
    padding: 10px;
    font-weight: bold;
    color: #7c878d;
    cursor: pointer;
    min-height: 80px;
}
.calendar .days .day_num span {
    display: inline-flex;
    width: 30px;
    font-size: 14px;
}
.calendar .days .day_num .event {
    margin-top: 10px;
    font-weight: 500;
    font-size: 14px;
    padding: 3px 6px;
    border-radius: 4px;
    background-color: #f7c30d;
    color: #fff;
    word-wrap: break-word;
}
.calendar .days .day_num .event.green {
    background-color: #51ce57;
}
.calendar .days .day_num .event.blue {
    background-color: #518fce;
}
.calendar .days .day_num .event.red {
    background-color: #ce5151;
}
.calendar .days .day_num:nth-child(7n+1) {
    border-left: 1px solid #e6e9ea;
}
.calendar .days .day_num:hover {
    background-color: #fdfdfd;
}
.calendar .days .day_num.ignore {
    background-color: #fdfdfd;
    color: #ced2d4;
    cursor: inherit;
}
.calendar .days .day_num.selected {
    background-color: #f1f2f3;
    cursor: inherit;
}

 
</style>


<?php
  
session_cache_limiter(FALSE);
session_start();
  
//insert.php
if(isset($_POST["Staff"]))
{
  
 // echo "1";
 include("../../../connect.php"); 
  $currentdate =date("Y-m-d H:i:s"); 
  $Staff = mysqli_real_escape_string($connection, $_POST["Staff"]); 
  $Month = mysqli_real_escape_string($connection, $_POST["Month"]);
  $timestamp    = strtotime($Month);
$first_date = date('Y-m-01', $timestamp);
$last_date  = date('Y-m-t', $timestamp); // A leap year!

$first_datewithtime = date('01/m/Y 00:00:01', $timestamp);
$last_datewithtime = date('t/m/Y 23:59:59', $timestamp);

$days = date('t', $timestamp);
 

function weeks_between($datefrom, $dateto)
    {
        $datefrom = DateTime::createFromFormat('d/m/Y H:i:s',$datefrom);
        $dateto = DateTime::createFromFormat('d/m/Y H:i:s',$dateto);
        $interval = $datefrom->diff($dateto);
        $week_total = $interval->format('%a')/7;
        return floor($week_total);

    }

$TotalWeeekOff =  weeks_between($first_datewithtime,$last_datewithtime );  


$strtDate = $first_date ;
$endDate = $last_date;

$startDateWeekCnt = round(floor( date('d',strtotime($strtDate)) / 7)) ;
// echo $startDateWeekCnt ."\n";
$endDateWeekCnt = round(ceil( date('d',strtotime($endDate)) / 7)) ;
//echo $endDateWeekCnt. "\n";

$datediff = strtotime(date('Y-m',strtotime($endDate))."-01") - strtotime(date('Y-m',strtotime($strtDate))."-01");
$totalnoOfWeek = round(floor($datediff/(60*60*24)) / 7) + $endDateWeekCnt - $startDateWeekCnt ;
 



$res= $connection->query("

SELECT (SELECT  COUNT(DISTINCT c.datename)  FROM `datetable` AS c 
JOIN usermovementlog AS b ON b.`logdate`=c.datename 
JOIN usermaster AS a ON a.`biometricid` = b.`empcode`*1 
WHERE  biometricid='$Staff' AND c.datename BETWEEN '$first_date' AND '$last_date' ) AS Present,
(SELECT COUNT(DISTINCT datename) FROM datetable 
WHERE datename BETWEEN '$first_date' AND '$last_date' AND datename 
NOT IN (SELECT logdate FROM usermovementlog WHERE empcode*1=$Staff AND logdate
 BETWEEN '$first_date' AND '$last_date') ) AS Absent;");
	  
 while ($data = mysqli_fetch_row($res))  
    { 
        $TotalPresent = $data[0];
        $TotalAbsent = $data[1];
 
    }
    ?>
	  
 <h4>Working Days: <?php echo $days; ?> </h4> 
 <h4>Days Present: <?php echo $TotalPresent; ?> </h4> 
 <h4>Week Off: <?php echo $TotalWeeekOff; ?> </h4> 
 <h4>Days Absent: <?php echo $TotalAbsent - $TotalWeeekOff; ?> </h4>
 

   
<?php 
include 'calendar.php';
$calendar = new Calendar(date($Month));
// $calendar->add_event('Birthday', '2022-04-03', 1, 'green');
// $calendar->add_event('Doctors', '2022-04-04', 1, 'red');
// $calendar->add_event('Holiday', '2022-04-16', 7);

$result = mysqli_query($connection, " 
SELECT 'PR',c.datename,1,'green'   FROM 
`datetable` AS c 
  JOIN usermovementlog AS b ON b.`logdate`=c.datename 
  JOIN usermaster AS a  ON a.`biometricid` = b.`empcode`*1  
    WHERE biometricid='$Staff' AND c.datename BETWEEN '$first_date' AND '$last_date'
GROUP BY  c.datename 

UNION

SELECT 'AP',datename,1,'red' FROM datetable WHERE datename BETWEEN '$first_date' AND '$last_date' AND 
datename NOT IN (SELECT logdate FROM usermovementlog WHERE empcode*1=$Staff
AND logdate BETWEEN '$first_date' AND '$last_date')
 
ORDER BY datename
  ");
 

 while($data = mysqli_fetch_row($result))
 {
   
      $calendar->add_event($data[0], $data[1],$data[2], $data[3]);
      
  }
 
echo "<div class='content home'>
			$calendar
		</div>";
 

  
    
 }
?> 
	    