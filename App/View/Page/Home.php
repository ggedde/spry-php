<?php declare(strict_types=1);
/**
 * Home Page View
 */

namespace App\View\Page;

use SpryPhp\Model\View;

/**
 * Class for Home Page View
 */
class Home extends View
{
    /**
     * Render the Home Page View
     */
    public function render()
    {
        ?>

            <h1>Home Page</h1>
        <?php
    }
}
