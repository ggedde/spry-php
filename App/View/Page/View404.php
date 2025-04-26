<?php declare(strict_types=1);
/**
 * 404 View
 */

namespace App\View\Page;

use SpryPhp\Model\View;

/**
 * Class for 404 View
 */
class View404 extends View
{
    /**
     * Render the 404 View
     */
    public function render(): void
    {
        ?>
        <h1 class="text-center color-grey">404 | Page not found.</h1>
        <?php
    }
}
