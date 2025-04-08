<?php declare(strict_types=1);
/**
 * JS Ping the Queue Route
 */

namespace App\View\Assets;

use SpryPhp\Provider\Session;

/**
 * Class for JsPingQueue
 */
class JsPingQueue
{
    /**
     * Construct the JsPingQueue Asset
     */
    public function __construct()
    {
        if (defined('APP_URI_QUEUE')) {
            ?>

            <script>
            async function pingQueue() {
                try {
                    const response = await fetch('<?= APP_URI_QUEUE; ?>', {
                        method: 'POST',
                        headers: new Headers({
                            'Content-Type': 'application/x-www-form-urlencoded',
                        }),
                        body: 'csrf=<?= Session::getCsrf() ?? ''; ?>'
                    });
                    if (response.ok) {
                        return true;
                    }
                } catch (error) {
                    return false;
                }

                return false;
            }

            window.addEventListener('load', () => {
                pingQueue();
            });
            </script>
            <?php
        }
    }
}
