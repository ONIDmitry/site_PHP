<?php

$result='<?xml version="1.0" encoding="utf8"?>
<?xml-stylesheet type="text/xsl" href="file.xsl"?>
<condition>
';
mysql_connect('localhost','root','') or die (mysql_error());
mysql_select_db('tutorials');
mysql_query ("set_client='utf8'");
mysql_query ("set character_set_results='utf8'");
mysql_query ("set collation_connection='utf8_unicode_ci'");

if(isset($_POST['toxml'])) {
    header("Location:materials.xml");
}

$query = mysql_query("SELECT * FROM variant ORDER BY `ide`;") ;
if ($query) 
    {
        // Затем в цикле разбираем запрос, и формируем XML
        $i=0;
        while ($data = mysql_fetch_array($query))
            { 
                $i++;
                $result.='<str>
    ';
                $result.='<ide>'.$data['ide'].'</ide>
    <varname>'.$data['varname'].'</varname>
    <kolvo>'.$data['kolvo'].'</kolvo>
    <tsenaaren>'.$data['tsenaaren'].'</tsenaaren>
    <tsenazak>'.$data['tsenazak'].'</tsenazak>
    <description>'.$data['description'].'</description>
';
                $result.='</str>
';
            }
    } 

$result.='</condition>';


$file_name = 'materials.xml';
if (!$handle = @fopen($file_name, 'w')) {
    echo '<p>Error: Cannot open file "' . $file_name . '".</p>';
} elseif (@fwrite($handle, $result) === false) {
    fclose($handle);
    echo '<p>Error: Cannot write to file "' . $file_name . '".</p>';
} else {
    fclose($handle);
    echo '<p>Документ создан! Можно переходить на materials.xml  и проверять !</p>';
}
//echo "$result";



?>

<form method="post" action="docxml.php">
              <input type="submit" name="toxml" value="Проверить документ xml"/>
              </form>
<form method="post" action="rss.php">
<input type ="submit" name ="back" value="Вернуться"/><br/>
</form>