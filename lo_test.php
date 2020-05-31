<?php
session_start();
?>
<html>
<head><title>login_test</title></head>
<body>

<?php if($_SERVER['REQUEST_METHOD'] == 'POST'){

try {
    $conn = new PDO("sqlsrv:server = tcp:ntueirc.database.windows.net,1433; Database = xxxxx", "xxxx", "xxxx");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //query Member data
    $q = $conn -> query("select M_Name,passwords from Member where SId = ".$_POST['username'].";");
    $rows = $q -> fetchAll();
    
    //query Teacher data
    $q2 = $conn -> query("select Teacher_Name,pwd from Teacher where Teach_Id = ".$_POST['username'].";");
    $rows2 = $q2 -> fetchAll();
    if(count($rows)==0 && count($rows2) == 0){
        print "查無此帳號!";
    }else if(count($rows) != 0){ //if find user is the member
     
        $username =  $rows[0][0];
        $password =  $rows[0][1];
        
        if($_POST['password'] == $password){
            $q3 = $conn->query("select Carde_Name from Member,Carde where ".$_POST['username']."= SId and SId = CSId;");
            $rows3 = $q3 -> fetchAll();
            if(count($rows3)!= 0){
                $Carde = $rows3[0][0];
                $_SESSION['Carde'] = $Carde;
                print $Carde.$username."您好!";
            }else{
                $_SESSION['Carde'] = '社員';
                print "社員".$username."您好!";
            }
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $_POST['username'];
            print "<br>"; 
            print "已登入完成";
    ?>
    <script type="text/javascript"> setTimeout("window.location.href='naviTest.php'",3000); </script><?php
        }else{
            print "密碼不對喔!";
        ?>
            <br>
            <script type="text/javascript"> setTimeout("window.location.href='login.php'",2000); </script>
            <p>將帶您前往登入畫面!</p>
        <?php
        }
        
    }else{  //if find user is the teacher
         
        $username_teacher =  $rows2[0][0];
        $password_teacher =  $rows2[0][1];
        
        if($_POST['password'] == $password_teacher){

                $_SESSION['Carde'] = "教師";
                print "教師 ".$username_teacher." 您好!";
            
            $_SESSION['username'] = $username_teacher;
            $_SESSION['userId'] = $_POST['username'];
            print "<br>"; 
            print "已登入完成";
    ?>
    <script type="text/javascript"> setTimeout("window.location.href='naviTest.php'",3000); </script><?php
        }else{
            print "密碼不對喔!";
          ?>
            <script type="text/javascript"> setTimeout("window.location.href='login.php'",3000); </script>
        <?php
        }
    }
    
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}


}else{?>
    正將您帶到登入畫面！
    <script type="text/javascript"> setTimeout("window.location.href='in.php'",3000); </script>
<?php }?>
</body>
</html>