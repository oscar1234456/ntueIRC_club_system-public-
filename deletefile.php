<?php
    session_start();
?>
<?php
  try {
    $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxxx", "xxxxx");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
  catch (PDOException $e) {
      print("Error connecting to SQL Server.");
      die(print_r($e));
  }
    $wantTodelete = "upload/".$_POST['file_name'];
    if(file_exists($wantTodelete)){
            unlink($wantTodelete);//將檔案刪除
            $ex = $conn ->exec("delete from Homework_submit where SId_H = '".$_SESSION['userId']."' AND SHId = '".$_POST['HId']."';");
            print "已經刪除!<br>3秒後關閉視窗";
          ?>
    <script>opener.location.reload(); setTimeout("window.close()",3000);</script>
       <?php }else{
            echo"檔案不存在";
        }
?>        