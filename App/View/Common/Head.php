<?php

declare(strict_types=1);
/**
 * Head View
 */

namespace App\View\Common;

use SpryPhp\Provider\Session;

/**
 * Class for Head View
 */
class Head
{
    /**
     * Construct the Head View
     *
     * @param string $title
     */
    public function __construct(string $title = '')
    {
        ?>
        <!doctype html>
        <html lang="en-US">

        <head>
            <title><?= $title ? $title.' - ' : ''; ?><?= APP_TITLE; ?></title>
            <meta name="description" content="<?= APP_TITLE; ?>">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">

            <meta name="application-name" content="<?= APP_TITLE; ?>">
            <meta name="msapplication-TileColor" content="#888888">
            <meta name="theme-color" content="#ffffff">

            <meta name="robots" content="noindex, nofollow">
            <script>
                const _csrf = '<?= Session::getCsrf(); ?>';
                const _ttl = <?= Session::getTTL(); ?>;
                const _logged_in_cookie_name = '<?= defined('APP_SESSION_COOKIE_NAME_ACTIVE') ? APP_SESSION_COOKIE_NAME_ACTIVE : ''; ?>';
                let _sessionTimer = null;

                console.log(_csrf);
                console.log(_ttl);
                

                window.addEventListener('load', () => {
                    sessionStartTimer();
                    pingQueue();
                });

                // Ping the Queue Route
                async function pingQueue() {
                    try {
                        const response = await fetch('/queue', {
                            method: 'POST',
                            headers: new Headers({
                                'Content-Type': 'application/x-www-form-urlencoded',
                            }),
                            body: 'csrf='+_csrf
                        });
                        if (response.ok) {
                            return true;
                        }
                    } catch (error) {
                        return false;
                    }

                    return false;
                }

                // Extend Session
                async function sessionExtend() {
                    const response = await pingQueue();
                    if (response) {
                        document.getElementById('session-timeout-modal').classList.remove('open');
                        sessionStartTimer();
                    }
                }

                // Start Session Timer
                function sessionStartTimer() {
                    const timeBefore = 60; // Seconds.
                    clearTimeout(_sessionTimer);

                    if (_csrf && _ttl > 0) {
                        setTimeout(() => {
                            document.getElementById('session-timeout-modal').classList.add('open');
                        }, (_ttl - timeBefore) * 1000);

                        _sessionTimer = setTimeout(() => {
                            fetch('/logout', {
                                method: 'POST',
                                headers: new Headers({
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                }),
                                body: 'csrf='+_csrf+'&session=expired'
                            }).then((response) => {
                                if (response.ok) {
                                    window.location.href = '/login';
                                }
                            });
                        }, _ttl * 1000);
                    }
                }
                <?php if (!Session::getUser()) { ?> 
                // Check if using Back Button and if so make sure page renders.
                window.addEventListener("pageshow", function(event) {
                    if (event.persisted || (typeof window.performance != "undefined" && window.performance.navigation.type === 2)) {
                        // Handle page restore.
                        window.location.reload();
                        // this.document.documentElement.style.display = 'none';
                    }
                });
                <?php } ?> 
            </script>

        </head>
        <?php
    }
}
