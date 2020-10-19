<?php

namespace Kanboard\Plugin\Sesame;


use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\MarkdownPlus\Helper\MarkdownPlusHelper;


class Plugin extends Base

{
	public function initialize()
	{
        $this->hook->on('template:layout:js', array('template' => 'plugins/Sesame/Assets/js/jump_theme.js'));
	}
}
