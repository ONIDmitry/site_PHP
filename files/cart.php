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
   
   if (isset($_SESSION['name'])){
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
            header("Location:variant.php");
           }
        
       if (isset($_POST['confirm'])) {
        
            
          $upd=mysql_query("UPDATE cort SET confirmed='yes' WHERE login='$log'");
           
        header("Location:zayavka.php");
       }
       
       
       
          
         if (isset($_POST['dkolvo'])) {
            $dcort=($_POST['itovar']);
            $ddni=($_POST['kdni']);
            
            $dzap=mysql_query("DELETE FROM cort WHERE login='$log' and ide='$dcort'  and dni='$ddni'");
         }
    
            ?>
           
         
             
          <? 
          $summa=0;
          unset($_SESSION['cart_success']);
          $cort=mysql_query("SELECT * FROM cort WHERE login='$log'");
           if ($mascort=mysql_fetch_array($cort)) {
            if ($mascort['confirmed']=="yes") {
                $_SESSION['cart_success']=1;
            } else {
            
            ?>
            <h1>Ваша корзина :</h1>
             <form action="" method="post" id="cart-form">
          <table id="mycart" cellspacing="0" cellpadding="3" border="1">
          <tr>
             <th> Товар(вид заказа)</th>
             <th> Цена,руб</th>
             <th> Кол-во</th>
             <th>Возможное кол-во</th>
             <th> Всего ,руб</th>
             <th>Количество дней</th>
             <th></th>
          </tr>
          <?
          
            do {
            $mcort=$mascort['ide'];
           $mat=mysql_query("SELECT * FROM variant WHERE ide='$mcort'");
           $masmat=mysql_fetch_array($mat);
          
          if ($mascort['dni']=="neogr") {
          ?>
           
             
             
          <tr>
              <td align="center"><?=$masmat['varname']?>(закупка)</td>
               <td align="center"><?=$masmat['tsenazak']?></td>
               <td align="center"><?=$mascort['kolvo']?></td>
               <td align="center"><?=$masmat['kolvo']?></td>
          <td align="center"><?=$masmat['tsenazak']*$mascort['kolvo']?></td>
          <td align="center">Неограниченно</td>
         <td align="center"><form method="post" action="cart.php">
           <input type="submit" name="dkolvo" value="Удалить"/>
            <input type="hidden" name="itovar" value="<?=$mcort?>"/>
             <input type="hidden" name="kdni" value="<?=$mascort['dni']?>"/>
           </form>
           </td> 
          </tr>
          
          <?
          
            $summa=$summa+($masmat['tsenazak']*$mascort['kolvo']);
          }
          else {
            
          
          ?>
              
          <tr>
              <td align="center"><?=$masmat['varname']?>(аренда)</td>
               <td align="center"><?=$masmat['tsenaaren']?></td>
               <td align="center"><?=$mascort['kolvo']?></td>
                <td align="center"><?=$masmat['kolvo']?></td>
          <td align="center"><?=$masmat['tsenaaren']*$mascort['kolvo']*$mascort['dni']?></td>
          <td align="center"><?=$mascort['dni']?></td>
           <td align="center"><form method="post" action="cart.php">
           <input type="submit" name="dkolvo" value="Удалить"/>
           <input type="hidden" name="itovar" value="<?=$mcort?>"/>
             <input type="hidden" name="kdni" value="<?=$mascort['dni']?>"/>
           </form>
           </td> 
          </tr>
         
           
          <? 
           
          $summa=$summa+($masmat['tsenaaren']*$mascort['kolvo']*$mascort['dni']);
           
          }
           }       
          while ($mascort=mysql_fetch_array($cort));
          
           ?>
           </table>
          <p class="toral">Общая сумма заказа (руб): <?=$summa?></p><br />
          <?
           echo "<span style='color:red;'>Внимание!!!  </span>"."<span style='color:blue;'><U>Ваша корзина пока считается недействительной!</U></span>"."<br>\n";
  echo "<span style='color:red;'>Внимание!!!  </span>"."<span style='color:blue;'><U>Если вы окончательно сделали свой выбор, нажмите кнопку [Подтвердить корзину]</U></span>"."<br>\n"; 
          ?>
           <p><input type="submit" name="confirm" value="Подтвердить корзину"/></p>
          </form> 
          <?
          }
          }
           else {
            echo "Ваша корзина пуста";
           }
           
             
           if (isset($_SESSION['cart_success'])) {
            header("LOCATION:zayavka.php");
           }
           ?>  
                 
           <form method="post" action="cart.php">
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






