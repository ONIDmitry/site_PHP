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
          
           if (isset($_POST['backt'])) {
            header("Location:index.php");
           }
        
      
        
    
          if(isset($_POST['bsub'])) {
            $log=$_POST['blog'];
            $m="yes";
             $cortz=mysql_query("UPDATE zayavka SET buhcon='$m' WHERE login='$log'  ");
                 $conf=mysql_query ("SELECT * FROM cort WHERE login='$log'") ;
                while ($mconf=mysql_fetch_array($conf)) {
                    $id=$mconf['ide'];
                $mat=mysql_query("SELECT * FROM variant WHERE ide='$id' ");
                $mmat=mysql_fetch_array($mat);
               $novkolvo=$mmat['kolvo']-$mconf['kolvo'];
                $upd=mysql_query("UPDATE variant SET kolvo='$novkolvo' WHERE ide='$id'");
               }
            header("Location:index.php");
            
        }
        
      
       
       if (isset($_SESSION['buh'])) {
      
           
           
         $log=$_GET['log'];
         
         
        
             
         
          $summa=0;
          $cort=mysql_query("SELECT * FROM cort WHERE login='$log'");
           if ($mascort=mysql_fetch_array($cort)) {
            
                $podt=$mascort['confirmed'];
            
            
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
        
           </form>
         
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
         
          
           if ($podt=='yes') {
               echo     "<h1><span style='color:green;'>ВЫ ПОДТВЕРДИЛИ СВОЮ КОРЗИНУ</span></h1>"."<br>\n";
           }
           else {
            echo     "<h1><span style='color:red;'>ВЫ НЕ ПОДТВЕРДИЛИ СВОЮ КОРЗИНУ</span></h1>"."<br>\n";
           }
                
                
                
          ?>
           <form method="post" action="bcart.php">
           <input type="hidden" name="blog" value="<?=$log?>"/>
           <input type="submit" name="bsub" value="Одобрить"/>
          </form>
          <?
          
          
          } else {
            echo "Ваша корзина пуста";
           }
          }
          else { echo '<h1>Только для бухгалтерии)</h1>';}
            ?>
            
           <?
           
             
           
           ?>  
                 
           <form method="post" action="bcart.php">
           <input type="submit" name="backt" value="Вернуться"/><br />
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






