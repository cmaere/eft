

		<div id="content" "="">
	<h2>Sponsor Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Sponsor Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
			<div class="span6" style="width: 50px;">
	
<!-- sponsor form -->

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "staff")) {
  $insertSQL = sprintf("INSERT INTO sponsors (Name, Address, comment) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['szSponsor'], "text"),
                       GetSQLValueString($_POST['szAddress'], "text"),
                       GetSQLValueString($_POST['szTelephone'], "text"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());
}
?>
   <form name="staff" method="POST" action="<?php echo $editFormAction; ?>">
<table cellspacing="1" cellpadding="0" border="0" width=100% >
              <TR >
                <TD >Name of Sponsor:</TD>
                <TD><input type="text" name="szSponsor" size="30" class="vform" id="szSponsor">
                </TD>
              </TR>
			  <TR >
                <TD >Address:</TD>
                <TD><input type="text" class="vform" size="30" name="szAddress"></TD>
              </TR>
			  
			  <TR >
                <TD >Telephone No.:</TD>
                <TD><input type="text" class="vform" size="30" name="szTelephone"></TD>
              </TR>
			  
			  <tr>
				<td>&nbsp;</td>
				<td><input  class="vform" type="submit" name="action" value="update" onClick="return formValidator()"></td>
			  </tr>
</table>
<input type="hidden" name="MM_insert" value="staff">
</form>

	<!-- //sponsor form -->
	
	
	
	
	
	
	
	

</div>
			</div>
	</div>
</div>
</div>

