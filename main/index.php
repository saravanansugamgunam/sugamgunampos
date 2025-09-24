<?php include 'header.php'; ?>
<?php include('navfixed.php'); ?>
<div class="container-fluid">
    <div class="row-fluid">

        <style>
        #mainmain .HomeTable {
            text-decoration: none;
            padding-top: 15px;
            padding-bottom: 5px;
            padding-left: 5px;
            padding-right: 15px;
            border-radius: 15px;
            margin: 10px;

            display: inline-block;
            width: 150px;
            height: 85px;
            text-align: center;
            margin-bottom: 1px;
        }
        </style>


        <div id="mainmain">
            <?php
            $CurrentDate = date("Y-m-d");
            $position = $_SESSION['SESS_GROUP_ID'];
            $UserID = $_SESSION['SESS_MEMBER_ID'];


            if ($position == '2') {
            ?>


            <center>
                <table>
                    <tr>
                        <td class='HomeTable'><a href="IM/index.php?MID=1"><img src="assets/img/iconmedicine.png"
                                    class="media-object" alt="" /></a> </td>
                        <td class='HomeTable'> <a href="CLM/index.php?MID=18"><img src="assets/img/iconconsulting.png"
                                    class="media-object" alt="" /></a></td>
                        <td class='HomeTable'> <a href="TPM/index.php?MID=18"><img src="assets/img/icontherapy.png"
                                    class="media-object" alt="" /></a></td>
                        <td class='HomeTable'><a href="DS/index.php?MID=1"><img src=" assets/img/icondiagnosis.png"
                                    class="media-object" alt="" /></a> </td>

                        <td class='HomeTable'><a href="CM/index.php?MID=1"><img src="assets/img/iconcourse.png"
                                    class="media-object" alt="" /></a> </td>


                    </tr>
                    <tr>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                    <tr>

                    <tr>
                        <td class='HomeTable'><a href="FM/index.php?MID=1"><img src="assets/img/iconfinance.png"
                                    class="media-object" alt="" /></a> </td>
                        <td class='HomeTable'> <a href=""><img src="assets/img/iconreports.png" class="media-object"
                                    alt="" /></a></td>
                        <td class='HomeTable'><a href="MT/index.php?MID=1"><img src="assets/img/iconmarketing.png"
                                    class="media-object" alt="" /></a> </td>
                        <td class='HomeTable'><a href=""><img src="assets/img/iconhr.png" class="media-object"
                                    alt="" /></a> </td>

                        <td class='HomeTable'><a href="EC/index.php?MID=1"><img src="assets/img/iconecommerce.png"
                                    class="media-object" alt="" /></a> </td>

                    </tr>
                </table>


            </center>
            <?php
            }
            
             if ($position == '3') {
            ?>


            <center>
                <table>
                    <tr>
                        <td class='HomeTable'><a href="IM/index.php?MID=1"><img src="assets/img/iconmedicine.png"
                                    class="media-object" alt="" /></a> </td>
                        <td class='HomeTable'> <a href="CLM/index.php?MID=18"><img src="assets/img/iconconsulting.png"
                                    class="media-object" alt="" /></a></td>
                        <td class='HomeTable'> <a href="TPM/index.php?MID=18"><img src="assets/img/icontherapy.png"
                                    class="media-object" alt="" /></a></td>
                        <td class='HomeTable'><a href="DS/index.php?MID=1"><img src=" assets/img/icondiagnosis.png"
                                    class="media-object" alt="" /></a> </td>

                        <td class='HomeTable'><a href=""><img src="assets/img/iconcourse.png" class="media-object"
                                    alt="" /></a> </td>


                    </tr>
                    <tr>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                    <tr>

                    <tr>
                        <td class='HomeTable'><a href=""><img src="assets/img/iconfinance.png" class="media-object"
                                    alt="" /></a> </td>
                        <td class='HomeTable'> <a href=""><img src="assets/img/iconreports.png" class="media-object"
                                    alt="" /></a></td>
                        <td class='HomeTable'><a href=""><img src="assets/img/iconmarketing.png" class="media-object"
                                    alt="" /></a> </td>
                        <td class='HomeTable'><a href=""><img src="assets/img/iconhr.png" class="media-object"
                                    alt="" /></a> </td>

                        <td class='HomeTable'><a href="EC/index.php?MID=1"><img src="assets/img/iconecommerce.png"
                                    class="media-object" alt="" /></a> </td>

                    </tr>
                </table>


            </center>
            <?php
            }
            

            if ($position == '1') {
            ?>


            <center>
                <table>
                    <tr>

                        <td class='HomeTable'><a href="IM/index.php?MID=1"><img src="assets/img/iconmedicine.png"
                                    class="media-object" alt="" /></a> </td>
                        <td class='HomeTable'> <a href="CLM/index.php?MID=18"><img src="assets/img/iconconsulting.png"
                                    class="media-object" alt="" /></a></td>
                        <td class='HomeTable'> <a href="TPM/index.php?MID=18"><img src="assets/img/icontherapy.png"
                                    class="media-object" alt="" /></a></td>
                        <td class='HomeTable'><a href="DS/index.php?MID=1"><img src="assets/img/icondiagnosis.png"
                                    class="media-object" alt="" /></a> </td>

                        <td class='HomeTable'><a href="CM/index.php?MID=1"><img src="assets/img/iconcourse.png"
                                    class="media-object" alt="" /></a> </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                    <tr>

                    <tr>
                        <td class='HomeTable'><a href="FM/index.php?MID=1"><img src="assets/img/iconfinance.png"
                                    class="media-object" alt="" /></a> </td>
                        <?php if($UserID=='91' || $UserID=='13' || $UserID=='30') { ?>
                        <td class='HomeTable'> <a href="RP/index.php?MID=1"><img src="assets/img/iconreports.png"
                                    class="media-object" alt="" /></a></td>

                        <?php } else { ?>
                        <td class='HomeTable'> <a href=""><img src="assets/img/iconreports.png" class="media-object"
                                    alt="" /></a></td>
                        <?php  } ?>

                        <td class='HomeTable'><a href="MT/index.php?MID=1"><img src="assets/img/iconmarketing.png"
                                    class="media-object" alt="" /></a> </td>
                        <td class='HomeTable'><a href="AM/index.php?MID=1"><img src="assets/img/iconhr.png"
                                    class="media-object" alt="" /></a> </td>

                        <td class='HomeTable'><a href="EC/index.php?MID=1"><img src="assets/img/iconecommerce.png"
                                    class="media-object" alt="" /></a> </td>
                    </tr>
                </table>

            </center>

            <?php
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
</body>
<br>
<br>
<br>
<br>
<br>
<?php include('footer.php'); ?>

</html>