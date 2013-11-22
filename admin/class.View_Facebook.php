<?php
/**
 * Created by JetBrains PhpStorm.
 * User: abhishek
 * Date: 11/29/12
 * Time: 2:23 PM
 * To change this template use File | Settings | File Templates.
 */


     class View_Facebook extends SWIFT_View
     {
         public function __construct()
         {
             parent::__construct();
             $this->Load->Library('Settings:Settings');
             return true;
         }

         public function __destruct()
         {
             parent::__destruct();
             return true;
         }

         public function Render()
         {
             if($this->Settings->Get('fb_showPhrase'))
             {
                 echo "Facebook Integration!.....";
             }
             else
             {
                 echo "Nothing to show!";
             }
         }

         public function RenderSubmit($submitValue)
         {
             if (!$this->GetIsClassLoaded())
             {
                 return false;
             }

             $this->UserInterface->Start(get_class($this), '/facebook/Facebook/ProcessSubmit/' ,SWIFT_UserInterface::MODE_INSERT, false);
             $this->UserInterface->Toolbar->AddButton("Display Text", 'icon_check.gif');

             $_GeneralTabObject = $this->UserInterface->AddTab($this->Language->Get('tabgeneral'), 'icon_form.gif', 'general', true, false);
             $_GeneralTabObject->Text('subVal',"Text to Display");
             if($submitValue !== false)
             {
                 if($submitValue != "")
                     $_GeneralTabObject->RowHTML("<tr><td><b>You Submited This Text:</b></td><td>".$submitValue."</td></tr>");
                 else
                     $_GeneralTabObject->RowHTML("<tr><td colspan='2' style='color:red;'><b>You Did Not Submit Anything!</b></td></tr>");
             }
             $this->UserInterface->End();
             return true;
         }

     }
?>