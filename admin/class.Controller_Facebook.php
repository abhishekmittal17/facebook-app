<?php
/**
 * Created by JetBrains PhpStorm.
 * User: abhishek
 * Date: 11/29/12
 * Time: 2:22 PM
 * To change this template use File | Settings | File Templates.
 */


     class Controller_Facebook extends Controller_admin
     {
         // Core Constants
         const MENU_ID = 111;
         const NAVIGATION_ID = 1;

         public function __construct()
         {
             parent::__construct();
             $this->Language->Load('facebook');
             return true;
         }

         public function __destruct()
         {
             parent::__destruct();
             return true;
         }

         public function Render()
         {
             if (!$this->GetIsClassLoaded())
             {
                 throw new      SWIFT_Exception(SWIFT_CLASSNOTLOADED);

                 return false;
             }

             $this->UserInterface->Header( "Title", self::MENU_ID, self::NAVIGATION_ID);
             $this->UserInterface->Start(get_class($this), '/facebook/Facebook/Render', SWIFT_UserInterface::MODE_INSERT, false);

             $this->View->Render();

             $this->UserInterface->End();
             $this->UserInterface->Footer();
         }

         public function SubmitExample($submitValue = false)
         {

             if(!$this->GetIsClassLoaded())
             {
                 throw new SWIFT_Exception(SWIFT_CLASSNOTLOADED);
                 return false;
             }
             $this->UserInterface->Header(   $this->Language->Get('fb_name').' -   '.$this->Language->Get('fb_submitExample'), self::MENU_ID,   self::NAVIGATION_ID);

             $this->View->RenderSubmit($submitValue);

             $this->UserInterface->Footer();
         }

         public function ProcessSubmit()
         {
             if (!$this->GetIsClassLoaded())
             {
                 throw new SWIFT_Exception(SWIFT_CLASSNOTLOADED);
                 return false;
             }
             $submitValue = "";

             if(isset($_POST['subVal']))
             {
                 $submitValue = trim($_POST['subVal']);
             }


             $this->Load->SubmitExample($submitValue);
             return false;
         }

     }

     ?>