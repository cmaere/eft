

		<div id="content" "="">
	<h2>Course Roster Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Course List Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			<div class="span6" style="width: 50px;">
	

	<?php

				$currentPage = $_SERVER["PHP_SELF"];
				$editFormAction = $_SERVER['PHP_SELF'];
				if (isset($_SERVER['QUERY_STRING'])) {
	
				  $editFormAction .= "?". htmlentities($_SERVER['QUERY_STRING']);
  
				}
				$maxRows_courselist = 13;
				$pageNum_courselist = 0;
				$pageNum_inst = 0;
				if (isset($_GET['pageNum_courselist'])) {
				  $pageNum_courselist = $_GET['pageNum_courselist'];
				}
				$startRow_courselist = $pageNum_courselist * $maxRows_courselist;
				mysql_select_db($database_cha, $cha);
				if (isset($_GET['course'])) {
				  $key=$_GET['course'];
				  $query_courselist = "SELECT CourseCode, CourseName, Units FROM course WHERE CourseCode Like '%$key%' ORDER BY CourseCode";
				}else{
				$query_courselist = "SELECT CourseCode, CourseName, Units FROM course ORDER BY CourseCode";
				}

				$query_limit_courselist = sprintf("%s LIMIT %d, %d", $query_courselist, $startRow_courselist, $maxRows_courselist);
				$courselist = mysql_query($query_limit_courselist, $cha) or die(mysql_error());
				$row_courselist = mysql_fetch_assoc($courselist);

				if (isset($_GET['totalRows_courselist'])) {
				  $totalRows_courselist = $_GET['totalRows_courselist'];
				} else {
				  $all_courselist = mysql_query($query_courselist);
				  $totalRows_courselist = mysql_num_rows($all_courselist);
				}
				$totalPages_courselist = ceil($totalRows_courselist/$maxRows_courselist)-1;

				$queryString_courselist = "";
				if (!empty($_SERVER['QUERY_STRING'])) {
				  $params = explode("&", $_SERVER['QUERY_STRING']);
				  $newParams = array();
				  foreach ($params as $param) {
				    if (stristr($param, "pageNum_courselist") == false && 
				        stristr($param, "totalRows_courselist") == false) {
				      array_push($newParams, $param);
				    }
				  }
				  if (count($newParams) != 0) {
				    $queryString_courselist = "&" . htmlentities(implode("&", $newParams));
				  }
				}
				$queryString_courselist = sprintf("&totalRows_courselist=%d%s", $totalRows_courselist, $queryString_courselist);
 
				?>
				<table width="720" border="1" cellpadding="0" cellspacing="0">
				            <tr>
							<td width="25">Pick </td>
				              <td width="60">Course Code </td>
							  <td width="40">Units</td>
				              <td width="444" nowrap>Course Description </td>
				            </tr>
				            <?php do { ?>
				            <tr>
				                <td><?php $CourseCode = $row_courselist['CourseCode']; echo "<a href=\"/?page=StudentCourseRegister&section=AcademicRecords&CourseCode=$CourseCode\"> Pick </a>"; ?></td>
								<td nowrap><?php echo $row_courselist['CourseCode']; ?></td>
				                <td><?php echo $row_courselist['Units']; ?></td>
				                <td><?php echo $row_courselist['CourseName']; ?></td>
				            </tr>
				            <?php } while ($row_courselist = mysql_fetch_assoc($courselist)); ?>
				</table>
				
				<div class="pagination margin-none" style="width: 400px;">
				<ul>
				<?php
				if(($pageNum_inst - 1) < 0)
				{
				  echo "<li class='disabled'><a href='#'>&laquo;</a></li>";
				 }
				 else
				 {		 
				?> 
				<li><a href="<?php printf("/?page=CourseRoster&section=AcademicRecords&pageNum_inst=%d%s", max(0, $pageNum_inst - 1), $queryString_inst); ?>">&laquo;</a></li>
				<?php
				 }
				 //die($pageNum_inst);
				 if($pageNum_inst <> 0)
				 {
					 for($i=1; $i<=$pageNum_inst; $i++)
					 {
					 	?>
					 <li><a href="<?php printf("/?page=CourseRoster&section=AcademicRecords&pageNum_inst=%d%s", min($totalPages_inst, $i - 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
					 <?php
					 //$lastpage = $lastpage + 1;
					 }
	
				 }

 
				 ?>
				<li class="active"><a href="#"><?php echo $pageNum_inst+1; ?></a></li>
				<?php

				$lastpage = $pageNum_inst;

				for($i=$pageNum_inst+2; $i<=$totalPages_inst; $i++)
				{
					?>
				<li><a href="<?php printf("/?page=CourseRoster&section=AcademicRecords&pageNum_inst=%d%s", min($totalPages_inst, $pageNum_inst + 1), $queryString_inst);  ?>"><?php echo $i; ?></a></li>
				<?php
				$lastpage = $lastpage + 1;
				}

				if($lastpage > $totalPages_inst || $pageNum_inst == 0 )
				{
					?> 
					<li><a href="<?php printf("/?page=CourseRoster&section=AcademicRecords&pageNum_inst=%d%s",min($totalPages_inst, $pageNum_inst + 1), $queryString_inst); ?>">&raquo;</a></li>
					<?php 
 
				 }
				 else
				 {	
					 echo"<li class='disabled'><a href='#'>&raquo;</a></li>";
				}
				?>
				
				
				
				<br><br>
				
						    <form name="form1" method="get" action="<?php echo $editFormAction; ?>">
				              Search by Course Code
				              <input name="course" type="text" id="course" maxlength="50">
				              <input type="submit" name="Submit" value="Search">
				            </form>
		   
				<?php
				mysql_free_result($courselist);

				
				?>
			</ul>
			</div>
	
	
	
	
	

</div>
			</div>
	</div>
</div>
</div>

