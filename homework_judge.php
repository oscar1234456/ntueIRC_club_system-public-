


<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try {
        $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        $q = $conn ->exec("update Homework_submit set correct = '".$_POST['score']."' where SId_H = '".$_POST['SId']."' AND SHId = '".$_POST['HId']."';");
        print "已評分完畢 3秒後自動關閉視窗";
        ?>
      <script>opener.location.reload();  setTimeout("window.close()",3000);</script>
    <?php  }
      catch (PDOException $e) {
          print("Error connecting to SQL Server.");
          die(print_r($e));
      }
    
    
}else{
    $SId = $_GET['SId'];
    $HId = $_GET['HId'];
    try {
        $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $conn ->query("select M_Name,Title,correct from Member,Homework,Homework_submit where SId = '".$SId."' AND SId = SId_H AND SHId=HId AND SHId = '".$HId."';");
        $rows = $q->fetchAll();
       }
      catch (PDOException $e) {
          print("Error connecting to SQL Server.");
          die(print_r($e));
      }?>
        <p>學生學號：<?php print $SId; ?></p>
        <p>學生姓名：<?php print $rows[0][0]; ?></p>
        <p>作業標題：<?php print $rows[0][1]; ?></p>
        <form action="homework_judge.php" method = "post">
        評分：<input type="text" name ="score" value="<?php print $rows[0][2]; ?>" required> 
        <input type="hidden" name="SId" value="<?php print $SId;?>">
        <input type="hidden" name="HId" value="<?php print $HId;?>">
        <br>
        <input type="submit" value="傳送">
        
        </form>
    
<?php }
?>