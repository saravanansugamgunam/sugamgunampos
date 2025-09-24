<html>

<?php
    // Start the buffering //
    ob_start();

    include("../../connect.php");

    session_cache_limiter(FALSE);
    session_start(); 
    $LocationCode = $_SESSION['SESS_LOCATION'];

    $Invoice = $_GET['invoice'];
 

        
    ?>


<style>
body {
    background: rgb(204, 204, 204);
}

page {
    position: relative;
    background: white;
    display: block;
    margin: 0 auto;
    margin-bottom: 0.5cm;
    box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
}

page[size="A4"] {
    width: 21cm;
    height: 29.7cm;
}

header,
footer {
    position: absolute;
    left: 0;
    right: 0;
    /* padding-right: 1.5cm;
    padding-left: 1.5cm; */
}



header {
    top: 0;
    padding-top: 5mm;
    padding-bottom: 3mm;
}

footer {
    bottom: 0;
    color: #000;
    /* padding-top: 3mm;
    padding-bottom: 5mm; */
}

@media print {

    body,
    page {
        margin: 0;
        box-shadow: 0;
    }

    header,
    footer {
        position: fixed;
        left: 0;
        right: 0;
        background-color: #ccc;
        padding-right: 0cm;
        padding-left: 0cm;
    }
}
</style>

<body>
    <?php
$result = mysqli_query($connection, "  SELECT 
(SELECT COUNT(*) FROM paitentdocumentmaster WHERE referenceid ='1718095420846') AS TotalDocuments,
CONCAT('../CLM/',documentpath) AS Path 
 FROM paitentdocumentmaster WHERE referenceid ='$Invoice'  
                                "); 
                                
                                while($data = mysqli_fetch_row($result))
                                {
                                   echo " <page size='A4'>
                                   <header>
                                       <center> <img src='../assets/img/letterheadlogo.png' class='media-object' width='300' alt='' />
                                   </header> 
                                   <img src='$data[1]' width='780' />
                                <footer>
                                       <center> <img src='../assets/img/letterheadaddress.png' width='800' alt='' />
                                       </center>
                                   </footer>
                               </page> ";
                                } ?>
</body>

</html>