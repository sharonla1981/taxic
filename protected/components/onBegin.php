<?php

/**
 * Description of onBegin
 *
 * @author Sharon
 */
class onBegin 
{
  public function BeginRequest(CEvent $event)
  {
        
        Yii::app()->language=Yii::app()->request->getPreferredLanguage();
        
      
        if (Yii::app()->detectMobileBrowser->showMobile)
            {
                Yii::app()->theme = "mobile";
            }
  }
}

?>
