<?php



    
       
       
       if (isset($_COOKIE['a'])) {
        setcookie("a","",time()-259200,"/");
        echo '������������ 2 ������ ! ������ �� ��������� ���������������� �������������!';
          header("Location:index.php");
       }

else { header("Location:index.php");}



?>







<h2>��������! �� ���� ���������� �� ��� �������� ����������, ����� �� ������ ������������� ��� ���������������� ������������!</h2>