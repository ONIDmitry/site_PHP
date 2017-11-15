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
if(isset($_SESSION['name'])){
    echo '<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
  var no_active_delay = 120; 
  var now_no_active = 0; 
  setInterval("now_no_active++;", 120); 
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
        
      if (isset($_POST['apodtvtovar'])) {
        $log=$_POST['log'];
        $set=mysql_query("UPDATE zakaz SET tovarpodtv='yes' WHERE login='$log'");
        header("Location:index.php");
        
      }
        
    if (isset($_POST['aotkltovar'])) {
        $log=$_POST['log'];
        $set=mysql_query("UPDATE zakaz SET tovarpodtv='no' WHERE login='$log'");
         header("Location:index.php");
        
      }
        
      if (isset($_POST['apodtvkolvo'])) {
        $log=$_POST['log'];
        $set=mysql_query("UPDATE zakaz SET kolvopodtv='yes' WHERE login='$log'");
         header("Location:index.php");
        
      }
       
       if (isset($_POST['aotklkolvo'])) {
        $log=$_POST['log'];
        $set=mysql_query("UPDATE zakaz SET kolvopodtv='no' WHERE login='$log'");
         header("Location:index.php");
        
      }
       
       
       if (isset($_POST['apodtvtsena'])) {
        $log=$_POST['log'];
        $set=mysql_query("UPDATE zakaz SET tsenapodtv='yes' WHERE login='$log'");
         header("Location:index.php");
        
      }
       
       
       if (isset($_POST['aotkltsena'])) {
        $log=$_POST['log'];
        $set=mysql_query("UPDATE zakaz SET tsenapodtv='no' WHERE login='$log'");
         header("Location:index.php");
        
      }
       
       
      if (isset($_POST['datapodtv'])) {
        $log=$_POST['log'];
        $data=$_POST['data'];
        $set=mysql_query("UPDATE zakaz SET date='$data' WHERE login='$log'");
         header("Location:index.php");
        
      } 
       
       
       
       
       if (isset($_SESSION['admin'])) {
      
           
           
         $log=$_GET['log'];
         
         
        
             
         
         
          $cort=mysql_query("SELECT * FROM zakaz WHERE login='$log'");
           while ($mascort=mysql_fetch_array($cort)) {
            if (($mascort['tovarpodtv']=='') or ($mascort['kolvopodtv']=='') or ($mascort['tsenapodtv']=='') or ($mascort['date']=='')) {
            echo $mascort['login'];echo " ";echo $mascort['tovar'];echo " ";echo $mascort['kolvo'];echo " "; echo $mascort['tsena']; echo '<br/>';
           }
            
                
      if ($mascort['tovarpodtv']=='no') {
       $tov="no";
       }
       elseIF ($mascort['tovarpodtv']=='yes') {
       $tov="yes" ; 
       } else {
        $tov="Еще не проверено";
       }
       
      
      
      if ($mascort['kolvopodtv']=='no') {
       $kol="no";
       }
       elseIF ($mascort['kolvopodtv']=='yes') {
       $kol="yes" ; 
       } else {
        $kol="Еще не проверено";
       }
      
      
      
           if ($mascort['tsenapodtv']=='no') {
       $tse="no";
       }
       elseIF ($mascort['tsenapodtv']=='yes') {
       $tse="yes" ; 
       } else {
        $tse="Еще не проверено";
       }
            
            
            
            
            
            
         
         }       
          ?>
          Подтверждение товара :<?=$tov?> <form method="post" action="azakaz.php">
            <input type="hidden" name="log" value="<?=$log?>"/>
          <input type="submit" name="apodtvtovar" value="Подтвердить товар"/> <input type="submit" name="aotkltovar" value="Отклонить товар"/></form>
          Подтверждение количество товара : <?=$kol?><form method="post" action="azakaz.php">
            <input type="hidden" name="log" value="<?=$log?>"/>
          <input type="submit" name="apodtvkolvo" value="Подтвердить колво"/> <input type="submit" name="aotklkolvo" value="Отклонить колво"/></form>
          
          Подтверждение цены товара : <?=$tse?><form method="post" action="azakaz.php">
            <input type="hidden" name="log" value="<?=$log?>"/>
          <input type="submit" name="apodtvtsena" value="Подтвердить цену"/> <input type="submit" name="aotkltsena" value="Отклонить цену"/></form><br /><br />
          
           <form method="post" action="azakaz.php">
             <input type="hidden" name="log" value="<?=$log?>"/>
          <input type="text" name="data" /> <input type="submit" name="datapodtv" value="Поставить дату выполнения заказа"/></form>
            
           <?}?>
             
           
             
           <form method="post" action="azakaz.php">
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






