<?php
if (isset($_COOKIE['PHPSESSID']))
{
    session_id($_COOKIE['PHPSESSID']); 
}
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION) || !is_array($_SESSION) || (count($_SESSION, COUNT_RECURSIVE) < 10)) {
    session_id('pistardashsess');
    session_start();
    
    include_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';          // MMDVMDash Config
    include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/tools.php';        // MMDVMDash Tools
    include_once $_SERVER['DOCUMENT_ROOT'].'/mmdvmhost/functions.php';    // MMDVMDash Functions
    include_once $_SERVER['DOCUMENT_ROOT'].'/config/language.php';        // Translation Code
    checkSessionValidity();
}

// Load the language support
require_once('../config/language.php');
require_once('../config/version.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" lang="en">
    <head>
	<meta name="robots" content="index" />
	<meta name="robots" content="follow" />
	<meta name="language" content="English" />
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="Author" content="Andrew Taylor (MW0MWZ), Daniel Caujolle-Bet (F1RMB)" />
	<meta name="Description" content="Pi-Star Expert Editor" />
	<meta name="KeyWords" content="MMDVMHost,ircDDBGateway,D-Star,ircDDB,DMRGateway,DMR,YSFGateway,YSF,C4FM,NXDNGateway,NXDN,P25Gateway,P25,Pi-Star,DL5DI,DG9VH,MW0MWZ,F1RMB" />
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="pragma" content="no-cache" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<meta http-equiv="Expires" content="0" />
	<title>Pi-Star - Digital Voice Dashboard - Expert Editor</title>
	<link rel="stylesheet" type="text/css" href="/css/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/pistar-css.php" />
    </head>
    <body>
	<div class="container">
	    <?php include './header-menu.inc'; ?>
	    <div class="contentwide">
		<?php
		if(isset($_POST['data'])) {
		    // File Wrangling
		    exec('sudo cp /etc/crontab /tmp/a8h4d8n3c83h4.tmp');
		    exec('sudo chown www-data:www-data /tmp/a8h4d8n3c83h4.tmp');
		    exec('sudo chmod 664 /tmp/a8h4d8n3c83h4.tmp');
		    
		    // Open the file and write the data
		    $filepath = '/tmp/a8h4d8n3c83h4.tmp';
		    $fh = fopen($filepath, 'w');
		    fwrite($fh, str_replace("\r", "", $_POST['data']));
		    fclose($fh);
		    exec('sudo mount -o remount,rw /');
		    exec('sudo cp /tmp/a8h4d8n3c83h4.tmp /etc/crontab');
		    exec('sudo chmod 644 /etc/crontab');
		    exec('sudo chown root:root /etc/crontab');
		    exec('sudo mount -o remount,ro /');
		    
		    // Re-open the file and read it
		    $fh = fopen($filepath, 'r');
		    $theData = fread($fh, filesize($filepath));
		    
		}
		else {
		    // File Wrangling
		    exec('sudo cp /etc/crontab /tmp/a8h4d8n3c83h4.tmp');
		    exec('sudo chown www-data:www-data /tmp/a8h4d8n3c83h4.tmp');
		    exec('sudo chmod 664 /tmp/a8h4d8n3c83h4.tmp');
		    
		    // Open the file and read it
		    $filepath = '/tmp/a8h4d8n3c83h4.tmp';
		    $fh = fopen($filepath, 'r');
		    $theData = fread($fh, filesize($filepath));
		}
		fclose($fh);
		
		?>
		<form name="test" method="post" action="">
		    <textarea name="data" cols="80" rows="45"><?php echo $theData; ?></textarea><br />
		    <input type="submit" name="submit" value="<?php echo $lang['apply']; ?>" />
		</form>
		
	    </div>
	    
	    <div class="footer">
		Pi-Star web config, &copy; Andy Taylor (MW0MWZ) 2014-<?php echo date("Y"); ?>.<br />
		&copy; Daniel Caujolle-Bert (F1RMB) 2017-<?php echo date("Y"); ?>.<br />
		Need help? Click <a style="color: #ffffff;" href="https://www.facebook.com/groups/pistarusergroup/" target="_new">here for the Support Group</a><br />
		or Click <a style="color: #ffffff;" href="https://forum.pistar.uk/" target="_new">here to join the Support Forum</a><br />
	    </div>
	    
	</div>
    </body>
</html>
