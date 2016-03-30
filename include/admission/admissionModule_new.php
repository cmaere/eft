

<section class="panel"> 
	<header class="panel-heading font-bold"> New Module </header> 
	<div class="panel-body"> 
		<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInstEdit" id="frmInstEdit" class="form-horizontal"> 
			
			<div class="form-group"> <label class="col-sm-2 control-label">Faculty</label> 
				<div class="col-sm-10">
					 <select name="cmbFac">
				<?php
				
				echo "<option>---Select Faculty---</option>";	
				do 
				{ 
					$value = $row_lecturers['FacultyName'];
					echo "<option value='$value'>$value</option>";	
						
				}while ($row_lecturers = mysql_fetch_assoc($campus));
	
					
				?>
				
					</select>
					
				 </div> 
			</div>
	    	     	<div class="line line-dashed line-lg pull-in"></div>
			<div class="form-group"> <label class="col-sm-2 control-label">Department</label> 
				<div class="col-sm-10">
					 <select name="cmbDept">
				<?php
				echo "<option>---Select Department----</option>";	
				do 
				{ 
					$value = $row_lecturers['DeptName'];
					echo "<option value='$value'>$value</option>";	
						
				}while ($row_lecturers = mysql_fetch_assoc($faculty));
	
					
				?>
				
					</select>
					
				 </div> 
			</div>
	    	     	<div class="line line-dashed line-lg pull-in"></div>
 			<div class="form-group"> <label class="col-sm-2 control-label">Course Code</label> 
 				<div class="col-sm-10"> <input type="text" name="txtCode" class="form-control rounded" value=""> </div> 
 			</div>
	   	         <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Course Title</label> 
 				<div class="col-sm-10"> <input type="text" name="txtTitle" class="form-control rounded" value=""> </div> 
 			</div>
			 <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Units</label> 
 				<div class="col-sm-10"> <input type="text" name="txtUnit" class="form-control rounded" value=""> </div> 
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