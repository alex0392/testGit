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
								$('#loader').hide();
								$('div#fader').fadeOut('slow');
			
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
				
		
				});
						
						
				/******Finde goods****/
				$('.find_text').live('keypress',function(e){
						var code = (e.keyCode ? e.keyCode : e.which);
						if(code==13){
							var string=$('.find_text').val();
							var kat=$('.find_text').attr('rel')
						
							$.ajax({
								type: "POST",
								url: "ajaxFindGoods.php",
								data:  {str:string,kategory:kat},
								success: function(html){
									
									$('#content').html(html);
									document.title = "Результат поиска";
								}
							});
						
						}
	     	 	});
				
				
					
				$('.button_find').live('click',function(){
					
						var string=$('.find_text').val();
						var kat=$('.find_text').attr('rel')
						
						$.ajax({
							type: "POST",
							url: "ajaxFindGoods.php",
							data:  {str:string,kategory:kat},
							success: function(html){
								
								$('#content').html(html);
								document.title = "Результат поиска";
							}
						});
						
					})
			