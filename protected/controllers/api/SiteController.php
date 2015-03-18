<?php

class SiteController extends SimbApiController
{
   
 /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        print_r($_SESSION);

    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->renderPartial('error', $error);
        }
    }
    
    public function actionRunReports() {
        $commandPath = Yii::app()->getBasePath() . DIRECTORY_SEPARATOR . 'commands';
        $runner = new CConsoleCommandRunner();
        $runner->addCommands($commandPath);
        $commandPath = Yii::getFrameworkPath() . DIRECTORY_SEPARATOR . 'cli' . DIRECTORY_SEPARATOR . 'commands';
        $runner->addCommands($commandPath);
        
        $args = array('yiic', 'reportmail', '--interactive=0');
        ob_start();
        $runner->run($args);
        echo htmlentities(ob_get_clean(), null, Yii::app()->charset);
    }    
  
}