<?
include('tpl/lib/connect.php');
header("Content-Type: text/html; charset=utf-8");
ini_set ("session.use_trans_sid", true); 
session_start();
		$to='sanya101@tut.by, 6663596@gmail.com';//e-mail админа каталога
	
		$subject = 'Поступил новый заказ в каталоге'; 

$count=explode('/',$_POST['count']);		
$i=0;	
$vpp='';	
?>
<p>Новое изменение</p>
<?	
		$rez = mysql_query("SELECT * FROM catalog_goods WHERE numb_order='".$_SESSION['NumbOrd']."'");
		$totalPrice=0;
		$massage='Поступил новый заказ в разделе каталог.'."\n"."\n";
		$cont='Контактные данные заказчика:'."\n".$_POST['Fname'].' '.$_POST['name'].' '.$_POST['Pname']."\n".'Телефон: '.$_POST['phone']."\n".'e-mail: '.$_POST['mail']."\n";
		while($row=mysql_fetch_assoc($rez)){
			$cat="Категория:".$row['kat']."\n"."Модель: ".$row['model']."\n"."Цена: ".$row['cost']."\n"."Количество: ".$count[$i]."\n"."\n";
			$massage=$massage."\n".$cat;
			$totalPrice=$totalPrice+(int)$row['cost']*(int)$count[$i];
			$i++;
		}
		$massage=$massage.$cont."Комментарий к заказу:"."\n".$_POST['coment']."\n"."Дата заказа: ".date('D, d M Y H:i:s')."\n";
		
		
		

		//mail($to,$subject,$massage); //отправка e-mail админу
	 	$messageToPay='Здравствуйте. Номер вашего заказа: '.$_SESSION['NumbOrd'];
		switch ($_POST['typePay']){
			case 'Cash':echo('<script> alert("Ваш заказ принят!");</script>'); break;
			case 'iPay':echo('<script> alert("Ваш заказ принят! Для оплаты через iPay, перейдите в раздел \"Способы оплаты\" нашего сайта и следуйте инструкции.");</script>'); break;
			case 'ERIP':echo('<script> alert("Ваш заказ принят! Номер вашего заказа отправлен на: '.$_POST['mail'].'");</script>');
			mail($_POST['mail'],'profiprint.by-номер заказа',$messageToPay);
			case 'WebPay':	$wsb_seed=time ( void );
							$wsb_storied=704059832;
							$wsb_order_num=$_SESSION['NumbOrd'];
							$wsb_test='0';
							$wsb_currency_id='BYR';
							$wsb_total=$totalPrice;
							$wsb_secretKey='KB028lbs_22';
							$wsb_signature=sha1($wsb_seed.$wsb_storied.$wsb_order_num.$wsb_test.$wsb_currency_id.$wsb_total.$wsb_secretKey);
			echo('<form action="https://payment.webpay.by" method="post">
            <input type="hidden" name="*scart">
            <input type="hidden" name="wsb_storeid" value="'.$wsb_storied.'">
            <input type="hidden" name="wsb_store" value="profiprint.by">
            <input type="hidden" name="wsb_language_id" value="russian">
            <input type="hidden" name="wsb_order_num" value="'.$wsb_order_num.'">
            <input type="hidden" name="wsb_currency_id" value="BYR">
            <input type="hidden" name="wsb_version" value="2">
            <input type="hidden" name="wsb_seed" value="'.$wsb_seed.'">
            <input type="hidden" name="wsb_signature" value="'.$wsb_signature.'">
            <input type="hidden" name="wsb_return_url" value="http://profiprint.by">
            <input type="hidden" name="wsb_cancel_return_url" value="http://profiprint.by">
            <input type="hidden" name="wsb_notify_url" value="http://profiprint.by">
            <input type="hidden" name="wsb_email" value="'.$_POST['mail'].'">
            <input type="hidden" name="wsb_phone" value="'.$_POST['phone'].'">
            <input type="hidden" name="wsb_test" value="0">
            <input type="hidden" name="wsb_invoice_item_name[1]" value="Сумма заказа">
            <input type="hidden" name="wsb_invoice_item_quantity[1]" value="1">
            <input type="hidden" name="wsb_invoice_item_price[1]" value="'.$wsb_total.'">
            <input type="hidden" name="wsb_total" value="'.$wsb_total.'">
			<input class="go_webpay" style="display:none;" type="submit" value="Купить">
        </form>');
			break;
		}
		

	mysql_query ("DELETE FROM catalog_goods WHERE numb_order='".$_SESSION['NumbOrd']."'");
	unset($_SESSION['NumbOrd']);
?>
