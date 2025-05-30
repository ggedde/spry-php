<?php declare(strict_types=1);
/**
 * JS Force Reload on Back navigation if Needed.
 */

namespace App\View\Assets;

/**
 * Class for JsForceReloadOnBack
 */
class JsForceReloadOnBack
{
    /**
     * Construct the JsForceReloadOnBack Asset
     */
    public function __construct()
    {
        ?>

        <script>
            // Check if using Back Button and if so make sure page renders.
            window.addEventListener("pageshow", function(event) {
                if (event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2)) {
                    window.location.reload();
                }
            });
        </script>
        <?php
    }
}
