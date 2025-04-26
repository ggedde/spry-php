<?php declare(strict_types=1);
/**
 * Home Page View
 */

namespace App\View\Page;

use SpryPhp\Model\View;
use SpryPhp\Provider\Session;

/**
 * Class for Home Page View
 */
class Home extends View
{
    /**
     * Render the Home Page View
     */
    public function render(): void
    {
        $user = Session::getUser();
        ?>

            <h1>Home Page</h1>
            <h3><?= $user->name ?? 'Unknown'; ?>
        <?php
    }
}
