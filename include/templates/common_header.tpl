<div class="col-lg-8">	
<section class="panel"> 
	<!-- BEGIN heading-->
	<header class="panel-heading">{PAGENAME}</header> 
	<div class="row text-sm wrapper"> 
	<div class="col-lg-7">
		 <form  name="upload" action="{ACTION}" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" name="email">
			</div>
			<div class="form-group">
				<label for="encry">Encryption file</label>
				<input type="file" class="form-control" name="encry">
			</div>
			<div class="form-group">
				<label for="csv">CSV/Excel</label>
				<input type="file" class="form-control" name="csv">
			</div>
			<button type="submit" class="btn btn-success">Submit</button>
			<input type="hidden" name="submit" value="upload">
			</form>
			</div>
		</div> 
	</div> 
	<!-- END heading-->