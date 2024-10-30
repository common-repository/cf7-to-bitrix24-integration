<?php

/**
 * Plugin Name:       Integration of CF7 and Bitrix24
 * Plugin URI:        https://kowalski.su/product/cf7-to-bitrix24-integration/
 * Description:       Contact Form 7 and CRM Bitrix24 integration plugin. Very flexible and easy to configure. You can create an unlimited number of forms and transfer their values to Birtix24
 * Version:           1.0.0
 * Author:            Ivan Zhukov
 * Author URI:        https://kowalski.su
 * Text Domain:       cf7-to-bitrix24-integration
 * Domain Path:       /languages/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CF7LB_BITRIX_LEAD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cf7-birtix-lead-activator.php
 */
function activate_cf7_birtix_lead() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7-birtix-lead-activator.php';
	Birtix_Lead_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cf7-birtix-lead-deactivator.php
 */
function deactivate_cf7_birtix_lead() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7-birtix-lead-deactivator.php';
	Birtix_Lead_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cf7_birtix_lead' );
register_deactivation_hook( __FILE__, 'deactivate_cf7_birtix_lead' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cf7-birtix-lead.php';
require plugin_dir_path( __FILE__ ) . 'index.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cf7_birtix_lead() {

	$plugin = new Birtix_Lead();
	$plugin->run();

}
run_cf7_birtix_lead();

