<!DOCTYPE html >

<html>
<head>
<title>Отдел снабжения института-регистрация</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf8"/>

<link rel="stylesheet" type="text/css" href="style.css" />


<div>


</div>

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
      <h2>Регистрация</h2><br />
      <h3>Пожалуйста, заполните все поля ввода</h3>
      
        <?php
$connect = mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('tutorials');
mysql_query ("set names 'utf8'");



if (isset($_POST['back'])){
    header("Location: index.php");
}

if (isset($_POST['registration'])) {
    
    $neds="@#№$%^*(){}[]<>|\/";
     $ned="@#№$%^*(){}[]<>|\/";
     $skobo="<>";
    $bad=false;
    session_start();
    unset($_SESSION['size_username']);
    unset($_SESSION['size_login']);
    unset($_SESSION['size_password']);
    unset($_SESSION['diff_passwords']);
    unset($_SESSION['error_password']);
    unset($_SESSION['same_login']);
    unset($_SESSION['reg_success']);
    $username=($_POST['username']);
    $login=($_POST['login']);
    $password=($_POST['password']);
    $rpassword=($_POST['rpassword']);
    $query=mysql_query("SELECT * FROM users WHERE login='$login'");
     $userdata=mysql_fetch_array($query);
      $skob=similar_text($password,$skobo);
     
    if((strlen($username)<3) || (strlen($username)>32)){
        $_SESSION['size_username']=1;
        $bad=true;
    }
    if ((strlen($login)<3) || (strlen($login)>32)){
        $_SESSION['size_login']=1;
        $bad=true;
        }
        if ((strlen($password)<6) || (strlen($password)>32)){
        $_SESSION['size_password']=1;
        $bad=true;
        }
        
        
 if (!preg_match("/^[a-zA-Z0-9а-яА-Я_-]+$/", $username)){
        $_SESSION['error_username']=1;
        $bad=true;
       }
       
if (!preg_match("/^[a-zA-Z0-9а-яА-Я_-]+$/", $login)) {
        $_SESSION['error_login']=1;
        $bad=true;
       }
       
       if ($skob>0) {
        $_SESSION['error_password']=1;
        $bad=true;
       }
      if (strlen($userdata[1])>0){
       $_SESSION['same_login']=1;
       $bad=true;
     }
       if ($password <> $rpassword) {
      $_SESSION['diff_passwords']=1;
      $bad=true;
      }
      
      if (!$bad){
        $username=mysql_real_escape_string($username);
        $login=mysql_real_escape_string($login);
        $password=mysql_real_escape_string($password);
        $password=md5($password);
      $query=mysql_query("INSERT INTO users VALUES('','$username','$login','$password')") or die(mysql_error());
      $_SESSION['reg_success']=1;
      header("Location:index.php");
      
      }

}


 if(isset($_SESSION['error_username'])==1){
   echo "<span style='color: red;'>Имя пользователя может содержать только русские, латинские буквы, цифры,тире и нижнее подчёркивание! </span>"."<br>\n";
   unset($_SESSION['error_username']);
    
 }
 
  if(isset($_SESSION['error_login'])==1){
   echo "<span style='color: red;'>Ваш логин может содержать только  русские , латинские буквы, цифры,тире и нижнее подчёркивание! </span>"."<br>\n";
   
    unset($_SESSION['error_login']);
    
 }
 
if (isset($_SESSION['same_login'])==1){
    echo "<span style='color: red;'>Такой логин уже существует. Пожалуйста, придумайте другой логин</span>"."<br>\n";
    unset($_SESSION['same_login']);
}


if (isset($_SESSION['size_username'])==1) {
    echo "<span style='color: red;'>Слишком короткое/длинное имя пользователя . Пожалуйста, придумайте другое имя.</span>"."<br>\n";
    unset($_SESSION['size_username']);
 }

 if (isset($_SESSION['size_login'])==1) {
    echo "<span style='color: red;'>Слишком короткий/длинный логин. Пожалуйста, придумайте другой логин.</span>"."<br>\n";
    unset($_SESSION['size_login']);
 }

if (isset($_SESSION['size_password'])==1) {
    echo "<span style='color:red;'>Слишком короткий/длинный пароль. Пожалуйста, придумайте другой пароль.</span>"."<br>\n";
    unset($_SESSION['size_password']);
 }

if (isset($_SESSION['diff_passwords'])==1) {
    echo "<span style='color: red;'>Введённые пароли не совпадают!</span>"."<br>\n";
    unset($_SESSION['diff_passwords']);
 }




if(isset($_SESSION['error_password'])==1) {
    echo "<span style='color:red;'>Во избежание опасности скобочки <> отключены. Пожалуйста, придумайте другой пароль";
    unset($_SESSION['error_password']);
}                             
?>                            

<form method="post" action="registration.php">
<input type = "text" name = "username" placeholder=" | Username" required /><br/>
<input type = "text" name = "login" placeholder=" | Login"  required /> <br />
<input type = "password" name = "password" placeholder=" | Password"  required /><br/>
<input type = "password" name = "rpassword" placeholder=" | Repeat your password"  required /><br/>
<input type = "submit" name="registration" value = "Зарегистрироваться"/><br/>
</form>

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






