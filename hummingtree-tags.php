<?php
/**
 * Plugin Name: HummingTree Wrapper Plugin
 * Plugin URI: http://hummingtree.co/
 * Description: This plugin adds the wrapper for HummingTree Wordpress sites
 * Version: 1.0.0
 * Author: HummingTree Co
 * License: GPL2
*/

add_action('wp_head', 'hummingtree_styles');

function hummingtree_styles() {
  ?>
  <link type="text/css" rel="stylesheet" href="https://storage.googleapis.com/hummingtree-static-assets/modal_v1.0.1.css" />
  <?php  
}

add_action('admin_menu', 'hummingtree_menu');

function hummingtree_menu() {
   add_menu_page('HummingTree Settings', 'HummingTree Plugin Settings', 'administrator', 'hummingtree-plugin-settings', 'hummingtree_settings_page', 'dashicons-admin-generic');
}

function hummingtree_settings_page() {
  ?>
    <div class="wrap">
    <h2>HummingTree Details</h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'hummingtree-settings-group' ); ?>
        <?php do_settings_sections( 'hummingtree-settings-group' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">HummingID</th>
            <td><input type="text" name="hummingid" value="<?php echo esc_attr( get_option('hummingid') ); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
    </div>
<?php
}

add_action( 'admin_init', 'hummingtree_settings' );

function hummingtree_settings() {
  register_setting( 'hummingtree-settings-group', 'hummingid' );
}


add_action( 'wp_footer', 'get_humming_id',99 );
function get_humming_id() {
  echo '<script type="text/javascript" src="https://storage.googleapis.com/hummingtree-static-assets/modal_v1.js"></script>';
  $hummingid = get_option('hummingid');
  echo '<script type="text/javascript">
        hummingtree.init({ hostId: "'. $hummingid. '"});
        
        // NOTE: If your website is a Single Page Application:
        hummingtree.getAd();
        </script>';
}

