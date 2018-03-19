=== Paid Memberships Pro - Import Members from CSV ===
Contributors: eighty20results, sorich87, ideadude
Tags: user, users, csv, batch, import, importer, admin, paid memberships pro, members, member, pmpro
Requires at least: 4.4
Tested up to: 4.9.3
Stable tag: 2.8

Import users from a CSV file into WordPress

== Description ==

I updated and integrated the Import Users from CSV with the PMPro Import Users from CSV Integration add-on to create a Paid Memberships Pro specific member import (CSV files) plugin.

It will allow you to import users from a CSV file uploaded to your web server/membership site. It will add users with basic information as well as meta fields, the user role (if applicable) and the specified PMPro member configuration/information.

If you've exported the user's passwords as hashed strings, you can import them without re-encrypting them again (by setting the option).

You can also choose to send a notification to the new users and to display password nag on user login.

This plugin supports Network Activation on a WordPress Multisite installation (see the settings page when using in a multisite configuration)
[Check out my other plugins.](http://eighty20results.com/wordpress-plugins/)

= Features =

* Imports all WP User database table fields
* Imports user meta
* Imports PMPro membership data
* Update existing users if they already exist in the WP Users database (if the option is selected)
* Deactivate preexisting membership records for the same membership level as is being imported (if the option is selected)
* Set/Update the user WordPress role for the member (if the role is specified in the import file)
* Sends new user a notification message (if the option is selected)
* Shows password nag on user login (if the option is selected)
* Allows large user/member import without having to configure the PHP max_execution_time variable (if the option is selected)
* Import hashed password for new/updating users (if the option is selected)


For feature request and bug reports, [please use the issues section on GitHub](https://github.com/eighty20results/import-members-from-csv/issues).
Code contributions are welcome [on Github](https://github.com/eighty20results/import-members-from-csv).

== Installation ==

For an automatic installation through WordPress:

1. Go to the 'Add New' plugins screen in your WordPress admin area
1. Search for 'Import Users from CSV'
1. Click 'Install Now' and activate the plugin
1. Upload your CSV file in the 'Users' menu, under 'Import From CSV'


Or use a nifty tool by WordPress lead developer Mark Jaquith:

1. Visit [this link](http://coveredwebservices.com/wp-plugin-install/?plugin=pmpro-import-members-from-csv) and follow the instructions.


For a manual installation via FTP:

1. Upload the `pmpro-import-members-from-csv` directory to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' screen in your WordPress admin area
1. Upload your CSV file in the 'Members' menu, under 'Import Members'


To upload the plugin through WordPress, instead of FTP:

1. Search for the plugin ("Paid Memberships Pro Import Members from CSV" on the 'Add New' plugins screen in your WordPress admin area and activate.
1. Upload your CSV file in the 'Memberships' menu, under 'Import Members'

== Frequently Asked Questions ==

= How to use? =

Click on the 'Import Members' link in the 'Membership' menu, then select your CSV file.
Next you have to decide whether you:

1. want to deactivate previously existing member record(s) for the user - The CSV record has to specify the same membership as the user previously had so this is most useful when having to reimport/update data (default: enabled and recommended),
1. update the existing user/member's information (default: enabled and recommended)
1. send a notification email to new users (default: disabled),
1. want the password nag to be displayed when the user logs in (default: disabled),
1. have included a hashed (encoded) password specified in the import file and (default: disabled)
1. want to use the background import option (default: enabled and recommended)

Then click the 'Import' button.

Each row in your CSV file should represent a user; each column identifies user data, user meta data or user membership data
If a column name matches a field in the user table, data from this column is imported in that field; if not, data is imported in a user meta field with the name of the column or into the PMPro custom membership tables.

Look at the examples/import.csv file in the plugin directory to have a better understanding of how the your CSV file should be organized.
You can try importing that file and look at the result.

= The .CSV file from the "Export to CSV" button on the "Members List" page won't import? =

The purpose of the resulting .CSV file from the "Export to CSV" is to generate reports that are meaningful to a human, not a file that can be imported easily. This is true for any of the available Import from .CSV plugins/add-ons for Paid Memberships Pro.

Basically there are a few key differences between the file resulting from the Export function and the file contents needed to import the same member.

As of version 2.5, this plugin includes data checks for some of the more common mistakes I've seen in the .CSV file(s).

= My import fails, what is wrong? =

This is almost always related to the data in the file being imported. As a result, I've added some data tests for some of the typical mistakes I've seen in the .CSV file(s) being imported.

= The member is imported, but there is no order? =

Correct. Adding an order to the system means the plugin has to require certain data to be present during the import operation. Since we want this plugin to be as flexible as possible, I can't guarantee there's enough data being provided to include an order record in the PMPro database tables. My philosophy has thus been that there is no order because the import operation doesn't include any financial transactions. Orders in PMPro reflect an actual transaction (even if it's a free sign-up).

There's one exception: If you include the gateway specific fields - like; membership_gateway, membership_subscription_transaction_id, etc - in the import file, the plugin will attempt to add an (incomplete) order record for that user.

= How should the .csv file be defined? =

This plugin assumes that the .csv file;

* Uses a comma (,) character to denote a new column in a row
* Uses a double-quote (") character to wrap the contents of each of the columns
* Uses a backslash (\) character as the escape character

For example;
To have a 2 column .csv file, each row **after** the header row, the row should look something like this: `"my first column data","my second \"escaped\" column data"`.

The application you use to edit and export your .CSV file will need to be configured appropriately before you export the .csv file.

= Why am I or my users not receiving New user notifications =

There are a couple of possible reasons, as far as I can tell. The functionality in WordPress that generates the "new user notification" message is what they call "pluggable". That means that it's possible for a plugin (any plugin!) to override the behavior of the functionality. So the first thing I'd suggest investigating is whether you have a pluing active that intentionally changes/modifies/updates how the `wp_new_user_notification()` function works/behaves.

Next, it's (very) possible that your hosting environment doesn't want you to be sending out a lot of email messages from their servers. As a result, the import operation could potentially trip their anti-spam measures and blocking you from sending any messages.

Third, the recipient email server may be using a SBL (Spam Black List) and have your web server IP listed as a typical source of Spam messages (it happens, a lot).

== Screenshots ==

1. User import screen
1. Ongoing (background) import screen
1. Default settings on the user import screen

== Changelog ==

= 2.8 =
* BUG FIX: Attempting to fix issue with the New User Notice not always being sent
* ENHANCEMENT: Select target recipients of "New User Notice" (User, Admin or both)

= 2.7 =
* BUG FIX: Didn't include the transaction IDs, affiliate ID or gateway settings in the import
* BUG FIX: Typo in readme.txt

= 2.6 =
* ENHANCEMENT: Now calculating # of records to import in background based on PHP setting for max_execution_time
* ENHANCEMENT: Differentiate between warnings and errors. Errors should terminate execution. Warnings should be logged, but not end import.
* ENHANCEMENT: Added ('Recommended') for Import settings we recommend you use
* ENHANCEMENT: Make timeout for JavaScript loop be 20% > than max_execution_time
* ENHANCEMENT: Improved error/warning reporting by using SplFileObject() to manage import file (indicates the line in the .csv file with a problem)
* ENHANCEMENT: Added error message when the ID, user_login _and_ user_email columns are missing
* ENHANCEMENT: Added file indexed warning message if user_login has to be generated from the record email address (using front of '@' as the login name)
* ENHANCEMENT: Added file indexed warning message when an email address is either missing or unrecognizable
* ENHANCEMENT: Include warning and error messages in Import status window (when applicable)
* ENHANCEMENT: Updated links to the WordPress.org repository for information and support for the plugin
* ENHANCEMENT: Linted and refactored the source files
* ENHANCEMENT: Expanded the FAQ section, fixed a few typos and updated the Change log in readme.txt
* BUG FIX: Better handling/reporting of unexpected values in the membership_status column, incorrect email formats, incorrect or missing membership_id value(s), improper date formats for the membership_startdate, membership_enddate and membership_timestamp columns and unexpected membership configurations (based on values supplied in the import file)
* BUG FIX: Displaying error/warning/info messages in wp-admin was a little flaky
* BUG FIX: Would allow duplication of error messages in wp-admin area

= 2.5 =
* ENHANCEMENT: Added error checking and messages to warn about the most common PMPro related errors in the .csv file being imported.
* ENHANCEMENT: Added function to test dates for compliance with MySQL requirements

= 2.4 =
* BUG FIX: Typo in add_action( 'pmp_im_pre_user_import' ...) caused default pre-import action to not be triggered
* ENHANCEMENT/FIX: Updated action names: 'pmp_im_post_member_import', 'pmp_im_pre_members_import'

= 2.3 =
* BUG FIX: PHP Warning
* BUG FIX: The resume URL didn't work as expected
* BUG FIX: Didn't set the blog ID when updating membership info
* BUG FIX: Didn't cancel previous membership records for the imported user ID / membership ID combination when deactivate_old_memberships was set to true (checked)
* ENHANCEMENT: Renamed import page function (documentation related)
* ENHANCEMENT: Added link to error log (if applicable) to the admin notices

= 2.2 =
* ENHANCEMENT: Add support for WP Multi Site configurations (adding/updating users to the specified WPMU site)
* ENHANCEMENT: Better error handling/notifications

= 2.1 =
* BUG FIX: Lost track of how to update via JavaScript
* BUG FIX: Didn't preserve settings between loads of JS
* BUG FIX: Didn't always load the correct settings for the JS based import
* BUG FIX: Include error info
* BUG FIX: Didn't include all required settings in AJAX operation
* BUG FIX: Didn't set and clear busy icon for import status text
* ENHANCEMENT/FIX: Use PMPro variable array to set record info for each user
* ENHANCEMENT/FIX: Renamed methods to better describe where they're being used/what they're used for
* ENHANCEMENT: Action handler when clicking the "Finished" button at end of import ( redirect to admin_url() )
* ENHANCEMENT: Add set_busy() and clear_busy() for feedback during import
* ENHANCEMENT: Add "Finished" button (display when import is complete)
* ENHANCEMENT: Reorder options (more logical, I think)
* ENHANCEMENT: Use AJAX import as default behavior
* ENHANCEMENT: Add "Import Members" to "Memberships" drop-down menu in /wp-admin/
* ENHANCEMENT: Improved prompts/info for options on import page
* ENHANCEMENT: Load plugin actions in plugins_loaded action
* ENHANCEMENT: Fixing PHPDoc for new functions/updated functions
* ENHANCEMENT: Variable name update
* ENHANCEMENT: Clean up insert method for hashed passwords
* ENHANCEMENT: Log error message if there's a problem with a header field
* ENHANCEMENT: Adding screenshot images

= 2.0.1 =
* Fixed bug: Sanitizing request variables
* Fixed bug: Notification nag not getting configured correctly
* Fixed bug: New user notification not getting configured correctly
* Fixed bug: Didn't always handle pause/resume (at all)
* Fixed bug: Didn't stop/pause the import when user clicked the "pause" link
* Enhancement: Added `is_iu_import_records_per_scan` filter to let user set # of records to import per step when using JS import
* Enhancement: Refactored and added local scope for variables & functions
* Enhancement: Use JSON and status returns from server
* Enhancement: Use filter to set timeout for AJAX operation
* Enhancement: Use proper WP AJAX functionality for variables and statuses
* Enhancement: Clean up translations and grammar.
* Enhancement: Use printf()/sprintf() to improve formatting & translation
* Enhancement: Use wp_register_script()/wp_localize_script() and wp_enqueue_script() to handle passing dynamic data to JavaScript
* Enhancement: Clean up REQUEST variable use
* Enhancement: Allow setting password nag for both new and updated accounts
* Enhancement: Use wp_send_json*() functions for AJAX actions
* Enhancement: Allow import of pre-hashed passwords for user records
* Enhancement: More reliable option based tracking of imports (not transients)
* Enhancement: Moved JavaScript to own location

= 2.0.0 =
* Forked from the Import Users from CSV plugin and integrated the "PMPro Import Users From CSV Integration" add-on functionality
* Fixed bug with Notification Nag
* Fixed bug with user notification
* Fixed bugs with static/non-static function calls
* Enhancement: JavaScript based async loading (for large imports)
