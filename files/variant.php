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


if(isset($_SESSION['name'])) {
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
            if (isset($_SESSION['cort_success'])==1) {
           echo "<span style='color: green;'>Добавлено в корзину!</span>"."<br>\n";
            unset($_SESSION['cort_success']);
            }
            
             if (isset($_SESSION['error_kolvo'])) {
                echo "<span style='color: red;'>Ваше введённое количество товара превышает количество в наличии!</span>"."<br>\n";
                unset($_SESSION['error_kolvo']);
                
            }
            
             if (isset($_SESSION['fail_dni'])) {
                echo "<span style='color: red;'>Количество дней должно быть натуральным числом!</span>"."<br>\n";
                unset($_SESSION['fail_dni']);
                
            }
            
            if( isset($_SESSION['fail_kolvo'])) {
               echo "<span style='color: red;'>Количество товара - это натуральное число!</span>"."<br>\n";
                unset($_SESSION['fail_kolvo']);
              
            }
           
            if (!$good){
            header("Location:mustregistr.php");
           }
           
           
            unset($_SESSION['cart_success']);
          $cort=mysql_query("SELECT * FROM cort WHERE login='$log'");
           if ($mascort=mysql_fetch_array($cort)) {
            if ($mascort['confirmed']=='yes') {
                $_SESSION['cart_success']=1;
            }
            }
            
            if (isset($_SESSION['cart_success'])) {
            header("LOCATION:cart.php");
           }
           
         if(isset($_POST['zakaz'])) {
        header("Location:zakaz.php");
       }
          
           if (isset($_POST['backto'])) {
            header("Location:index.php");
           }
      
      
      

      echo '
             <h2>Выбор вариантов</h2></br>
             <b>Вот таблица наших свободных товаров : </b></br>'.
             
            '<table border="3" cellpadding="10" >
            <tr><th>Вид товара</th><th>Кол-во в наличии</th><th>Аренда,((руб)/(шт*день))</th><th>Закупка,руб/шт</th></tr>';
    
    $tov=mysql_query("SELECT * FROM variant");
           
            while ($mastov=mysql_fetch_array($tov)) {
            if ($mastov['block']=="no"){
            echo ('
   <tr align="center"><td>'.$mastov['varname'].'</br><a href="mvariant.php?ide='.$mastov['ide'].'">[подробнее]</a>
   </td><td>'.$mastov['kolvo'].'</td><td>'.$mastov['tsenaaren'].'</td><td>'.$mastov['tsenazak'].'</td></tr>
             ');
          }
          } 
         echo '</table>'."</br><b><span style='color:blue;'>Для выбора товара и перехода к подробной информации нажмите [подробнее] для этого товара</span></b>";
           
  
  
                  
      
        
        if (!isset($_SESSION['admin']) and (!isset($_SESSION['buh']))) {
            echo '<h2>Если вы хотите сделать заказ на изготовление, нажмите 
            <form method="post" action="variant.php">
             <input type="submit" name="zakaz" value="Заказ на изготовление"/>
             </form>
              </h2>';
        }
          
         echo '<h2>Рейтинг наших товаров :</h2>';
         
        $zaprate=mysql_query("SELECT * from reting");
        while ($mzaprate=mysql_fetch_array($zaprate)){
            $k=$mzaprate['ide'];
            $tovrate=mysql_query("SELECT * FROM variant WHERE ide='$k'");
            $mtovrate=mysql_fetch_array($tovrate);
           $n=$mtovrate['varname'];
           $m=$mzaprate['rating'];
           echo $n.':'.$m.'<br/>';
            
        }
           ?>
           
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






