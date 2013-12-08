<?php

	namespace RelationField;

	use Configuration;

	final class Services {

		private static $services = array();

		/**
		 * Register a public service.
		 *
		 * @param $handle
		 * @param $obj
		 */
		public static function register($handle, $obj) {
			self::$services[$handle] = $obj;
		}

		/**
		 * Get service.
		 *
		 * @param $handle
		 *
		 * @return mixed
		 */
		public static function get($handle) {
			return self::$services[$handle];
		}

		/**
		 * @return Configuration
		 */
		public static function Config() {
			return self::get('config');
		}

		/**
		 * @return Database
		 */
		public static function Database() {
			return self::get('database');
		}

		/**
		 * @return Utils
		 */
		public static function Utils() {
			return self::get('utils');
		}
	}
