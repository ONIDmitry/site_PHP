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
           
              
            
          $cort=mysql_query("SELECT * FROM cort WHERE login='$log'");
           if ($mascort=mysql_fetch_array($cort)) {
            if ($mascort['confirmed']=='yes') {
            
            
             if (isset($_SESSION['cart_success'])) {
                    echo "<span style='color:blue;'>Вы уже сделали свой выбор и подтвердили корзину.</span>"."<br>\n";
                 }
      
         ?>
          <p><a href="pcart.php">Посмотреть готовую подтвержденную корзину</p></a>
       
      
        <?  
         
          echo ' <h2>Оформление заявки</h2><br />
      <h3>Пожалуйста, заполните все поля ввода</h3>';
         
           if (isset($_POST['ok'])) {
    
    
    
    
    $bad=false;
    
    unset($_SESSION['size_imya']);
    unset($_SESSION['size_familiya']);
    unset($_SESSION['size_otchestvo']);
    unset($_SESSION['error_imya']);
    unset($_SESSION['error_familiya']);
    unset($_SESSION['error_otchestvo']);
    unset($_SESSION['error_mail']);
    unset($_SESSION['zayav_success']);
    $imya=($_POST['imya']);
    $familiya=($_POST['familiya']);
    $otchestvo=($_POST['otchestvo']);
    $mail=($_POST['mail']);
     
    $dif='@.';   
     
     
      
      
       
    if(strlen($imya)>50){
        $_SESSION['size_imya']=1;
        $bad=true;
    }
    if (strlen($familiya)>50){
        $_SESSION['size_familiya']=1;
        $bad=true;
        }
        if (strlen($otchestvo)>50){
        $_SESSION['size_otchestvo']=1;
        $bad=true;
        }
        
        
if (!preg_match("/^[a-zA-Z_-]+$/", $imya)){
        $_SESSION['error_imya']=1;
        $bad=true;
       }
       
if (!preg_match("/^[a-zA-Z_-]+$/", $familiya)) {
        $_SESSION['error_familiya']=1;
        $bad=true;
       }
   
if (!preg_match("/^[a-zA-Z_-]+$/", $otchestvo)) {
        $_SESSION['error_otchestvo']=1;
        $bad=true;
       }
      
      
     if ((!preg_match("/^[a-zA-Z0-9_-]+$/", $mail)) and (similar_text($dif,$mail)<2)){ 
        $_SESSION['error_mail']=1;
        $bad=true;
       }
      
    
     
      
      
      if (!$bad){
        $c=$_COOKIE['a'];
    $query=mysql_query("SELECT * FROM loginuser WHERE cod='$c'");
    $userdata=mysql_fetch_array($query);
    $t=$userdata['login'];  
      $quer=mysql_query("INSERT INTO zayavka VALUES('','$imya','$familiya','$otchestvo','$mail','$t','no')") or die(mysql_error());
      $_SESSION['zayav_success']=1;
      
      
      
      }

}




$nzayav=mysql_query("SELECT * FROM zayavka WHERE login='$log'");

     if( $mnzayav=mysql_fetch_array($nzayav)) {
      $nzayavki=$mnzayav['identif'];
      
      $cortz=mysql_query("UPDATE cort SET nzayavki='$nzayavki' WHERE login='$log'  ");
       header("Location:index.php");
}




 if(isset($_SESSION['error_imya'])==1){
   echo "<span style='color: red;'>Ваше имя может содержать только латинские буквы и тире! </span>"."<br>\n";
   unset($_SESSION['error_imya']);
    
 }
 
  if(isset($_SESSION['error_familiya'])==1){
  echo "<span style='color: red;'>Ваша фамилия может содержать только латинские буквы и тире! </span>"."<br>\n";
    unset($_SESSION['error_familiya']);
    
 }
 
if (isset($_SESSION['error_otchestvo'])==1){
 echo "<span style='color: red;'>Ваше отчество может содержать только латинские буквы и тире! </span>"."<br>\n";
    unset($_SESSION['error_otchestvo']);
}


if (isset($_SESSION['size_imya'])==1) {
    echo "<span style='color: red;'>Слишком длинное имя пользователя . Пожалуйста, придумайте другое имя.</span>"."<br>\n";
    unset($_SESSION['size_imya']);
 }

 if (isset($_SESSION['size_familiya'])==1) {
    echo "<span style='color: red;'>Слишком короткая фамилия. Пожалуйста, придумайте другую фамилию.</span>"."<br>\n";
    unset($_SESSION['size_familiya']);
 }

if (isset($_SESSION['size_otchestvo'])==1) {
    echo "<span style='color:red;'>Слишком длинное отчество. Пожалуйста, придумайте другое отчество.</span>"."<br>\n";
    unset($_SESSION['size_otchestvo']);
 }

if (isset($_SESSION['error_mail'])==1){
     echo "<span style='color:red;'>Ваша почта неверна.</span>"."<br>\n";
    unset($_SESSION['error_mail']);
}



if(isset($_SESSION['error_bmail'])==1) {
 echo "<span style='color:red;'>Почта вашей бухгалтерии неверна.</span>"."<br>\n";
    unset($_SESSION['error_bmail']);
}




            
            
         echo  '   <form method="post" action="zayavka.php">
            <b>Ваше имя :</b><input type="text" name="imya"  required /><br />
            <b>Ваша фамилия :</b><input type="text" name="familiya"  required/><br />
            <b>Ваше отчество :</b><input type="text" name="otchestvo"  required/><br />
            <b>Ваша почта :</b><input type="text" name="mail"  required/><br />
           
           
       
           <input type="submit" name="ok" value="Подтвердить"/>
       </form>';
            
            
    } else { echo "<span style='color:blue;'>Вы еще не подтвердили свою корзину!</span>"."<br>\n";}
    }  else { echo "<span style='color:red;'>Рано переходить к заполнению заявки, так как у вас пустая корзина.</span>"."<br>\n";}   
           
           ?>
         
           <form method="post" action="zayavka.php">
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






