<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Core\Base;

class MyAvatarHelper extends Base
{
    /**
     * Render user avatar
     *
     * @access public
     * @param  string  $user_id
     * @param  string  $username
     * @param  string  $name
     * @param  string  $email
     * @param  string  $avatar_path
     * @param  string  $css
     * @param  int     $size
     * @return string
     */
    public function render($user_id, $username, $name, $email, $avatar_path, $css = 'avatar-left', $size = 48)
    {
        if (empty($user_id) && empty($username)) {
            $html = $this->avatarManager->renderDefault($size);
        } else {
            $html = $this->avatarManager->render($user_id, $username, $name, $email, $avatar_path, $size);
        }

        return '<div class="avatar avatar-'.$size.' '.$css.'">'.$html.'</div>';
    }

    /**
     * Render small user avatar
     *
     * @access public
     * @param  string $user_id
     * @param  string $username
     * @param  string $name
     * @param  string $email
     * @param  string $avatar_path
     * @param  string $css
     * @return string
     */
    public function small($user_id, $username, $name, $email, $avatar_path, $css = '')
    {
        return $this->render($user_id, $username, $name, $email, $avatar_path, $css, 38);
    }

    /**
     * Get a small avatar for the current user
     *
     * @access public
     * @param  string $css
     * @return string
     */
    public function currentUserSmall($css = '')
    {
        $user = $this->userSession->getAll();
        return $this->small($user['id'], $user['username'], $user['name'], $user['email'], $user['avatar_path'], $css);
    }
}
