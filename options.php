<?php

$mode = trim($_GET['mode']);

$CID_settings = array('CID_options');

if (!empty($_POST['Submit'])) {
	$CID_options = array();
	$CID_options['flag_icons_url'] = trim($_POST['flag_icons_url']);
	$CID_options['flag_template'] = trim($_POST['flag_template']);
	
	$CID_options['WB_OS_icons_url'] = trim($_POST['WB_OS_icons_url']);
	$CID_options['WB_OS_template'] = trim($_POST['WB_OS_template']);
	
	$CID_options['auto_display_flag'] = intval($_POST['auto_display_flag']);
	$CID_options['auto_display_WB_OS'] = intval($_POST['auto_display_WB_OS']);
	
	$update_queries = array();
	$update_queries[] = update_option('CID_options', $CID_options);
	
	$update_text = array();
	$update_text[] = __('Show-UserAgent Options', 'show-useragent');
	
	$i=0;
	$text = '';
	foreach ($update_queries as $update_query) {
		if ($update_query) {
			$text .= '<font color="green">'.$update_text[$i].' '.__('Updated', 'show-useragent').'</font><br />';
		}
		$i++;
	}
	if (empty($text)) {
		$text = '<font color="red">'.__('No Option Updated', 'show-useragent').'</font>';
	}
}

if(!empty($_POST['do'])) {
	switch($_POST['do']) {		
	                      	case __('UNINSTALL', 'show-useragent') :
	                      		if(trim($_POST['uninstall_cid_yes']) == 'yes') {
	                      			echo '<div id="message" class="updated fade">';
	                      			echo '<p>';
	                      			foreach($CID_settings as $setting) {
	                      				$delete_setting = delete_option($setting);
	                      				if($delete_setting) {
	                      					echo '<font color="green">';
	                      					printf(__('Setting key \'%s\' has been deleted.', 'show-useragent'), "<strong><em>{$setting}</em></strong>");
	                      					echo '</font><br />';
	                      				} else {
	                      					echo '<font color="red">';
	                      					printf(__('Cannot delete setting key \'%s\'.', 'show-useragent'), "<strong><em>{$setting}</em></strong>");
	                      					echo '</font><br />';
	                      				}
	                      			}
	                      			echo '</p>';
	                      			echo '</div>'; 
	                      			$mode = 'end-UNINSTALL';
	                      		}
	                      		break;
	}
}

