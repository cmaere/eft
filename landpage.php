<?php 
//this code uses a PEAR module called  HTML_Template_IT used to centralize and reuse html templates as Modular templates
// Developer
//charlie maere
// july 2014

	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
	  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}
	// set template directory
	$template = new HTML_Template_IT("./include/templates");
	// load template
	$template->loadTemplateFile("main.tpl");
	// parse header block
	$template->setCurrentBlock("header");
	$template->setVariable("TITLE", "EFT");
	if($page=="Register")
	{
		$template->setVariable("URL", "./");
		$template->setVariable("LINK-TITLE", "LogIn");
		$template->parseCurrentBlock();
		$template->show();
		// load template
		$template->loadTemplateFile("register.tpl");
		$template->setCurrentBlock("register");
		$template->setVariable("TITLE", "Register Now");
		$template->parseCurrentBlock();
		$template->show();
	}
	else
	{
		$template->setVariable("URL", "./?page=Register");
		$template->setVariable("LINK-TITLE", "New User");
		$template->parseCurrentBlock();
		$template->show();
		// load template
		$template->loadTemplateFile("login.tpl");
		$template->setCurrentBlock("login");
		$template->setVariable("TITLE", "LogIn");
		$template->parseCurrentBlock();
		$template->show();	
	}
	$template->loadTemplateFile("main_footer.tpl");
	$template->setCurrentBlock("footer");
	$template->setVariable("FOOTER_TITTLE", "2016 EFT SMS");
	$template->parseCurrentBlock();
	$template->show();
	
?>

