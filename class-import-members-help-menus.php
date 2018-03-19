<?php
namespace PMPRO\Addons;

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );
/**
 * text-domain: pmpro-import-members
 */
class Import_Members_Help_Menus {
	/**
	 * Add the minimum capabilities used for the plugin
	 */
	const min_caps = 'manage_options';

	protected $add_on_name;
	protected $database_names;

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'show_plugin_activation' ) );
		add_action( 'admin_menu', array( $this, 'create_admin_menus' ) );
		add_action( 'admin_init', array( $this, 'import_members_welcome' ), 11 );
		add_action( 'admin_menu', array( $this, 'import_members_admin_help_tab' ) );
	}

	/**
	 * Add the page to the admin area
	 */
	public function show_plugin_activation() {
		?>
		<style type="text/css">
			#wpwrap {
				background-color: aliceblue !important;
			}
			#wpbody-content .pmpro_admin {
				min-height: 89vh;
				height: 95%;
				padding: .5rem;
			}
		</style>
		<?php
	}

	/**
	 * Add the page to the admin area
	 */
	public function create_admin_menus() {
		add_dashboard_page(
			__( 'Import Members splash page', 'pmpro-import-members' ),
			__( 'Import Members splash page', 'pmpro-import-members' ),
			self::min_caps,
			'import-page.php',
			array( $this, 'import_members_intro_message' )
		);

		// Remove the page from the menu
		remove_submenu_page( 'index.php', 'import-page.php' );
	}

	/**
	 * Display the plugin import message
	 */
	public function import_members_intro_message() {
		require_once( PMPRO_DIR . '/adminpages/admin_header.php' );
		echo '<h2>' . __FUNCTION__ . '</h2>';
		echo '<p class="description">' . __( 'Import Members splash page is created in the following file. This text can be edited in the method above.', 'pmpro-import-members' ) . '</p>';
		echo '<p class="description">' . __( 'We know the Import Members welcome class is active when the background-color of the dashboard changes to aliceblue.', 'pmpro-import-members' ) . '</p><br>';
		echo '<h4>' . __FILE__ . '</h4>';
		echo '<br><a class="button button-primary" href="' . admin_url( 'admin.php?page=pmpro-import-members-from-csv' ) . '" >Get Started Here</a>';

			require_once( PMPRO_DIR . '/adminpages/admin_footer.php' );
	}

	/**
	 * Check the plugin activated transient exists if does then redirect
	 */
	public function import_members_welcome() {
		if ( ! get_transient( 'import_members_activated' ) ) {
			return;
		}
		delete_transient( 'import_members_activated' );

		wp_safe_redirect(
			add_query_arg(
				array(
					'page' => 'import-members-page.php',
				), admin_url( 'index.php' )
			)
		);
		exit;
	}

	public function import_members_admin_help_tab() {
		$import_help_page = 'memberships_page_pmpro-import-members-from-csv';
		$import_welcome_page = add_dashboard_page( __( 'Import Members Help', 'pmpro-import-members' ), __( 'Import Members Help', 'pmpro-import-members' ), self::min_caps, 'import-members-page.php', array( $this, 'import_members_intro_message' ) );
		add_action( 'load-' . $import_welcome_page, array( $this, 'admin_add_help_tab' ) );
		add_action( 'load-' . $import_help_page, array( $this, 'admin_add_help_tab' ) );
	}


	public function admin_add_help_tab() {
		$screen = get_current_screen();
		$screen->add_help_tab(
			array(
				'id'    => 'import_members_help_tab_1',
				'title' => __( 'Help Import Members One' ),
				'content' => '<h2>' . basename( __FILE__ ) . ' on line ' . __LINE__ . '</h2><p>' . __( 'Use this field to describe to the user what text you want on the help tab.' ) . '</p>',
			)
		);
		$screen->add_help_tab(
			array(
				'id'    => 'import_members_help_tab_2',
				'title' => __( 'Help Import Members Two' ),
				'content'   => '<h2>' . basename( __FILE__ ) . ' on line ' . __LINE__ . '</h2><p>' . __( 'Use this field to describe to the user what text you want on the help tab.' ) . '</p>',
			)
		);
		$screen->add_help_tab(
			array(
				'id'    => 'import_members_help_tab_3',
				'title' => __( 'Help Import Members Three' ),
				'content' => '<h2>' . basename( __FILE__ ) . ' on line ' . __LINE__ . '</h2><p>' . __( 'Use this field to describe to the user what text you want on the help tab.' ) . '</p>',
			)
		);
		$screen->add_help_tab(
			array(
				'id'    => 'import_members_help_tab_4',
				'title' => __( 'Help Import Members Four' ),
				'content' => '<h2>' . basename( __FILE__ ) . ' on line ' . __LINE__ . '</h2><p>' . __( 'Use this field to describe to the user what text you want on the help tab.' ) . '</p>',
			)
		);
	}

	public function import_members_help_admin_page() {
		echo '<div class="wrap">';
		echo '<h4>' . __FILE__ . '</h4>';
		echo '<h1 style="color:salmon;">' . __CLASS__ . '</h1>';
		echo '<p class="description">This is a description paragraph. The text is italicized because of its class and the fact that it\'s withing the wrap class.</p>';
		$this->import_members_intro_message();
		echo '<p><a href="#"><button style="padding:.5rem 2rem;background-color:aliceblue;">Link</button></a></p>';
		echo '</div>';
	}
}
new Import_Members_Help_Menus();
