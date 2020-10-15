<?php

namespace Kanboard\Plugin\MyCustom;


use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\MarkdownPlus\Helper\MarkdownPlusHelper;


class Plugin extends Base

{
	public function initialize()
	{
        $this->hook->on('template:layout:js', array('template' => 'plugins/MyCustom/Assets/js/jump_theme.js'));
	}
}
