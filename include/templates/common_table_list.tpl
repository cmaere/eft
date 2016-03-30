	<form name="listform" id="listform">
	<div class="table-responsive"> 
		<table class="table table-striped b-t text-sm"> 
			<thead> 
				<tr> 
					
					<th width="20"><input type="checkbox"></th> 
					<!-- BEGIN columns -->
					<th {OPTIONS}>{COLUMNTITLE} 
						
						{SPINNER}
					</th> 
					<!-- END columns -->
					
					<th>Edit</th> 
				</tr> 
			</thead> 
			<tbody> 
				<!-- BEGIN row -->
				<tr> 
					<!-- BEGIN id -->
					<td><input type='checkbox' value='{ID}' name='checkbox[]'></td> 
					<!-- END id --> 
					<!-- BEGIN innercolumns -->
					<td>{ROWDATA}</td>   
					<!-- END innercolumns --> 
					<!-- BEGIN edit -->
					<td> 
					<a  class='active' href='{ID}'>
						<i class='fa fa-pencil text-success text-active'></i>
						</a> 
					</td> 
					<!-- END edit -->
					
					
				</tr> 
				<!-- END row -->
				
				
			</tbody> 
		</table> 
	</div> 
	<footer class="panel-footer"> 
		<div class="row"> 
			<div class="col-sm-4 hidden-xs">
				<!-- BEGIN delete -->
				 <select class="input-sm form-control input-s-sm inline"> 
				 	<option value="0">Bulk action</option> 
				 	<option value="1" onClick=" delete_records('{FORM}');">Delete selected</option> 
					 <option value="3">Export</option> 
			 	</select> 
				<!-- END delete -->
				
		 	</div> 
			<!-- BEGIN pagenumstat -->
		 	<div class="col-sm-4 text-center"> 
			 	<small class="text-muted inline m-t-sm m-b-sm">
				 	{PAGENUMSTATUS}
				 </small> 
		 	</div> 
			<!-- END pagenumstat -->
		 	<div class="col-sm-4 text-right text-center-xs"> 
				 <ul class="pagination pagination-sm m-t-none m-b-none"> 
					<!-- BEGIN back -->
					<li class='{CLASS}'><a href='{LINK}'><i class='fa fa-chevron-left'></i></a></li>
					<!-- END back -->
					
				       <!-- BEGIN pages -->				       	 
				       <li><a href="{LINK}">{PAGES}</a></li>
				       	<!-- END pages -->		
					<!-- BEGIN active -->
					<li class='active'><a href='#'>{ACTIVEPAGE}</a></li>	
					<!-- END active -->
					
					<!-- BEGIN pagesfront -->
					<li><a href="{LINK}">{FRONTPAGES}</a></li>
					
					<!-- END pagesfront -->
					<!-- BEGIN front -->
					
					<li class='{CLASS}'><a href='{LINK}'><i class='fa fa-chevron-right'></i></a></li>
				 	<!-- END front -->
				 	
			 	</ul> 
			 </div> 
		 </div>
		  </form> 
 	</footer> 

</section>	
</div>
