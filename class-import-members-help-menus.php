<?php
namespace PMPRO\Addons;

defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );

class Import_Members_Help_Menus {

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'dev_menu' ) );
		add_action( 'admin_menu', array( __CLASS__, 'move_spacer1_admin_menu_item' ) );
		// add_action( 'admin_menu', array( __CLASS__, 'move_options_page_admin_menu' ) );
		add_action( 'admin_menu', array( __CLASS__, 'change_pages_label_to_something_else' ) );
		add_action( 'admin_menu', array( __CLASS__, 'change_posts_label_to_updates' ) );
		add_action( 'admin_menu', array( __CLASS__, 'remove_some_admin_menus' ), 990 );
		add_action( 'admin_head', array( __CLASS__, 'add_help_screen_to_pmpro' ) );
		add_action( 'admin_head', array( __CLASS__, 'add_context_menu_help' ) );
		add_action( 'admin_head', array( __CLASS__, 'add_help_sidebar' ) );
		add_action( 'admin_menu', array( __CLASS__, 'nacin_add_special_theme_page' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_parent_theme_style' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_parent_dashboard_style' ) );
	}

	public static function print_current_screen_in_header() {
		$current_screen = get_current_screen();
		echo '<h2 class="screen">' . $current_screen->id . ' is the current_screen</h2>';
	}
	// add_action( 'admin_head', 'print_current_screen_in_header' );
	public static function enqueue_parent_dashboard_style() {
		?>
		  <style type="text/css">
		  h2.screen {
		  color:salmon;
		  position: absolute;
		  top: 2rem;
		  left: 34%;
		  }
		  </style>
		<?php
	}

	// add_action( 'wp_head', 'pagination_nav' );
	public static function pagination_nav() {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
		?>
		<nav class="pagination" role="navigation">
			<div class="nav-previous"><?php next_posts_link( '&larr; Older posts' ); ?></div>
			<div class="nav-next"><?php previous_posts_link( 'Newer posts &rarr;' ); ?></div>
		</nav>
	<?php
		}
	}

	public static function adding_paginations_p2() {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$args = array(
			'posts_per_page' => 3,
			'paged'          => $paged,
		);

		$the_query = new WP_Query( $args );
	}

	/**
	 * As a child theme, let's make sure we enqueue scripts and styles from the parent theme.
	 */
	public static function enqueue_parent_theme_style() {
		wp_enqueue_style( 'parent-style', esc_url( trailingslashit( get_template_directory_uri() ) . 'style.css' ) );
	}

	public static function pbrx_add_help() {
		// We are in the correct screen because we are taking advantage of the load-* action (below)
		$screen = get_current_screen();
		// $screen->remove_help_tabs();
		$screen->add_help_tab(
			array(
				'id'       => 'pbrx-default',
				'title'    => __( 'Default' ),
				'content'  => 'This is where I would provide tabbed help to the user on how everything in my admin panel works. Formatted HTML works fine in here too',
			)
		);
		// add more help tabs as needed with unique id's
		// Help sidebars are optional
		$screen->set_help_sidebar(
			'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
			'<p><a href="http://wordpress.org/support/" target="_blank">' . _( 'Support Forums' ) . '</a></p>'
		);
	}

	// global $pbrx_hook;
	// if ( $pbrx_hook ) {
	// add_action( 'load-' . $pbrx_hook, 'pbrx_add_help' );
	// }
	public static function nacin_add_special_theme_page() {
		// $theme_page = add_theme_page( ... );
		// if ( $theme_page ) {
		// add_action( 'load-' . $theme_page, 'nacin_add_help_tabs_to_theme_page' );
		// }
	}
	public static function nacin_add_help_tabs_to_theme_page() {
		$screen = get_current_screen();
		$screen->add_help_tab(
			array(
				'id'      => 'additional-plugin-help', // This should be unique for the screen.
			'title'   => 'Special Instructions',
			'content' => '<p>This is the content for the tab.</p>',
			// Use 'callback' instead of 'content' for a function callback that renders the tab content.
			)
		);
	}

	add_action( 'admin_menu', 'test_admin_help_tab' );
	public static function test_admin_help_tab() {
		$test_help_page = add_options_page( __( 'Test Help Tab Page', 'text_domain' ), __( 'Test Help Tab Page', 'text_domain' ), 'manage_options', 'text_domain', 'test_help_admin_page' );

		add_action( 'load-' . $test_help_page, 'admin_add_help_tab' );
	}

	public static function admin_add_help_tab() {
		global $test_help_page;
		$screen = get_current_screen();

		// Add my_help_tab if current screen is My Admin Page
		$screen->add_help_tab(
			array(
				'id'    => 'test_help_tab',
				'title' => __( 'Test Help Tab' ),
				'content'   => '<p>' . __( 'Use this field to describe to the user what text you want on the help tab.' ) . '</p>',
			)
		);
	}

	public static function test_help_admin_page() {
		echo '<h3>test_help_admin_page</h3>';
	}

	// adds a sidebar to the help context menu
	public static function add_help_sidebar() {

		// get the current screen object
		$current_screen = get_current_screen();

		// show only on listing / single post type screens
		if ( $current_screen->base == 'edit' || $current_screen->base == 'post' ) {
			$current_screen->add_help_tab(
				array(
					'id'        => 'sp_book_sample',
					'title'     => __( 'Book Help Tab' ),
					'content'   => '<p>This is a simple help tab, hi </p>',
				)
			);
			// add the help sidebar (outputs a simple list)
			$current_screen->set_help_sidebar(
				'<ul><li>Here is a list item</li><li>Here is a second item</li><li>Final item</li></ul>'
			);
		}
	}

	public static function add_context_menu_help() {

		// get the current screen object
		$current_screen = get_current_screen();

		// content for help tab
		$content = '<p>Im a help tab, woo!</p>';

		// register our main help tab
		$current_screen->add_help_tab(
			array(
				'id'        => 'sp_basic_help_tab',
				'title'     => __( 'Basic Help Tab' ),
				'content'   => $content,
			)
		);

		// register our secondary help tab (with a callback instead of content)
		$current_screen->add_help_tab(
			array(
				'id'        => 'sp_help_tab_callback',
				'title'     => __( 'Help Tab With Callback' ),
				'callback'  => 'display_help_tab',
			)
		);
	}

	// function used to display the second help tab
	public static function display_help_tab() {
		$content = '<p>This is text from our output function</p>';
		echo $content;
	}
	public static function display_help_tab1() {
		$content = '<p>This is text from our output function</p>';
		echo $content;
	}
	public static function display_help_tab2() {
		$content = '<p>This is text from our output function</p>';
		echo $content;
	}

	public static function add_help_screen_to_pmpro() {

		// get the current screen object
		$current_screen = get_current_screen();

		// show only on book listing page
		if ( 'toplevel_page_pmpro-membershiplevels' === $current_screen->id ) {
			$content = '';
			$content .= '<p>This is a help tab, you can add <strong><em>whatever</em></strong> it is you like here, such as instructions</p>';
			$current_screen->add_help_tab(
				array(
					'id'        => 'sp_book_help_tab',
					'title'     => __( 'PMPro Help Tab' ),
					'content'   => $content,
				)
			);
		}
	}


	public static function my_formatter( $content ) {
		$new_content = '';
		$pattern_full = '{([raw].*?[/raw])}is';
		$pattern_contents = '{[raw](.*?)[/raw]}is';
		$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

		foreach ( $pieces as $piece ) {
			if ( preg_match( $pattern_contents, $piece, $matches ) ) {
				$new_content .= $matches[1];
			} else {
				$new_content .= wptexturize( wpautop( $piece ) );
			}
		}

		return $new_content;

	}

	public static function add_wp_filters_pmpro() {
		global $wp_filter;
		echo '<pre>' . print_r( $wp_filter, true ) . '</pre>';
	}



	// remove_filter( 'the_content', 'wpautop' );
	// remove_filter( 'the_content', 'wptexturize' );
	// add_action( 'wp_footer', 'add_wp_filters_pmpro' );
	public static function print_hooked_functions() {
		echo 'Hooked functions';
	}

	public static function list_hooked_functions( $tag = false ) {
		global $wp_filter;
		if ( $tag ) {
			$hook[ $tag ] = $wp_filter[ $tag ];
			if ( ! is_array( $hook[ $tag ] ) ) {
				trigger_error( "Nothing found for '$tag' hook", E_USER_WARNING );
				return;
			}
		} else {
			$hook = $wp_filter;
			ksort( $hook );
		}
		echo '<pre>';
		foreach ( $hook as $tag => $priority ) {
			echo "<br>Hook => <strong>$tag</strong><br>";
			// ksort( $priority );
			echo '<div style="padding-left:3rem;">';
			foreach ( $priority as $priority => $function ) {
				echo '$priority = ' . $priority;
				foreach ( $function as $name => $properties ) {
					echo " $name<br>";
				}
			}
			echo '</div>';
		}
		echo '</pre>';
		return;
	}

	public static function move_spacer1_admin_menu_item( $menu_order ) {
		global $menu;

		$spacer_admin_menu = $menu[4];

		if ( ! empty( $spacer_admin_menu ) ) {

			// Add 'woocommerce' to bottom of menu
			 $menu[15] = $spacer_admin_menu;

			// Remove initial 'woocommerce' appearance
			unset( $menu[4] );
		}
		return $menu_order;
	}

	public static function move_options_page_admin_menu( $menu_order ) {
		global $menu;

		$infra_admin_menu = $menu[81];

		if ( ! empty( $infra_admin_menu ) ) {

			// Add 'woocommerce' to bottom of menu
			 $menu[37] = $infra_admin_menu;

			// Remove initial 'woocommerce' appearance
			unset( $menu[81] );
		}
		return $menu_order;
	}


	public static function change_pages_label_to_something_else() {
		global $menu;

		$menu[20][0] = 'Home Panels';
	}

	public static function change_s_label_to_something_else() {
		global $menu;

		$menu[20][0] = 'Home ';
	}

	public static function change_posts_label_to_updates() {
		global $menu;

		$menu[5][0] = 'Current Updates';

	}


	public static function remove_some_admin_menus() {
		global $menu, $submenu;
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'edit.php' );
		remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
		remove_submenu_page( 'themes.php', 'theme-editor.php' );
	}


	public static function dev_menu() {
		// if ( current_user_can( 'manage_network' ) ) { // for multisite
		if ( current_user_can( 'manage_options' ) ) {
			add_menu_page( 'Dev Admin', 'Dev Admin', 'edit_posts', 'dev-admin-menu.php',  array( __CLASS__, 'dev_menu_page' ), 'dashicons-tickets', 13 );
			add_submenu_page( 'dev-admin-menu.php', 'Dev Arrays', 'Arrays', 'edit_posts', 'dev-arrays.php',  array( __CLASS__, 'dev_arrays_page' ) );
			add_submenu_page( 'dev-admin-menu.php', 'Dev Submenu', 'Menus/Submenus', 'edit_posts', 'dev-submenu.php',  array( __CLASS__, 'dev_submenu_page' ) );
		}
	}

	public static function dev_arrays_page() {
		echo '<h1>' . basename( __FUNCTION__ ) . '</h1>';
		echo '<pre>';
		echo 'You can find this file in  <br>';
		echo plugins_url( '/', __FILE__ );
		$cpts = get_post_types();
		print_r( $cpts );
		$cpt = get_post_type_object( 'new_relic_use_cases' );
		$cpt = get_post( 205 );
		print_r( $cpt );

		echo '<br>';
		echo '</pre>';
		$use_cases = new \WP_Query(
			array(
				'post_type' => 'use_cases',
			)
		);
		echo '<pre> Use Cases';
		print_r( $use_cases );
		echo '</pre>';
		echo '<pre>';
			print_r( get_field( 'use_cases' ) );
		echo '</pre>';
		die;
	}

	public static function dev_submenu_page() {
		global $menu;
		echo '<h1>' . basename( __FUNCTION__ ) . '</h1>';
		echo '<pre>';
		echo 'You can find this file in  <br>';
		echo plugins_url( '/', __FILE__ );
		print_r( $menu );
		echo '<br>';
		echo '<br>ACF path =>' . plugin_dir_path( __FILE__ ) . 'acf-json<br>';
		echo '</pre>';

	}

	public static function dev_menu_page() {
		echo '<h1>' . basename( __FUNCTION__ ) . '</h1>';
			echo '<h1>Dev Admin Menu</h1>';
			echo '<pre>';

			echo '<p>get_stylesheet_directory => ' . get_stylesheet_directory();
			echo '<p>get_stylesheet_directory_uri => ' . get_stylesheet_directory_uri();
			echo '<p>get_stylesheet_uri => ' . get_stylesheet_uri();

			echo 'You can find this file in  <br>';
			echo esc_url( plugins_url( '/', __FILE__ ) );
			echo '<br>';
			echo '</pre>';

			$mods = get_theme_mods();
			echo '<pre>';
			var_dump( $mods );
			echo '</pre>';
	}
}
