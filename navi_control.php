<?php
//$fh = fopen('nav.txt','ab');
//fwrite($fh,"\noooo.html|掰掰!");
//fclose($fh);
?>

<html>
<head><title>naviControl</title></head>
<body>
    <form action="">
        <select name="" id="">
        <?php
            foreach(file('nav.txt') as $line){
                $line = trim($line);
                $info = explode('|',$line);
                print '<option>'.$info[1].'</option>';
            }
        ?>
        </select>
    
    </form>
</body>
</html>