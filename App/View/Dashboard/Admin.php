<?php declare(strict_types=1);
/**
 * FormSelect View
 */

namespace App\View\Dashboard;

use App\Model\User;
use SpryPhp\Model\View;
use SpryPhp\Provider\Session;

/**
 * Class for FormSelect View
 */
class Admin extends View
{
    /**
     * Render the Login View
     */
    public function render(): void
    {
        $user = Session::getUser();
        ?>
            Hello <?= $user->name; ?>
        <?php
    }
}
