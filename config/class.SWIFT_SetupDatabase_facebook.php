<?php
/**
 * ###############################################
 *
 * SWIFT Framework
 * _______________________________________________
 *
 * @author         Abhishek Mittal
 *
 * @package        SWIFT
 * @copyright      Copyright (c) 2001-2013, Kayako
 * @license        http://www.kayako.com/license
 * @link           http://www.kayako.com
 *
 * ###############################################
 */

class SWIFT_SetupDatabase_Facebook extends SWIFT_SetupDatabase
{
    public function __construct()
    {
        parent::__construct("facebook");
        return true;
    }

    public function __destruct()
    {
        parent::__destruct();
        return true;
    }

//	public function Install($_pageIndex)
//	{
//		parent::Install($_pageIndex);
//
//		/**
//		 * Cron
//		 */
//		SWIFT_Cron::Create('cronfetchfacebookfeed', APP_FACEBOOK, 'FacebookMinute', 'Index', '0', '0', '-1', true);
//
//		return true;
//	}

//    public function Install($_pageIndex)
//    {
//        parent::Install($_pageIndex);
//        //$this->ImportSettings();
//        return true;
//    }
//
//    public function Uninstall()
//    {
//        parent::Uninstall();
//        return true;
//    }
//
//    public function Upgrade()
//    {
//       // $this->ImportSettings();
//        return parent::Upgrade();
//    }
//
//
//
//
    public function LoadTables()
    {
		$this->AddTable('facebook', new SWIFT_SetupDatabaseTable(TABLE_PREFIX . "facebook", "facebookpostid C(255),
																ticketid I DEFAULT '0' NOTNULL"));

        return true;
    }
//
//    private function ImportSettings()
//    {
//        $this->Load->Library('Settings:SettingsManager');
//        $this->SettingsManager->Import('./'.SWIFT_APPSDIRECTORY.'/facebook/config/settings.xml');
//    }
}

?>