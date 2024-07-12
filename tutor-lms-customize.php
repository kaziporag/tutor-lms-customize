<?php

/*
 * Plugin Name:       Tutor LMS Customize
 * Plugin URI:        https://academy.devtheme.net
 * Description:       Tutor LMS Customize is designed for Tutor LMS. This Tutor LMS Customize will show or hide the courses from frontend.
 * Author:            Kazi Rabiul Islam
 * Author URI:        https://kaziporag.devtheme.net
 * Version:           1.0.1
 */

class Tutor_LMS_Customize {

	private static $instance;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->require_classes();
	}

	private function require_classes() {
		require_once __DIR__ . '/includes/tlms-field-add.php';
	}
}

Tutor_LMS_Customize::get_instance();