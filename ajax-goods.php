<?php
include('tpl/lib/connect.php');
include ('tpl/lib/function_global.php');
header("Content-Type: text/html; charset=utf-8");
session_start();

$page_now=1;

if ($_POST['Navpage']==1){ 

	if($_SESSION['page']>1){
			$namm=$_SESSION['page'];
			$page_now=($namm-1)-14;
			$_SESSION['page']=$page_now;
	}
}

if ($_POST['Navpage']==2){
	
	if(ceil($_SESSION['page']/15)!=$_SESSION['max-page']){
		$namm=$_SESSION['page'];
		$page_now=($namm+1)+14;
		$_SESSION['page']=$page_now;
	}
	
}




if($_SESSION['kategory']!=$_POST['str']){
	
	$_SESSION['kategory']=$_POST['str'];
	$page_now=1;
	$_SESSION['page']=$page_now;
	$rezult = mysql_query("SELECT * FROM catalog WHERE kat2='".$_POST['str']."' and kat1='".$_POST['parents']."'");

	$num_post=mysql_num_rows($rezult);
	
	if($num_post<15){
		$num_max=1;
	}elseif($num_post % 15 != 0){
			$num_max=intval($num_post/15)+1;
		}else $num_max=$num_post/15;
	

	$_SESSION['max-page']=$num_max;
}



$page_now=$_SESSION['page']-1;

$rez = mysql_query("SELECT * FROM catalog WHERE kat2='".$_POST['str']."' and kat1='".$_POST['parents']."' LIMIT $page_now,15");

$page_now=ceil(($page_now+1)/15);
			echo('<div class="head-goods">Категория: '.$_SESSION['kategory'].'</div><div><a class="backet" href="#">Корзина</a></div>');
			
			echo('<div class="find">
				
				
				
<div style="font-family:tahoma;font-size:16pt;margin-bottom:20px;">Поиск товара в категории: <span style="font-weight:bold;">'.$_SESSION['kategory'].'</span></div>
				<p><span class="NameInput">Введите название товара:</span><input class="find_text" rel="'.$_POST['str'].'"type="text" placeholder="Введите название товара" value="" />
				<input type="button" value="Поиск" class="button_find">
				
				</p>
				<div style="font-family:tahoma;font-size:16pt;margin-bottom:20px;">Включить поиск по каталогу <input type="checkbox" class="full_find"/></div>
				</div>');
				
			echo('
			
				<div class="page-navigation">
				Страницы:
					<div class="prev"> <a  href="#" rel="1" alt="'.$_SESSION['kategory'].'">Предыдущая</a></div>');
					echo('<div>'.$page_now.' из ('.$_SESSION['max-page'].')</div>');
					
					
					
					echo('<div class="next"> <a  href="#" rel="2" alt="'.$_SESSION['kategory'].'">Следующая</a></div>
				</div>
			');
			
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
				echo('
			
				<div class="page-navigation">
				Страницы:
					<div class="prev"> <a  href="#" rel="1" alt="'.$_SESSION['kategory'].'">Предыдущая</a></div>');
					echo('<div>'.$page_now.' из ('.$_SESSION['max-page'].')</div>');
					
					
					
					echo('<div class="next"> <a  href="#" rel="2" alt="'.$_SESSION['kategory'].'">Следующая</a></div>
				</div>
			');	
		$_POST['page']=0;	
?>
