<?
include('tpl/lib/connect.php');
include ('tpl/lib/function_global.php');
header("Content-Type: text/html; charset=utf-8");
ini_set ("session.use_trans_sid", true); 
session_start();
if(!isset($_SESSION['NumbOrd'])){
$_SESSION['NumbOrd']=mt_rand(1000,9999);
}
if(isset($_POST['log_out'])) out();



$rez_user = mysql_query("SELECT * FROM user WHERE id='{$_SESSION['id']}'"); //запрашиваем строку с искомым id 			

if (mysql_num_rows($rez_user) == 1) 	
{ 		
	$row_user = mysql_fetch_assoc($rez_user);
	
}


?>

<!DOCTYPE >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Каталог</title>
<link rel="stylesheet" href="tpl/css/style.css" type="text/css" media="screen, projection"/>
<link rel="stylesheet" href="tpl/css/reset.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="tpl/css/defaults.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="tpl/css/header.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="tpl/css/table.css" type="text/css" media="screen, projection" />
<link rel="icon" href="tpl/css/images/favicon.png" type="image/x-icon" />
<meta content="Продажа оргтехники, принтеров, чернил. М…нижний уровень, сектор А, ряд 5, место 1.+375 (17) 336 00 95" name="description">
</meta>
<link href="http://profiprint.by/catalog/index.php" rel="canonical">
</link>
<meta content="ru_RU" property="og:locale">
</meta>
<meta content="article" property="og:type">
</meta>
<meta content="Продажа оргтехники Минск, Картриджи" property="og:title">
</meta>
<meta content="Продажа оргтехники, принтеров, чернил, картриджей. М…нижний уровень, сектор А, ряд 5, место 1.+375 (17) 336 00 95" property="og:description">
</meta>
<meta content="http://profiprint.by/pechat-fotografij" property="og:url">
</meta>
<meta content="Профипринт" property="og:site_name">
</meta>
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>

