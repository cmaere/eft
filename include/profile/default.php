
	<?php
		
	//$profile_stat =  studentindex($_SESSION['username'],$cha);
	
	?>
	
	<div class="col-lg-8">			
		
	
		 <section class="panel"> 
			 <header class="panel-heading bg-primary lter no-borders">
				  <div class="clearfix">
					  <a class="pull-left thumb avatar border m-r" href="#"> 
					  	<img class="img-circle" src="images/avatar_default.jpg">
				   	</a> 
					<div class="clear"> 
						<div class="h3 m-t-xs m-b-xs"><?php echo $_SESSION['loginName'];?>
							<i class="fa fa-circle text-success pull-right text-xs m-t-sm"></i>
						</div> 
						<small class="text-muted"><?php echo $profile_stat[1];?></small>
					 </div> 
				 </div> 
			 </header>
			  <div class="list-group no-radius alt"> 
				  <a href="#" class="list-group-item"> 
					  <span class="badge bg-success"></span> 
					  <i class="fa fa-comment icon-muted"></i> Username as <?php echo $profile_stat[0];?>
				  </a> 
				  <a href="#" class="list-group-item"> <span class="badge bg-info"></span> 
					  <i class="fa fa-envelope icon-muted"></i> Email is <?php echo $profile_stat[3];?>
				  </a> 
				  <a href="#" class="list-group-item"> <span class="badge bg-light"></span> 
					  <i class="fa fa-eye icon-muted"></i>Loggedin on <?php echo $profile_stat[2];?>
				  </a> 
				  
			   </div> 
		   </section> 
	
	
		
		 <section class="panel no-borders hbox"> 
			 <aside> 
				 <div class="pos-rlt"> 
					 <span class="arrow right hidden-xs"></span> 
					 <div class="panel-body"> 
						 <div class="clearfix m-b"> 
							 <small class="text-muted pull-right">2 days ago</small>
							  <a href="#" class="thumb-sm pull-left m-r"> 
								  <i class="fa fa-envelope"></i>
							  </a> 
							  <div class="clear"> 
								  <a href="#"><strong>EFT Message </strong></a> 
								  <small class="block text-muted">administrator</small> 
							  </div>
						  </div> 
						
						  <small class=""> <a href="#"><i class="fa fa-share"></i> Share (10)</a> </small> 
					  </div> 
					  <footer class="panel-footer"> 
						  <form class="pull-out b-t"> 
							  <input class="form-control no-border input-lg text-sm" placeholder="Write a comment..." type="text"> 
						  </form> 
					  </footer> 
				  </div> 
			  </aside> 
			  <aside class="bg-primary clearfix lter r-r text-right v-middle"> 
				  <div class="wrapper h3 font-thin"> </div> 
			  </aside> 
		  </section> 
	  </div>
 
		  
			