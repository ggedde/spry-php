<?php declare(strict_types=1);
/**
 * Users View
 */

namespace App\View\Admin;

use SpryPhp\Model\View;
use SpryPhp\Model\PageMeta;

/**
 * Class for Users View
 */
class Users extends View
{
    /**
     * Set the Page Meta
     *
     * @return PageMeta
     */
    public function meta(): PageMeta
    {
        return new PageMeta(
            title:       'Users',
            description: 'Welcome to Users',
        );
    }

    /**
     * Render the Users View
     */
    public function render(): void
    {
        ?>
            Users Page
        <?php
    }
}
