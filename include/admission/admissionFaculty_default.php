	<div class="table-responsive"> 
		<table class="table table-striped b-t text-sm"> 
			<thead> 
				<tr> 
					<th width="20"><input type="checkbox"></th> 
					<th data-toggle="class" class="th-sortable">Faculty 
						<span class="th-sort">
						 <i class="fa fa-sort-down text"></i> 
						 <i class="fa fa-sort-up text-active"></i> 
						 <i class="fa fa-sort"></i> 
					 	</span> 
					</th> 
					<th>Location</th> 
					<th>Address</th> 
					<th>Telephone</th> 
					<th>Email</th>
					<th width="30">Edit</th> 
				</tr> 
			</thead> 
			<tbody> 
				<tr> 
					 <?php do { 
						 	$id = $row_inst['FacultyID']; 
							$name = $row_inst['FacultyName'];
							$location = $row_inst['Location'];
							$address = $row_inst['Address'];
							$tel = $row_inst['Tel'];
							$email = $row_inst['Email'];
						 echo"
					<td><input type='checkbox' value='$id' name='post[]'></td> 
					<td>$name</td>
					<td>$location</td>
					<td>$address</td>  
					<td>$tel</td> 
					<td>$email</td>     
					<td> 
					<a  class='active' href='./?page=Faculty&section=Policy&edit=$id'>
						<i class='fa fa-check text-success text-active'></i>
						<i class='fa fa-times text-danger text'></i>
						</a> 
					</td> 
					
				</tr> ";
				} while ($row_inst = mysql_fetch_assoc($inst));
				?>
			</tbody> 
		</table> 
	</div> 
	<footer class="panel-footer"> 
		<div class="row"> 
			<div class="col-sm-4 hidden-xs">
				 <select class="input-sm form-control input-s-sm inline"> 
				 	<option value="0">Bulk action</option> 
				 	<option value="1">Delete selected</option> 
				 	<option value="2">Bulk edit</option> 
					 <option value="3">Export</option> 
			 	</select> 
			 	<button class="btn btn-sm btn-white">Apply</button> 
		 	</div> 
		 	<div class="col-sm-4 text-center"> 
			 	<small class="text-muted inline m-t-sm m-b-sm">
				 	<?php
				 	if(($pageNum_inst - 1) < 0)
				 	{
					 	if($totalRows_inst <= $maxRows_inst)
					 	{
					 		echo "showing 1 - $totalRows_inst of $totalRows_inst items";
				 	 	}
					 	else
					 	{
							$startpaging = 1;
							$endpaging = $startpaging + ($maxRows_inst - 1);
					 		echo "showing 1 - $endpaging  of $totalRows_inst items";
					 	}
				 	}
					else
					{
						$startpaging = ($pageNum_inst * $maxRows_inst) + 1;
						$endpaging = $startpaging + ($maxRows_inst - 1);
						echo "showing $startpaging - $endpaging of $totalRows_inst items";
					}
					 ?>
				 </small> 
		 	</div> 
		 	<div class="col-sm-4 text-right text-center-xs"> 
				 <ul class="pagination pagination-sm m-t-none m-b-none"> 
					<?php
					if(($pageNum_inst - 1) < 0)
					{
						echo"<li class='disabled'><a href='#'><i class='fa fa-chevron-left'></i></a></li> ";
					}
					else
					{
						$maxpage = max(0, $pageNum_inst - 1);
						echo"<li><a href='./?page=Faculty&section=Policy&pageNum_inst=$maxpage$queryString_inst'><i class='fa fa-chevron-left'></i></a></li>";
						
					}
				        if($pageNum_inst <> 0)
				        {
				       	 	for($i=1; $i<=$pageNum_inst; $i++)
				       	 	{
				       	 
				       	 	       echo "<li><a href='"; 							  printf("./?page=Faculty&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $i - 1), $queryString_inst);
						       echo"'>$i</a></li>";
				       	 //$lastpage = $lastpage + 1;
				       	        }
	
				        }	
					$activepage = $pageNum_inst+1;
					echo "<li class='active'><a href='#'>$activepage</a></li>";	
					$lastpage = $pageNum_inst;

					for($i=$pageNum_inst+2; $i<=$totalPages_inst; $i++)
					{
						?>
					<li><a href="<?php printf("./?page=Faculty&section=Policy&pageNum_inst=%d%s", min($totalPages_inst, $pageNum_inst + 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
					
					<?php
					$lastpage = $lastpage + 1;
					}
					
					if($lastpage > $totalPages_inst || $pageNum_inst == 0 )
					{
						?> 
						<li><a href="<?php printf("./?page=Faculty&section=Policy&pageNum_inst=%d%s",min($totalPages_inst, $pageNum_inst + 1), $queryString_inst); ?>"><i class="fa fa-chevron-right"></i></a></li>
						<?php 
 
					 }
					 else
					 {	
						 echo"<li class='disabled'><a href='#'><i class='fa fa-chevron-right'></i></a></li>";
					}
					?>	
				 	
				 	
			 	</ul> 
			 </div> 
		 </div> 
 	</footer> 


