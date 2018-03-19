<?php
// namespace PMPRO\Addons;
defined( 'ABSPATH' ) || die( 'File cannot be accessed directly' );
/**
 * Plugin Name: Paid Memberships Pro - Import Members from CSV
 * Plugin URI: http://wordpress.org/plugins/pmpro-import-members-from-csv/
 * Description: Import Users and their metadata from a csv file.
 * Version: 2.8
 * Requires PHP: 5.4
 * Author: <a href="https://eighty20results.com/thomas-sjolshagen/">Thomas Sjolshagen <thomas@eighty20results.com></a>
 * License: GPL2
 * Text Domain: pmpro-import-members-from-csv
 * Domain Path: languages/
 */

/**
 * Copyright 2017-2018 - Thomas Sjolshagen (https://eighty20results.com/thomas-sjolshagen)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @credit http://wordpress.org/plugins/import-users-from-csv/ - Ulich Sossou -  https://github.com/sorich87
 * @credit https://github.com/strangerstudios/pmpro-import-users-from-csv - Jason Coleman - https://github.com/ideadude
 */


/**
 * Load welcome page
 */
require_once( 'class-import-members-help-menus.php' );
register_activation_hook( __FILE__, 'import_members_install_welcome' );
function import_members_install_welcome() {
	set_transient( 'import_members_activated', true, 30 );
}


require_once( 'class-pmpro-import-members.php' );
// Load the plugin.
// add_action( 'plugins_loaded', array( Import_Members_From_CSV::get_instance(), 'load_plugins' ) );
if ( ! defined( 'PMP_IM_CSV_DELIMITER' ) ) {
	define( 'PMP_IM_CSV_DELIMITER', ',' );
}
if ( ! defined( 'PMP_IM_CSV_ESCAPE' ) ) {
	define( 'PMP_IM_CSV_ESCAPE', '\\' );
}
if ( ! defined( 'PMP_IM_CSV_ENCLOSURE' ) ) {
	define( 'PMP_IM_CSV_ENCLOSURE', '"' );
}
