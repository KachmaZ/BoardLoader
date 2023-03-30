<?php

namespace Kanboard\Plugin\BoardLoader;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        $this->route->addRoute('board/:project_id/download', 'BoardLoaderController', 'loadExcel', 'BoardLoader');

        $this->template->hook->attach('template:project:dropdown', 'boardLoader:project\dropdown');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        return 'BoardLoader';
    }

    public function getPluginDescription()
    {
        return t('Plugin gives an option to download board information as xlsx table');
    }

    public function getPluginAuthor()
    {
        return 'Arthur Kachmazov';
    }

    public function getPluginVersion()
    {
        return '0.0.2';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-myplugin';
    }
}

