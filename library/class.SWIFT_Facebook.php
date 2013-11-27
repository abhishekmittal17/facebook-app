<?php
/**
 * ###############################################
 *
 * SWIFT Framework
 * _______________________________________________
 *
 * @author		Bishwanath Jha
 *
 * @package		SWIFT
 * @copyright	Copyright (c) 2001-2012, Kayako
 * @license		http://www.kayako.com/license
 * @link		http://www.kayako.com
 *
 * ###############################################
 */

/**
 * The Dwoo Template File Abstraction Layer
 *
 * @author Varun Shoor
 */
class SWIFT_Facebook extends SWIFT_Library
{
	var $FB = false;
	/**
	 * Constructor
	 *
	 * @internal param string $file the path to the template file, make sure it exists
	 */
	public function __construct()
	{
		parent::__construct();

		$_libPath = './' . SWIFT_APPSDIRECTORY . '/facebook/' . SWIFT_THIRDPARTYDIRECTORY . '/';

		require_once $_libPath . 'sdk/facebook.php';

		$this->FB = new Facebook(array(
									   'appId'  => $this->Settings->Get('fb_appid'),
									   'secret' => $this->Settings->Get('fb_secretkey'),
								  ));

	}

	/**
	 * Destructor
	 *
	 * @author Bishwanath Jha
	 * @return bool "true" on Success, "false" otherwise
	 */
	public function __destruct()
	{

		return true;
	}

	public function GetFeed () {
		$_feedContainer = $this->FB->api($this->Settings->Get('fb_pageid') . '/feed');

		return $_feedContainer;
	}

	public function GetUser ($_userID) {
		$_userDetails = $this->FB->api("/$_userID",'GET');
		return $_userDetails;

	}
}
?>