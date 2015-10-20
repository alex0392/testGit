<?
include('tpl/lib/connect.php');
mysql_query ("DELETE FROM catalog_goods WHERE id='".$_POST['str']."'");
?>