<?php declare(strict_types=1);
/**
 * Page Layout
 */

namespace App\View\Layout;

use SpryPhp\Model\View;
use App\View\Common\Head;
use App\View\Common\Alerts;

/**
 * Class for Page Layout
 */
class Page
{
    /**
     * Construct the Page Layout
     *
     * @param View   $view
     * @param string $title
     */
    public function __construct(View $view, $title = '')
    {
        ?><?php new Head($title); ?>

        <body class="layout-page pt-2">
            <?php new Alerts(); ?>
            <?php $view->render(); ?>

        </body>
</html>
        <?php
    }
}
