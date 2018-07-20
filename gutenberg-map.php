<?php
/**
 * Plugin Name: Gutenberg Google Map
 * Description: Insert Google Map to your post through the gutenberg.
 * Version: 1.0.0
 * Author: Govind Kumar
 * Author URI: http://emgk.github.io
 * Text-Domain: gutenberg-map
 */

// Exit if not defined.
defined( 'ABSPATH' ) || exit;

/**
 * Class Gutenberg map.
 *
 * @since 1.0.0
 */
class Gutenberg_Map {

	/**
	 * Constructor function for the Gutenberg map.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'enqueue_block_editor_assets', array( $this, 'register_assets_for_gutenberg_map' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets_for_gutenberg_map' ) );


		// Create google map menu.
		add_action( 'admin_menu', array( $this, 'register_menu_option' ) );

		// Register settings function.
		add_action( 'admin_init', array( $this, 'register_setting_options' ) );
	}

	/**
	 * Register the Gutenberg Map block.
	 *
	 * @since 1.0.0
	 */
	public function register_assets_for_gutenberg_map() {

		// Register gutenberg map block.
		wp_enqueue_script(
			'gutenberg-map-block',
			plugins_url( 'assets/blocks/gutenberg-map.js', __FILE__ ),
			array( 'wp-element', 'wp-blocks', 'wp-i18n', 'wp-components', 'wp-editor' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'assets/blocks/gutenberg-map.js' )
		);

		// Register gutenberg map block.
		wp_enqueue_style(
			'gutenberg-map-block',
			plugins_url( 'assets/css/style.css', __FILE__ )
		);

		wp_enqueue_script(
			'gutenberg-google-map',
			'https://maps.googleapis.com/maps/api/js?key=' . get_option( 'google_api_key' ) . '&libraries=places'
		);

		wp_localize_script( 'gutenberg-map-block', 'googleMapScript', array(
			'plugins_url' => plugin_dir_url( __FILE__ ),
		) );
	}

	/**
	 * Register Google menu option.
	 *
	 * @since 1.0.0
	 */
	public function register_menu_option() {
		add_menu_page( __( 'Gutenberg Map', 'gutenberg-map' ), __( 'Google Map API', 'gutenberg-map' ), 'administrator', __FILE__, array(
			$this,
			'register_map_option_page'
		), 'dashicons-location' );
	}

	/**
	 * Register setting option.
	 *
	 * @since 1.0.0
	 */
	public function register_setting_options() {
		// Register google api setting.
		register_setting( 'gutenberg-google-map-options', 'google_api_key' );
	}

	/**
	 * Setting page for Google Map API.
	 *
	 * @since 1.0.0
	 */
	public function register_map_option_page() {

		?>
        <div class="wrap">
            <h1><?php echo __( 'Gutenberg Google Map API', 'gutenberg-map' ); ?></h1>

            <form method="post" action="options.php">
				<?php settings_fields( 'gutenberg-google-map-options' ); ?>
				<?php do_settings_sections( 'gutenberg-google-map-options' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo __( 'Google Map API', 'gutenberg-map' ); ?></th>
                        <td>
                            <input type="password" name="google_api_key"
                                   value="<?php echo esc_attr( get_option( 'google_api_key' ) ); ?>"/>
                            <br/>
                            <p class="description">
								<?php echo __( 'Please refer to this url to get the API key <code>https://developers.google.com/maps/documentation/javascript/get-api-key</code>', 'gutenberg-map' ); ?>
                            </p>
                        </td>
                    </tr>
                </table>
				<?php submit_button(); ?>
            </form>
        </div>
	<?php }

}

new Gutenberg_Map();
