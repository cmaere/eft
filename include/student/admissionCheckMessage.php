		<div id="content" "="">
	<h2>Message Page <span>for Student Academic Record Information System (SARIS)</span></h2>

<div class="innerLR">
	<!-- Intro message -->
	<div class="widget" data-toggle="collapse-widget">
		<div class="widget-head">
			<h4 class="heading glyphicons cardio">Inbox</h4>
		</div>
		<div class="widget-body collapse in">
			<div id="chart_lines_fill_nopoints1" style="height: 200px; padding: 0px; position: relative;">
				
<?php
$maxRows_studentsuggestion = 1;
$pageNum_studentsuggestion = 0;
if (isset($_GET['pageNum_studentsuggestion'])) {
  $pageNum_studentsuggestion = $_GET['pageNum_studentsuggestion'];
}
$startRow_studentsuggestion = $pageNum_studentsuggestion * $maxRows_studentsuggestion;

$colname_studentsuggestion = "1";
if (isset($_COOKIE['RegNo'])) {
  $colname_studentsuggestion = (get_magic_quotes_gpc()) ? $_COOKIE['RegNo'] : addslashes($_COOKIE['RegNo']);
}
mysql_select_db($database_cha, $cha);
$query_studentsuggestion = "SELECT received, fromid, toid, message FROM suggestion WHERE toid = '$RegNo' ORDER BY received DESC";
$query_limit_studentsuggestion = sprintf("%s LIMIT %d, %d", $query_studentsuggestion, $startRow_studentsuggestion, $maxRows_studentsuggestion);
$studentsuggestion = mysql_query($query_limit_studentsuggestion, $cha) or die(mysql_error());
$row_studentsuggestion = mysql_fetch_assoc($studentsuggestion);

if (isset($_GET['totalRows_studentsuggestion'])) {
  $totalRows_studentsuggestion = $_GET['totalRows_studentsuggestion'];
} else {
  $all_studentsuggestion = mysql_query($query_studentsuggestion);
  $totalRows_studentsuggestion = mysql_num_rows($all_studentsuggestion);
}
$totalPages_studentsuggestion = ceil($totalRows_studentsuggestion/$maxRows_studentsuggestion)-1;

$queryString_studentsuggestion = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_studentsuggestion") == false && 
        stristr($param, "totalRows_studentsuggestion") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_studentsuggestion = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_studentsuggestion = sprintf("&totalRows_studentsuggestion=%d%s", $totalRows_studentsuggestion, $queryString_studentsuggestion);

if($totalRows_studentsuggestion>0){
?>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
Your Messages: <span class="style64 style1">...............</span><?php  print "<a href=\"/?page=CheckInbox&section=Communication\">Reply Message</a>"?> 
<table width="721" border="1" cellpadding="0" cellspacing="0">
            <?php do { ?>
            <tr>
                <td width="61"><div align="right">Date:</div></td>
                <td width="703"><?php echo $row_studentsuggestion['received']; ?></td>
            </tr>
            <tr>
                <td><div align="right">From:</div></td>
                <td><?php echo $row_studentsuggestion['fromid']; ?></td>
            </tr>
            <tr>
                <td valign="top"><div align="right">Message:</div></td>
                <td><?php echo $row_studentsuggestion['message']; ?></td>
            </tr>
            <?php } while ($row_studentsuggestion = mysql_fetch_assoc($studentsuggestion)); ?>
</table>
		    <p><a href="<?php printf("%s?pageNum_studentsuggestion=%d%s", $currentPage, max(0, $pageNum_studentsuggestion - 1), $queryString_studentsuggestion); ?>">Previous</a> Message: <?php echo min($startRow_studentsuggestion + $maxRows_studentsuggestion, $totalRows_studentsuggestion) ?> of <?php echo $totalRows_studentsuggestion ?> <span class="style64">...</span><a href="<?php printf("%s?pageNum_studentsuggestion=%d%s", $currentPage, min($totalPages_studentsuggestion, $pageNum_studentsuggestion + 1), $queryString_studentsuggestion); ?>">Next</a> </p>
<?php
}else{
echo " Dear, $chauser, You have no Message!";
}


?>

</div>
			</div>
	</div>
</div>
</div>