<?php
#get post variables
$key = htmlspecialchars($_GET['edit']);
mysql_select_db($database_cha, $cha);

$query_instEdit = "SELECT * FROM campus WHERE CampusID ='$key'";
$instEdit = mysql_query($query_instEdit, $cha) or die(mysql_error());
$row_instEdit = mysql_fetch_assoc($instEdit);
$totalRows_instEdit = mysql_num_rows($instEdit);

$queryString_inst = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_inst") == false && 
        stristr($param, "totalRows_inst") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_inst = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_inst = sprintf("&totalRows_inst=%d%s", $totalRows_inst, $queryString_inst);
//display form
?>

<section class="panel"> 
	<header class="panel-heading font-bold"> New Institution </header> 
	<div class="panel-body"> 
		<form action="<?php echo $editFormAction; ?>" method="POST" name="frmInstEdit" id="frmInstEdit" class="form-horizontal"> 
			<div class="form-group"> <label class="col-sm-2 control-label">Institution</label> 
				<div class="col-sm-10"> <input type="text" name="txtName" class="form-control rounded" value="<?php echo $row_instEdit['Campus']; ?>"> </div> 
			</div> 
			<div class="line line-dashed line-lg pull-in"></div> 
			<div class="form-group"> <label class="col-sm-2 control-label">Address</label> 
			 	<?php Wysiwyg('txtAdd',$row_instEdit['Address']); ?>
			 </div>
	   	         <div class="line line-dashed line-lg pull-in"></div> 
			 <div class="form-group"> <label class="col-sm-2 control-label">Physical Address</label> 
			 	<?php Wysiwyg('txtPhyAdd',$row_instEdit['Location']); ?>
			 </div>
			 <div class="line line-dashed line-lg pull-in"></div> 
 			<div class="form-group"> <label class="col-sm-2 control-label">Telephone</label> 
 				<div class="col-sm-10"> <input type="text" name="txtTel" class="form-control rounded" value="<?php echo $row_instEdit['Tel']; ?>"> </div> 
 			</div>
			<div class="line line-dashed line-lg pull-in"></div> 
			
			<div class="form-group"> <label class="col-sm-2 control-label">Email</label> 
				<div class="col-sm-10"> <input type="text" name="txtEmail" class="form-control rounded" value="<?php echo $row_instEdit['Email']; ?>"><input name="id" type="hidden" id="id" value="<?php echo $key ?>">
				</div> 
			</div>
			
	    	     	<div class="line line-dashed line-lg pull-in"></div> 
			
    		    	<div class="form-group"> <div class="col-sm-4 col-sm-offset-2">  
	    		    <button class="btn btn-primary" type="submit">Edit Record</button> 
			    <input type="hidden" name="MM_update" value="frmInstEdit">
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