<?php

	Class Extension_Relations extends Extension {

		/*------------------------------------------------------------------------------------------------*/
		/* Installation  */
		/*------------------------------------------------------------------------------------------------*/

		public function install() {
			return Symphony::Database()->query("CREATE TABLE IF NOT EXISTS `tbl_fields_relation` (
				`id` int(11) unsigned NOT NULL auto_increment,
				`field_id` int(11) unsigned NOT NULL,
				`limit` int(6) unsigned NOT NULL default '0',
				`sections` VARCHAR(255) NOT NULL default '',
				`view` VARCHAR(255) NOT NULL default '',
				`view_info` TEXT NOT NULL default '',
				PRIMARY KEY  (`id`),
				KEY `field_id` (`field_id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
		}

		public function uninstall() {
			return Symphony::Database()->query("DROP TABLE `tbl_fields_relation`");
		}

	}
 
