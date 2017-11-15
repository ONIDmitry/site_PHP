<!DOCTYPE html >

<html>
<head>
<title>Проверка чёрного списка</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>

<link rel="stylesheet" type="text/css" href="style.css" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#but").click(function(){
       var chlogin=$("#chlogin").val();
       $.post("prov.php",
       {
        
         chlogin:chlogin
        
        
       },
       function(data) {
        $("#alert").html(data);
       }
       );
    });
    });


</script>
    



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
      <div class="right">
      <div class="right_menu">
              <a href="index.php">Главная</a>
              <a href="forum.php">Форум</a>
              <a href="novosti.php">Свежие новости</a>
              <a href="arhiv.php">Архив</a>
              <a href="cart.php">Ваша корзина</a>
              </div>
              
      </div>
      <div class="left">
      
      <h2>Проверить ч/c</h2>
               <input type="text" id="chlogin"/>
              <button id="but" >Проверить пользователя</button>
              <p id="alert"></p>
       


 


<form method="post" action="registration.php">
<input type ="submit" name ="back" value ="Вернуться"/><br/>

</form>
      </div>
   </div>
   <div class="footer">Защита прав, 1999 итд</div>

</div>



</body>
</head>
</html>






