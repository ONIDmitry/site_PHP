<?php
if(isset($_POST)) {
    
    if (!empty($_POST['chlogin'])) {
    $chlogin=$_POST['chlogin'];
    
 $connect = mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('tutorials');
    
    
    $result=mysql_query("SELECT * FROM chern WHERE login='$chlogin'");
    if (mysql_num_rows($result)>0) {
        $row=mysql_fetch_array($result);
        echo "<h2><span style='color:red;'>Этот пользователь в чёрном списке!</span></h2>"."<br>\n";
         
    } else { echo "<h2><span style='color:green;'>Этого пользователя нет в чёрном списке!</span></h2>"."<br>\n"; }
    
  } else {
    echo "<h2><span style='color:red;'>Вы не ввели пользователя на проверку!</span></h2>"."<br>\n";
  }  
    
}



?>