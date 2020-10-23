<?php

namespace Kanboard\Plugin\Sesame;


use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\MarkdownPlus\Helper\MarkdownPlusHelper;


class Plugin extends Base

{
	public function initialize()
	{
	    //页面跳转进度条
        $this->jump();
        //$this->template->setTemplateOverride( 'task/details', 'Sesame:task_details' );
	}
    //页面跳转进度条
	protected function jump()
    {
        $this->hook->on('template:layout:js', array('template' => 'plugins/Sesame/Assets/js/jump_theme.js'));
    }
}
