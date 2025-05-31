<?php declare(strict_types=1);
/**
 * AdminLayout Layout
 */

namespace App\View\Layout;

use App\View\Assets\JsSessionTimer;
use SpryPhp\Provider\Route;
use SpryPhp\Provider\Session;
use SpryPhp\Model\View;
use App\View\Common\Alerts;
use App\View\Common\Csrf;
use App\View\Common\Head;
use App\View\Common\ModalSessionExtend;

/**
 * Class for AdminLayout Layout
 */
class AdminLayout
{
    /**
     * Construct the AdminLayout Layout
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        if (!Session::getUser() && defined('APP_URI_LOGIN')) {
            Route::redirect(APP_URI_LOGIN);
        }

        $user = Session::getUser();

        ?><?php new Head(); ?>
        <body class="layout-dashboard">
            <div class="bg-inherit md:row block-start" style="gap: 0">
                <div class="sticky index-4" style="max-width: 200px;">
                    <div class="flex block-center between fixed top w/100 r-0 lg bg-faint pl-2 bb-1 pr-2 glow-theme glow-2 glow/100 p-2">
                        <div class="flex block-center navigable">
                            <button class="button link icon menu sm a:close md:none" aria-label="Toggle Menu" data-toggle="next" data-toggle-dismissible></button>
                            <div class="collapse md:open f:open from-left">
                                <nav style="max-width: 200px; height: calc(100vh - 3.50em);" class="list g-1 absolute left outer-bottom bg-theme border-alpha-30 auto p-3 pb-4 sm br-1 bt-1 shadow md:shadow-none scrollspy" data-scrollspy-replace>
                                    <ul>
                                        <li>
                                            <a class="h5 g-2" href="/users">
                                                <svg class="icon sm mr-1" viewBox="0 0 24 24"><path d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9 3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3 3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3 3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.536 5.536 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13v-1.75M0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9-.59.68-.95 1.62-.95 2.65V20H0m24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65 2.56.34 4.45 1.51 4.45 2.9V20z" /></svg>
                                                Users
                                            </a>
                                        </li>
                                        <li>
                                            <a class="h5 g-2" href="/admin">
                                                <svg class="icon sm mr-2" viewBox="0 0 24 24"><path d="M13 3v6h8V3m-8 18h8V11h-8M3 21h8v-6H3m0-2h8V3H3v10z" /></svg>
                                                Components
                                            </a>

                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <a class="flex mr-2 md:mr-3 ml-2 color-contrast" href="/admin">
                                <svg class="icon circle outline border/50 mr-3 xs border-contrast none md:inline p-1" viewBox="0 0 24 24"><path d="M12.89,3L14.85,3.4L11.11,21L9.15,20.6L12.89,3M19.59,12L16,8.41V5.58L22.42,12L16,18.41V15.58L19.59,12M1.58,12L8,5.58V8.41L4.41,12L8,15.58V18.41L1.58,12Z" /></svg>
                                <span class="bg-contrast bg-to-secondary clip-text">Admin</span>
                            </a>
                        </div>
                        <div class="flex g-3 sm">
                            <button class="icon link circle" onclick="spryJs.query('body').toggleClass('scheme-toggle');" title="Toggle Theme" aria-label="Toggle Theme">
                                <svg class="xl" viewBox="0 0 24 24"><path d="M12,18V6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,15.31L23.31,12L20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31Z" /></svg>
                            </button>
                            <form method="post" action="/logout">
                                <?php new Csrf(); ?>
                                <button class="link" type="submit" title="Logout" aria-label="Logout">
                                    <svg class="icon" viewBox="0 0 24 24"><path d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9z" /></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                <main class="bg-inherit p-3" style="margin-top: 3.5em;">

                    <?php new Alerts(); ?>
                    <?php $view->render(); ?>

                </main>
            </div>

            <!-- Session Timeout Modal -->
            <div id="session-timeout-modal" class="modal bg-blur-sm bounce">
                <article class="outline shadow g-1 mw-300 mx-auto">
                    <header>
                        <h5>Your Session is About to Expire</h5>
                    </header>
                    <div class="p-3 text-center">
                        <button type="button" class="primary" onclick="sessionExtend();">Keep me logged in</button>
                    </div>
                </article>
            </div>

            <!-- Session Timer and Timeout Modal -->
            <?php new JsSessionTimer(); ?>
        </body>

        </html>
        <?php
    }
}
