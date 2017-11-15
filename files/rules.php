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
<title>Отдел снабжения института-форум</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="style.css" />

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
    
   
 ?>
  </div>
  
<div class="right_up">
  <img src="logotip.png"/>
</div>
  </div> 
    <div class="content">

             <div class="left">
             
           <?php
          
            
      echo "<span style='color:blue;'>На нашем сайте вы можете заказать необходимые материалы для вашего института.</span>"."<br>\n";
      echo     "<span style='color:blue;'>Ссылка на переход к просмотру возможных вариантов находится на главной странице.</span>"."<br>\n";
      echo    "<span style='color:blue;'>Вы можете заказать товар как для закупки, так и взять в аренду на определённое количество дней.</span>"."<br>\n";
      echo    "<span style='color:blue;'>Список ваших выбранных вариантов формируется корзиной, вы можете отслеживать ваш выбор, нажав на ссылку [Ваша корзина].</span>"."<br>\n";
      echo    "<span style='color:blue;'>Также в корзине вы можете отслеживать общую сумму заказа, а также можете удалить данный товар в случае, если вы ошиблись или хотите заказать меньшее количество (клавиша [Удалить]для данного вида товара).</span>"."<br>\n";
      echo    "<span style='color:blue;'>При повторном выборе аренды товара, который уже есть в вашей корзине, количество дней устанавливается столько, сколько было указано при последнем выборе .</span>"."<br>\n";
      echo    "<span style='color:blue;'>Пожалуйста, будьте внимательны.</span>"."<br>\n";
   echo "<span style='color:red;'><U>Важно!!!  </span>"."<span style='color:blue;'>Ваш заказ считается недействительным, пока вы не подтвердили ваш выбор в вашей корзине.</span>"."<br>\n"; 
   echo "<span style='color:red;'>Важно!!!  </span>"."<span style='color:blue;'>Это означает, что по мере заполнения корзины другой пользователь может опередить вас и заказать</span>"."<br>\n";
   echo "<span style='color:red;'>Важно!!!  </span>"."<span style='color:blue;'>большое количество данного товара,</span>"."<br>\n";  
   echo "<span style='color:red;'>Важно!!!  </span>"."<span style='color:blue;'>и вам может не хватить товара ввиду ограниченности возможного количества.</U></span>"."<br>\n";
   echo "<span style='color:blue;'>В корзине вас всегда предупредят об оставшемся возможном количестве данного товара.</span>"."<br>\n";
   echo "<span style='color:blue;'>Пожалуйста, не затягивайте с подтверждением выбора вашей корзины.</span>"."<br>\n";
   echo "<span style='color:blue;'>После подтверждения корзины вы должны заполнить поля для заявки, в этом случае</span>"."<br>\n"; 
   echo "<span style='color:blue;'>вы еще можете вернуться к своей корзине, перейдя по ссылке</span>"."<br>\n"; 
   echo "<span style='color:blue;'>на данной странице,изменить или удалить её полностью, нажав на соответствующую кнопку.</span>"."<br>\n";
   echo "<span style='color:blue;'>Но после этого не забудьте ее опять подтвердить)</span>"."<br>\n";
   echo "<span style='color:blue;'>После заполнения полей для заявки вам будет присвоен её номер.</span>"."<br>\n";
   echo "<span style='color:red;'><U>Важно!!!  </span>"."<span style='color:blue;'>В этом случае ваша корзина будет подтверждена окончательно!!</U></span>"."<br>\n";
   echo "<span style='color:blue;'>После этого вам надо дождаться подтверждения заказа вашей бухгалтерией.</span>"."<br>\n"; 
   echo "<span style='color:blue;'>После подтверждения вашего заказа бухгалтерией вы будете оповещены.</span>"."<br>\n";
   echo "<span style='color:blue;'>После этого вы можете забирать свой товар по адресу, который вы увидите)</span>"."<br>\n"; 
      echo "<h1><span style='color:brown;'>Спасибо Вам за пользование нашим сайтом!</span></h1>"."<br>\n";    
  
  
  
  
       
            if (isset($_POST['userchern'])) {
    $chernlogin=$_POST['blogin']; 
    if ($chernlogin<>""){
     $zapr=mysql_query("INSERT INTO chern VALUES('','$chernlogin')") or die(mysql_error());
    }
  }
 

if (isset($_POST['usercherndel'])) {
    $delloginchern=$_POST['dlogin'];
    if ($delloginchern<>"") {
    $zapr=mysql_query("DELETE FROM chern WHERE blogin='$delloginchern' ") or die(mysql_error());
}
}
           
           
           
            ?>
            

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






