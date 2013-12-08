<?php

	namespace RelationField;

	/**
	 * RelationField application.
	 */
	final class App {

		public static function init() {
			self::initUtils();
		}


		private static function initUtils() {
			Services::register('utils', new Utils());
		}
	}
