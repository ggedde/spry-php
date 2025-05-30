<?php declare(strict_types=1);
/**
 * Page Layout
 */

namespace App\View\Layout;

use SpryPhp\Model\View;
use App\View\Common\Head;
use App\View\Common\Footer;

/**
 * Class for Page Layout
 */
class Page
{
    /**
     * Construct the Page Layout
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        new Head($view->meta());
        echo PHP_EOL;
        ?>
    <body class="layout-page m-4">
        <?php
            echo PHP_EOL;
            $view->render();
            echo PHP_EOL;
            new Footer($view->meta());
            echo PHP_EOL;
        ?>
    </body>
</html>
        <?php
    }
}
