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

    function formatMoney($number, $fractional = false)
    {
        if ($fractional) {
            $number = sprintf('%.2f', $number);
        }
        while (true) {
            $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
            if ($replaced != $number) {
                $number = $replaced;
            } else {
                break;
            }
        }
        return $number;
    }

    // $Invoice = mysqli_real_escape_string($connection, $_POST["Invoice"]); 
    $EmployeeCode = $_GET['ei'];



    $res = $connection->query(" select userid, username,mobileno,emailid,address1,b.designation,date_format(doj,'%d-%m-%Y') doj,gender,salary,
	  address2,area,city,state,pincode,hrdocumentid as HRID from usermaster  as a
	   join designationmaster as b on a.hrdesignation=b.`id` where a.userid ='$EmployeeCode';");


    while ($data = mysqli_fetch_row($res)) {

        $EmployeeName = $data[1];
        $MobileNo = $data[2];
        $EmailID = strtoupper($data[3]);
        $Address1 = $data[4];
        $Designation = $data[5];
        $DOJ = $data[6];
        $Gender = $data[7];
        $Salary = $data[8];
        $HRID = $data[14];
    }

    ?>
    <div class="content" id="content">


        <script>
            function printDiv() {
                var divToPrint = document.getElementById('DivInvoice');
                newWin = window.open("");
                newWin.document.write(divToPrint.outerHTML);
                newWin.print();
                newWin.close();
            }

            function Clickheretoprint() {
                var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
                disp_setting += "scrollbars=yes,width=900, height=400, left=100, top=25";
                var content_vlue = document.getElementById("DivInvoice").innerHTML;

                var docprint = window.open("", "", disp_setting);
                docprint.document.open();
                docprint.document.write(
                    '</head><body onLoad="self.print()" style="width: 800px; font-size: 17px; font-family: calibri;">');
                docprint.document.write(content_vlue);
                docprint.document.close();
                docprint.focus();
            }
        </script>
        <div id='DivInvoice'>

            <div style="margin: 0 auto; padding: 20px; width: 900px; font-weight: normal;">
                <div style="width: 100%; ">

                    <center> <img src="../assets/img/letterheadlogo.png" class="media-object" width="300" alt="" />
                    </center>
                    <hr>

                    <br>
                    <center><b>Appointment Letter</b></center>
                    <br>
                    <div style='float:right;'>Date : <?php echo $DOJ; ?>
                        <br>
                        HR/2024-25/<?php echo $HRID; ?>

                    </div>

                    <br>
                    <br>
                    <div style='float:left;'>
                        Name : <?php echo $EmployeeName; ?>
                        <br>
                        Mobile : <?php echo $MobileNo; ?>
                        <br>
                        Gender : <?php echo $Gender; ?>
                        <br>
                        Address : <?php echo $Address1; ?>

                        <br>
                        <p style="width: 800px; float: left;" align='justify'>
                            <br>
                            <b>
                                Sub: Letter of Appointment.
                            </b>
                            <br>
                            <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;This is with reference to your application for the job profile
                            <b>"<?php echo $Designation; ?>"</b> and the subsequent discussions you had with us at
                            the
                            interview,
                            on the following terms and conditions.
                            <br> <br>
                            Designation: <b><?php echo $Designation; ?></b> <br>
                            Location: <b>Chennai</b>

                            <br>
                            <br>
                            You may, however, be required to work at any place of the company per the later
                            requirement.

                            <br>
                            <br>
                            <b>Commencement of Employment:</b><br>

                            Your employment will be effective with us since <b><?php echo $DOJ; ?></b>.<br>
                            <br>
                            <b> Salary and Compensation:</b><br>
                            You will receive the Monthly Salary of <b>Rs. <?php echo $Salary; ?></b> and CTC of
                            <b><?php echo $Salary * 12; ?></b> lakhs, you will be on
                            probation initially, for a period of 6 months with effect from the date of joining. Your
                            probation may have extended by the company at its discretion based on your performance
                            and
                            or conduct. <br><br>


                            <b>Duties and Responsibilities:</b> <br>
                            a) The organization will expect you to work with high standard of initiative, efficiency
                            and
                            economy. You will perform, observe and confirm to such duties, directions and
                            instructions
                            assigned or communicated to you by the concerned authorities. <br>
                            b) You will devote your entire time to the work of the organization and will not
                            associate
                            yourself with any business, direct / indirect or work, honorary or with remuneration
                            either
                            in your name or in the names of your family members except with the written permission
                            from
                            the management. Contravention of this clause will lead to termination of your employment
                            with this organization without any notice or any compensation. <br>
                            c) You shall not seek membership of any local or public bodies without prior permission
                            of
                            the management in writing.


                            <br><br>

                            <b>Ethics and Confidentiality:</b> <br>
                            Strict Confidentiality and secrecy in mandatory from every employee, as regards any
                            information of whatever nature (verbal or documentary) acquired during the course of
                            employment and or interaction with the company’s associates, suppliers, customers etc.,
                            You
                            will not at any time divulge or disclose such information except with the written
                            consent of
                            the company or if required under legal process. It is also obligatory that you deal with
                            the
                            company’s money, material and documents with utmost honesty and professional ethics and
                            be
                            true and fair to the company in relation to all accounts and transactions related to the
                            company’s business. Non-adherence to this condition will constitute a breach of trust
                            and
                            the company reserves its right to terminate your employment without any notice. In case
                            of
                            such termination, no compensation for deficiency of notice period will be paid by the
                            company.


                            <br><br>
                            
                            
                            <b>Working Hours: </b>

                            The working days will normally start from Monday to Sunday. The working hours will be 7
                            AM to 5 PM (1st Shift) and 10 AM to 8 PM (2nd Shift), 30 mins lunch break. Compensation week off
                            will be based on rotational basis at the discretion of company.
                            <br><br>
                            
                            
                            <!--<b>Working Hours: </b>-->

                            <!--The working days will normally start from Monday to Sunday. The working hours will be 9-->
                            <!--AM to 7 PM, 30 mins Hour lunch break. Compensation week off-->
                            <!--will be based on rotational basis at the discretion of company.-->
                            <!--<br><br>-->
                            
                            
                            <b>General:</b> <br>
                            a) You will be governed by policies, rules and regulations of the organization that are
                            in
                            force from time to time.<br>
                            b) Your age mentioned in the Matriculation / Higher Secondary Certificate deemed to be
                            the
                            conclusive proof of your date of birth.<br>
                            c) You will intimate in writing to the management any change in your address with in the
                            week of such change,
                            failing which any communication sent to your last recorded address shall be deemed to
                            have
                            been served on you.<br>
                            d) The present designation is subject to change depending upon work assignments /
                            redeployment from time to time.<br>
                            e) You are expected remain in duty throughout the business/ Working hours of the
                            organization.<br>
                            f) The organization works on seven- days a week i.e. from Monday to Sunday. Your working
                            hours shall be as per rules in force from time to time and as demanded by your job.<br>
                            g) Incase, if you relieving from employment, should be in proper way which mean before
                            one
                            month you should inform your relieving in written format and clear all the dues. If not,
                            settlement wont redeemed.<br>
                            h) The Company encourages innovation and discovery or inventions and processes. If you
                            do
                            discover or contribute to any invention or improved process, it is expected from the
                            management end and get rewards.<br>
                            i) At first six months you have been considered as probationer. During this period,
                            management will notice your performance, attitude and rest of the factors. In case, if
                            we
                            receive any unfavorable report or dissatisfied with your work, management will terminate
                            you
                            at any of the probation month.<br>
                            <br><br>


                            <b>Termination and Notice Period:</b><br><br>
                            You reserve the right to terminate this agreement by providing written notice to the
                            company. The minimum notice period is thirty (60) days. <br>
                            The company reserves the right to terminate this your employment with prior notice with
                            or
                            without any reason <br>
                            • Misconduct, as provided in Misconduct and Disciplinary Action Policy<br>
                            • Non-adherence to Associate Deployment <br>
                            • Violation of social media or Conflict<br>
                            • Breach of integrity, embezzlement, misappropriation, misuse or causing damage to the
                            Company's assets/property or reputation<br>
                            • Insubordination or failure to comply with the directions given to you by persons so
                            authorized<br>
                            • Insolvency or conviction for any offence involving moral turpitude<br>
                            • Breach of any terms or conditions of the Agreement and/or Company's policies or other
                            documents or directions of the Company <br>
                            • Conduct regarded by the Company as prejudicial to its own interests or to the
                            interests of
                            its client.<br>

                            We congratulate you on your appointment and wish you a long career with us. We assure
                            you
                            have a great journey and get our full support for your professional growth and
                            development.
                            IN WITNESS WHEREOF, the Parties hereto have duly executed this Agreement as of the day
                            and
                            year first above written. <br><br>
                            I hereby acknowledge the terms and conditions of this Letter and I further confirm & declare
                            that I shall abide by the above terms and conditions.
                        </P>

                        <p style="width: 800px;">

                            <br><br>

                            <br><br>
                        </p>
                        <p style='float:left'>
                            <b>Sincerely,</b>

                            <br><br><br><br><br><br>
                            Signature & Date
                            <b>

                        </p>
                        <p style='float:right'>
                            For Sugamgunam Health
                            Centre</b>
                            <br><br><br><br><br><br>
                            Authorized Signatory
                            <b>
                        </p>



                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br><br><br>
                        <br><br>
                        <br><br>
                        <br><br>
                        <br>
                        <style>
                            .footer {
                                bottom: 0
                            }
                        </style>
                        <center class='footer'> <img src=" ../assets/img/letterheadaddress.png" class="media-object" width="800" alt="" />
                        </center>

                    </div>

                    <div class="clearfix"></div>
                </div>
                <div style="width: 100%; ">




                </div>
            </div>
        </div>
    </div>
    <center>
        <tr>
            <?php


            // Get the content that is in the buffer and put it in your file //
            file_put_contents('Bill.html', ob_get_contents());
            ?>

            <td><button type="button" onclick="Clickheretoprint();" class="btn btn-sm btn-info">
                    <i class="icon-print"></i> Print</button> </td>


    </center>
    <script>
        function redirecttoReceiptPrint() {
            var Invoice = document.getElementById("txtInvoiceNo").value;
            var str1 = "ReceiptPrint.php?invoice=";
            var str2 = Invoice;
            var str3 = "";
            var BillPrintURL = str1.concat(str2, str3);
            // alert(BillPrintURL);
            // window.location.href = BillPrintURL;
            window.open(BillPrintURL);
        }
    </script>
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Email To</h4>
                </div>
                <div class="modal-body">
                    <label>
                        Email ID*
                    </label>
                    <input class="form-control" style='width: 350px;' type="text" name="txtEmail" id="txtEmail" />

                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>

                    <a href="javascript:;" type='submit' onclick='SeneEmail();' class='btn btn-sm btn-success'>Send</a>
                </div>
            </div>
        </div>
    </div>



</form>




<script>
    function SeneEmail() {

        var EmaiID = document.getElementById("txtEmail").value;
        if (EmaiID == "") {
            alert("Kindly provide Email ID");
        } else {

            var datas = "&EmaiID=" + EmaiID;
            // alert(datas);
            $.ajax({
                url: "sendemail.php",
                method: "POST",
                data: datas,
                success: function(data) {
                    alert(data);

                }
            });
        }

    }
</script>