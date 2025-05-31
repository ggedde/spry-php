<?php declare(strict_types=1);
/**
 * Dashboard View
 */

namespace App\View\Portal;

use App\Model\User;
use SpryPhp\Model\View;
use SpryPhp\Model\PageMeta;
use SpryPhp\Provider\Functions;
use SpryPhp\Provider\Session;

/**
 * Class for Dashboard View
 */
class Dashboard extends View
{
    /**
     * Set the Page Meta
     *
     * @return PageMeta
     */
    public function meta(): PageMeta
    {
        return new PageMeta(
            title:       'Dashboard',
            description: 'Welcome to Dashboard',
        );
    }

    /**
     * Render the Dashboard View
     */
    public function render(): void
    {
        $user = Session::getUser();
        if ($user->id) {
            $u = new User($user->id);
        }
        ?>
            Welcome to your Dashboard <?= $user->name; ?>
        <?php
    }
}
