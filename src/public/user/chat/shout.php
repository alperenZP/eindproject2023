<?php
/*********************************************************************************************************
 This code is part of the ShoutBox software (www.gerd-tentler.de/tools/shoutbox), copyright by
 Gerd Tentler. Obtain permission before selling this code or hosting it on a commercial website or
 redistributing it over the Internet or in any other medium. In all cases copyright must remain intact.
*********************************************************************************************************/

	error_reporting(E_WARNING);
	if(function_exists('session_start')) session_start();

//========================================================================================================
// Set variables, if they are not registered globally; needs PHP 4.1.0 or higher
//========================================================================================================

	$sbID = isset($_POST['sbID']) ? $_POST['sbID'] : '';
	$sbName = isset($_POST['sbName']) ? $_POST['sbName'] : '';
	$sbEMail = isset($_POST['sbEMail']) ? $_POST['sbEMail'] : '';
	$sbText = isset($_POST['sbText']) ? $_POST['sbText'] : '';
	$sbSpr = isset($_POST['sbSpr']) ? $_POST['sbSpr'] : '';
	$sbLobbyid = isset($_POST['sbLobbyid']) ? $_POST['sbLobbyid'] : '';

	$create = isset($_POST['create']) ? $_POST['create'] : '';
	$delete = isset($_REQUEST['delete']) ? (int) $_REQUEST['delete'] : 0;
	$admin = isset($_REQUEST['admin']) ? $_REQUEST['admin'] : '';

	$PHP_SELF = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : '';
	$HTTP_HOST = isset($_SERVER['HTTP_HOST']) ? substr($_SERVER['HTTP_HOST'], 0, 9) : '';
	$HTTP_USER_AGENT = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';

//========================================================================================================
// Includes
//========================================================================================================

	if($HTTP_HOST == 'localhost' || $HTTP_HOST == '127.0.0.1' || $HTTP_HOST == '192.168.0') {
		include('config_local.inc.php');
	}
	else {
		include('config_main.inc.php');
	}
	if(!isset($language)) $language = 'en';
	include("languages/lang_$language.inc.php");
	include('smilies.inc');
	include('funclib.inc');

//========================================================================================================
// Set session variables (admin login); needs PHP 4.1.0 or higher
//========================================================================================================

	if(!empty($admin)) $_SESSION['sb_admin'] = ($admin == $adminPass) ? $admin : '';

