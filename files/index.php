
<!DOCTYPE html >

<html>
<head>
<title>Отдел снабжения института-главная</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<link rel="stylesheet" type="text/css" href="vid.css" />

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">

$(document).ready(function(){

 $("#button").click(function(){
     
    var text1="Спасибо!"
    var text2="Мы рады, что вам понравился наш сайт!"
    var text3="Будем стараться сделать его ещё лучше!!!"
    alert(text1);
   alert(text2);
   alert(text3);
 });
    
});
</script>



<div>


</div>

</head>





    



<body>
 
<div class="wrapper">
    <div class="header">
  <div class="left_up">
  <?php
  session_start();
  $connect = mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('tutorials');
mysql_query ("set_names 'utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_unicode_ci'");






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


  
  if (isset($_SESSION['reg_success'])==1){
    echo "<span style='color: green;'>Регистрация прошла успешно!</span>"."<br>\n";
    unset($_SESSION['reg_success']);
}
if (isset($_POST['registration'])){
 header("Location:registration.php");
}


if(isset($_POST['ajax'])) {
    
    header("Location:chern.php");
}


if (isset($_POST['to'])) {
    $elogin=mysql_real_escape_string($_POST['elogin']);
    $epassword=mysql_real_escape_string($_POST['epassword']);
    $epassword=md5($epassword);
    $query=mysql_query("SELECT * FROM users WHERE login='$elogin'");
    $zapros=mysql_query("SELECT * FROM chern WHERE login='$elogin'");
    $userdata=mysql_fetch_array($query);
    if ($reszap=mysql_fetch_array($zapros)) {
      echo "<span style='color:red;'>Вы занесены в чёрный список за невыполнение требований сайта</span><br>\n";
        }
        else {
 if ($userdata['password'] == $epassword) {
      $_SESSION['name'] = 1;
      $c=md5(time());
     $c.=md5($elogin);
       setcookie("a","$c",time()+259200,"/");
       $k=$userdata['username'];
       $lol=mysql_query("DELETE FROM loginuser WHERE login='$elogin'");
      $zaplog=mysql_query("INSERT INTO loginuser VALUES('','$elogin','$c','$k')") or die(mysql_error());

if (($userdata['login']=="admin") or ($userdata['login']=="Admin")) {
    $_SESSION['admin']=1;
}
 if (($userdata['login']=="buh") or ($userdata['login']=="Buh")) {
    $_SESSION['buh']=1;
}
         
  
    }
 else   {
    echo "<span style='color:red;'>Wrong password or login</span><br>\n";
 }
 }
 } 

 if(isset($_POST['logout'])){
   unset($_SESSION['name']);
   unset($_SESSION['admin']);
   unset($_SESSION['buh']);
   setcookie("a","",time()-259200,"/");
    }
   
     if (isset($_SESSION['name'])==1) {
        echo "Hello, ".$k."!".'<br/><form method= "post" action ="index.php">
<input type = "submit" name = "logout" value = "Выйти"/><br/>
</form>'
;
   }
    
    else{
echo "Добро пожаловать, гость!".'<br/><form method= "post" action ="index.php">
<input type="text" name="elogin" placeholder=" |  Login" required /><br/>
<input type="password" name="epassword" placeholder=" |  Password"  required /><br/>
<input type = "submit" name = "to"  value = "Вход"/><br/>
</form>'.'<form method= "post" action ="index.php"><input type = "submit" name = "registration"  value = "Регистрация"/><br/>
</form>'
;
    } 
 if(isset($_SESSION['name'])) {
    
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
      alert("Неактивность 2 минуты"); 
      
      
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

if (isset($_POST['bcort'])) {
    header("Location:bcart.php");
}




?>
  </div>
    
<div class="right_up">
  <img src="logotip.png"/><br />
   <p id="alertt"></p> 

</div>
  </div> 
    <div class="content">

             <div class="left">
             
             Здравствуйте! Вы находитесь на сайте otdsnab.ru! Здесь вы можете найти материалы, закупить, арендовать, или даже 
              сделать заказ на изготовление для вашего института. Наш отдел обеспечит вас всем необходимым. Итак, если вы хотите 
              перейти к просмотру вариантов, нажмите <form method="post" action="index.php">
              <input type="submit" name="variant" value="Сюда"/>
              </form><br />
              Если вы у нас первый раз, советуем почитать правила нашего сайта <p><a href="rules.php">Правила сайта</a></p> 
              
             <?php
             if (isset($_POST['variant'])) {
                header("Location:variant.php");
             }
          
          if(isset($_POST['kdellog'])) {
        $dellog=($_POST['dellog']);
        $delvse=mysql_query("DELETE cort,zayavka FROM cort LEFT JOIN zayavka ON zayavka.login=cort.login WHERE cort.login='$dellog' ");
       }
          
          
           
           if (isset($_SESSION['name'])) {
      if(!isset($_SESSION['buh'])) {
         $log=$userdata['login'] ; 
    $provzayav=mysql_query("SELECT * FROM zayavka WHERE login='$log'");
    if ($mprovzayav=mysql_fetch_array($provzayav)) {
        
        
         echo     "<h1><span style='color:green;'>Уважаемый ".$mprovzayav['familiya']." </span></h1>"."<h1><span style='color:green;'> ".$mprovzayav['imya']." </span></h1>".
         "<h1><span style='color:green;'> ".$mprovzayav['otchestvo']."!</span></h1>"."<br>\n";
         echo    "<h1><span style='color:green;'>За вами закреплена заявка номер ".$mprovzayav['identif']."!</span></h1>"."<br>\n";
      echo '   <p><a href="pcart.php">Посмотреть корзину</a></p>';
        if($mprovzayav['buhcon']!='yes') {
             echo    "<span style='color:red;'>Бухгалтерия еще не подтвердила ваш заказ!</span>"."<br>\n";
        
        } else { echo "<span style='color:green;'>Ваш заказ подтверждён бухгалтерией! Вы можете обращаться в наш отдел по адресу Кантемировская 29-2-199 и забирать свой заказ!</span>"."<br>\n"; }
        
    }     
    }        
     }        
          
             
      if (isset($_SESSION['buh']))  {
        
        $dlyab=mysql_query("SELECT * FROM zayavka ");
       
       
       while ($mdlyab=mysql_fetch_array($dlyab)){
        
        if ($mdlyab['buhcon']=='no') {
            
        
             echo $mdlyab['login'];
          ?>
          <p><a href="bcart.php?log=<?=$mdlyab['login']?>">Посмотреть его корзину</a></p>
          <?
        } 
         }  
      }     
             
     
     
     
     if (isset($_SESSION['admin']))   {
        
     echo'   <h2>Итоговые заказы на изготовление :</h2><br/>';
        $zakaz=mysql_query("SELECT * FROM zakaz");
       while ($mzakaz=mysql_fetch_array($zakaz)) {
        if (($mzakaz['tovarpodtv']=='') or ($mzakaz['kolvopodtv']=='') or ($mzakaz['tsenapodtv']=='') or ($mzakaz['date'])=='') {
            echo $mzakaz['login'];
        ?> <p><a href="azakaz.php?log=<?=$mzakaz['login']?>">Посмотреть его заказ</a></p> <?
        }
        
        
       }
       
        
        
        
        
     } 
        
    if (isset($_SESSION['name'])) {
        
    $log=$userdata['login'];
        $lol=mysql_query("SELECT * FROM zakaz WHERE login='$log'");
        if ($maslol=mysql_fetch_array($lol)) {
             echo '<h2>Результаты заказа на изготовление  : </h2><br/>';
            if (($maslol['tovarpodtv'])=='yes') echo "Товар одобрен!"; elseif  ($maslol['tovarpodtv']=='') echo  "Товар еще не проверен!"; else echo "Товар не одобрен!"; echo '<br/>';
            if (($maslol['kolvopodtv'])=='yes') echo "Количество одобрено!"; elseif  ($maslol['kolvopodtv']=='') echo  "Количество еще не проверено!"; else echo "Количество не одобрена!";echo '<br/>';
            if (($maslol['tsenapodtv'])=='yes') echo "Цена одобрена!"; elseif  ($maslol['tsenapodtv']=='') echo  "Цена еще не проверена!"; else echo "Цена не одобрена!";echo '<br/>';
            echo "Дата завершения изготовления :"; echo $maslol['date'];
        }
        
        else echo "У Вас нет заказов на изготовление";
        
    }   
       
       
       
            ?>
             </div>
             <div class="right">
              <div class="right_menu">
              <a href="index.php">Главная</a>
              <a href="rules.php">Правила сайта</a>
              <a href="novosti.php">Свежие новости</a>
              <a href="arhiv.php">Архив</a>
              
             <a href="cart.php">Ваша корзина</a><br /><br />
            
              <a href="xml.php">XML</a>
        
              
              
              <li><a href="rss.php">Новости: Yandex</a></li><br /><br /><br />
              
              </div>
                     <?if (isset($_COOKIE['a'])){
    $c=$_COOKIE['a'];
    $query=mysql_query("SELECT * FROM loginuser WHERE cod='$c'");
    $userdata=mysql_fetch_array($query);
    $k=$userdata['username'];
    $log=$userdata['login'];
    ?>
    <form method="post" action="index.php">
              <input type="hidden" name="dellog" value="<?=$log?>"/>
              <input type="submit" name="kdellog" value="Удалить корзину и заявку"/>
              </form>
              
   <?}?>
              <form method="post" action="index.php">
              <input type="submit" name="ajax" value="Проверить чёрный список"/>
              </form>
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
              <h2>Вам нравится наш сайт?</h2>
              <button id="button" >Нравится!</button>
              
               
              
              </div>
              
       
     

</div>
<div class="footer">
Защита прав, 1999 итд</div>
</div>


</body>
</head>
</html>






