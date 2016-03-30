<section class="panel"> 
	<header class="panel-heading font-bold"> New Institution </header> 
	<div class="panel-body"> 
		<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInst" id="frmInst" class="form-horizontal"> 
			<div class="form-group"> <label class="col-sm-2 control-label">Institution</label> 
				<div class="col-sm-10"> <input type="text" name="txtName" class="form-control rounded"> </div> 
			</div> 
			<div class="line line-dashed line-lg pull-in"></div> 
			<div class="form-group"> <label class="col-sm-2 control-label">Address</label> 
			 	<?php Wysiwyg('txtAdd'); ?>
			 </div>
	   	         <div class="line line-dashed line-lg pull-in"></div> 
			 <div class="form-group"> <label class="col-sm-2 control-label">Physical Address</label> 
			 	<?php Wysiwyg('txtPhyAdd'); ?>
			 </div>
			 <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Telephone</label> 
 				<div class="col-sm-10"> <input type="text" name="txtTel" class="form-control rounded"> </div> 
 			</div>
			<div class="line line-dashed line-lg pull-in"></div> 
			<div class="form-group"> <label class="col-sm-2 control-label">Email</label> 
				<div class="col-sm-10"> <input type="text" name="txtEmail" class="form-control rounded"> </div> 
			</div>
	    	     	<div class="line line-dashed line-lg pull-in"></div> 
    		    	<div class="form-group"> <div class="col-sm-4 col-sm-offset-2">  
	    		    <button class="btn btn-primary" type="submit">Add Record</button> 
			    <input type="hidden" name="MM_insert" value="frmInst">
    	    		</div> 

		</form> 
	</div> 
</section>
</section>	
</div>