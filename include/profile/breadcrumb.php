

<?php 
//breadcrumb code

if($page != "" && $section !="")
{
 		$template->setCurrentBlock("breadcrumbsection");
 		$template->setVariable("SECTION", $section);
 	 	$template->parseCurrentBlock();
		 
		 if(array_key_exists('edit', $_GET))
		 {	$link = "./?section=$section&page=$page";
		 	$template->setCurrentBlock("breadcrumbpage");
			$template->setVariable("LINK", $link);
		 	$template->setVariable("PAGE", $page);
		 	$template->parseCurrentBlock();
		 
		 	$template->setCurrentBlock("breadcrumbaction");
		 	$template->setVariable("ACTION", "Edit");
			 $template->parseCurrentBlock();
		 }
		 else if(array_key_exists('new', $_GET))
		 {
			 $link = "./?section=$section&page=$page";
			 $template->setCurrentBlock("breadcrumbpage");
			 $template->setVariable("LINK", $link);
			 $template->setVariable("PAGE", $page);
			 $template->parseCurrentBlock();
			 
			 $template->setCurrentBlock("breadcrumbaction");
			 $template->setVariable("ACTION", "New");
			 $template->parseCurrentBlock();
		 }
		 else
		 {
			 $template->setCurrentBlock("breadcrumbaction");
			 $template->setVariable("ACTION", $page);
			 $template->parseCurrentBlock();
	 	 }
	 	
		
 }
 else if(isset($section))
 {
	 
	$template->setCurrentBlock("breadcrumbsection");
	$template->setVariable("SECTION", $section);
 	$template->parseCurrentBlock();
 
 
 }