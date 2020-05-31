<?php
session_start();

?>

<?php



    $HId = $_GET['HId'];
    try {
        $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $conn ->query("select Title,Homework_End_date,Homework_content,HCId from Homework where HId ="."'".$HId."';");
        $rows = $q->fetchAll();
       }
      catch (PDOException $e) {
          print("Error connecting to SQL Server.");
          die(print_r($e));
      }
   
        ?>
        <p>作業編號： <?php print $HId ?></p>
        <p>課程編號： <?php print $rows[0][3]?></p>
        <p>作業標題： <?php print $rows[0][0]?></p>
        <p>繳交期限： <?php print $rows[0][1]?></p>
        <p>作業內容： <?php print $rows[0][2]?></p>
       
