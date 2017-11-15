<?php
  $connect = mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('tutorials');
mysql_query ("set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");

?>
<!DOCTYPE html >

<html>
<head>
<title>Отдел снабжения института-новости</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
<link rel="stylesheet" type="text/css" href="vid.css" />

<div>


</div>

</head>





    



<body>
 
<div class="wrapper">
    <div class="header">
  <div class="left_up">
  <?php
  session_start();
    if (isset($_COOKIE['a'])){
    $c=$_COOKIE['a'];
    $query=mysql_query("SELECT * FROM loginuser WHERE cod='$c'");
    $userdata=mysql_fetch_array($query);
    $k=$userdata['username'];
     $log=$userdata['login'];
     $_SESSION['name']=1;
    }
else {
    unset($_SESSION['name']);
    unset($_SESSION['buh']);
    unset($_SESSION['admin']);
}

  
  

 if(isset($_POST['logout'])){
   unset($_SESSION['name']);
   unset($_SESSION['buh']);
    unset($_SESSION['admin']);
   setcookie("a","",time()-259200,"/");
    }
   
     if (isset($_SESSION['name'])==1) {
        echo "Hello, ".$k."!".'<br/><form method= "post" action ="index.php">
<input type = "submit" name = "logout" value = "Выйти"/><br/>
</form>';
   $good=true;
   }

if (isset($_SESSION['name'])) {
    echo '<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
  var no_active_delay = 120; 
  var now_no_active = 0; 
  setInterval("now_no_active++;", 1000); 
 setInterval("update()", 1000);
  document.onmousemove = activeUser; 
  function activeUser() {
    now_no_active = 0; 
  }
  function update() {
    if (now_no_active >= no_active_delay) { 
      alert("Пользователь не активен"); 
      
      var login=1;
      $.post("default.php",
       {
        
         login:login
        
        
       },
       function(data) {
        $("#alertt").html(data);
       });
       document.location.href = "default.php";
      return;
    }
   
  }
</script>';
}


 if (isset($_POST['userchern'])) {
    $chernlogin=$_POST['blogin']; 
    if ($chernlogin<>""){
     $zapr=mysql_query("INSERT INTO chern VALUES('','$chernlogin')") or die(mysql_error());
    }
  }
 

if (isset($_POST['usercherndel'])) {
    $delloginchern=$_POST['dlogin'];
    if ($delloginchern<>"") {
    $zapr=mysql_query("DELETE FROM chern WHERE login='$delloginchern' ") or die(mysql_error());
}
}    
   
 ?>
  </div>
  
<div class="right_up">
  <img src="logotip.png"/>
</div>
  </div> 
    <div class="content">

             <div class="left">
            
           <?php
           if (!$good){
            header("Location:mustregistr.php");
           }
           
           if (isset($_POST['backto'])) {
            header("Location:index.php");
           }
           
           
           
           $prov=mysql_query("SELECT * FROM zakaz WHERE login='$log'");
           if ($masprov=mysql_fetch_array($prov)) {
            echo 'У вас уже есть заказ на изготовление! Ждите его подтверждения!';
           }
           else {
      if ((!isset($_SESSION['admin'])) and(!isset($_SESSION['buh']))) {
      if (isset($_POST['podtzakaz'])) {
    
    
     
    $bad=false;
   
    unset($_SESSION['error_tovar']);
    unset($_SESSION['error_kolvo']);
    unset($_SESSION['error_tsena']);
    unset($_SESSION['zakaz_success']);
    $tovar=($_POST['tovar']);
    $kolvotovar=($_POST['kolvotovar']);
    $tsenatovar=($_POST['tsenatovar']);

     
        
 if (!preg_match("/^[a-zA-Z0-9а-яА-Я_-]+$/", $tovar)){
        $_SESSION['error_tovar']=1;
        $bad=true;
       }
       

  if (!ctype_digit($kolvotovar)) {
                $_SESSION['error_kolvo']=1;
                $bad=true;
               }
               
               
               
if (!ctype_digit($tsenatovar)) {
    $_SESSION['error_tsena']=1;
                $bad=true;
               }
       
       
      
      if (!$bad){
       
      $query=mysql_query("INSERT INTO zakaz VALUES('','$log','$tovar','$kolvotovar','$tsenatovar','','','','')") or die(mysql_error());
      $_SESSION['zakaz_success']=1;
      
      
      }

}


 if(isset($_SESSION['error_tovar'])==1){
   echo "<span style='color: red;'>Название товара может включать только цифры, тире, подчеркивание и латинские символы! </span>"."<br>\n";
   unset($_SESSION['error_tovar']);
    
 }
 
  if(isset($_SESSION['error_kolvo'])==1){
   echo "<span style='color: red;'>Количество товара-это натуральное число! </span>"."<br>\n";
   
    unset($_SESSION['error_kolvo']);
    
 }
 
if (isset($_SESSION['error_tsena'])==1){
    echo "<span style='color: red;'>Цена заказа - натуральное число!</span>"."<br>\n";
    unset($_SESSION['error_tsena']);
}


if (isset($_SESSION['zakaz_success'])==1) {
    echo "<span style='color: green;'>Ваш заказ успешно добавлен! Дождитесь подтверждения админа, в случае успеха на главной странице вас оповестят! </span>"."<br>\n";
    unset($_SESSION['zakaz_success']);
 }

 

      
      
      
      
      
      
      
      
      

          
           
           ?>
           <h2>Заполните необходимые поля для завершения заказа на изготовление </h2>
           <form method="post" action="zakaz.php">
           <p>Введите вид товара : <input type="text" name="tovar" required/></p>
           <p>Введите количество данного товара : <input type="text" name="kolvotovar" required/></p>
           <p>Введите цену этого заказа : <input type="text" name="tsenatovar" required/></p>
           <input type="submit" name="podtzakaz" value="Подтвердить заказ"/>
           </form><br /><br /><br />
           
           
           <? } else  {
            echo '<h2>Администратор сайта и бухгалтерия не могут заказывать у своего отдела!!!</h2>';
           }
           }?>
           <form method="post" action="variant.php">
           <input type="submit" name="backto" value="Вернуться"/><br />
           </form>
      
      
           </div>  
               <div class="right">
              <div class="right_menu">
              <a href="index.php">Главная</a>
              <a href="rules.php">Правила сайта</a>
              <a href="novosti.php">Свежие новости</a>
              <a href="arhiv.php">Архив</a>
              <a href="cart.php">Ваша корзина</a>
              </div>
               <div class="admin">
              <?php
              if (isset($_SESSION['admin'])==1) {
                echo '<form method="post" action="index.php">
                <input type="text" name="blogin" placeholder=" |  UserAdd"  /><br/>
               <input type = "submit" name = "userchern"  value = "Добавить пользователся в чс"/><br/>';
               
               echo '<form method="post" action="index.php">
                <input type="text" name="dlogin" placeholder=" |  UserDelete"  /><br/>
               <input type = "submit" name = "usercherndel"  value = "Убрать пользователя из чс"/><br/>';
               }
             ?>
              </div>
              
        <div style="clear: both;"></div>
        </div>
   
</div>

<div class="footer">
Защита прав, 1999 итд</div>
</div>
 </div>

</body>
</head>
</html>






