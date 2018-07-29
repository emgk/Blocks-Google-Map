<?php
/**
 * Plugin Name: Blocks Google Map
 * Description: Integrate Google Maps to your post content with Gutenberg.
 * Version: 1.0.0
 * Author: Govind Kumar
 * Author URI: http://emgk.github.io
 * Text-Domain: blocks-google-map
 */

// Exit if not defined.
defined( 'ABSPATH' ) || exit;

/**
 * Blocks-Google-Maps
 * Copyright (C) 2018 Govind Kumar <gkprmr@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 3 as published
 * by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Class Blocks Google Maps.
 *
 * @since 1.0.0
 */
class Blocks_Google_Maps {

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
			'blocks-google-map',
			plugins_url( 'assets/blocks/blocks-google-maps.js', __FILE__ ),
			array( 'wp-element', 'wp-blocks', 'wp-i18n', 'wp-components', 'wp-editor' ),
			filemtime( plugin_dir_path( __FILE__ ) . 'assets/blocks/blocks-google-maps.js' )
		);

		// Register gutenberg map block.
		wp_enqueue_style(
			'blocks-google-map',
			plugins_url( 'assets/css/style.css', __FILE__ )
		);

		// Add the google maps script with API key.
		wp_enqueue_script(
			'gutenberg-google-map',
			'https://maps.googleapis.com/maps/api/js?key=' . get_option( 'google_api_key' ) . '&libraries=places'
		);

		// Pass the variables to the block js file.
		wp_localize_script( 'blocks-google-map', 'googleMapScript', array(
			'plugins_url' => plugin_dir_url( __FILE__ ),
		) );
	}

	/**
	 * Register Google menu option.
	 *
	 * @since 1.0.0
	 */
	public function register_menu_option() {
		add_menu_page( __( 'Blocks Google Map', 'blocks-google-map' ), __( 'Google Map API', 'blocks-google-map' ), 'administrator', __FILE__, array(
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
		register_setting( 'blocks-google-maps-setting', 'google_api_key' );
	}

	/**
	 * Setting page for Google Map API.
	 *
	 * @since 1.0.0
	 */
	public function register_map_option_page() {

		?>
        <div class="wrap">
            <h1><?php echo __( 'Blocks Google Map API', 'blocks-google-map' ); ?></h1>

            <form method="post" action="options.php">
				<?php settings_fields( 'blocks-google-maps-setting' ); ?>
				<?php do_settings_sections( 'blocks-google-maps-setting' ); ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php echo __( 'Google Map API', 'blocks-google-map' ); ?></th>
                        <td>
                            <input type="password" name="google_api_key"
                                   value="<?php echo esc_attr( get_option( 'google_api_key' ) ); ?>"/>
                            <br/>
                            <p class="description">
								<?php echo __( 'Please refer to this url to get the API key <code>https://developers.google.com/maps/documentation/javascript/get-api-key</code>', 'blocks-google-map' ); ?>
                            </p>
                        </td>
                    </tr>
                </table>
				<?php submit_button(); ?>
            </form>
        </div>
	<?php }

}

new Blocks_Google_Maps();
