<?php

	Class Extension_Relation extends Extension {

		private static $assetsLoaded = false;



		/*------------------------------------------------------------------------------------------------*/
		/* Installation  */
		/*------------------------------------------------------------------------------------------------*/

		public function install() {
			return Symphony::Database()->query("CREATE TABLE IF NOT EXISTS `tbl_fields_relation` (
				`id` int(11) unsigned NOT NULL auto_increment,
				`field_id` int(11) unsigned NOT NULL,
				`related_field_id` VARCHAR(255) NOT NULL,
				`hide_when_populated` enum('yes','no') NOT NULL default 'yes',
				`view` VARCHAR(255) NOT NULL default '',
				`per_page` int(4) unsigned NOT NULL default '12',
				`limit` int(4) unsigned NOT NULL default '0',
				`show_create` enum('yes','no') NOT NULL default 'yes',
				`show_edit` enum('yes','no') NOT NULL default 'yes',
				`show_delete` enum('yes','no') NOT NULL default 'yes',
				`show_association` enum('yes','no') NOT NULL default 'yes',
				PRIMARY KEY  (`id`),
				KEY `field_id` (`field_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
		}

		public function uninstall() {
			Symphony::Database()->query("DROP TABLE `tbl_fields_relation`");
		}



		/*------------------------------------------------------------------------------------------------*/
		/* Public utilities  */
		/*------------------------------------------------------------------------------------------------*/

		/**
		 * Add some JavaScript and CSS to the header
		 *
		 * @return void
		 */
		public static function appendAssets() {
			if (self::$assetsLoaded === false
				&& class_exists('Administration')
				&& Administration::instance() instanceof Administration
				&& Administration::instance()->Page instanceof HTMLPage
			) {
				self::$assetsLoaded = true;

				$page = Administration::instance()->Page;

				$page->addScriptToHead(URL . '/extensions/relation/assets/libraries/jquery-ui-1.8.16.custom.min.js');
				$page->addScriptToHead(URL . '/extensions/relation/assets/libraries/inheritance.js');
				$page->addScriptToHead(URL . '/extensions/relation/assets/libraries/sblv.js');
				$page->addScriptToHead(URL . '/extensions/relation/assets/libraries/sblvview.js');
				$page->addStylesheetToHead(URL . '/extensions/relation/assets/styles/sblv.css');
			}
		}
		/*------------------------------------------------------------------------------------------------*/
		/*  Internal  */
		/*------------------------------------------------------------------------------------------------*/
	}
 
