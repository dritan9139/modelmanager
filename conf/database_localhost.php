<?php
$strDbServ = 'localhost';
$strDbUser = 'root';
$strDbPass = ''; 
$strDbBase = 'waldin';
$con = mysql_connect($strDbServ, $strDbUser, $strDbPass);
if (!$con) 
{
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($strDbBase);
 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");


$strDbLocation = 'mysql:dbname='.$strDbBase.';host='.$strDbServ;
$strDbPassword = $strDbPass;
$objDb = new PDO(	$strDbLocation, 
					$strDbUser, 
					$strDbPassword, 
					array(PDO::ATTR_PERSISTENT => false, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true));
$objDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$objDb->query("SET NAMES utf8");
$GLOBALS['DB'] = $objDb;