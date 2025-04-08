<?php declare(strict_types=1);
/**
 * FormSelect View
 */

namespace App\View\Page;

use SpryPhp\Model\View;
use SpryPhp\Provider\Session;

/**
 * Class for FormSelect View
 */
class Home extends View
{
    /**
     * Render the Login View
     */
    public function render()
    {
        // $user = Session::getUser();
        ?>

        <h1>Home Page</h1>
        <h4><?= Session::getCsrf(); ?>
        <h4><?= Session::getUser()->name ?? 'Unknown'; ?>

        <?php
    }
}
