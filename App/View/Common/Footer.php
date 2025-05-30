<?php declare(strict_types=1);
/**
 * Footer View
 */

namespace App\View\Common;

use SpryPhp\Model\PageMeta;

/**
 * Class for Footer View
 */
class Footer
{
    /**
     * Construct the Footer View
     *
     * @param PageMeta|null $meta
     */
    public function __construct(?PageMeta $meta = null)
    {
        if (!$meta) {
            $meta = new PageMeta();
        }
        echo $meta->footerHtml;
    }
}
