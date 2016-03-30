
<section class="panel"> 
	<header class="panel-heading font-bold"> New Sponsor </header> 
	<div class="panel-body"> 
		<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInstEdit" id="frmInstEdit" class="form-horizontal"> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Name of Sponsor</label> 
 				<div class="col-sm-10"> <input type="text" name="txtName" class="form-control rounded" value=""> </div> 
 			</div>
	   	         <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Address</label> 
 				<div class="col-sm-10"> <input type="text" name="txtAddress" class="form-control rounded" value=""> </div> 
 			</div>
			 <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Telephone No.</label> 
 				<div class="col-sm-10"> <input type="text" name="txtTel" class="form-control rounded" value=""> <input type="hidden" name="id" value=""></div> 
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

<?php

//


@mysql_free_result($inst);

@mysql_free_result($instEdit);
?>