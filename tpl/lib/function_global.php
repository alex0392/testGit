<?

function enter (){

	$error = array();
	
	if ($_POST['mail'] != "" && $_POST['password'] != "")
	{

		$mail = $_POST['mail']; 
		$password = $_POST['password'];

		$rez = mysql_query("SELECT * FROM user WHERE mail='$mail'");
		
		
		
		if (mysql_num_rows($rez) == 1)
		{
	
				$row = mysql_fetch_assoc($rez); 			
				if (md5(md5($password).$row['salt']) == $row['password']){
		
			
					$_SESSION['id'] = $row['id'];
					$id = $_SESSION['id']; 
				
					return $error;
				}else
				{$error[]="Неверный логин или пароль";
				return $error;
				}
		}
		else
		{
			$error[]="Неверный логин или пароль";
			return $error;
		
		}
	}
	else{
	$error[]="Поля не должны быть пустыми";
	return $error;
	}	
}	
?>


<?

function is_admin($id) { 
	
$rez = mysql_query("SELECT prava FROM user WHERE id='$id'"); 	

if (mysql_num_rows($rez) == 1) 	
{ 		
	$prava = mysql_result($rez, 0); 		

if ($prava == 1) return 1; 		
elseif($prava == 2) return 2;
else return 0; 
} 	
else return 0;	 
}
?>


<?
function login () { 	

@ini_set ("session.use_trans_sid", true);
	
session_start(); 

if (isset($_SESSION['id']))//если сесcия есть 	

{ 		
if(isset($_COOKIE['mail']) && isset($_COOKIE['password'])) //если cookie есть, то просто обновим время их жизни и вернём true 		
{ 		

$id='11';		
	
return $id;
} 		
else //иначе добавим cookie с логином и паролем, чтобы после перезапуска браузера сессия не слетала  		
{ 			
$rez = mysql_query("SELECT * FROM user WHERE id='{$_SESSION['id']}'"); //запрашиваем строку с искомым id 			

if (mysql_num_rows($rez) == 1) //если получена одна строка 			
{ 		
$row = mysql_fetch_assoc($rez); //записываем её в ассоциативный массив 				

//setcookie ("mail", $row['mail'], time()+50000, '/'); 				

//setcookie ("password", $row['password'], time() + 50000, '/'); 

$id = $_SESSION['id'];
			
return $id;
} 
else return $id; 		
} 	
} 	
  return $id;
}
?>

<?

function out () { 	
session_start(); 


session_unset();
session_destroy();

header('Location: http://www.profiprint.by/personal/index.php'); //перенаправляем на главную страницу сайта 
	exit();
}
?>
