<?
include('tpl/lib/connect.php');
session_start();

$rez = mysql_query("SELECT * FROM catalog WHERE id='".$_POST['id']."'"); //запрашиваем строку с искомым id 				
$row = mysql_fetch_assoc($rez);

mysql_query( "INSERT INTO catalog_goods (kat,model,cost,costType,id,images,numb_order) VALUES ('".$row['kat2']."','".$row['model']."','".$row['cost']."','".$row['costType']."','".$row['id']."','".$row['image']."','".$_SESSION['NumbOrd']."')");

?>