		<div id="content" "="">
	<h2>Suggestion Box Page<span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Suggestion Box  Form</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmsuggestion")) {
  $insertSQL = sprintf("INSERT INTO suggestion (received, fromid, toid, message) VALUES (now(), %s, %s, %s)",
                       //GetSQLValueString($_POST['received'], "text"),
                       GetSQLValueString($_POST['regno'], "text"),
                       GetSQLValueString($_POST['toid'], "text"),
                       GetSQLValueString($_POST['message'], "text"));

  mysql_select_db($database_cha, $cha);
  $Result1 = mysql_query($insertSQL, $cha) or die(mysql_error());

  $insertGoTo = "studentindex.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
echo '<meta http-equiv = "refresh" content ="0; 
	url = studentindex.php">';
}

mysql_select_db($database_cha, $cha);
$query_suggestionbox = "SELECT suggestion.received, suggestion.fromid, suggestion.toid, suggestion.message FROM suggestion";
$suggestionbox = mysql_query($query_suggestionbox, $cha) or die(mysql_error());
$row_suggestionbox = mysql_fetch_assoc($suggestionbox);
$totalRows_suggestionbox = mysql_num_rows($suggestionbox);
?>


 <form action="<?php echo $editFormAction; ?>" method="POST" name="frmsuggestion" id="frmsuggestion">
            <table width="529" border="0">
              <tr>
                <td width="95" height="21"><div align="right"><strong>Send To:</strong></div></td>
                <td width="424" nowrap>System Administrator 
                  <input name="regno" type="hidden" id="regno" value="<?php echo $RegNo; ?>">
                  <input name="toid" type="hidden" id="toid" value="admin">
                  <input name="received" type="hidden" id="received" value="<?php $today = date("F j, Y"); echo $RegNo; ?>"></td>
              </tr>
              <tr>
                <td height="136"><div align="right"><strong>Message:</strong></div></td>
                <td><textarea name="message" cols="50" rows="7" class="normaltext" id="message"></textarea></td>
              </tr>
			  <tr>
                <td height="28" nowrap><div align="right"><strong>Post Message:</strong></div></td>
                <td nowrap>
                  <div align="left">
                    <input name="Send" type="submit" value="Post Message">
                    <span class="style64 style1">............................</span>
                    <input type="reset" name="Reset" value="Clear Message">
                  </div></td></tr>
            </table>
              <input type="hidden" name="MM_insert" value="frmsuggestion">
</form>


</div>
			</div>
	</div>
</div>
</div>