switch($mode) {
	case 'end-UNINSTALL':
		$deactivate_url = 'plugins.php?action=deactivate&amp;plugin=show-useragent/show-useragent.php';
		if(function_exists('wp_nonce_url')) { 
			$deactivate_url = wp_nonce_url($deactivate_url, 'deactivate-plugin_show-useragent/show-useragent.php');
		}
		echo '<div class="wrap">';
		echo '<h2>'.__('Uninstall Show-UserAgent', 'show-useragent').'</h2>';
		echo '<p><strong>'.sprintf(__('<a href="%s">Click here</a> to finish the uninstallation and Show-Useragent will be deactivated automatically.', 'show-useragent'), $deactivate_url).'</strong></p>';
		echo '</div>';
		break;
		
	default:
	$CID_options = get_option('CID_options');
?>
<script type="text/javascript">
	/* <![CDATA[*/
	function CID_default_templates(template) {
		var default_template;
		switch(template) {
			case 'flag_icons_url':
				default_template = "<?php echo WP_PLUGIN_URL . "/show-useragent/flags"; ?>";
				break;
			case 'flag_template':
				default_template = '<span class="country-flag"><img src="%IMAGE_BASE%/%COUNTRY_CODE%.png" title="%COUNTRY_NAME%" alt="%COUNTRY_NAME%" /> %COUNTRY_NAME%</span> ';
				break;
			case 'WB_OS_icons_url':
				default_template = "<?php echo WP_PLUGIN_URL . "/show-useragent/browsers"; ?>";
				break;
			case 'WB_OS_template':
				default_template = '<span class="WB-OS"><img src="%IMAGE_BASE%/%BROWSER_CODE%.png" title="%BROWSER_NAME%" alt="%BROWSER_NAME%" /> %BROWSER_NAME% %BROWSER_VERSION% <img src="%IMAGE_BASE%/%OS_CODE%.png" title="%OS_NAME%" alt="%OS_NAME%" /> %OS_NAME% %OS_VERSION%</span>';
				break;				
		}
		document.getElementById(template).value = default_template;
	}
	/* ]]> */
</script>
<?php if (!empty($text)) { echo '<div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
<div class="wrap"> 
	<h2><?php _e('Show-UserAgent Options', 'show-useragent'); ?></h2>
	<table class="form-table">
		<tr>
			<td valign="top">
				<strong><?php _e('Country Flag Icons Base URL:', 'show-useragent'); ?></strong><br /><br />
				<input type="button" name="RestoreDefault" value="<?php _e('Restore Default URL', 'show-useragent'); ?>" onclick="CID_default_templates('flag_icons_url');" class="button" />
			</td>
			<td valign="top">
				<input type="text" id="flag_icons_url" name="flag_icons_url" size="90" value="<?php echo htmlspecialchars(stripslashes($CID_options['flag_icons_url'])); ?>" />
			</td>
		</tr>
		
		<tr>
			<td valign="top">
				<strong><?php _e('Country Flag Template:', 'show-useragent'); ?></strong><br /><br />
				<?php _e('Allowed Variables:', 'show-useragent'); ?><br />
				- %COUNTRY_CODE%<br />
				- %COUNTRY_NAME%<br />
				- %IMAGE_BASE%<br />
				- %COMMENTER_IP%<br />
				<br />
				<input type="button" name="RestoreDefault" value="<?php _e('Restore Default Template', 'show-useragent'); ?>" onclick="CID_default_templates('flag_template');" class="button" />
			</td>
			<td valign="top">
				<textarea cols="87" rows="10"  id="flag_template" name="flag_template"><?php echo htmlspecialchars(stripslashes($CID_options['flag_template'])); ?></textarea>
			</td>
		</tr>

		<tr>
			<td valign="top">
				<strong><?php _e('Web Browser and OS Icons Base URL:', 'show-useragent'); ?></strong><br /><br />
				<input type="button" name="RestoreDefault" value="<?php _e('Restore Default URL', 'show-useragent'); ?>" onclick="CID_default_templates('WB_OS_icons_url');" class="button" />
			</td>
			<td valign="top">
				<input type="text" id="WB_OS_icons_url" name="WB_OS_icons_url" size="90" value="<?php echo htmlspecialchars(stripslashes($CID_options['WB_OS_icons_url'])); ?>" />
			</td>
		</tr>
		
		<tr>
			<td valign="top">
				<strong><?php _e('Web Browser and OS Template:', 'show-useragent'); ?></strong><br /><br />
				<?php _e('Allowed Variables:', 'show-useragent'); ?><br />
				- [BROWSER] - [/BROWSER]<br />
				- %BROWSER_NAME%<br />
				- %BROWSER_CODE%<br />
				- %BROWSER_VERSION%<br />
				- [OS] - [/OS]<br />
				- %OS_NAME%<br />
				- %OS_CODE%<br />
				- %OS_VERSION%<br />
				- %IMAGE_BASE%<br />
				<br />
				<input type="button" name="RestoreDefault" value="<?php _e('Restore Default Template', 'show-useragent'); ?>" onclick="CID_default_templates('WB_OS_template');" class="button" />
			</td>
			<td valign="top">
				<textarea cols="87" rows="10"  id="WB_OS_template" name="WB_OS_template"><?php echo htmlspecialchars(stripslashes($CID_options['WB_OS_template'])); ?></textarea>
			</td>
		</tr>
		<tr>
			<td valign="top" width="30%"><strong><?php _e('Display Country Flags Automatically:', 'show-useragent'); ?></strong></td>
			<td valign="top">
				<select name="auto_display_flag" size="1">
					<option value="0"<?php selected('0', $CID_options['auto_display_flag']); ?>><?php _e('No', 'show-useragent'); ?></option>
					<option value="1"<?php selected('1', $CID_options['auto_display_flag']); ?>><?php _e('Yes', 'show-useragent'); ?></option>
					<option value="2"<?php selected('2', $CID_options['auto_display_flag']); ?>><?php _e('Yes but don\'t display in WP-Admin', 'show-useragent'); ?></option>
				</select>
				<br /><?php _e('Use this option if you don\'t want to modify your theme code', 'show-useragent'); ?>
			</td>
		</tr>
		<tr>
		     	<td valign="top" width="30%"><strong><?php _e('Display Web Browsers and OS Automatically:', 'show-useragent'); ?></strong></td>
		     	<td valign="top">
		     		<select name="auto_display_WB_OS" size="1">
		     			<option value="0"<?php selected('0', $CID_options['auto_display_WB_OS']); ?>><?php _e('No', 'show-useragent'); ?></option>
		     			<option value="1"<?php selected('1', $CID_options['auto_display_WB_OS']); ?>><?php _e('Yes', 'show-useragent'); ?></option>
		     			<option value="2"<?php selected('2', $CID_options['auto_display_WB_OS']); ?>><?php _e('Yes but don\'t display in WP-Admin', 'show-useragent'); ?></option>
		     		</select>
		     		<br /><?php _e('Use this option if you don\'t want to modify your theme code', 'show-useragent'); ?>
		     	</td>
		</tr>		
	</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button" value="<?php _e('Save Changes', 'show-useragent'); ?>" />
	</p>
</div>
</form>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
<div class="wrap"> 
	<h2><?php _e('Uninstall Show-UserAgent', 'show-useragent'); ?></h2>
	<p>
		<input type="checkbox" name="uninstall_cid_yes" value="yes" />&nbsp;<?php _e('Yes', 'show-useragent'); ?><br /><br />
		<input type="submit" name="do" value="<?php _e('UNINSTALL', 'show-useragent'); ?>" class="button" onclick="return confirm('<?php _e('Are you sure to uninstall this plugin?\nChoose [Cancel] to stop, [OK] to uninstall.', 'show-useragent'); ?>')" />
	</p>
</div> 
</form>
<div class="update-nag" id="donate">
<div style="text-align: center;">
		<span style="font-size: 20px;margin: 5px 0;display: block;"><a href="http://zlz.im/">Show UserAgent v1.0.8</a></span>
		<br />
		Created, Developed and maintained by <a target="_blank" href="http://zlz.im/">hzlzh</a><br>If you like the <code>Show UserAgent</code> plugin, please donate. It will help in developing new features and versions.
		<br />
		Any feedback or bugs you find please add it -> <a target="_blank" href="https://github.com/hzlzh/Show-Useragent/issues">Github</a>
		<table style="margin:0 auto;">
			<tbody><tr>
				<td style="width:200px;">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
					<input type="hidden" name="cmd" value="_donations">
					<input type="hidden" name="business" value="hzlzh.dev@gmail.com">
					<input type="hidden" name="lc" value="US">
					<input type="hidden" name="item_name" value="hzlzh's WordPress Dev">
					<input type="hidden" name="item_number" value="thanks 03">
					<input type="hidden" name="no_note" value="0">
					<input type="hidden" name="currency_code" value="USD">
					<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
					<img alt="" border="0" src="https://www.paypalobjects.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
					</form>
				</td>
			</tr>
			</tbody>
		</table>
		<div style="color:#777"><strong>Alipay:</strong> hzlzh.dev@gmail.com</div>
	</div>
</div>
<?php } ?>