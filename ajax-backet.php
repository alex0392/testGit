<style>
.NameInput{
	width:200px;
}
</style>
<script>
    $(document).ready(function() {
	
	//Фамилия
	$("#Fname").change(function(){
		Fname = $("#Fname").val();
		
		if(Fname.length < 1){
			$("#Fname").next().hide().text("Поле должно быть заполненно").css("color","red").fadeIn(400);
			$("#Fname").removeClass().addClass("inputRed");
			$("#e_FnameOk").css("display","none");
			FnameStat = 0;
			buttonOnAndOff();
		}else{
			$("#Fname").removeClass().addClass("inputGreen");
			$("#Fname").next().text("");
			$("#e_FnameOk").css("display","inline");
			FnameStat = 1;
			buttonOnAndOff();
		}	
	
	});	
	
	$("#Fname").keyup(function(){
		$("#Fname").removeClass();
		$("#Fname").next().text("");
	});
	
	//Имя
	$("#name").change(function(){
		Fname = $("#name").val();
		
		if(Fname.length < 1){
			$("#name").next().hide().text("Поле должно быть заполненно").css("color","red").fadeIn(400);
			$("#name").removeClass().addClass("inputRed");
			$("#e_nameOk").css("display","none");
			nameStat = 0;
			buttonOnAndOff();
		}else{
			$("#name").removeClass().addClass("inputGreen");
			$("#name").next().text("");
			$("#e_nameOk").css("display","inline");
			nameStat = 1;
			buttonOnAndOff();
		}	
	
	});	
	
	$("#name").keyup(function(){
		$("#name").removeClass();
		$("#name").next().text("");
	});
	
	//Отчество
	$("#Pname").change(function(){
		Fname = $("#Pname").val();
		
		if(Fname.length < 1){
			$("#Pname").next().hide().text("Поле должно быть заполненно").css("color","red").fadeIn(400);
			$("#name").removeClass().addClass("inputRed");
			$("#e_PnameOk").css("display","none");
			PnameStat = 0;
			buttonOnAndOff();
		}else{
			$("#Pname").removeClass().addClass("inputGreen");
			$("#Pname").next().text("");
			$("#e_PnameOk").css("display","inline");
			PnameStat = 1;
			buttonOnAndOff();
		}	
	
	});	
	
	$("#Pname").keyup(function(){
		$("#Pname").removeClass();
		$("#Pname").next().text("");
	});
	
	
	//Телефон
	$("#phone").change(function(){
		Fname = $("#phone").val();

		if(Fname.length < 1){
			$("#phone").next().hide().text("Поле должно быть заполненно").css("color","red").fadeIn(400);
			$("#phone").removeClass().addClass("inputRed");
			$("#e_phoneOk").css("display","none");
			PhoneStat = 0;
			buttonOnAndOff();
		}else{
			$("#phone").removeClass().addClass("inputGreen");
			$("#phone").next().text("");
			$("#e_phoneOk").css("display","inline");
			PhoneStat = 1;
			buttonOnAndOff();
		}	
	
	});	
	
	$("#phone").keyup(function(){
		$("#phone").removeClass();
		$("#phone").next().text("");
	});
	
	
		
	// Email
	$("#mail").change(function(){
		
		email = $("#mail").val();
		var expEmail = /[-0-9a-z_]+@[-0-9a-z_]+\.[a-z]{2,6}/i;
		var resEmail = email.search(expEmail);
		
		if(resEmail == -1){
			$("#mail").next().hide().text("Неверный формат Email").css("color","red").fadeIn(400);
			$("#e_mailOk").css("display","none");
			$("#mail").removeClass().addClass("inputRed");
			mailStat = 0;
			buttonOnAndOff();
		}else{
			mailStat = 1;
            $("#e_mailOk").css("display","inline");
			buttonOnAndOff();
		}
		
	});	
	$("#mail").keyup(function(){
		$("#mail").removeClass();
		$("#mail").next().text("");
	});	
	
	

	
	
	function buttonOnAndOff(){
        
		if(FnameStat==1  && nameStat==1 && PnameStat==1 && PhoneStat==1 && mailStat == 1 ){
           
			$(".GO_order").removeAttr("disabled");
		}else{
			$(".GO_order").attr("disabled","disabled");
		}
	
	}
});
</script>
<?php
include('tpl/lib/connect.php');
include ('tpl/lib/function_global.php');
header("Content-Type: text/html; charset=utf-8");