//========================================================================================================
// Functions
//========================================================================================================

	function is_admin() {
		global $adminPass;
		return (!empty($_SESSION['sb_admin']) && $_SESSION['sb_admin'] == $adminPass);
	}

	function read_data() {
		$data = array();
		clearstatcache();

		if(is_file('data/shoutbox.txt')) {
			$size = filesize('data/shoutbox.txt');

			if($size > 0) {
				if($fp = fopen('data/shoutbox.txt', 'r')) {					
					$data = fread($fp, $size);					
					$data = explode(chr(8) . "\r\n", $data);					
					for($i = 0; $i < count($data); $i++) {					
						$data[$i] = explode(chr(7), $data[$i]);
					}
					fclose($fp);
				}
			}
		}		
		return is_array($data) ? $data : array();
	}

	function write_data($data) {
		if($fp = fopen('data/shoutbox.txt', 'w')) {
			for($i = 0; $i < count($data); $i++) $data[$i] = implode(chr(7), $data[$i]);
			$data = implode(chr(8) . "\r\n", $data);
			fwrite($fp, $data);
			fclose($fp);
		}
	}

	function delete_entry($id) {
		global $tbl_name, $fld_id, $mysqli;

		$error = '';

		if(!empty($mysqli)) {
			if(!$mysqli->query("DELETE FROM $tbl_name WHERE $fld_id='$id'")) $error = $mysqli->error;
		}
		else {
			$data = read_data();

			if(count($data)) foreach($data as $key => $val) {
				if($val[0] == $id) {
					array_splice($data, $key, 1);
					write_data($data);
					break;
				}
			}
		}
		return $error;
	}

	function new_entry($name, $email, $text) {
		global $tbl_name, $fld_id, $fld_timestamp, $fld_name, $fld_email, $fld_lobbyid, $fld_senderid, $sbLobbyid,
			   $fld_text, $boxEntries, $reservedNames, $mysqli;

		$error = '';
		$tstamp = date('YmdHis');

		if(!is_admin() && in_array(strtolower($name), $reservedNames)) {
			$name = 'xxx';
		}

		if(!empty($mysqli)) {
			$name = $mysqli->real_escape_string($name);
			$email = $mysqli->real_escape_string($email);
			$text = $mysqli->real_escape_string($text);
			$lobbyid = $_SESSION["lobbyid"];
			$senderid = $_SESSION["user"]["id"];

			$sql = "INSERT INTO $tbl_name ($fld_timestamp, $fld_name, $fld_email, $fld_text, $fld_lobbyid, $fld_senderid) ";
			$sql .= "VALUES ('$tstamp', '$name', '$email', '$text', '$lobbyid', '$senderid')";

			if(!$mysqli->query($sql)) $error = $mysqli->error;
			else {
				$sql = "SELECT $fld_id FROM $tbl_name ORDER BY $fld_timestamp DESC LIMIT $boxEntries, 1";
				$result = $mysqli->query($sql);
				if($result->num_rows) {
					if($row = $result->fetch_row()) {
						$sql = "DELETE FROM $tbl_name WHERE $fld_id<=$row[0]";
						if(!$mysqli->query($sql)) $error = $mysqli->error;
					}
				}
			}
		}
		else {
			$data = read_data();
			$len = count($data);
			$id = $len ? $data[$len-1][0] + 1 : 1;
			if($len >= $boxEntries) array_shift($data);
			$data[] = array($id, $tstamp, $name, $email, $text);
			write_data($data);
		}
		return $error;
	}

	function read_entries() {
		global $msg, $mysqli, $tbl_name, $fld_timestamp, $messageOrder, $messageBGColors, $fld_lobbyid, $sbLobbyid,
			   $boxEntries, $boxWidth, $wordLength, $timeOffset, $reservedNames, $dateFormat;

		if(!empty($mysqli)) {
			$lobbyid = $_SESSION["lobbyid"];
			$sql = "SELECT * FROM $tbl_name WHERE $fld_lobbyid = $lobbyid ORDER BY $fld_timestamp $messageOrder LIMIT $boxEntries";
			$result = $mysqli->query($sql);
			$data = [];
			while($row = $result->fetch_row()) $data[] = $row;
		}
		else {		
			$data = read_data();
			if(strtoupper($messageOrder) != 'ASC') rsort($data);
		}

		for($i = 0; $i < count($data); $i++) {
			$id = $data[$i][0];
			$tstamp = timeStamp($data[$i][1]);			
			$name = !empty($data[$i][2]) ? format($data[$i][2], $wordLength, $boxWidth - 22, true) : '???';			
			$email = (!empty($data[$i][3]) && strstr($data[$i][3], '@')) ? $data[$i][3] : '';
			$text = format($data[$i][4], $wordLength, $boxWidth - 22, false);
			$bgcolor = (empty($bgcolor) || $bgcolor != $messageBGColors[0]) ? $messageBGColors[0] : $messageBGColors[1];

			if($dateFormat != 'Y-m-d' || (int) $timeOffset != 0) {
				$a = explode(' ', $tstamp);
				$d = explode('-', $a[0]);
				$t = explode(':', $a[1]);
				$ts = mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]);
				if((int) $timeOffset != 0) $ts += (int) $timeOffset * 3600;
				if(!$dateFormat) $dateFormat = 'Y-m-d';
				$tstamp = date($dateFormat . ' H:i:s', $ts);
			}

			if(is_admin()) {
?>
				<div class="cssShoutRaised" style="float:right" title="<?php echo $msg['delete']; ?>"
				onMouseDown="this.className='cssShoutPressed'"
				onMouseUp="this.className='cssShoutRaised'"
				onMouseOut="this.className='cssShoutRaised'"
				onClick="confirmDelete(<?php echo $id; ?>)">
				<img src="delete.gif" width="10" height="10">
				</div>
<?php
			}
			$class = in_array(strtolower($name), $reservedNames) ? 'cssShoutTextAdmin' : 'cssShoutText';
?>
			<div class="cssShoutTime" style="background-color:<?php echo $bgcolor; ?>">
			<?php echo $tstamp; ?>
			</div>
			<div class="<?php echo $class; ?>" style="background-color:<?php echo $bgcolor; ?>">
			<?php if($email) echo '<a href="mailto:' . $email . '">'; ?>

			<b><?php echo '
				<head>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
			
				<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.3/dist/full.css" rel="stylesheet" type="text/css" />
				</head>
				<div class="chat chat-start">

  				<div class="chat-header">
    				'.$name.'
  				</div>';
				?>
			</b>
			<?php if($email) echo '</a>'; ?> 
			<?php echo '
					<div class="chat-bubble">'.$text.'</div>			
					</div>
				'; 
			?>

			</div>