<script type="text/javascript" src="tpl/js/scriptbreaker-multiple-accordion-1.js"></script>
<script type="text/javascript" src="tpl/js/scrollup.js"></script>
<script type="text/javascript" src="tpl/js/validForm.js"></script>
<script>
 $(document).ready(function() {

                    $(".topnav").accordion({
                        accordion:false,
                        speed: 500,
                        closedSign: '[+]',
                        openedSign: '[-]'
                    });
					
					str='СНПЧ для Canon';
					kat='СНПЧ и ПЗК'
					$.ajax({
							type: "POST",
							url: "ajax-goods.php",
							data:  {str:str,parents:kat},
							success: function(html){
								$('#content').html(html);
								document.title = "Каталог | "+str;
								/**dev cost on digit number**/
								$('div.cost-goods').each(function(){
									
									
									var str=$(this).html();
									var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
									$(this).html(newstr);
								});
							}
					});
					
					var kategoryP;
					var NumOrder=<? echo($_SESSION['NumbOrd']);?>;
					
					/***********BUCKET************/
					$('.backet').live('click',function(){
					$.ajax({
							type: "POST",
							url: "ajax-backet.php",
							data:  "str="+NumOrder,
							success: function(html){
								$('#content').html(html);
								$('#checkboxTP1').prop('checked','checked');
								$('#loader').hide();
								$('div#fader').fadeOut('slow');
			
								$('.costdev').each(function(){
									
									
									var str=$(this).html();
									var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
									$(this).html(newstr);
								});
								$('.desc').each(function(){
									var str=$(this).html();
									$(this).html(str.replace(new RegExp("/",'g')," "));
								});
								
							}
						});
					
                	});
					
				
				
				$('.cat-list').live('click',function(){
					showHideLoader();
					$('.cat-list').removeAttr("id")
					$(this).attr('id', 'active');
					var str=$(this).attr('rel');
					var kat=$(this).attr('alt');
					kategoryP=kat;
						$.ajax({
							type: "POST",
							url: "ajax-goods.php",
							data:  {str:str,parents:kat},
							success: function(html){
								$('#content').html(html);
								$('#loader').hide();
								$('div#fader').fadeOut('slow');
								document.title = "Каталог | "+str;
									/**dev cost on digit number**/
								$('div.cost-goods').each(function(){
									
									
									var str=$(this).html();
									var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
									$(this).html(newstr);
								});
							}
						});
		
				});
				/*****NEXT PAGE****/
				$('.page-navigation a').live('click',function(){
					showHideLoader();
					var key=$(this).attr('rel');
					var kat=$(this).attr('alt');
					var pr=kategoryP;
						$.ajax({
							type: "POST",
							url: "ajax-goods.php",
							data:  {Navpage:key, str:kat, parents:pr},
							success: function(html){
								$('#content').html(html);
								$('#loader').hide();
								$('div#fader').fadeOut('slow');
								//document.title = "Каталог | "+str;
									/**dev cost on digit number**/
								$('div.cost-goods').each(function(){
									
									
									var str=$(this).html();
									var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
									$(this).html(newstr);
								});
							}
						});
		
				});
				
				/****ADD GOODS****/
				$('.push').live('click',function(){
							var string=$(this).attr('rel');
							
							$("<span style='float: right; margin: 20px; color:#58007D;'>Товар добавлен</span>").insertAfter(this).fadeIn(400);
							$(this).remove();
							
							$.ajax({
							type: "POST",
							url: "ajax-add.php",
							data:  {id:string},
							success: function(html){
								//NumOrder=html;
								$('div#fader').fadeOut('slow');
							}
						});
							
				});			
				
				/******DELETE GOODS*******/
				$('.delGoods').live('click',function(){
							var string=$(this).attr('rel');
							$("<span style='float: right; color:red;'>Товар удален</span>").insertAfter(this).fadeIn(400);
							$(this).remove();
							
							$.ajax({
							type: "POST",
							url: "ajax-del.php",
							data:  {str:string},
							success: function(html){
								
							}
						});
							
				});	
				
					$('.GO_order').live('click',function(){
					var count='';
					$('.countCopy').each(function() {
                        var st=$(this).val();
						count=count+st+'/';
                    });
					var Fname=$('#Fname').val();
					var name=$('#name').val();
					var Pname=$('#Pname').val();
					var mail=$('#mail').val();
					var phone=$('#phone').val();
					var coment=$('#coment').val();
					var typePay;
					$('.typePay').each(function(){
						if($(this).is(':checked')){
							typePay=$(this).val();
						}
					});
						$.ajax({
							type: "POST",
							url: "ajaxCount.php",
							data:  {typePay:typePay,count:count,Fname:Fname,name:name,Pname:Pname,mail:mail,phone:phone,coment:coment},
							success: function(html){
								$('#content').html(html);
								
								if(typePay=='WebPay'){
									$('.go_webpay').trigger('click');
									showHideLoader();
								}else{
									window.location='http://www.profiprint.by/catalog/index.php';
								}
							}
						});
						$.ajax({

						});
					});
					/**dev cost on digit number**/
					$('div.cost-goods').each(function(){
						
						
						var str=$(this).html();
						var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
						$(this).html(newstr);
					});

					
				});
						
						
				/******Finde goods****/
				$('.find_text').live('keypress',function(e){
						var code = (e.keyCode ? e.keyCode : e.which);
						if(code==13){
							var string=$('.find_text').val();
							var kat=$('.find_text').attr('rel')
							var checked=$('.full_find').prop("checked");
							$.ajax({
								type: "POST",
								url: "ajaxFindGoods.php",
								data:  {str:string,kategory:kat,check:checked},
								success: function(html){
									
									$('#content').html(html);
									document.title = "Результат поиска";
										/**dev cost on digit number**/
								$('div.cost-goods').each(function(){
									
									
									var str=$(this).html();
									var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
									$(this).html(newstr);
								});
								}
							});
						
						}
	     	 	});
				
				
					
				$('.button_find').live('click',function(){
					
						var string=$('.find_text').val();
						var kat=$('.find_text').attr('rel')
						var checked=$('.full_find').prop("checked");
						
						$.ajax({
							type: "POST",
							url: "ajaxFindGoods.php",
							data:  {str:string,kategory:kat,check:checked},
							success: function(html){
								
								$('#content').html(html);
								document.title = "Результат поиска";
									/**dev cost on digit number**/
								$('div.cost-goods').each(function(){
									
									
									var str=$(this).html();
									var newstr=str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
									$(this).html(newstr);
								});
							}
						});
						
				})
               
					
function OnCheckbox(nameCheck,valCheck){
	$('.'+nameCheck).each(function(){
		if($(this).is(':checked')){
			$(this).removeAttr('checked');
		}
	});
	
	$('#'+valCheck).prop('checked','checked');
	
	
}			
</script>
</head>

<body>
<div id="container">
<? include('tpl/header.php'); ?>
<div id="main">
  <div id="left-menu">
    <ul class="topnav">
      <?php
		$stek='';
        $rez_cat = mysql_query("SELECT * FROM category_list"); //запрашиваем строку с искомым id 	
		$i=1;	
		while( $row1=mysql_fetch_assoc($rez_cat)){
			/*echo($row1['category']);*/
			if($row1['category_parents']!=$stek){
				$tt=$row1['category_parents'];
			echo('<li><a href="#">'.$row1['category_parents'].'</a><ul>');
			$rez_temp = mysql_query("SELECT * FROM category_list WHERE category_parents='".$tt."'");
			
				while( $row2=mysql_fetch_assoc($rez_temp)){
					echo('<li><a class="cat-list" ');if($i==1){echo('id="active" ');} echo('href="#" rel="'.$row2['category'].'" alt="'.$row2['category_parents'].'">'.$row2['category'].'</a></li>');
					$i++;
					
				}
				$i++;
			echo('</ul>	</li>');		
			}
			$stek=$row1['category_parents'];
		}
         ?>
    </ul>
  </div>
  <div id="content"> </div>
  <!-- #content --> 
  
</div>
<!-- #main -->

<? include('tpl/footer.php');?>
<div id="loader"></div>
</body>
</html>