ini_set ("session.use_trans_sid", true); 
session_start();
header("Content-Type: text/html; charset=utf-8");
$rez_user = mysql_query("SELECT * FROM user WHERE id='{$_SESSION['id']}'"); //запрашиваем строку с искомым id 			
if (mysql_num_rows($rez_user) == 1) 	
{ 		
	$row_user = mysql_fetch_assoc($rez_user);
	
}

$rez = mysql_query("SELECT * FROM catalog_goods WHERE numb_order='".$_POST['str']."'");
if(mysql_num_rows($rez)!=0){
echo('
		<table class="bordered">
       		<tr class="headTable">
            	<td>Наименование товара</td>
                <td>Количество</td>
                <td>Стоимость</td>
				<td>Удалить</td>
            </tr>

');

$i=1;

	while($row=mysql_fetch_assoc($rez)){
			
					echo('
					
					<tr>
						<td class="nameGoods"><div class="icon"><img src="admin/imagesCategory/imagesGoods/'.$row['images'].'"></div>
							<div class="desc">'.$row['kat'].'>'.$row['model'].'</div>
						</td>
						<td><input type="number" value="1" class="countCopy" /></td>
						<td class="costdev">'.$row['cost'].' '.$row['costType'].'</td>
						<td><a class="delGoods" href="#" rel='.$row['id'].'>Удалить</a></td>
            		</tr>
			
					
					');
$i++;					
	}
echo('</table>');
echo('

<h3>Введите контактные данные:</h3>
<p><span class="NameInput">Фамилия:</span><input id="Fname"  type="text" name="Fname" value="'.$row_user['Fname'].'" placeholder="Фамилия:"><span></span><span id="e_FnameOk" style="display: none;"> <img src="tpl/css/images/ok.png"/></span></p>
<p><span class="NameInput">Имя:</span><input id="name"  type="text" name="name" value="'.$row_user['name'].'" placeholder="Имя:"><span></span><span id="e_nameOk" style="display: none;"> <img src="tpl/css/images/ok.png"/></span></p>
<p><span class="NameInput">Отчество:</span><input id="Pname"  type="text" name="Pname" value="'.$row_user['Pname'].'" placeholder="Отчество:"><span></span><span id="e_PnameOk" style="display: none;"> <img src="tpl/css/images/ok.png"/></span></p>
<p><span class="NameInput">E-mail:</span><input id="mail" type="text" name="mail" value="'.$row_user['mail'].'"placeholder="e-mail:"><span></span><span id="e_mailOk" style="display: none;"> <img src="tpl/css/images/ok.png"/></span></p>                       
<p><span class="NameInput">Телефон:</span><input id="phone" type="text" name="phone" value="'.$row_user['phone'].'" placeholder="Телефон:"><span></span><span id="e_phoneOk" style="display: none;"> <img src="tpl/css/images/ok.png"/></span></p>  
<p>Комментарий к заказу:</p>
<p><textarea name="comet" id="coment" value="" cols="60" rows="10" placeholder="Введите текст комментария..."></textarea></p>
<div id="mug"><div class="parameter"> 
	<h4 style="text-transform:uppercase">Способ оплаты:</h4>
	<p><input id="checkboxTP1" class="typePay" type="checkbox" name="typePay[]" value="Cash" onclick="OnCheckbox(this.className,this.id)"/>Наличиными или картой в пунктах продажи</p>
	<p><input id="checkboxTP2" class="typePay" type="checkbox" name="typePay[]" value="ERIP" onclick="OnCheckbox(this.className,this.id)"/>Система "Расчет"</p>
	<p><input id="checkboxTP3" class="typePay" type="checkbox" name="typePay[]" value="iPay" onclick="OnCheckbox(this.className,this.id)"/>Через систему iPay</p>
	<p><input id="checkboxTP4" class="typePay" type="checkbox" name="typePay[]" value="WebPay" onclick="OnCheckbox(this.className,this.id)"/>Через систему WebPay</p>
</div>
                          
                        </div>                   
<p> <input type="submit" class="GO_order" value="Оформить заказ" disabled></p>  

');
}else {echo('<span style="font-size:16pt; margin-top:50px;float:left;">Корзина пуста</span>');}
?>
