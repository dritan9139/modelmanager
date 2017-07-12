<?php
ob_start("ob_gzhandler");
require_once(dirname(__FILE__)."/conf/always.inc.php");
if( !empty($_GET['func']) ) 
{
	$strModuleName = basename($_GET['func'], '.php');
	$strModuleNameAlternative = $strModuleName;

	/** if the second paramter is not an integer **/
	if(!empty($_GET['subfunc']) && !is_numeric($_GET['subfunc'])) 
	{
		$strModuleName.= '-'.basename($_GET['subfunc']);
	}
	$strModulePath = dirname(__FILE__)."/modules/".$strModuleName.".php";
	$strModulePathAlternative = dirname(__FILE__)."/modules/".$strModuleNameAlternative.".php";

	
	if( !file_exists($strModulePath) ) 
	{
		$strModuleName = $strModuleNameAlternative;
		$strModulePath = $strModulePathAlternative;
	}
	if( file_exists($strModulePath) ) 
	{
		require($strModulePath);
	} 
	else 
	{
		/** *** when giving an illegal module name *** **/
		$strModulePath = dirname(__FILE__)."/modules/index.php";
		require($strModulePath);
	}
}
else 
{
	$strModulePath = dirname(__FILE__)."/modules/index.php";
	require($strModulePath);
}
ob_end_flush();