add_action( 'plugins_loaded', 'CF7LB_wpcf7_lead_language' );
function CF7LB_wpcf7_lead_language() {
	load_plugin_textdomain( 'cf7-to-bitrix24-integration', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


}






add_action('admin_menu', 'CF7LB_register_submenu_page_wpcf7');
function CF7LB_register_submenu_page_wpcf7(){
	add_submenu_page(
		'wpcf7',
		__('Bitrix24 Integration', 'cf7-to-bitrix24-integration' ),
		__('Bitrix24 Integration', 'cf7-to-bitrix24-integration' ),
		'manage_options',
		'bitrix-page-wpcf7',
		'CF7LB_bitrix_page_wpcf7_callback'
	);
}

function CF7LB_bitrix_page_wpcf7_callback() {
	global $domaine_activation;

	if ( isset($_POST['submit']) )
    {
        $bitrix_lead_protocol = sanitize_text_field($_POST['bitrix_lead_protocol']);
        update_option('bitrix_lead_protocol', $bitrix_lead_protocol);
        $bitrix_lead_url = sanitize_text_field($_POST['bitrix_lead_url']);
        update_option('bitrix_lead_url', $bitrix_lead_url);
        $bitrix_lead_port = sanitize_text_field($_POST['bitrix_lead_port']);
        update_option('bitrix_lead_port', $bitrix_lead_port);
        $bitrix_lead_rest_api_path = sanitize_text_field($_POST['bitrix_lead_rest_api_path']);
        update_option('bitrix_lead_rest_api_path', $bitrix_lead_rest_api_path);
        $bitrix_lead_login_api = sanitize_text_field($_POST['bitrix_lead_login_api']);
        update_option('bitrix_lead_login_api', $bitrix_lead_login_api);
        $bitrix_lead_password_api = sanitize_text_field($_POST['bitrix_lead_password_api']);
        update_option('bitrix_lead_password_api', $bitrix_lead_password_api);

	}

			$bitrix_lead_protocol = stripcslashes(get_option('bitrix_lead_protocol'));
			$bitrix_lead_url = stripcslashes(get_option('bitrix_lead_url'));
			$bitrix_lead_port = stripcslashes(get_option('bitrix_lead_port'));
			$bitrix_lead_rest_api_path = stripcslashes(get_option('bitrix_lead_rest_api_path'));
			$bitrix_lead_login_api = get_option('bitrix_lead_login_api');
			$bitrix_lead_password_api = get_option('bitrix_lead_password_api');



			?>
<div class="wrap">
		<h2><?=get_admin_page_title()?></h2>
		<div class="card_bitrix" id="constant_contact">
<h2 class="title">Bitrix24</h2>

<br class="clear">
   <form method="post"
            action="<?php echo $_SERVER['PHP_SELF']; ?>?page=bitrix-page-wpcf7">
<div class="inside">

					 <tr valign="top">




                    <td>
                      <select name="bitrix_lead_protocol">
					  <?php
					  if($bitrix_lead_protocol == 'https://'){

						  ?>
							<option value="http://">http://</option>
						  <option value="https://" selected>https://</option>
						  <?php
					  }else{
						  	  ?>
							<option value="http://" selected>http://</option>
						  <option value="https://">https://</option>
						  <?php
					  }
					  ?>

</select>  </td>
   <td>

							   <input type="text" name="bitrix_lead_url"
                            size="70" value="<?php echo $bitrix_lead_url; ?>" placeholder="<?php _e('The host on which your Bitrix24 is located (yourdomain.bitrix24.ru)', 'cf7-to-bitrix24-integration' );?>" />
                    </td>
   <td>

							   <input type="text" name="bitrix_lead_port"
                            size="1" value="<?php echo $bitrix_lead_port; ?>" placeholder="443" />
                    </td>


                </tr>

				<br>
				 <tr valign="top">




                    <td>
                                <p><?php _e('REST api path', 'cf7-to-bitrix24-integration');?></p>
							   <input type="text" name="bitrix_lead_rest_api_path"
                            size="92" value="<?php echo $bitrix_lead_rest_api_path; ?>"  placeholder="/crm/configs/import/lead.php" />
                    </td>


                </tr>
				<br>
				 <tr valign="top">




                    <td>
					<p><?php _e('Required field', 'cf7-to-bitrix24-integration');?></p>

							   <input type="text" name="bitrix_lead_login_api"
                            size="20" value="<?php echo $bitrix_lead_login_api; ?>" placeholder="<?php _e('Login', 'cf7-to-bitrix24-integration' );?>" />

							   <input type="password" name="bitrix_lead_password_api"
                            size="20" value="<?php echo $bitrix_lead_password_api; ?>" placeholder="<?php _e('Password', 'cf7-to-bitrix24-integration' );?>" />
                    </td>


                </tr>

				  <p class="submit">
            <input type="submit" class="button-primary" name="submit" value="<?php _e('Save Changes', 'cf7-to-bitrix24-integration' ) ?>" />
            </p>
			    </form>
</div>
</div>
	</div>

<?php
$response = wp_remote_get($domaine_activation.'licence.html');
$info_box = serialize($response['body']);
update_option('bitrix_lead_info_box', $info_box);

echo unserialize(get_option('bitrix_lead_info_box'));
}




add_filter('wpcf7_editor_panels', 'CF7LB_add_bitrix24_panel');
function CF7LB_add_bitrix24_panel($panels) {
	if ( current_user_can( 'wpcf7_edit_contact_form' ) ) {
		$panels['wpcf7cf-conditional-panesl'] = array(
			'title'    => __( 'Bitrix24 leads', 'cf7-to-bitrix24-integration' ),
			'callback' => 'CF7LB_editor_panel_bitrix24'
		);
	}
	return $panels;
}

    function CF7LB_getMetaBitrix24($post_id) {
        return unserialize(get_post_meta($post_id,'wpcf7_bitrix_lead_options',true));
    }



add_action( 'wpcf7_save_contact_form', 'CF7LB_bitrix24_lead_save_contact_form', 10, 1 );
function CF7LB_bitrix24_lead_save_contact_form( $contact_form )
{
	if ( ! isset( $_POST ) || empty( $_POST ) || ! isset( $_POST['wpcf7-lead'] )) {
		return;
	}

	$post_id = $contact_form->id();
	if ( ! $post_id )
		return;



	$data_post_bitrix24 = serialize($_POST["wpcf7-lead"]);
	return update_post_meta($post_id,'wpcf7_bitrix_lead_options',$data_post_bitrix24);
}

function CF7LB_editor_panel_bitrix24($post) {



function CF7LB_get_all_cf7_tags($post){
	$array_type_bitrix24 = array(
	__( 'NONE_FILED', 'cf7-to-bitrix24-integration' ) => 'NONE',
		__( 'TITLE_FILED', 'cf7-to-bitrix24-integration' ) => 'TITLE',
		__( 'BIRTHDATE_FILED', 'cf7-to-bitrix24-integration' ) => 'BIRTHDATE',
		__( 'NAME_FILED', 'cf7-to-bitrix24-integration' ) => 'NAME',
		__( 'LAST NAME_FILED', 'cf7-to-bitrix24-integration' ) => 'LAST_NAME',
		__( 'SECOND NAME_FILED', 'cf7-to-bitrix24-integration' ) => 'SECOND_NAME',
		__( 'COMPANY TITLE_FILED', 'cf7-to-bitrix24-integration' ) => 'COMPANY_TITLE',
		__( 'POST_FILED', 'cf7-to-bitrix24-integration' ) => 'POST',
		__( 'ADDRESS_CITY_FILED', 'cf7-to-bitrix24-integration' ) => 'ADDRESS_CITY',
		__( 'ADDRESS_COUNTRY_FILED', 'cf7-to-bitrix24-integration' ) => 'ADDRESS_COUNTRY',
		__( 'ADDRESS_FILED', 'cf7-to-bitrix24-integration' ) => 'ADDRESS',
		__( 'COMMENTS_FILED', 'cf7-to-bitrix24-integration' ) => 'COMMENTS',
		__( 'SOURCE_DESCRIPTION_FILED', 'cf7-to-bitrix24-integration' ) => 'SOURCE_DESCRIPTION',
		__( 'OPPORTINUTY_FILED', 'cf7-to-bitrix24-integration' ) => 'OPPORTINUTY',
		__( 'CURRENCY_ID_FILED', 'cf7-to-bitrix24-integration' ) => 'CURRENCY_ID',
		__( 'SOURCE_ID_FILED', 'cf7-to-bitrix24-integration' ) => 'SOURCE_ID',
		__( 'STATUS_ID_FILED', 'cf7-to-bitrix24-integration' ) => 'STATUS_ID',
		__( 'PHONE_WORK_FILED', 'cf7-to-bitrix24-integration' ) => 'PHONE_WORK',
		__( 'PHONE_MOBILE_FILED', 'cf7-to-bitrix24-integration' ) => 'PHONE_MOBILE',
		__( 'PHONE_FAX_FILED', 'cf7-to-bitrix24-integration' ) => 'PHONE_FAX',
		__( 'PHONE_PAGER_FILED', 'cf7-to-bitrix24-integration' ) => 'PHONE_PAGER',
		__( 'PHONE_OTHER_FILED', 'cf7-to-bitrix24-integration' ) => 'PHONE_OTHER',
		__( 'WEB_WORK_FILED', 'cf7-to-bitrix24-integration' ) => 'WEB_WORK',
		__( 'WEB_HOME_FILED', 'cf7-to-bitrix24-integration' ) => 'WEB_HOME',
		__( 'WEB_FACEBOOK_FILED', 'cf7-to-bitrix24-integration' ) => 'WEB_FACEBOOK',
		__( 'WEB_LIVEJOURNAL_FILED', 'cf7-to-bitrix24-integration' ) => 'WEB_LIVEJOURNAL',
		__( 'WEB_TWITTER_FILED', 'cf7-to-bitrix24-integration' ) => 'WEB_TWITTER',
		__( 'EMAIL_WORK_FILED', 'cf7-to-bitrix24-integration' ) => 'EMAIL_WORK',
		__( 'EMAIL_HOME_FILED', 'cf7-to-bitrix24-integration' ) => 'EMAIL_HOME',
		__( 'EMAIL_OTHER_FILED', 'cf7-to-bitrix24-integration' ) => 'EMAIL_OTHER',
		__( 'IM_SKYPE_FILED', 'cf7-to-bitrix24-integration' ) => 'IM_SKYPE',
		__( 'IM_ICQ_FILED', 'cf7-to-bitrix24-integration' ) => 'IM_ICQ',
		__( 'IM_MSN_FILED', 'cf7-to-bitrix24-integration' ) => 'IM_MSN',
		__( 'IM_JABBER_FILED', 'cf7-to-bitrix24-integration' ) => 'IM_JABBER',
		__( 'IM_OTHER_FILED', 'cf7-to-bitrix24-integration' ) => 'IM_OTHER');


	$all_fields = $post->scan_form_tags();
	$current_form = wpcf7_get_current_contact_form();
    $current_form_id = $current_form->id();

	$meta_this_post = CF7LB_getMetaBitrix24($current_form_id);

		foreach ($all_fields as $tag) {
			if($tag['type']=='submit'){}else{
			?>
			<tr>
	<th scope="row">
		<label for="wpcf7-lead-<?=$tag['name']?>">[<?=$tag['name']?>]</label>
	</th>
	<td>

	<select name="wpcf7-lead[<?=$tag['name']?>]" id="wpcf7-lead-<?=$tag['name']?>">

	<?php
	foreach ($array_type_bitrix24 as $key=>$value) {
?>
 <option <?php if($meta_this_post[$tag['name']]==$value){echo 'selected';}?> value="<?=$value?>"><?php echo __( "$key", 'cf7-to-bitrix24-integration' ); ?></option>
	<?php
}

	?>

   </select>

	</td>
	</tr>
			<?php
			}

	}


}
?>



<div class="contact-form-editor-box-mail" id="<?php echo $id; ?>">

<div class="wpcf7cf-inner-container">
        <h3><?php echo esc_html( __( 'Bitrix24 Settings', 'cf7-to-bitrix24-integration' ) ); ?></h3>
   <form method="post"
            action="<?php echo $_SERVER['PHP_SELF']; ?>?page=bitrix-page-wpcf7">
       <table class="form-table">
<tbody>

	<?php
	CF7LB_get_all_cf7_tags($post);
	?>

</tbody>
</table>

</form>
    </div>
</div>

<?php
}




add_action( 'wpcf7_mail_sent', 'CF7LB_wpcf7_mail_sent_function' );
function CF7LB_wpcf7_mail_sent_function( $contact_form ) {

   $title = $contact_form->title;
   $posted_data = $contact_form->posted_data;
       $submission = WPCF7_Submission::get_instance();
       $posted_data = $submission->get_posted_data();


	   $current_form_id = $contact_form->id;
	$meta_this_post = CF7LB_getMetaBitrix24($current_form_id);
	   $postData = array();
	foreach ($meta_this_post as $key=>$value) {
$postData["$value"] =  $posted_data[$key];
	}


          $postData['LOGIN'] = stripcslashes(get_option('bitrix_lead_login_api'));
          $postData['PASSWORD'] = stripcslashes(get_option('bitrix_lead_password_api'));


       $fp = fsockopen("ssl://".stripcslashes(get_option('bitrix_lead_url')), stripcslashes(get_option('bitrix_lead_port')), $errno, $errstr, 30);
       if ($fp) {
          $strPostData = '';
          foreach ($postData as $key => $value)
             $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

          $str = "POST ".stripcslashes(get_option('bitrix_lead_rest_api_path'))." HTTP/1.0\r\n";
          $str .= "Host: ".stripcslashes(get_option('bitrix_lead_url'))."\r\n";
          $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
          $str .= "Content-Length: ".strlen($strPostData)."\r\n";
          $str .= "Connection: close\r\n\r\n";

          $str .= $strPostData;

          fwrite($fp, $str);

          $result = '';
          while (!feof($fp))
          {
             $result .= fgets($fp, 128);
          }
          fclose($fp);

          $response = explode("\r\n\r\n", $result);

          $output = '<pre>'.print_r($response[1], 1).'</pre>';
       } else {
          echo 'Connection Failed! '.$errstr.' ('.$errno.')';}


}


?>
