<?php
// dashboard.php
include("../connect.php");

function indianNumberFormat($num) {
    $num = (string)$num;
    $len = strlen($num);
    if ($len > 3) {
        $last3digits = substr($num, -3);
        $restUnits = substr($num, 0, $len - 3);
        $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
        $formattedNum = $restUnits . "," . $last3digits;
    } else {
        $formattedNum = $num;
    }
    return $formattedNum;
}

function getMonthsBetweenDates($start_date, $end_date) {
    $d1 = new DateTime($start_date);
    $d2 = new DateTime($end_date);
    $diff = $d1->diff($d2);
    $months = ($diff->y * 12) + $diff->m;
    if ($diff->d > 0) {
        $months += 1;
    }
    return $months;
}

function fetchSingleValue($connection, $query, $column = 'total') {
    $result = $connection->query($query);
    $row = $result->fetch_assoc();
    return $row[$column] ?? 0;
}

// Set date range (default current month)
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-t');

// Main function
function getSummaryData($connection, $start_date, $end_date) {
    $data = [];

    $months = getMonthsBetweenDates($start_date, $end_date);



    // Previous Month Dates
$prev_start_date = date('Y-m-01', strtotime($start_date . ' -1 month'));
$prev_end_date = date('Y-m-t', strtotime($start_date . ' -1 month'));

// Previous Month Data
$prev_total_consulting = fetchSingleValue($connection, "
    SELECT COUNT(DISTINCT consultationuniquebill) as total_consulting 
    FROM consultingbillmaster 
    WHERE billdate BETWEEN '$prev_start_date' AND '$prev_end_date 23:59:59'
", 'total_consulting');

$prev_total_revenue = array_sum([
    fetchSingleValue($connection, "
        SELECT ROUND(SUM(amount),0) as total 
        FROM salepaymentdetails 
        WHERE transactionstatus='Live' 
        AND date BETWEEN '$prev_start_date' AND '$prev_end_date 23:59:59'
    ")
]);






    $data['total_consulting'] = fetchSingleValue($connection, "
        SELECT COUNT(DISTINCT consultationuniquebill) as total_consulting 
        FROM consultingbillmaster 
        WHERE billdate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'total_consulting');

    $data['total_patients'] = fetchSingleValue($connection, "
        SELECT COUNT(DISTINCT paitentid) as total_patients 
        FROM consultingbillmaster 
        WHERE billdate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'total_patients');

    $data['new_patients'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as new_patients 
        FROM paitentmaster 
        WHERE createdin BETWEEN '$start_date' AND '$end_date 23:59:59' 
        AND paitentid IN (SELECT paitentid FROM consultingbillmaster)
    ", 'new_patients');

    $tasks = $connection->query("
        SELECT 
            SUM(CASE WHEN status = 'planned' THEN 1 ELSE 0 END) as planned_tasks,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_tasks
        FROM taskdetails
        WHERE duedate BETWEEN '$start_date' AND '$end_date'
    ")->fetch_assoc();
    $data['planned_tasks'] = $tasks['planned_tasks'] ?? 0;
    $data['completed_tasks'] = $tasks['completed_tasks'] ?? 0;

    $data['totalexpenses'] = fetchSingleValue($connection, "
        SELECT ROUND(SUM(amount),0) as total 
        FROM salepaymentdetails 
        WHERE transactiontype IN ('RefundToCustomer','SupplierOrder','ExpenseEntry',
        'Supplier Payment','Doctor Share','Therapy Share','Advance','Bonus',
        'Consulting Share','Incentive','Salary')
        AND transactionstatus='Live'
        AND date BETWEEN '$start_date' AND '$end_date 23:59:59'
    ");
    $data['formatted_totalexpenses'] = indianNumberFormat($data['totalexpenses']);

    $data['MedicineBillsCounter'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as MedicineBillsCounter 
        FROM salemaster 
        WHERE saletype IN ('Counter','Free') 
        AND transactiontype='Sale' 
        AND cancellstatus='0' 
        AND saledate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'MedicineBillsCounter');

    $data['MedicineBillsCourier'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as MedicineBillsCourier 
        FROM salemaster 
        WHERE saletype IN ('Online','Courier') 
        AND transactiontype='Sale' 
        AND cancellstatus='0' 
        AND saledate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'MedicineBillsCourier');

    $data['TherapyCompleted'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as TherapyCompleted 
        FROM therapybookingdetails a 
        JOIN therapybookingmaster b ON a.bookinguniqueid=b.bookinguniqueid 
        WHERE bookingstatus IN ('Closed','R-Closed') 
        AND reviseddate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'TherapyCompleted');

    $data['TherapyPending'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as TherapyPending 
        FROM therapybookingdetails a 
        JOIN therapybookingmaster b ON a.bookinguniqueid=b.bookinguniqueid 
        WHERE bookingstatus='Booked' 
        AND reviseddate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'TherapyPending');

    $data['PathologySampleCollected'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as PathologySampleCollected 
        FROM diagnosissalemaster 
        WHERE resultstatus='Not Delivered' 
        AND completedstatus<>'Cancelled' 
        AND saledate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'PathologySampleCollected');

    $data['PathologyReportDelivered'] = fetchSingleValue($connection, "
        SELECT COUNT(*) as PathologyReportDelivered 
        FROM diagnosissalemaster 
        WHERE resultstatus='Delivered' 
        AND completedstatus<>'Cancelled' 
        AND saledate BETWEEN '$start_date' AND '$end_date 23:59:59'
    ", 'PathologyReportDelivered');

    // Revenue
    $data['revenue'] = [
        'consultation' => fetchSingleValue($connection, "
            SELECT ROUND(SUM(amount),0) as total 
            FROM salepaymentdetails 
            WHERE transactiontype='DoctorFee' 
            AND transactionstatus='Live' 
            AND date BETWEEN '$start_date' AND '$end_date 23:59:59'
        "),
        'medicine' => fetchSingleValue($connection, "
            SELECT ROUND(SUM(amount),0) as total 
            FROM salepaymentdetails 
            WHERE transactiontype IN ('CashAdvance','PaitentOrder',
            'OutstandingCollection','Sales','Advance - PaitentOrder') 
            AND transactionstatus='Live' 
            AND date BETWEEN '$start_date' AND '$end_date 23:59:59'
        "),
        'therapy' => fetchSingleValue($connection, "
            SELECT ROUND(SUM(amount),0) as total 
            FROM salepaymentdetails 
            WHERE transactiontype='Therapy Payment' 
            AND transactionstatus='Live' 
            AND date BETWEEN '$start_date' AND '$end_date 23:59:59'
        "),
        'lab' => fetchSingleValue($connection, "
            SELECT ROUND(SUM(amount),0) as total 
            FROM salepaymentdetails 
            WHERE transactiontype='Diagnosis' 
            AND transactionstatus='Live' 
            AND date BETWEEN '$start_date' AND '$end_date 23:59:59'
        ")
    ];


    // Formatted Revenue
    $data['formatted_consultationrevenue'] = indianNumberFormat($data['revenue']['consultation']);
    $data['formatted_medicinerevenue'] = indianNumberFormat($data['revenue']['medicine']);
    $data['formatted_therapyrevenue'] = indianNumberFormat($data['revenue']['therapy']);
    $data['formatted_labrevenue'] = indianNumberFormat($data['revenue']['lab']);

    // Totals
    $data['total_revenue'] = array_sum($data['revenue']);
    $data['formatted_totalrevenue'] = indianNumberFormat($data['total_revenue']);
    $data['gross_profit'] = $data['total_revenue'] - $data['totalexpenses'];

    // Targets
    $data['RevenueTarget_Consulting'] = 300000 * $months;
    $data['RevenueTarget_Medicine'] = 1500000 * $months;
    $data['RevenueTarget_Therapy'] = 800000 * $months;
    $data['RevenueTarget_Lab'] = 100000 * $months;

    
    
// Consulting Growth %
if ($prev_total_consulting > 0) {
    $data['consulting_growth_percent'] = round((($data['total_consulting'] - $prev_total_consulting) / $prev_total_consulting) * 100, 1);
} else {
    $data['consulting_growth_percent'] = 0;
}

// Revenue Growth %
if ($prev_total_revenue > 0) {
    $data['revenue_growth_percent'] = round((($data['total_revenue'] - $prev_total_revenue) / $prev_total_revenue) * 100, 1);
} else {
    $data['revenue_growth_percent'] = 0;
}





    return $data;
}

$summaryData = getSummaryData($connection, $start_date, $end_date);

?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Chairman Dashboard</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
     <style>
     .card {
         margin-bottom: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
         transition: transform 0.3s;

         width: 100%;
         border: 1px solid #ccc;
         background-color: white;

     }

     .card:hover {
         transform: translateY(-5px);
     }

     .card-header {
         font-weight: bold;
         background-color: #f8f9fa;
     }

     .stat-card {
         text-align: center;
         padding: 10px;
     }

     .stat-value {
         font-size: 2.5rem;
         font-weight: bold;
     }

     .stat-label {
         font-size: 1rem;
         color: #6c757d;
     }

     .positive {
         color: #28a745;
     }

     .negative {
         color: #dc3545;
     }

     .revenue-breakdown {
         margin-top: 15px;
     }

     .revenue-item {
         padding: 5px 0;
         border-bottom: 1px solid #eee;
     }

     .date-filter {
         background-color: #f8f9fa;
         padding: 15px;
         border-radius: 5px;
         margin-bottom: 20px;
     }

     .card-content {
         overflow: hidden;
         /* Ensures floats don't break the card layout */
         position: relative;
     }

     .float-left {
         float: left;
     }

     .float-right {
         float: right;
     }



     .summary-card h2 {
         text-align: center;
         padding-bottom: 10px;
     }

     .summary-row {
         display: flex;
         justify-content: space-between;
         padding: 10px 0;
         font-size: 16px;
     }

     .summary-row:last-child {
         border-bottom: none;
     }

     .label {
         color: #555;
     }

     .value {
         font-weight: bold;
         color: #333;
     }
     </style>
 </head>

 <body>
     <div class="container-fluid">
         <h1 class="my-4">Chairman Dashboard</h1>

         <!-- Date Filter -->
         <div class="date-filter">
             <form method="GET" class="row g-3">
                 <div class="col-md-3">
                     <label for="start_date" class="form-label">Start Date</label>
                     <input type="date" class="form-control" id="start_date" name="start_date"
                         value="<?= $start_date ?>">
                 </div>
                 <div class="col-md-3">
                     <label for="end_date" class="form-label">End Date</label>
                     <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $end_date ?>">
                 </div>
                 <div class="col-md-2 align-self-end">
                     <button type="submit" class="btn btn-primary">Filter</button>
                     <a href="dashboard.php" class="btn btn-secondary">Reset</a>
                 </div>
                 <div class="col-md-4 align-self-end text-end">
                     <span class="text-muted">Showing data from <?= date('M d, Y', strtotime($start_date)) ?> to
                         <?= date('M d, Y', strtotime($end_date)) ?></span>
                 </div>
             </form>
         </div>



         <!-- Revenue Summary -->
         <div class="col-md-6">
             <div class="card">
                 <div class="card-header">
                     Revenue Summary
                 </div>
                 <div class="card-body">

                     <div class="summary-card">
                         <div class="summary-row">
                             <div class="label">Total Revenue</div>
                             <div class="value">
                                 <h3><?= $summaryData['formatted_totalrevenue'] ?></h3>
                             </div>
                         </div>

                          



                         <div class="summary-row">
                             <div class="label">Consulting</div>
                             <div class="value">
                             <?= $summaryData['formatted_consultationrevenue'] ?>
                         </div>
                         </div>
                     
                     <div class="summary-row">
                         <div class="label">Medicine</div>
                         <div class="value">
                             <?= $summaryData['formatted_medicinerevenue'] ?> </div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Therapy</div>
                         <div class="value">
                             <?= $summaryData['formatted_therapyrevenue'] ?> </div>
                     </div>

                     <div class="summary-row">
                         <div class="label">Pathology</div>
                         <div class="value">
                             <?= $summaryData['formatted_labrevenue'] ?> </div>
                     </div>


                 </div>


                 <hr>
                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Cash Expenses</div>
                         <div class="value"><?= $summaryData['total_consulting']*0 ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">
                             Other Expenses</div>
                         <div class="value"><?= $summaryData['formatted_totalexpenses'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Gross Profit</div>
                         <div class="value">
                             <h3><?= indianNumberFormat($summaryData['total_revenue'] - $summaryData['totalexpenses']) ?></h3>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>



     <!-- Consulting Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Consuting Summary
             </div>
             <div class="card-body">

                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Total Consultation</div>
                         <div class="value"><?= $summaryData['total_consulting'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">New Patient</div>
                         <div class="value"><?= $summaryData['new_patients'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Old Patient</div>
                         <div class="value">
                             <?= $summaryData['total_patients'] - $summaryData['new_patients'] ?></div>
                     </div>
                 </div>


                 <hr>
                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Consulting Revenue</div>
                         <div class="value"><?= $summaryData['formatted_consultationrevenue'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">
                             Avg. Per Patient</div>
                         <div class="value"> 
                         
                         <?=  round($summaryData['revenue']['consultation']/$summaryData['total_consulting'],0)   ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Target Achived %</div>
                         <div class="value">
                             <?= round(($summaryData['revenue']['consultation']/$summaryData['RevenueTarget_Consulting'])*100,0) ?>%</div>
                     </div>
                 </div> 
             </div>
         </div>
     </div>



     <!-- Medicine Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Medicine Summary
             </div>
             <div class="card-body">

                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Total Bills</div>
                         <div class="value"><?= $summaryData['MedicineBillsCounter']+$summaryData['MedicineBillsCourier'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Counter Bills</div>
                         <div class="value"><?= $summaryData['MedicineBillsCounter'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Courier Bills</div>
                         <div class="value">
                             <?= $summaryData['MedicineBillsCourier'] ?></div>
                     </div>
                 </div>


                 <hr>
                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Medicine Revenue</div>
                         <div class="value"><?= $summaryData['formatted_medicinerevenue'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">
                             Avg. Per Bill</div>
                         <div class="value"><?= indianNumberFormat(round($summaryData['revenue']['medicine']  /  
                          $summaryData['MedicineBillsCounter']+$summaryData['MedicineBillsCourier']),0)?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Target Achived %</div>
                         <div class="value">
                         <?= round(($summaryData['revenue']['medicine']/$summaryData['RevenueTarget_Medicine'])*100,0) ?>%</div>
                     </div>
                 </div>

             </div>
         </div>
     </div>



     <!-- Therapy Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Therapy Summary
             </div>
             <div class="card-body">

                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Total Therapies</div>
                         <div class="value"><?= $summaryData['TherapyCompleted']  +  $summaryData['TherapyPending'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Completed</div>
                         <div class="value"><?= $summaryData['TherapyCompleted'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Pending</div>
                         <div class="value">
                             <?= $summaryData['TherapyPending'] ?></div>
                     </div>
                 </div>
               
                 <hr>
                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Therapy Revenue</div>
                         <div class="value"><?= $summaryData['formatted_therapyrevenue'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">
                             Avg. Per Patient</div>
                         <div class="value"><?= indianNumberFormat(round($summaryData['revenue']['therapy'] / 
                         $summaryData['TherapyCompleted']  +  $summaryData['TherapyPending']),0) ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Target Achived %</div>
                         <div class="value">
                            
                             <?= round(($summaryData['revenue']['therapy']/$summaryData['RevenueTarget_Therapy'])*100,0) ?>% 
                              </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>





 
     <!-- Pathology Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Pathology Summary
             </div>
             <div class="card-body">

                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Total Tests</div>
                         <div class="value"><?= $summaryData['PathologySampleCollected'] + $summaryData['PathologyReportDelivered'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Sample Collected</div>
                         <div class="value"><?= $summaryData['PathologySampleCollected'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Report Deliverd</div>
                         <div class="value">
                             <?= $summaryData['PathologyReportDelivered']  ?></div>
                     </div>
                 </div>


                 <hr>
                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Therapy Revenue</div>
                         <div class="value"><?= $summaryData['formatted_labrevenue'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">
                             Avg. Per Patient</div>
                         <div class="value"><?= indianNumberFormat(round($summaryData['revenue']['lab'] / 
                         $summaryData['PathologyReportDelivered']  +  $summaryData['PathologySampleCollected']),0) ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Target Achived %</div>
                         <div class="value">
                            
                             <?= round(($summaryData['revenue']['lab']/$summaryData['RevenueTarget_Lab'])*100,0) ?>% 
                              </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>





     <!-- Revenue Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Task Summary
             </div>


             <table class="w-full text-sm text-left border border-gray-200">
                 <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                     <tr>
                         <th class="p-2">Type</th>
                         <th class="p-2 text-center">Total</th>
                         <th class="p-2 text-center">✅</th>
                         <th class="p-2 text-center">⏳</th>
                         <th class="p-2 text-center">🟢 %</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr class="border-t">
                         <td class="p-2 font-medium">Routine Task</td>
                         <td class="p-2 text-center">13</td>
                         <td class="p-2 text-center">8</td>
                         <td class="p-2 text-center">5</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-blue-700">38%</span>
                                 <div class="w-full h-2 bg-blue-100 rounded">
                                     <div class="h-2 bg-blue-500 rounded" style="width: 38%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>
                     <tr class="border-t">
                         <td class="p-2 font-medium">Onetime Task</td>
                         <td class="p-2 text-center">45</td>
                         <td class="p-2 text-center">23</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>
                 </tbody>
             </table>


         </div>
     </div>




     <!-- Revenue Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Marketing & Branding
             </div>

             <div class="card-body">

                 <div class="summary-row">
                     <div class="label">Total Calls Received</div>
                     <div class="value">
                         <?= $summaryData['total_consulting'] ?>
                     </div>
                 </div>
                 <div class="summary-row">
                     <div class="label">Leads Generated</div>
                     <div class="value"><?= $summaryData['new_patients'] ?></div>
                 </div>
                 <div class="summary-row">
                     <div class="label">Leads Converted</div>
                     <div class="value">
                         <?= $summaryData['total_patients'] - $summaryData['new_patients'] ?></div>
                 </div>
             </div>

             <table class="w-full text-sm text-left border border-gray-200">
                 <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                     <tr>
                         <th class="p-2">Type</th>
                         <th class="p-2 text-center">Achived</th>
                         <th class="p-2 text-center">Target</th>
                         <th class="p-2 text-center">🟢 %</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr class="border-t">
                         <td class="p-2 font-medium">Google Review</td>
                         <td class="p-2 text-center">8</td>
                         <td class="p-2 text-center">5</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-blue-700">38%</span>
                                 <div class="w-full h-2 bg-blue-100 rounded">
                                     <div class="h-2 bg-blue-500 rounded" style="width: 38%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>
                     <tr class="border-t">
                         <td class="p-2 font-medium">A/V Testimonial</td>
                         <td class="p-2 text-center">23</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr class="border-t">
                         <td class="p-2 font-medium">Social Media Posters</td>
                         <td class="p-2 text-center">23</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>

                     <tr class="border-t">
                         <td class="p-2 font-medium">Social Media Videos</td>
                         <td class="p-2 text-center">23</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>


                 </tbody>
             </table>


         </div>
     </div>






     <!-- Revenue Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Ad Performance
             </div>
             <div class="card-body">

                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Total Ads</div>
                         <div class="value">
                             <?= $summaryData['total_consulting'] ?>
                         </div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Leads Generated</div>
                         <div class="value"><?= $summaryData['new_patients'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Leads Converted</div>
                         <div class="value">
                             <?= $summaryData['total_patients'] - $summaryData['new_patients'] ?></div>
                     </div>
                     <div class="summary-row">
                         <div class="label">Conversion %</div>
                         <div class="value">
                             <?= $summaryData['total_patients'] - $summaryData['new_patients'] ?></div>
                     </div>



                 </div>


                 <hr>
                 <div class="summary-card">
                     <div class="summary-row">
                         <div class="label">Total Value Spent</div>
                         <div class="value"><?= $summaryData['total_consulting'] ?></div>
                     </div>

                     <div class="summary-row">
                         <div class="label">Revenue Generated</div>
                         <div class="value">
                             <h3><?= $summaryData['total_patients'] - $summaryData['new_patients'] ?></h3>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>






     <!-- Revenue Summary -->
     <div class="col-md-6">
         <div class="card">
             <div class="card-header">
                 Social Media Tracker
             </div>


             <table class="w-full text-sm text-left border border-gray-200">
                 <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                     <tr>
                         <th class="p-2">Platform</th>
                         <th class="p-2 text-center">LM Followers</th>
                         <th class="p-2 text-center">CM Followers</th>
                         <th class="p-2 text-center">🟢 %</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr class="border-t">
                         <td class="p-2 font-medium">Instagram</td>
                         <td class="p-2 text-center">13</td>
                         <td class="p-2 text-center">5</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-blue-700">38%</span>
                                 <div class="w-full h-2 bg-blue-100 rounded">
                                     <div class="h-2 bg-blue-500 rounded" style="width: 38%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>
                     <tr class="border-t">
                         <td class="p-2 font-medium">Facebook</td>
                         <td class="p-2 text-center">45</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>



                     <tr class="border-t">
                         <td class="p-2 font-medium">Youtube</td>
                         <td class="p-2 text-center">45</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>


                     <tr class="border-t">
                         <td class="p-2 font-medium">WhatsApp</td>
                         <td class="p-2 text-center">45</td>
                         <td class="p-2 text-center">22</td>
                         <td class="p-2 text-center">
                             <div class="flex flex-col items-center">
                                 <span class="text-sm font-semibold text-green-700">49%</span>
                                 <div class="w-full h-2 bg-green-100 rounded">
                                     <div class="h-2 bg-green-500 rounded" style="width: 49%"></div>
                                 </div>
                             </div>
                         </td>
                     </tr>
                 </tbody>
             </table>


         </div>
     </div>








     </div>

     <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

 </body>

 </html>