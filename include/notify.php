<?php
$notify = false;
if(isset($_SESSION[$prefix.'notify_type']) && $_SESSION[$prefix.'notify_type']!=''){
	$notify_type = $_SESSION[$prefix.'notify_type'];
	$notify_text = $_SESSION[$prefix.'notify_msg'];
	$_SESSION[$prefix.'notify_type'] = '';
	$_SESSION[$prefix.'notify_msg'] = '';
	$notify = true;
}
?>

<div id="notify" class="fluid_width <?php echo $notify!=true?'hidden':''; ?>" title="Click to dismiss" onclick="dismissNotify('notify')">
	<div class="check <?php echo $notify_type ?>">
		<?php echo $notify_text ?>
	</div>
</div>