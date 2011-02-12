<?php 
/**
 * @todo cleanup
 */
$form_body = "";

foreach (array('wwwroot', 'path', 'dataroot', 'view') as $field) {
	$form_body .= "<div>";
	$form_body .= elgg_echo('installation:' . $field) . "<br />";
	$warning = elgg_echo('installation:warning:' . $field);
	if ($warning != 'installation:warning:' . $field) {
		echo "<b>" . $warning . "</b><br />";
	}
	$value = elgg_get_config($field);
	$form_body .= elgg_view("input/text",array('internalname' => $field, 'value' => $value));
	$form_body .= "</div>";
}

$form_body .= "<div>" . elgg_echo('admin:site:access:warning') . "<br />";
$form_body .= elgg_echo('installation:sitepermissions');
$form_body .= elgg_view('input/access', array(
	'internalname' => 'default_access',
	'value' => elgg_get_config('default_access'),
)) . "</div>";
$form_body .= "<div>" . elgg_echo('installation:allow_user_default_access:description') . "<br />";
$form_body .= elgg_view("input/checkboxes", array(
	'options' => array(elgg_echo('installation:allow_user_default_access:label')),
	'internalname' => 'allow_user_default_access',
	'value' => (elgg_get_config('allow_user_default_access') ? elgg_echo('installation:allow_user_default_access:label') : ""),
)) . "</div>";
$form_body .= "<div>" . elgg_echo('installation:simplecache:description') . "<br />";
$form_body .= elgg_view("input/checkboxes", array(
	'options' => array(elgg_echo('installation:simplecache:label')),
	'internalname' => 'simplecache_enabled',
	'value' => (elgg_get_config('simplecache_enabled') ? elgg_echo('installation:simplecache:label') : ""),
)) . "</div>";
$form_body .= "<div>" . elgg_echo('installation:viewpathcache:description') . "<br />";
$form_body .= elgg_view("input/checkboxes", array(
	'options' => array(elgg_echo('installation:viewpathcache:label')),
	'internalname' => 'viewpath_cache_enabled',
	'value' => (elgg_get_config('viewpath_cache_enabled') ? elgg_echo('installation:viewpathcache:label') : ""),
)) . "</div>";

$debug_options = array('0' => elgg_echo('installation:debug:none'), 'ERROR' => elgg_echo('installation:debug:error'), 'WARNING' => elgg_echo('installation:debug:warning'), 'NOTICE' => elgg_echo('installation:debug:notice'));
$form_body .= "<div>" . elgg_echo('installation:debug');
$form_body .= elgg_view('input/dropdown', array(
	'options_values' => $debug_options,
	'internalname' => 'debug',
	'value' => elgg_get_config('debug'),
));
$form_body .= '</div>';

// control new user registration
$options = array(
	'options' => array(elgg_echo('installation:registration:label')),
	'internalname' => 'allow_registration',
	'value' => elgg_get_config('allow_registration') ? elgg_echo('installation:registration:label') : '',
);
$form_body .= '<div>' . elgg_echo('installation:registration:description');
$form_body .= '<br />' .elgg_view('input/checkboxes', $options) . '</div>';

// control walled garden
$walled_garden = elgg_get_config(walled_garden);
$options = array(
	'options' => array(elgg_echo('installation:walled_garden:label')),
	'internalname' => 'walled_garden',
	'value' => $walled_garden ? elgg_echo('installation:walled_garden:label') : '',
);
$form_body .= '<div>' . elgg_echo('installation:walled_garden:description');
$form_body .= '<br />' . elgg_view('input/checkboxes', $options) . '</div>';

$form_body .= "<div>" . elgg_echo('installation:httpslogin') . "<br />";
$form_body .= elgg_view("input/checkboxes", array(
	'options' => array(elgg_echo('installation:httpslogin:label')),
	'internalname' => 'https_login',
	'value' => (elgg_get_config('https_login') ? elgg_echo('installation:httpslogin:label') : "")
)) . "</div>";

$form_body .= "<div>" . elgg_echo('installation:disableapi') . "<br />";
$on = elgg_echo('installation:disableapi:label');
$disable_api = elgg_get_config('disable_api');
if ($disable_api) {
	$on = (disable_api ?  "" : elgg_echo('installation:disableapi:label'));
}
$form_body .= elgg_view("input/checkboxes", array(
	'options' => array(elgg_echo('installation:disableapi:label')),
	'internalname' => 'api',
	'value' => $on,
));
$form_body .= "</div>";

$form_body .= elgg_view('input/hidden', array('internalname' => 'settings', 'value' => 'go'));

$form_body .= '<div class="bta">';
$form_body .= elgg_view('input/submit', array('value' => elgg_echo("save")));
$form_body .= '</div>';

echo $form_body;