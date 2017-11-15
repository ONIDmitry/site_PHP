	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php
if (isset($_POST['back'])) {
    header("Location:index.php");
}
$handle = fopen("rss.xml","w+");
$res=file_get_contents("http://news.yandex.ru/computers.rss"); 
if ($res and preg_match("/<rss/i",$res))
{
fwrite($handle,$res);
fclose($handle);
$xmlfile = simplexml_load_file("rss.xml");
echo('<h2><a href="'.$xmlfile->channel->link.'">'.$xmlfile->channel->title.'</a></h2>');
echo ($xmlfile->channel->description.'<br/><b>Последнее обновление новостей от '.date("d.m.Y").'</b>');
$i = 0;
foreach($xmlfile->channel->item as $data)
{
$i++;
echo '<h3><a href="'.$data->link.'">'.$data->title.'</a></h3>';
echo $time = date("d.m.Y H:i:s",strtotime($data->pubDate)) ;
echo '<p>'.$data->description.'</p>';
if ($i>4) break;
}
}



?>
<form method="post" action="rss.php">
<input type ="submit" name ="back" value="Вернуться"/><br/>
</form>