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
			buttonOnAndOff();
		}
		
	});	
	$("#mail").keyup(function(){
		$("#mail").removeClass();
		$("#mail").next().text("");
	});	
	
	

	
	
	function buttonOnAndOff(){
		if(FnameStat==1  && nameStat==1 && PnameStat==1 && PhoneStat==1 && mailStat == 1 ){
			$("#submit").removeAttr("disabled");
		}else{
			$("#submit").attr("disabled","disabled");
		}
	
	}
});