<?php
		}
	}

//========================================================================================================
// Main
//========================================================================================================

	$mysqli = !empty($db_name) ? dbOpen($db_server, $db_user, $db_pass, $db_name) : null;
	$error = '';
	$table_exists = true;

	if(!empty($mysqli)) {
		if(!$mysqli->query("SELECT 1 FROM $tbl_name LIMIT 1")) $table_exists = false;
	}

	header('Cache-control: private, no-cache, must-revalidate');
	header('Expires: Sat, 01 Jan 2000 00:00:00 GMT');
	header('Date: Sat, 01 Jan 2000 00:00:00 GMT');
	header('Pragma: no-cache');
?>
	<html>
	<head>
	<meta name="robots" content="noindex, nofollow">
<?php
	if($table_exists) {
?>
		<meta http-equiv="refresh" content="<?php echo $boxRefresh; ?>; URL=<?php echo basename($PHP_SELF); ?>">
<?php
	}
?>
	<title>Output</title>
<?php
	$messageOrder = strtoupper($messageOrder);
	if($messageOrder != 'ASC' && $messageOrder != 'DESC') $messageOrder = 'DESC';

	if($messageOrder == 'ASC') {
?>
		<script type="text/javascript"> <!--
		function autoscroll() {
			if(document.documentElement && document.documentElement.offsetHeight)
				window.scrollBy(0, document.documentElement.offsetHeight + 1000);
			else if(document.body && document.body.offsetHeight)
				window.scrollBy(0, document.body.offsetHeight + 1000);
			else if(window.innerHeight)
				window.scrollBy(0, window.innerHeight + 1000);
			else if(document.height)
				window.scrollBy(0, document.height + 1000);
		}
		window.onload = autoscroll;
		//--> </script>
<?php
	}

	if(is_admin()) {
?>
		<script type="text/javascript"> <!--
		function confirmDelete(id) {
			var check = confirm("<?php echo $msg['confirm']; ?>");
			if(check) document.location.href = '<?php echo $PHP_SELF; ?>?delete=' + id;
		}
		//--> </script>
<?php
	}
?>
	<link rel="stylesheet" href="shoutbox.css" type="text/css">
	</head>
	<body style="margin:2px">
<?php
	if(!empty($mysqli) && !$table_exists) {

		if($create == 'yes') {
			$sql = "CREATE TABLE $tbl_name ( " .
					"$fld_id INT(10) NOT NULL auto_increment, " .
					"$fld_timestamp VARCHAR(14) NOT NULL, " .
					"$fld_name VARCHAR(20), " .
					"$fld_email VARCHAR(75), " .
					"$fld_text TEXT NOT NULL, " .
					"PRIMARY KEY ($fld_id))";
			if(!$mysqli->query($sql)) $error = $mysqli->error;
			else $table_exists = true;
		}
		else if($create == 'no') $error = 'Operation cancelled.';
		else {
			echo '<div class="cssShoutText" style="padding:4px">';
			echo '<form name="f1" action="' . $PHP_SELF . '" method="post" style="margin:0px">';
			echo "<b>Table $tbl_name doesn't exist. Create it now?</b><br><br>";
			echo '<input type="radio" name="create" value="yes" onClick="document.f1.submit()">yes &nbsp; ';
			echo '<input type="radio" name="create" value="no" onClick="document.f1.submit()">no';
			echo '</form></div>';
		}
	}
	else {
		read_entries();
		if(!empty($admin) && $admin != $_SESSION['sb_admin']) $error = $msg['wrongPass'];
		else if(is_admin() && $delete) {
			$error = delete_entry($delete);
		}
		else if($sbText) {
			if(checkSpam($sbID, -1, $sbName, $sbEMail, '', $sbText, '', $sbSpr)) $error = $msg['noSpam'];
			else $error = new_entry($sbName, $sbEMail, $sbText);
		}

		if($error) echo '<div class="cssShoutError">' . $error . '</div>';

		
	}
?>
	</body>
	</html>
<?php
	if(!empty($mysqli)) $mysqli->close();
