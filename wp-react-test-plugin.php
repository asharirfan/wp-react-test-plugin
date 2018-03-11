<?php
/**
 * Plugin Name:     React Test Plugin
 * Plugin URI:      https://asharirfan.com
 * Description:     A basic WordPress plugin to test React with Webpack.
 * Version:         0.1.0
 * Author:          mrasharirfan
 * Author URI:      https://asharirfan.com
 * License:         GPL-2.0+
 * License URI:     http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:     react-test
 *
 * @package react-test
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'RT_React_Test' ) ) {

	/**
	 * React Test Main Class.
	 */
	class RT_React_Test {

		/**
		 * Plugin's Single Instance.
		 *
		 * @var RT_React_Test
		 */
		protected static $_instance;

		/**
		 * Method: Creates an instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Method: Constructor.
		 */
		public function __construct() {
			// Register plugin page.
			add_action( 'admin_menu', array( $this, 'register_plugin_page' ) );

			// Enqueue React Build file.
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_react_build' ), 10, 1 );
		}

		/**
		 * Method: Add plugin page.
		 *
		 * @return void
		 */
		public function register_plugin_page() {
			// Register plugin page.
			add_submenu_page(
				'tools.php',
				__( 'React Test Plugin', 'react-test' ),
				__( 'React Test Plugin', 'react-test' ),
				'manage_options',
				'react-test-plugin',
				array( $this, 'react_test_plugin_page' )
			);
		}

		/**
		 * Method: React Test Plugin Render Callback.
		 *
		 * @return void
		 */
		public function react_test_plugin_page() {
			// Plugin Page.
			?>
			<div class="wrap">
				<h1><?php esc_html_e( 'React Test Plugin', 'react-test' ); ?></h1>
				<p><?php esc_html_e( 'A plugin for testing React JS with WordPress.', 'react-test' ); ?></p>

				<!-- React App -->
				<div id="rt_app"></div>
				<!-- / React App -->
			</div>
			<?php
		}

		/**
		 * Method: Enqueue React Build.
		 *
		 * @param string $hook – Page hook.
		 * @return void
		 */
		public function enqueue_react_build( $hook ) {
			// Check hook for tools page.
			if ( 'tools_page_react-test-plugin' !== $hook ) {
				return;
			}

			// Enqueue script!
			wp_enqueue_script(
				'react-test-build',
				plugin_dir_url( __FILE__ ) . 'assets/build/js/react-test-build.js',
				array(),
				filemtime( plugin_dir_path( __FILE__ ) . 'assets/build/js/react-test-build.js' ),
				true
			);
		}
	}
}

/**
 * Returns the main instance of RT_React_Test.
 */
function rt_plugin() {
	return RT_React_Test::instance();
}
rt_plugin();
