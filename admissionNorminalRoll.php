<!DOCTYPE html 
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Creating worksheets</title>
    <style>
    body {
      font-family: Verdana;
    }
    </style>    
  </head>
  <body>
    <?php
		//die("here");
    // load Zend Gdata libraries
    require_once 'Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');

    // set credentials for ClientLogin authentication
    $user = "cmaere@kcn.unima.mw";
    $pass = "dumitembo";

    try {
      // connect to API
      $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
      $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
      $service = new Zend_Gdata_Spreadsheets($client);

      // get spreadsheet entry
	  die($ssEntry. "am there");
      $ssEntry = $service->getSpreadsheetEntry(
        'https://docs.google.com/a/kcn.unima.mw/spreadsheet/ccc?key=0AumyFvx6NCRWdHRsUTFLYnBRcThmQ0RpaGwtOU1BNUE#gid=0');
		
      // get worksheet feed for this spreadsheet
      $wsFeed = $service->getWorksheetFeed($ssEntry);
	  
	  

      // create new entry
      $wsEntry = new Zend_Gdata_Spreadsheets_WorksheetEntry();
      $title = new Zend_Gdata_App_Extension_Title('Jan 2011');
      $wsEntry->setTitle($title);
      $row = new Zend_Gdata_Spreadsheets_Extension_RowCount('10');
      $wsEntry->setRowCount($row);
      $col = new Zend_Gdata_Spreadsheets_Extension_ColCount('10');
      $wsEntry->setColumnCount($col);

      // insert entry
      $entryResult = $service->insertEntry($wsEntry, 
        $wsFeed->getLink('self')->getHref());
      echo 'The ID of the new worksheet entry is: ' . $entryResult->id;

    } catch (Exception $e) {
      die('ERROR: ' . $e->getMessage());
    }
    ?>

  </body>
<html>