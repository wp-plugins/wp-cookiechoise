<?php
/**
 * Plugin Name.
 *
 * @package   Wp Cookie Choice
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */

/**
 * Plugin class.
 *
 * TODO: Rename this class to a proper name for your plugin.
 *
 * @package PluginName
 * @author  Your Name <email@example.com>
 */
class CookieChoice {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	protected $version = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'wp-cookiechoise';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;
	
	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		add_action( 'admin_enqueue_scripts', array( $this , 'enqueue_styles') );
		
		add_action( 'wp_footer' , array( $this , 'add_cookiechoice_code' ));
		
	}
			
			
	public function enqueue_styles() {

		//wp_enqueue_script( 'cookiechoice', plugins_url( 'js/cookiechoices.js', __FILE__ ) );
		wp_enqueue_style( 'cookiechoice', plugins_url('css/style.css',__FILE__), array(), 1.0, 'screen' );
	}
		
	/**
	* add the TrackingCode into wp_footer
	* 
	*/
	
	public function add_cookiechoice_code(){

		$cookieChoice = get_option('cookiechoice','');
		
		if($cookieChoice != '') {
			
			if($cookieChoice['active']) {
			
				?>
				
				<script src="<?php echo plugins_url( 'js/cookiechoices.js', __FILE__ ); ?>"></script>

				<?php 
				
				if($cookieChoice['kind'] == 'top') {
				?>
				<script>
				  document.addEventListener('DOMContentLoaded', function(event) {
					cookieChoices.showCookieConsentBar('<?php echo esc_html_e($cookieChoice['message']); ?>','<?php esc_html_e($cookieChoice['close']); ?>', '<?php esc_html_e($cookieChoice['more']); ?>', '<?php echo $cookieChoice['url']; ?>');
				  });
				</script>
				<?php 
				} else {
				?>
				<script>
				  document.addEventListener('DOMContentLoaded', function(event) {
					cookieChoices.showCookieConsentDialog('<?php esc_html_e($cookieChoice['message']); ?>','<?php esc_html_e($cookieChoice['close']); ?>', '<?php esc_html_e($cookieChoice['more']); ?>', '<?php echo $cookieChoice['url']; ?>');
				  });
				</script>
				<?php 
				}
				
			
			
			}
		}
	
	
	}
		
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		
		//if( current_user_can( "manage_options" ) ) {
		
			$this->plugin_screen_hook_suffix = add_options_page(
				__( 'WP Cookie Choice', $this->plugin_slug ),
				__( 'CookieChoice', $this->plugin_slug ),
				'manage_options',
				$this->plugin_slug,
				array( $this, 'display_cookiechoice_admin_page' )
			);
		
		//}
		
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_cookiechoice_admin_page() {
		include_once( 'views/admin.php' );
	}

}