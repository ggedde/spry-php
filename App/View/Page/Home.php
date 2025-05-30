<?php declare(strict_types=1);
/**
 * Home Page View
 */

namespace App\View\Page;

use SpryPhp\Model\PageMeta;
use SpryPhp\Model\View;
use SpryPhp\Provider\Session;

/**
 * Class for Home Page View
 */
class Home extends View
{
    /**
     * Get the Page Head Meta
     *
     * @return PageMeta
     */
    public function meta(): PageMeta
    {
        return new PageMeta(
            title:       'Home',
            description: 'Welcome to '.APP_TITLE,
        );
    }

    /**
     * Render the Home Page View
     */
    public function render(): void
    {
        $user = Session::getUser();
        ?>
        <h1>Home Page</h1>
        <h3><?= isset($user->name) && is_string($user->name) ? $user->name : 'Unknown'; ?></h3>
        <?php
    }
}
