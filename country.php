<?php

function CID_get_country($ip) {
	require_once(dirname(__FILE__).'/ip2c/ip2c.php');
	if (isset($GLOBALS['ip2c'])) {
		global $ip2c;
	} else {
		$ip2c = new ip2country(dirname(__FILE__).'/ip2c/ip-to-country.bin');
		$GLOBALS['ip2c'] = $ip2c;
	}
	return $ip2c->get_country($ip);
}

function CID_get_flag($ip) {
	$country = CID_get_country($ip);
	if (!$country) return "";
	
	$code = strtolower($country['id2']);
	$name = $country['name'];
	
	global $CID_options;
	
	$output = stripslashes($CID_options['flag_template']);
	
	if (!$output) return "";
	
	$output = str_replace("%COUNTRY_CODE%", $code, $output);
	$output = str_replace("%COUNTRY_NAME%", $name, $output);
	$output = str_replace("%COMMENTER_IP%", $ip, $output);
	$output = str_replace("%IMAGE_BASE%", $CID_options['flag_icons_url'], $output);
	
	return $output;
}

function CID_get_flag_without_template($ip, $show_image = true, $show_text = true, $before = '', $after = '') {
	$country = CID_get_country($ip);
	if (!$country) return "";
	
	$code = strtolower($country['id2']);
	$name = $country['name'];
	
	global $CID_options;
	
	$output = '';
	
	if ($show_image)
		$output = '<img src="' . $CID_options['flag_icons_url'] . '/' . $code . '.png" title="' . $name . '" alt="' . $name . '" class="country-flag" />';
	if ($show_text)
		$output .= ' ' . $name;
	
	return $before . $output . $after;
}

function CID_get_comment_flag() {
	$ip = get_comment_author_IP();
	return CID_get_flag($ip);
}

function CID_get_comment_flag_without_template() {
	$ip = get_comment_author_IP();
	return CID_get_flag_without_template($ip);
}

function CID_print_comment_flag() {
	echo CID_get_comment_flag();
}
	
?>
