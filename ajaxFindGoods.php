<?php
include('tpl/lib/connect.php');
include ('tpl/lib/function_global.php');
header("Content-Type: text/html; charset=utf-8");
session_start();
echo('<div class="head-goods">'.$_SESSION['kategory'].'</div><div><a class="backet" href="#">Корзина</a></div>');
echo('<div class="find">
				<div style="font-family:tahoma;font-size:16pt;margin-bottom:20px;">Поиск товара в категории: <span style="font-weight:bold;">'.$_SESSION['kategory'].'</span></div>
				
				<p><span class="NameInput">Введите название товара:</span><input class="find_text" rel="'.$_SESSION['kategory'].'"type="text" placeholder="Введите название товара"/>
				<input type="submit" value="Поиск" class="button_find">
				</p>
				<div style="font-family:tahoma;font-size:16pt;margin-bottom:20px;">Включить поиск по каталогу <input type="checkbox" class="full_find"/></div>
				</div>
				<div>
				<h4 style="float:left; font-weight:bold;margin-top:20px;font-size:18pt">Результат поиска:</h4>
				</div>
				
				
				');
				
		


if($_POST['check']=='true'){
	$rez = mysql_query("SELECT * FROM catalog WHERE model like '%".$_POST['str']."%'"); 
}else{
	$rez = mysql_query("SELECT * FROM catalog WHERE model like '%".$_POST['str']."%' and kat2='".$_POST['kategory']."'"); 
}


				while( $row=mysql_fetch_assoc($rez)){
					echo('
					<div class="model">
						<div class="title-model">'.$row['kat2'].' '.$row['model'].'<span></span></div>
						<div class="info-goods">
							<div class="icon"><img src="admin/imagesCategory/imagesGoods/'.$row["image"].'"></div>
							<div class="description-goods">
								<p style="font-family:Pompadur2">Описание:</p>
								<div class="">'.$row['description'].'</div>
								<p></p>
								<p style="font-family:Pompadur2">Дополнительное описание:</p>
								<div style="min-height:100px;">'.$row['dop_description'].'</div>
							</div>
						</div>
						<div class="cost-goods">Цена: '.$row['cost'].' '.$row['costType'].'</div>
						<form action="" method="post" class="add-goods" >
						
							<input type="button" name="Go_backet" class="push" rel="'.$row['id'].'" value="Добавить в корзину">
						</form>
					</div>
					');
				}
					
	if(mysql_num_rows($rez)<1){echo('<div style="margin-top:230px;padding-top:20px;font-size:16pt;border-top:1px solid #111;">По запросу:<span style="font-weight:bold;font-family:tahoma;">'.$_POST['str'].'</span> товаров не найдено<div>');}	
?>
