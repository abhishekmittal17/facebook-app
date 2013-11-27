<?php
/**
 * ###############################################
 *
 * SWIFT Framework
 * _______________________________________________
 *
 * @author		Bishwanth Jha
 *
 * @package		SWIFT
 * @copyright	Copyright (c) 2001-2012, Kayako
 * @license		http://www.kayako.com/license
 * @link		http://www.kayako.com
 *
 * ###############################################
 */

/**
 * The Cron Daily Controller
 *
 * @author Varun Shoor
 */
class Controller_FacebookMinute extends Controller_cron
{
	/**
	 * Constructor
	 *
	 * @author Varun Shoor
	 */
	public function __construct()
	{
		parent::__construct();

		SWIFT_Loader::LoadLibrary('SLA:SLAManager', APP_TICKETS);

	}

	/**
	 * Destructor
	 *
	 * @author Varun Shoor
	 * @return bool "true" on Success, "false" otherwise
	 */
	public function __destruct()
	{
		parent::__destruct();

		return true;
	}


	/**
	 * The Default Daily Method
	 *
	 * @author Varun Shoor
	 * @return bool "true" on Success, "false" otherwise
	 * @throws SWIFT_Exception If the Class is not Loaded
	 */
	public function Index()
	{
		if (!$this->GetIsClassLoaded()) {
			throw new SWIFT_Exception(__CLASS__ . ':  ' . SWIFT_CLASSNOTLOADED);
		}
		$_tickets = array();
		$_FB = new SWIFT_Facebook();
		$_feedContainer = $_FB->GetFeed();
		$_data = $this->Database->QueryFetchAll("SELECT * from swfacebook");

		foreach($_data as $_key => $_ticket) {
			$_tickets[$_ticket['facebookpostid']] = $_ticket['ticketid'];
		}

		foreach ($_feedContainer['data'] as $_key => $_post)
		{
			// If already exist, then dont process. just process it for first time.
			if (array_key_exists($_post['id'], $_tickets)) {
				continue;
			}

			if (!isset($_post['message']) && empty($_post['message'])){
				continue;
			}

			$_user     = $_FB->GetUser($_post['from']['id']);
			$_email    = $_user['username'] . '@facebook.com';
			$_subject  = substr($_post['message'], 0, 25) . '...';
			$_fullName = $_post['from']['name'];
			$_contents = $_post['message'];
			$_date     = strtotime($_post['created_time']);
			$_userID   = SWIFT_Ticket::GetOrCreateUserID($_fullName, $_email, '1');

			$_Ticket = SWIFT_Ticket::Create($_subject, $_fullName, $_email, $_contents, '', 2, 1, 1, 1, $_userID, 1, 1, SWIFT_Ticket::CREATOR_USER, SWIFT_Ticket::CREATIONMODE_FACEBOOK,
				'', 0, true, '', false, $_date, false);

			$_ticketID = $_Ticket->GetProperty('ticketid');
			$this->Database->AutoExecute(TABLE_PREFIX . 'facebook', array('facebookpostid' => $_post['id'], 'ticketid' => intval($_ticketID)), 'INSERT');
		}

		return true;
	}
}
?>
