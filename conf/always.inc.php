<?php
if(DIRECTORY_SEPARATOR == '\\') 
{
	$GLOBALS['LIVESYSTEM'] = false;
} 
else 
{
	$GLOBALS['LIVESYSTEM'] = true;	
}

date_default_timezone_set("Europe/Berlin");
setlocale(LC_TIME, "de_DE.UTF-8");

/**
 * change include pathes
 */
$strInludePath = ini_get('include_path') . 
					PATH_SEPARATOR .
					dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR .'classes' .
					PATH_SEPARATOR.
					dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR .'conf' . 
					PATH_SEPARATOR .
					dirname(__FILE__). DIRECTORY_SEPARATOR . '..'. DIRECTORY_SEPARATOR .'EbatNs';
ini_set('include_path', $strInludePath);
		
if( $GLOBALS['LIVESYSTEM'] ) 
{
 	ini_set('error_reporting', E_ALL ^ E_NOTICE);
 	ini_set('display_errors', '0');
// 	ini_set('error_reporting', E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
// 	ini_set('display_errors', '1');
		
	ini_set('log_errors', 'On');
	ini_set('error_log', dirname(__FILE__).'/../logs/error.log');
	set_time_limit(0);
	
	$GLOBALS['HOST']                = 'http://' . $_SERVER['HTTP_HOST'] . '/';

	$GLOBALS['MAILSTOCUSTOMER']	= true;
	require_once("database_live.php");
	

			
	$GLOBALS['MAILTEST_PFAD']       	= dirname(__FILE__).'/../temp/';
	$GLOBALS['TEMP_PFAD']       		= dirname(__FILE__).'/../temp/';
	$GLOBALS['MAILTPL_PFAD']        	= dirname(__FILE__).'/../templates/mails/';
	$GLOBALS['TPL_PFAD']        		= dirname(__FILE__).'/../templates/';
	$GLOBALS['LOG_PFAD']        		= dirname(__FILE__).'/../logs/';
	$GLOBALS['SYSTEM_PFAD']        		= dirname(__FILE__).'/../';

	
	$GLOBALS['EBAY_DISABLE_PUSHFUNCS'] = false;
	$GLOBALS['EBAY_IMPORT_HOURS_DEFAULT'] = 6;
	$GLOBALS['AMAZON_IMPORT_HOURS_DEFAULT'] = 120;		
} 
else 
{
    ini_set('error_reporting', E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
    ini_set('display_errors', '1');
    set_time_limit(0);
    
    $GLOBALS['HOST']                = 'http://foto.dritan.de/';
    $GLOBALS['HOSTRE']              = 'http://rechnung.dritan.de/';
    $GLOBALS['HOSTLS']              = 'http://lieferschein.dritan.de/';    
    $GLOBALS['MAILSTOCUSTOMER']	= false;	
    require_once("database_localhost.php");
    
    $GLOBALS['POLLING_PFAD_DHL']		= dirname(__FILE__).'\..\..\polling\dhl\\';
    $GLOBALS['POLLING_PFAD_DPD']		= dirname(__FILE__).'\..\..\polling\dpd\\';
    $GLOBALS['POLLING_PFAD_DPDKP']		= dirname(__FILE__).'\..\..\polling\dpd\\';
    $GLOBALS['POLLING_PFAD_BACKUP']		= dirname(__FILE__).'\..\..\polling\backup\\';
    $GLOBALS['POLLINGRES_PFAD_DHL']		= dirname(__FILE__).'\..\..\polling\dhl_done\\';
    $GLOBALS['POLLINGRES_PFAD_DPD']		= dirname(__FILE__).'\..\..\polling\dpd_done\\';
    $GLOBALS['POLLINGRES_PFAD_DPDKP']	= dirname(__FILE__).'\..\..\polling\dpd_done\\';
    $GLOBALS['POLLINGBACKUP_PFAD_DHL']	= dirname(__FILE__).'\..\..\polling\dhl_backup\\';
    $GLOBALS['POLLINGBACKUP_PFAD_DPD']	= dirname(__FILE__).'\..\..\polling\dpd_backup\\';
    $GLOBALS['POLLINGBACKUP_PFAD_DPDKP']= dirname(__FILE__).'\..\..\polling\dpd_backup\\';
                
    $GLOBALS['MAILTEST_PFAD']       = dirname(__FILE__).'\..\temp\\';
    $GLOBALS['TEMP_PFAD']       	= dirname(__FILE__).'\..\temp\\';
    $GLOBALS['POLLING_BACKUP_PFAD']	= dirname(__FILE__).'\..\temp\\';
    $GLOBALS['MAILTPL_PFAD']        = dirname(__FILE__).'\..\templates\mails\\';
    $GLOBALS['TPL_PFAD']        	= dirname(__FILE__).'\..\templates\\';    
    $GLOBALS['LOG_PFAD']        	= dirname(__FILE__).'\..\logs\\';    
    $GLOBALS['SYSTEM_PFAD']        	= dirname(__FILE__).'\..\\';    
    $GLOBALS['RECHNUNGEN_PFAD']     = dirname(__FILE__).'\..\..\rechnung\\';
    $GLOBALS['LIEFERSCHEIN_PFAD']   = dirname(__FILE__).'\..\..\lieferschein\\';


    $GLOBALS['EBAY_DISABLE_PUSHFUNCS'] = false;    
    $GLOBALS['EBAY_IMPORT_HOURS_DEFAULT'] = 6;
    $GLOBALS['AMAZON_IMPORT_HOURS_DEFAULT'] = 120;

    /**
     * get2post (helper for debugging ajax functions with eclipse)
     */
  
	foreach( $_GET as $index => $value )
	{
		$_POST[$index] = 	$value;
	}
	$GLOBALS['DEBUGPOLLING'] = true;
}	



$log_file = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'error.log';
ini_set('log_errors', 'On');
ini_set('error_log', $log_file);

$GLOBALS['CSS']		= $GLOBALS['HOST'].'css/';
$GLOBALS['CSSRE']	= $GLOBALS['HOSTRE'].'css/';
$GLOBALS['JS']		= $GLOBALS['HOST'].'js/';
$GLOBALS['IMG']		= $GLOBALS['HOST'].'images/';
$GLOBALS['IMG']		= $GLOBALS['HOST'];
$GLOBALS['AJAX'] 	= $GLOBALS['HOST'].'ajax/';

/**
 * MAILSERVER CONFIG FOR SENDING EMAILS
 */
$GLOBALS['MAIL_SENDER_EMAIL']	= 'info@test.info';
$GLOBALS['MAIL_SENDER_NAME']	= 'www.test.de Nachricht';
$GLOBALS['EMAIL_IMPORT_DATEN']	= array('host' => 'pop.1und1.de',
										'port' => 110,
										'user' => 'test@htest.al',
										'pass' => 'fdsf');
$GLOBALS['NACHNAHME_POSTGEBUEHR']   = 2.00;
$GLOBALS['NACHNAHME_AUFSCHLAG']     = 5.00;



header('Content-Type: text/html; charset=utf-8');
session_start();



require_once("DbTable.class.php");
require_once("Tomekuser.class.php");
require_once("Modele.class.php");



