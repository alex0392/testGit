<div id="header">

				<div id="head_top">
                
					<div class="logo">
						<a href="http://www.profiprint.by"><img src="http://www.profiprint.by/personal/tpl/css/images/logo.png" alt="Logo"></a>
   					</div><!-- .logo -->
    
   				
        <div id="headerRight">
        <div id="user-email-header"> <?php echo($row['mail']);?> </div>
        <form action='' method='POST' >
                        
							<input type="submit" name='log_out' class="buttonOut" value="Выход"  />
                            
     	</form>
		</div>			
                
                
      
  
   				</div> 
                
                <nav id="mainmenu" role="navigation">
                    
                    <ul class="secondmenu">
                    
		<li><a href='add-csv.php' class="<?php echo($current_csv)?>"><span>Работа с  .CSV</span></a></li>	
		<li><a href='admin-category-list.php' class="<?php echo($currentCategory)?>"><span>Список категорий</span></a></li>
        <li><a href='goods.php' class="<?php echo($currentGoods)?>"><span>Товары</span></a></li>
       
        </ul>
        </nav>  
</div>