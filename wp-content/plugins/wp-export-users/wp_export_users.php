<?php
/*
Plugin Name: WP Export Users
Plugin URI: http://countingrows.com/wp-export-user/
Description: Allows for custom csv user data output.  It allows you to customize the Field Separators and Encapsulators.  It gives you a preview of your data that you can copy and paste into a text file or into any application.
Version: 1.4
Author: Matthew Price
Author URI: http://countingrows.com
License: GPL2
*/

if($_GET['action']); {

	switch ($_GET['action']) {
		
	case 'generate-custom-user-list': generate_custom_user_list(); break;

	}
}

function wp_export_users() {
	
global $wpdb;

if ($_GET['user_login'] != '') { $get_user_login = $_GET['user_login'] . ","; }
if ($_GET['disp_name'] != '') { $get_disp_name = $_GET['disp_name'] . ","; }
if ($_GET['user_email'] != '') { $get_user_email = $_GET['user_email'] . ","; }
if ($_GET['user_pass'] != '') { $get_user_pass = $_GET['user_pass'] . ","; }
if ($_GET['user_url'] != '') { $get_user_url = $_GET['user_url'] . ","; }
if ($_GET['user_role'] != '') { $get_user_role = $_GET['user_role'] . ","; }
if ($_GET['first_name'] != '') { $get_first_name = $_GET['first_name'] . ","; }
if ($_GET['last_name'] != '') { $get_last_name = $_GET['last_name'] . ","; }


$encapsulator = $_GET['encapsulator'];
$separator = $_GET['separator'];
$headers = $_GET['headers'];

$select = "ID," . $get_user_login . $get_disp_name . $get_user_email . $get_user_pass . $get_user_url;
$select = substr($select, 0, -1);
// print_r($select);

$users = $wpdb->get_results("SELECT $select FROM {$wpdb->prefix}users");

?>
<div class="wrap">
<h2>WP Export Users Settings</h2>

<div id="left">
<form action="?action=generate-custom-user-list" method="post">

<div class="options">
<label for="user_login">User Login</label>
<input type="checkbox" id="user_login" name="user_login" <?php if ($_GET['user_login'] != '') { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="user_email">First Name</label>
<input type="checkbox" id="first_name" name="first_name" <?php if ($_GET['first_name'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="user_email">Last Name</label>
<input type="checkbox" id="last_name" name="last_name" <?php if ($_GET['last_name'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="user_email">Email</label>
<input type="checkbox" id="user_email" name="user_email" <?php if ($_GET['user_email'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="user_pass">Password (Encrypted)</label>
<input type="checkbox" id="user_pass" name="user_pass" <?php if ($_GET['user_pass'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="disp_name">Display Name</label>
<input type="checkbox" id="disp_name" name="disp_name" <?php if ($_GET['disp_name'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="user_email">User Url</label>
<input type="checkbox" id="user_url" name="user_url" <?php if ($_GET['user_url'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="user_email">User Role</label>
<input type="checkbox" id="user_role" name="user_role" <?php if ($_GET['user_role'] != "") { echo 'checked="checked"'; } ?>>
</div>

<div class="options">
<label for="separator">Field Ecapsulation<br>
<span>
Please select the field separator needed for your output file. Typical separators are "comma", "semi-colon", "pipe".<br>
</span>
</label>
<select name="encapsulator">
<option value="comma" <?php if ($encapsulator == "comma") { echo 'selected="selected"'; } ?>>Comma (,)</option>
<option value="semicolon" <?php if ($encapsulator == "semicolon") { echo 'selected="selected"'; } ?>>Semi-Colon (;)</option>
<option value="pipe" <?php if ($encapsulator == "pipe") { echo 'selected="selected"'; } ?>>Pipe (|)</option>
<option value="newline" <?php if ($encapsulator == "newline") { echo 'selected="selected"'; } ?>>Line Break</option>
<option value="squote" <?php if ($encapsulator == "squote") { echo 'selected="selected"'; } ?>>Single Quote (')</option>
<option value="dquote" <?php if ($encapsulator == "dquote") { echo 'selected="selected"'; } ?>>Double Quote (")</option>
<option value="none" <?php if ($encapsulator == "none") { echo 'selected="selected"'; } ?>>None</option>
</select>
</div>

<div class="options">
<label for="separator">Field Separator<br>
<span>
Please select the record/user separator needed for your output file.<br>
</span>
</label>
<select name="separator">
<option value="comma" <?php if ($separator == "comma") { echo 'selected="selected"'; } ?>>Comma (,)</option>
<option value="semicolon" <?php if ($separator == "semicolon") { echo 'selected="selected"'; } ?>>Semi-Colon (;)</option>
<option value="pipe" <?php if ($separator == "pipe") { echo 'selected="selected"'; } ?>>Pipe (|)</option>
<option value="newline" <?php if ($separator == "newline") { echo 'selected="selected"'; } ?>>Line Break</option>
<option value="squote" <?php if ($separator == "squote") { echo 'selected="selected"'; } ?>>Single Quote (')</option>
<option value="dquote" <?php if ($separator == "dquote") { echo 'selected="selected"'; } ?>>Double Quote (")</option>
<option value="none" <?php if ($separator == "none") { echo 'selected="selected"'; } ?>>None</option>
</select>
</div>

<div class="options">
Here is an explanation of both options above...<br><br>
<span class="red">Field Separator</span><br>
<span class="blue">Field Encapsulator</span>
<br><br>
example:  <span class="blue">"</span>Field Value #1<span class="blue">"</span><span class="red">,</span><span class="blue">"</span>Field Value #2<span class="blue">"</span>
</div>

<div class="options">
<label for="headers">Do you want field headers?</label>
<input type="checkbox" id="headers" name="headers" <?php if ($_GET['headers'] != '') { echo 'checked="checked"'; } ?>
</div>

<input type="submit" value="Generate Custom List" id="sumit" name="submit">
</form>

</div>

<div id="right">

<?php if ($_GET['separator'] == '') { ?>
<h3>Full List of Emails</h3>
<div class="directions">
1) Review the records to make sure they are what you want.  If not, then revise your options.<br>
2) You can copy these records and paste into a text file and save as "my_users.csv"<br>
3) Then you can import this file into a newsletter application or where ever you need this data<br>
</div>
<textarea cols="75" rows="25">
<?php
foreach ($users as $user) {
echo $user->user_email . "\n";
	}
?>
</textarea>

<?php } else { ?>

<h3>Your Custom List</h3>
<strong>Directions</strong><br>
<div class="directions">
1) Review the records to make sure they are what you want.  If not, then revise your options.<br>
2) You can copy these records and paste into a text file and save as "my_users.csv"<br>
3) Then you can import this file into a newsletter application or where ever you need this data<br>
</div>
<br>
<textarea cols="75" rows="25">
<?php

if ($encapsulator == 'comma') { $encap = ","; } 
elseif ($encapsulator == 'semicolon') { $encap = ";"; } 
elseif ($encapsulator == 'pipe') { $encap = "|"; } 
elseif ($encapsulator == 'newline') { $encap = "\n"; } 
elseif ($encapsulator == 'squote') { $encap = "'"; } 
elseif ($encapsulator == 'dquote') { $encap = "\""; } 
elseif ($encapsulator == 'none') { $encap = ""; } 

if ($separator == 'comma') { $sep = ","; } 
elseif ($separator == 'semicolon') { $sep = ";"; } 
elseif ($separator == 'pipe') { $sep = "|"; } 
elseif ($separator == 'newline') { $sep = "\n"; } 
elseif ($separator == 'squote') { $sep = "'"; } 
elseif ($separator == 'dquote') { $sep = "\""; } 
elseif ($separator == 'none') { $sep = " "; } 

if ($_GET['headers'] != '') {

if ($_GET['user_login'] == '' ) { $ul = ''; } else { $ul = "user_login, "; }
if ($_GET['disp_name'] == '' ) { $dn = ''; } else { $dn = "disp_name, "; }
if ($_GET['user_email'] == '' ) { $em = ''; } else { $em = "user_email, "; }
if ($_GET['user_pass'] == '' ) { $up = ''; } else { $up = "user_pass, "; }
if ($_GET['user_url'] == '' ) { $uu = ''; } else { $uu = "user_url, "; }
if ($_GET['user_role'] == '' ) { $ur = ''; } else { $ur = "user_role, "; }
if ($_GET['first_name'] == '' ) { $fn = ''; } else { $fn = "first_name, "; }
if ($_GET['last_name'] == '' ) { $ln = ''; } else { $ln = "last_name, "; }

$getArray = $ul . $dn . $em . $up . $uu . $ur . $fn . $ln;
$getArray = explode(', ', $getArray);
$countArray = count($getArray);
$i = 1;

foreach ($getArray as $arr) {
	
	if ($i == $countArray) {
	echo "";
	} elseif ($i == $countArray - 1) {
	echo $encap . $arr . $encap;
	} else {
	echo $encap . $arr . $encap . $sep;
	}
	$i++;
}	

echo "\n";

}

foreach ($users as $user) {

if ($get_user_login == '' ) { $gul = ''; } else { $gul = $user->user_login .  ", "; }
if ($get_disp_name == '' ) { $gdn = ''; } else { $gdn = $user->display_name . ", "; }
if ($get_user_email == '' ) { $gem = ''; } else { $gem = $user->user_email . ", "; }
if ($get_user_pass == '' ) { $gup = ''; } else { $gup = $user->user_pass . ", "; }
if ($get_user_url == '' ) { $guu = ''; } else { $guu = $user->user_url . ", "; }

if ($get_user_role) { 
	
	$user = get_userdata( $user->ID );
	$capabilities = $user->{$wpdb->prefix . 'capabilities'};

	if ( !isset( $wp_roles ) )
		$wp_roles = new WP_Roles();

	foreach ( $wp_roles->role_names as $role => $name ) {

		if ( array_key_exists( $role, $capabilities ) )
			$roleM = $role;
	}
	
}

if ($get_user_role == '') { $gur = ''; } else { $gur = $roleM . ", "; }

$user_first_name = get_usermeta($user->ID,'first_name');
if ($get_first_name == '') { $gfn = ''; } else { $gfn = $user_first_name . ", "; }

$user_last_name = get_usermeta($user->ID,'last_name');
if ($get_last_name == '') { $gln = ''; } else { $gln = $user_last_name . ", "; }

$getArrayData = $gul . $gdn . $gem . $gup . $guu . $gur . $gfn . $gln;
$getArrayData = explode(', ', $getArrayData);
$countArrayData = count($getArrayData);
$iData = 1;

foreach ($getArrayData as $arrData) {
	
	if ($iData == $countArrayData) {
	echo "";
	} elseif ($iData == $countArrayData - 1) {
	echo $encap . $arrData . $encap;
	} else {
	echo $encap . $arrData . $encap . $sep;
	}
	$iData++;
}




echo "\n";
	}
	
?>
</textarea>

<?php } ?>

</div>

</div>
<?php
}	

function generate_custom_user_list() {

if ($_POST['user_login'] == 'on') { $user_login = "user_login"; } else { $user_login = ""; }
if ($_POST['disp_name'] == 'on') { $disp_name = "display_name"; } else { $disp_name = ""; } 
if ($_POST['user_email'] == 'on') { $user_email = "user_email"; } else { $user_email = ""; }
if ($_POST['user_pass'] == 'on') { $user_pass = "user_pass"; } else { $user_pass = ""; }
if ($_POST['user_url'] == 'on') { $user_url = "user_url"; } else { $user_url = ""; }
if ($_POST['user_role'] == 'on') { $user_role = "user_role"; } else { $user_role = ""; }
if ($_POST['first_name'] == 'on') { $first_name = "first_name"; } else { $first_name = ""; }
if ($_POST['last_name'] == 'on') { $last_name = "last_name"; } else { $last_name = ""; }

$encapsulator = $_POST['encapsulator'];
$separator = $_POST['separator'];
$headers = $_POST['headers'];

header("Location: " . $_SERVER['PHP_SELF'] . "?page=wp-export-users&user_login=".$user_login."&disp_name=".$disp_name."&user_email=".$user_email."&user_pass=".$user_pass."&user_url=".$user_url."&user_role=".$user_role."&first_name=".$first_name."&last_name=".$last_name."&encapsulator=".$encapsulator."&separator=".$separator."&headers=".$headers);

}
	
function wp_export_users_add_to_users_menu() {
add_users_page(__('WP Export Users','wp export users'), __('WP Export Users','wp export users'), 'manage_options', 'wp-export-users', 'wp_export_users', '', '');
}

function wp_export_users_styles() {
?>
<style type="text/css">
.options {width: 300px; padding: 5px; background: #EFEFEF; color: #333333; margin: 5px; border: 1px solid #cccccc;}
.options label {float: left; width: 285px;}
.options label span {font-size: 12px; color: #666666; width: 200px;}
#left {float: left;}
#right {float: left;}
.red {color: #FF0000; font-weight: bold;}
.blue {color: #0048ff; font-weight: bold;}
.directions {width: 375px;}
</style>
<?php
}

add_action( 'admin_head', 'wp_export_users_styles' );	
add_action( 'admin_menu', 'wp_export_users_add_to_users_menu' );
?>