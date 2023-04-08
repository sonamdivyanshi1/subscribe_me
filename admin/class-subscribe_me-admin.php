<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sonam.wisdmlabs.net
 * @since      1.0.0
 *
 * @package    Subscribe_me
 * @subpackage Subscribe_me/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Subscribe_me
 * @subpackage Subscribe_me/admin
 * @author     sonam <sonam.divyanshi@wisdmlabs.com>
 */
class Subscribe_me_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Subscribe_me_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Subscribe_me_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/subscribe_me-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Subscribe_me_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Subscribe_me_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/subscribe_me-admin.js', array( 'jquery' ), $this->version, false );

	}

	function add_menu_pages()
	{
		add_menu_page(
			'Subscribe Me',
			'Subscribe Mail',
			'manage_options',
			'subscribe-me',
			array($this, 'subscribe_me_cb'),
			'dashicons-email',
			100
		);
	}

	function subscribe_me_cb()
	{
?>
		<div class="wrap">
			<h2>Subscribe Me</h2>
			<form method="post" action="options.php">
				<?php
				settings_fields('my_plugin_settings_group');
				do_settings_sections('subscribe-me-settings');
				?>
				<?php submit_button('Save Changes'); ?>
			</form>
		</div>
<?php
	}

	function reg_settings()
	{
		register_setting('my_plugin_settings_group', 'no_of_posts');
		add_settings_section('subs_settings', 'Subscription Mail Settings', '', 'subscribe-me-settings');
		add_settings_field('no_of_posts', 'No of Posts', array($this, 'no_of_posts_cb'), 'subscribe-me-settings', 'subs_settings');
	}

	public function no_of_posts_cb()
	{
	?>
		<input type="text" name="no_of_posts" value="<?php echo esc_attr(get_option('no_of_posts')) ?>">
	<?php
	}

}
