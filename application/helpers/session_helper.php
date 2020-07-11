<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_login'))
{
<<<<<<< HEAD
	function test_login($check = "") {
=======
	function test_login($check) {
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		if(strpos($url, 'logout') !== FALSE || strpos($url, 'verify') !== FALSE) {
			return;
		}
		$CI = & get_instance();  //get instance, access the CI superobject
		$isLoggedIn = $CI->session->userdata('user');
<<<<<<< HEAD
		if($check === 1) {
			if(!$isLoggedIn || $isLoggedIn['role'] === '2') {
				redirect('login');
			}
		} elseif($check === 2) {
			if(!$isLoggedIn || $isLoggedIn['role'] === '1') {
				redirect('login');
			}
		} elseif($check === 3) {
=======
		if($check == 1) {
			if(!$isLoggedIn || $isLoggedIn['role'] === '2') {
				redirect('login');
			}
		} /*elseif($check == 2) {
			if($isLoggedIn['role'] === '1') {
				redirect('login');
			}
		} */elseif($check == 3) {
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
			if($isLoggedIn['role'] === '1') {
				redirect('admin');
			} elseif($isLoggedIn['role'] === '2') {
				redirect('user');
			}
<<<<<<< HEAD
		} else {
=======
		} /*else {
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
			if($isLoggedIn['role'] === '1') {
				redirect('admin');
			} elseif($isLoggedIn['role'] === '2') {
				redirect('user');
			} else {
				redirect('home');
			}
<<<<<<< HEAD
		}
=======
		}*/
>>>>>>> ac2811c4a7694c40a9a27213b4c91daf1673c7db
	}
}
