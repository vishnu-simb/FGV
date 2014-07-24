<?php

class SimbWebApplicationEndBehavior extends CBehavior
{
    // Web application end's name.
    private $_endName;

    // Getter.
    // Allows to get the current -end's name
    // this way: Yii::app()->endName;
    public function getEndName()
    {
        return $this->_endName;
    }

    // Run application's end.
    public function runEnd($name)
    {
        $this->_endName = $name;

        // Attach the changeModulePaths event handler
        // and raise it.
        $this->onModuleCreate = array($this, 'changeModulePaths');
        $this->onModuleCreate(new CEvent($this->owner));

        $this->owner->run(); // Run application.
    }

    // This event should be raised when CWebApplication
    // or CWebModule instances are being initialized.
    public function onModuleCreate($event)
    {
        $this->raiseEvent('onModuleCreate', $event);
    }

    // onModuleCreate event handler.
    // A sender must have controllerPath and viewPath properties.
    protected function changeModulePaths($event)
    {
        $event->sender->controllerPath .= DIRECTORY_SEPARATOR . $this->_endName;
        $event->sender->viewPath .= DIRECTORY_SEPARATOR . $this->_endName;

        // Re-assign the theme Base Path
        $event->sender->themeManager->basePath = $event->sender->basePath . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . CThemeManager::DEFAULT_BASEPATH . DIRECTORY_SEPARATOR . $this->_endName;
        // Set the base Url for theme
        $event->sender->themeManager->setBaseUrl($event->sender->params['absUrl'] . '/'.CThemeManager::DEFAULT_BASEPATH.'/' . $this->_endName);
    }
}