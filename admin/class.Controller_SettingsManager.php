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

class Controller_SettingsManager extends Controller_admin
{
    // Core Constants
    const MENU_ID = 111;
    const NAVIGATION_ID = 1;

    public function __construct()
    {
        parent::__construct();
        $this->Load->Library('Settings:SettingsManager');
        $this->Language->Load('facebook');
        $this->Language->Load('settings');
        return true;
    }

    public function __destruct()
    {
        parent::__destruct();
        return true;
    }


    public function Index()
    {
        $_SWIFT = SWIFT::GetInstance();

        if (!$this->GetIsClassLoaded())
        {
            throw new SWIFT_Exception(SWIFT_CLASSNOTLOADED);

            return false;
        }

        $this->UserInterface->Header( $this->Language->Get('fb_name').' - '.$this->Language->Get('fb_settingName'), self::MENU_ID, self::NAVIGATION_ID);

        if ($_SWIFT->Staff->GetPermission('admin_canupdatesettings') == '0')
        {
            $this->UserInterface->DisplayError($this->Language->Get('titlenoperm'), $this->Language->Get('msgnoperm'));
        } else {
            $this->UserInterface->Start(get_class($this), '/facebook/SettingsManager/Index', SWIFT_UserInterface::MODE_INSERT, false);
            $this->SettingsManager->Render($this->UserInterface, SWIFT_SettingsManager::FILTER_NAME, array('settings_fb'));
            $this->UserInterface->End();
        }

        $this->UserInterface->Footer();

        return true;
    }
}
?>