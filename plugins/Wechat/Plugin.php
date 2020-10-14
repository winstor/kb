<?php

namespace Kanboard\Plugin\Wechat;

require_once __DIR__.'/vendor/autoload.php';

use Kanboard\Core\Translator;
use Kanboard\Core\Plugin\Base;

/**
 * Telegram Plugin
 *
 * @package  telegram
 * @author   Manu Varkey
 */
class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:config:integrations', 'wechat:config/integration');
        $this->template->hook->attach('template:project:integrations', 'wechat:project/integration',array('bot_name' =>  $this->configModel->get('telegram_username')) );
        $this->template->hook->attach('template:user:integrations', 'wechat:user/integration',array('bot_name'=> $this->configModel->get('telegram_username')) );

        $this->userNotificationTypeModel->setType('wechat', t('Wechat'), '\Kanboard\Plugin\Wechat\Notification\Telegram');
        $this->projectNotificationTypeModel->setType('wechat', t('Wechat'), '\Kanboard\Plugin\Wechat\Notification\Telegram');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginDescription()
    {
        return 'Receive notifications on Telegram';
    }

    public function getPluginAuthor()
    {
        return 'Manu Varkey';
    }

    public function getPluginVersion()
    {
        return '1.3.2';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/manuvarkey/plugin-telegram';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
