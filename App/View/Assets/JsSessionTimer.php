<?php declare(strict_types=1);
/**
 * JS start Session Timer.
 */

namespace App\View\Assets;

use SpryPhp\Provider\Session;

/**
 * Class for JsSessionTimer
 */
class JsSessionTimer
{
    /**
     * Construct the JsSessionTimer Asset
     */
    public function __construct()
    {
        if (defined('APP_URI_LOGOUT') && defined('APP_URI_LOGIN')) {
            ?>

            <script>
            // Extend Session
            async function sessionExtend() {
                const response = await pingQueue();
                if (response) {
                    document.getElementById('session-timeout-modal')?.classList.remove('open');
                    sessionStartTimer();
                }
            }

            // Start Session Timer
            let _sessionTimer = null;
            function sessionStartTimer() {
                const timeBefore = 60; // Seconds.
                const ttl = <?= Session::getTTL(); ?>;
                clearTimeout(_sessionTimer);

                if ('<?= Session::getCsrf() ?? ''; ?>' && ttl > 0) {
                    setTimeout(() => {
                        document.getElementById('session-timeout-modal')?.classList.add('open');
                    }, (ttl - timeBefore) * 1000);

                    _sessionTimer = setTimeout(() => {
                        fetch('<?= APP_URI_LOGOUT; ?>', {
                            method: 'POST',
                            headers: new Headers({
                                'Content-Type': 'application/x-www-form-urlencoded',
                            }),
                            body: 'csrf=<?= Session::getCsrf() ?? ''; ?>&session=expired'
                        }).then((response) => {
                            if (response.ok) {
                                window.location.href = '<?= APP_URI_LOGIN; ?>';
                            }
                        });
                    }, ttl * 1000);
                }
            }

            window.addEventListener('load', () => {
                sessionStartTimer();
            });
            </script>
            <?php
        }
    }
}
