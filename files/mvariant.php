<?php
  $connect = mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('tutorials');
mysql_query ("set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_general_ci'");

function add_to_cart ($ide) {
    if (isset($_SESSION['cart'][$ide])) {
        $_SESSION['cart']['$ide']++;
        return true;
    }
    else {
        $_SESSION['cart'][$ide]=1;
        return true;
    }
    
    return false;
}

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
            header("LOCATION:pcart.php");
           }
          
          
           if (isset($_POST['backto'])) {
            header("Location:variant.php");
           }
           $n=5;
           unset($_SESSION['cort_success']);
           
            if (isset($_GET['ide']) ){
                if ($n<($_GET['ide']) ) {
                    echo(" Такого товара не существует");
                }
              else  { $ide=$_GET['ide'];
              
              
               
             
               
               
               
              
        $result=mysql_query("SELECT * FROM variant WHERE ide='$ide'");
           $data=mysql_fetch_array($result);
       printf ('
            <div class="article">
          
            <b class="tittle"><h2>'.$data['varname'].'</h2></b> 
            <p>'.$data['description'].'</p>
            <img id="picture"  src='.$data['image'].' />
            <p>Цена при аренде ((руб)/(шт*день)) : '.$data['tsenaaren'].'</br>
            Цена при заказе ((руб)/(шт*)) : '.$data['tsenazak'].'<br/>
            Осталось товара : '.$data['kolvo'].'</p>
             
             </div>
             ');
              
              ?>
                  <form method="post" action="mvariant.php">
                  Закупить этот товар в количестве : <input type="text" name="kolvo" required/>
                  <input type="hidden" name="ide"  value="<?=$ide?>"/>
                  <input type="submit" name="addcortzak"  value="Добавить в корзину"/>
                  </form><br/>
                  
                  <h2> Или </h2><br/>
                  
                   <form method="post" action="mvariant.php">
              Арендовать этот товар в количестве: <input type="text" name="kolvo" required/>
                  <input type="hidden" name="ide"  value="<?=$ide?>"/><br />
                На количество дней :   <input type="text" name="dni" required/>
                <input type="submit" name="addcortaren"  value="Добавить в корзину"/>
                  </form>
              <?
          
          }
          
           }
           else  { $ide=1;
              
              
               
             
               
               
               
              
        $result=mysql_query("SELECT * FROM variant WHERE ide='$ide'");
           $data=mysql_fetch_array($result);
       printf ('
            <div class="article">
          
            <b class="tittle"><h2>'.$data['varname'].'</h2></b> 
            <p>'.$data['description'].'</p>
            <img id="picture"  src='.$data['image'].' />
            <p>Цена при аренде ((руб)/(шт*день)) : '.$data['tsenaaren'].'</br>
            Цена при заказе ((руб)/(шт*)) : '.$data['tsenazak'].'<br/>
            Осталось товара : '.$data['kolvo'].'</p>
             
             </div>
             ');
              
              ?>
                  <form method="post" action="mvariant.php">
                  Закупить этот товар в количестве : <input type="text" name="kolvo" required/>
                  <input type="hidden" name="ide"  value="<?=$ide?>"/>
                  <input type="submit" name="addcortzak"  value="Добавить в корзину"/>
                  </form><br />
                  
                  <h2> Или </h2><br/>
                  
                   <form method="post" action="mvariant.php">
              Арендовать этот товар в количестве: <input type="text" name="kolvo" required/>
                  <input type="hidden" name="ide"  value="<?=$ide?>"/><br />
                На количество дней :   <input type="text" name="dni" required/>
                <input type="submit" name="addcortaren"  value="Добавить в корзину"/>
                  </form>
              <?
          
          }
          
      
    
 
         
         if (isset($_POST['addcortzak'])) {
              unset($_SESSION['error_kolvo']);
              unset($_SESSION['fail_kolvo']);
             unset($_SESSION['fail_dni']);
              $bad=false;
              $kolvo=($_POST['kolvo']);
            
                  if (!ctype_digit($kolvo)) {
                $_SESSION['fail_kolvo']=1;
                $bad=true;
               }
                
                else {
                $dni="neogr";
              $ide=($_POST['ide']);
              $result=mysql_query("SELECT * FROM variant WHERE ide='$ide'");
              $rating=mysql_query("SELECT * FROM reting WHERE ide='$ide'");
              $mrating=mysql_fetch_array($rating);
              $data=mysql_fetch_array($result);
              $var=mysql_query("SELECT * FROM cort WHERE ide='$ide' and login='$log' and dni='neogr'");
            $dvar=mysql_query("SELECT * FROM cort WHERE ide='$ide' and login='$log' and dni!='neogr'");
              if ($masvar=mysql_fetch_array($var))   {  $kolvozak=$masvar['kolvo']+$kolvo;
              } else {$kolvozak=$kolvo;}
               if ($dmasvar=mysql_fetch_array($dvar))    { $kolvo=$dmasvar['kolvo']+$kolvozak; 
               } else {
                $kolvo=$kolvozak;
               }
              if ($kolvo>$data['kolvo']) {
                $_SESSION['error_kolvo']=1;
                $bad=true;
               
                }
                if ((!isset ($_SESSION['error_kolvo'])==1)) {
                
                $dele=mysql_query("DELETE FROM cort WHERE ide='$ide' and login='$log' and dni='neogr'");
                }
            
            
            
          
          
                 if (!$bad) {
              $t=$mrating['rating'];
               $delrating=mysql_query("DELETE FROM reting WHERE ide='$ide'");
               $t++;
              $_SESSION['cort_success']=1;
              $vvod=mysql_query("INSERT INTO cort VALUES('','$log','$ide','$kolvozak','$dni','','')");
             $vvod2=mysql_query("INSERT INTO reting VALUES ('','$ide','$t')");
            }
         }
         
          header("LOCATION:variant.php");
       
        
           
        }
          
          
          
          
          
          
          if (isset($_POST['addcortaren'])) {
              unset($_SESSION['error_kolvo']);
              unset($_SESSION['fail_kolvo']);
              unset($_SESSION['fail_dni']);
             
              $bad=false;
              $kolvo=($_POST['kolvo']);
              $dni=($_POST['dni']);
            if (!ctype_digit($dni)){
                $_SESSION['fail_dni']=1;
                $bad=true;
            }
            
            
            
                  if (!ctype_digit($kolvo)) {
                $_SESSION['fail_kolvo']=1;
                $bad=true;
               }
                 else {
                
              $ide=($_POST['ide']);
              $result=mysql_query("SELECT * FROM variant WHERE ide='$ide'");
              $data=mysql_fetch_array($result);
                $rating=mysql_query("SELECT * FROM reting WHERE ide='$ide'");
              $mrating=mysql_fetch_array($rating);
              $var=mysql_query("SELECT * FROM cort WHERE ide='$ide' and login='$log' and dni!='neogr'");
               $dvar=mysql_query("SELECT * FROM cort WHERE ide='$ide' and login='$log' and dni='neogr'");
            
              if ($masvar=mysql_fetch_array($var))   {  $kolvoaren=$masvar['kolvo']+$kolvo;
              } else {$kolvoaren=$kolvo;}
               if ($dmasvar=mysql_fetch_array($dvar))   {  $kolvo=$dmasvar['kolvo']+$kolvoaren;
               } else {
                $kolvo=$kolvoaren;
               }
              
            
                
              if ($kolvo>$data['kolvo']) {
                $_SESSION['error_kolvo']=1;
                $bad=true;
               
                }
                if ((!isset ($_SESSION['error_kolvo'])==1)){
                $dele=mysql_query("DELETE FROM cort WHERE ide='$ide' and login='$log' and dni!='neogr'");
                }
            
            
            
          
          
                 if (!$bad) {
               $t=$mrating['rating'];
               $delrating=mysql_query("DELETE FROM reting WHERE ide='$ide'");
               $t++;
              $_SESSION['cort_success']=1;
              $vvod=mysql_query("INSERT INTO cort VALUES('','$log','$ide','$kolvoaren','$dni','','')");
              $vvod2=mysql_query("INSERT INTO reting VALUES ('','$ide','$t')");
             
            }
         
        
         }
          header("LOCATION:variant.php");
       
        
           
        }
          
          
          
          
          
          
          
          
          
          
          
           
           ?>
           
            <form method="post" action="mvariant.php">
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






