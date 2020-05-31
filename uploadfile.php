<?php
session_start();

?>

<script language = javascript>
    function click_img_cancel(){
        var sure = window.confirm("您確定要刪除嗎?");
        if(sure){
            form_cancel.submit();
        }
    }
</script>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if($_FILES['file']['error']>0){
        echo "Error: ".$_FILES['file']['error'];?>
        <script type="text/javascript"> setTimeout("window.location.href='uploadfile.php'",3000)</script>
        <?php
    }else{
        if(file_exists("upload/".$_SESSION['userId']."_".$_FILES['file']['name'])){
            try {
                $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               }
              catch (PDOException $e) {
                  print("Error connecting to SQL Server.");
                  die(print_r($e));
              }
            
            for(@$i=0;$i<=100;$i++){
                if(!file_exists("upload/".$_SESSION['userId']."_".$i."_".$_FILES['file']['name'])){
                    $filename = $_SESSION['userId']."_".$i."_".$_FILES['file']['name'];
                    move_uploaded_file($_FILES['file']['tmp_name'],"upload/".$filename);
                    $ex = $conn ->exec("insert into Homework_submit values('".$_POST['HId']."', '".$_SESSION['userId']."', '".$filename."', '0');");
                    print "上傳成功! 3秒後關閉視窗!";
                  
                    break;
                }
            }
            ?>
            
            <script>opener.location.reload(); setTimeout("window.close()",3000);</script>
            <?php
        }else{
            try {
                $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               }
              catch (PDOException $e) {
                  print("Error connecting to SQL Server.");
                  die(print_r($e));
              }
              $filename = $_SESSION['userId']."_".$_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'],"upload/".$filename);
            //$ex = $conn ->exec("update from Homework_submit set files_name = '".$filename."'  where SId = '".$_POST['HId']."' SId_H = '".$_SESSION['userId']."';");
            $ex = $conn ->exec("insert into Homework_submit values('".$_POST['HId']."', '".$_SESSION['userId']."', '".$filename."', '0');");
            
            print "上傳成功! 3秒後關閉視窗!";
      
            ?>
            
           <script>opener.location.reload();  setTimeout("window.close()",3000);</script>
            <?php
        }
    }
}else{
    $state = $_GET['file_state'];
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
    if($state == false){
        ?>
        <p>作業編號： <?php print $HId ?></p>
        <p>課程編號： <?php print $rows[0][3]?></p>
        <p>作業標題： <?php print $rows[0][0]?></p>
        <p>繳交期限： <?php print $rows[0][1]?></p>
        <p>作業內容： <?php print $rows[0][2]?></p>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        檔案上傳: <input type="file" name="file"   id="file" /><br />
      <br>
      <br>
           
            <input type="hidden"  name = "HId" value="<?php print $HId?>">
            <input type="submit" value="開始上傳">
        </form>
    <?php }else{
        $q4 = $conn ->query("select files_name from Homework_submit where SHId ="."'".$HId."' AND SId_H = '".$_SESSION['userId']."';");
        $getfile = $q4->fetchAll();
        ?>
         <p>作業編號： <?php print $HId ?></p>
        <p>課程編號： <?php print $rows[0][3]?></p>
        <p>作業標題： <?php print $rows[0][0]?></p>
        <p>繳交期限： <?php print $rows[0][1]?></p>
        <p>作業內容： <?php print $rows[0][2]?></p>
        <p>您已繳交檔案： <a href="upload/<?php print $getfile[0][0]?>" download><?php print $getfile[0][0]?></a></p>
        <form action="deletefile.php" method="post" name="form_cancel">
            <input type="button" value="刪除檔案" onclick="click_img_cancel()">
            <input type="hidden" name = "file_name"value="<?php print $getfile[0][0];?>">
            <input type="hidden" name = "HId"value="<?php print $HId;?>">
        </form>
    <?php }
}?>