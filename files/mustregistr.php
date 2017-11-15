<!DOCTYPE html >

<html>
<head>
<title>Отдел снабжения института</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<link rel="stylesheet" type="text/css" href="naregistr.css" />
<div>


</div>

</head>









<body>
<div class="wrapper">
   <div class="header">
       <div class="left_up">
     
       </div>
       <div class="right_up">
       <img src="logotip.png"/>
       </div>
   
   </div>
   <div class="content">
   <?php
   if(isset($_COOKIE['a'])) {
        echo"<span style='color:green;'> Вы уже зарегистрированы!<span/>"
   .'<form method="post" action="registration.php">
<input type ="submit" name ="back" value ="Вернуться"/><br/>
</form>'; 
   }
   else{
        echo"<span style='color:red;'>Для просмотра необходимо войти в свой аккаунт. Если у вас нет своего аккаунта, пожалуйста, зарегистрируйтесь<span/>"
   .'<form method="post" action="registration.php">
<input type ="submit" name ="back" value ="Вернуться"/><br/>
</form>';
} 
?>  
     
      </div>
      
      
      
   
   <div class="footer">Защита прав, 1999 итд</div>
</div>



</body>
</head>
</html>






