<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_login'))
{
	function test_login($check) {
		$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		if(strpos($url, 'logout') !== FALSE || strpos($url, 'verify') !== FALSE) {
			return;
		}
		if ($check == 4 && strpos($url, 'admin/login') !== FALSE)
		{
			$check = 3;
		}
		$CI = & get_instance();  //get instance, access the CI superobject
		if($check == 1) {
			// to check if admin pages are accessed and admin is not login
			$isLoggedIn = $CI->session->userdata('admin');
			if(!$isLoggedIn || $isLoggedIn['role'] === '2') {
				redirect('admin/login');
			}
		} elseif($check == 2) {
			// to check if user pages are accessed and user is not login
			$isLoggedIn = $CI->session->userdata('user');
			if (!$isLoggedIn) {
				redirect('home');
			}
		} elseif($check == 3) {
			// to check if admin login page is open and admin is already logged in
			$isLoggedIn = $CI->session->userdata('admin');
			if(isset($isLoggedIn['role']) && $isLoggedIn['role'] === '1') {
				redirect('admin');
			}
		} elseif($check == 4) {
			// to check if authentication pages are accessed and user already logged in
			$isLoggedIn = $CI->session->userdata('user');
			if(isset($isLoggedIn['role']) && $isLoggedIn['role'] === '2') {
				redirect('home');
			}
		} /*else {
			if($isLoggedIn['role'] === '1') {
				redirect('admin');
			} elseif($isLoggedIn['role'] === '2') {
				redirect('user');
			} else {
				redirect('home');
			}
		}*/
	}
}
