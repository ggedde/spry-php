<?php declare(strict_types=1);
/**
 * Dashboard Layout
 */

namespace App\View\Layout;

use SpryPhp\Provider\Route;
use SpryPhp\Provider\Session;
use SpryPhp\Model\View;
use App\View\Common\Alerts;
use App\View\Common\Csrf;
use App\View\Common\Head;

/**
 * Class for Dashboard Layout
 */
class Dashboard
{
    /**
     * Construct the Dashboard Layout
     *
     * @param View $view
     */
    public function __construct(View $view)
    {
        if (!Session::getUser()) {
            Route::goTo('/login');
        }

        ?><?php new Head(); ?>
        <body class="layout-dashboard">
            <div class="bg-inherit">
                <div data-x-data="{open: false}" class="sticky toolbar sharp index-4 bg-faint border-alpha-20 pl-1 bb-1 pr-1">
                    <div class="flex items-center">
                        <h5 class="flex items-center">
                            <a class="flex items-center color-contrast mr-2 md:mr-3 ml-1 sm" href="/">
                                <svg class="color-contrast" width="100" viewBox="0 0 300 50">
                                    <path fill="currentColor" d="M.37 9.73v39.09c0 .34.27.61.61.61h8.55c.34 0 .61-.27.61-.61V34.16c0-.34.27-.61.61-.61h15.88c.34 0 .61.27.61.61v14.66c0 .34.27.61.61.61h8.55c.34 0 .61-.27.61-.61V9.73c0-5.06-4.1-9.16-9.16-9.16H9.54C4.48.57.38 4.67.38 9.73H.37ZM27.24 25h-17.1V10.34c0-.68.55-1.22 1.22-1.22h14.66c.68 0 1.22.55 1.22 1.22V25ZM262.98 1.18v47.64c0 .34.27.61.61.61h8.55c.34 0 .61-.27.61-.61V9.12h15.88c.68 0 1.22.55 1.22 1.22v38.48c0 .34.27.61.61.61h8.55c.34 0 .61-.27.61-.61V9.73c0-5.06-4.1-9.16-9.16-9.16h-26.87c-.34 0-.61.27-.61.61ZM211.07.57h-8.94c-.99 0-1.88.6-2.26 1.51l-7.1 17.14c-.38.91-1.27 1.51-2.26 1.51h-6.31V1.18c0-.34-.27-.61-.61-.61h-8.55c-.34 0-.61.27-.61.61v47.64c0 .34.27.61.61.61h8.55c.34 0 .61-.27.61-.61V29.28h6.31c.99 0 1.88.6 2.26 1.51l7.1 17.14c.38.91 1.27 1.51 2.26 1.51h8.94l-9.73-23.49c-.25-.6-.25-1.27 0-1.87L211.07.57ZM76.71 49.43H48.62c-1.35 0-2.44-1.09-2.44-2.44V1.18c0-.34.27-.61.61-.61h8.55c.34 0 .61.27.61.61v39.7h15.59c.99 0 1.88.6 2.26 1.51l2.92 7.04ZM85.26.57l2.92 7.04c.38.91 1.27 1.51 2.26 1.51h18.03c.68 0 1.22.55 1.22 1.22v4.86c0 .99-.6 1.88-1.51 2.26l-19.71 8.16a9.173 9.173 0 0 0-5.66 8.46v6.19c0 5.06 4.1 9.16 9.16 9.16h18.32c5.06 0 9.16-4.1 9.16-9.16V9.73c0-5.06-4.1-9.16-9.16-9.16H85.25Zm23.21 40.31H93.81c-.68 0-1.22-.55-1.22-1.22V34.8c0-.99.6-1.88 1.51-2.26l15.59-6.46v13.57c0 .68-.55 1.22-1.22 1.22ZM155.5 15.84v-5.5c0-.68-.55-1.22-1.22-1.22h-14.66c-.68 0-1.22.55-1.22 1.22v4.86c0 .99.6 1.88 1.51 2.26l19.71 8.16a9.173 9.173 0 0 1 5.66 8.46v6.19c0 5.06-4.1 9.16-9.16 9.16H137.8c-5.06 0-9.16-4.1-9.16-9.16v-6.11c0-.34.27-.61.61-.61h8.55c.34 0 .61.27.61.61v5.5c0 .68.55 1.22 1.22 1.22h14.66c.68 0 1.22-.55 1.22-1.22V34.8c0-.99-.6-1.88-1.51-2.26l-19.71-8.16a9.173 9.173 0 0 1-5.66-8.46V9.73c0-5.06 4.1-9.16 9.16-9.16h18.32c5.06 0 9.16 4.1 9.16 9.16v6.11c0 .34-.27.61-.61.61h-8.55c-.34 0-.61-.27-.61-.61ZM222.54 2.08l-2.92 7.04h23.21c.68 0 1.22.55 1.22 1.22v4.86c0 .99-.6 1.88-1.51 2.26l-19.71 8.17a9.173 9.173 0 0 0-5.66 8.46v6.19c0 5.06 4.1 9.16 9.16 9.16h18.32c5.06 0 9.16-4.1 9.16-9.16V9.73c0-5.06-4.1-9.16-9.16-9.16h-19.87c-.99 0-1.88.6-2.26 1.51Zm20.29 38.8h-14.66c-.68 0-1.22-.55-1.22-1.22V34.8c0-.99.6-1.88 1.51-2.26l15.59-6.46v13.57c0 .68-.55 1.22-1.22 1.22Z"></path>
                                    <path fill="currentColor" d="m82.75 19.17-6.62 2.74c-.3.12-.54.36-.66.66l-2.74 6.62c-.11.25-.46.25-.56 0l-2.74-6.62c-.12-.3-.36-.54-.66-.66l-6.62-2.74c-.25-.11-.25-.46 0-.56l6.62-2.74c.3-.12.54-.36.66-.66l2.74-6.62c.11-.25.46-.25.56 0l2.74 6.62c.12.3.36.54.66.66l6.62 2.74c.25.11.25.46 0 .56Z"></path>
                                </svg>
                                <i class="icon circle mr-1 ml-2 border-primary">
                                    <svg viewBox="0 0 24 24"><path d="M12 20a8 8 0 0 0 8-8 8 8 0 0 0-8-8 8 8 0 0 0-8 8 8 8 0 0 0 8 8m0-18a10 10 0 0 1 10 10 10 10 0 0 1-10 10C6.47 22 2 17.5 2 12A10 10 0 0 1 12 2m.5 5v5.25l4.5 2.67-.75 1.23L11 13V7h1.5z" /></svg>
                                </i>
                                <span class="none md:inline">Time Tracker</span> 
                            </a>
                        </h5>
                    </div>
                    <div class="sm row g-1">
                        <button class="shy link span-auto circle sm" onclick="toggleTheme();" title="Toggle Theme" aria-label="Toggle Theme">
                            <svg class="icon xl" viewBox="0 0 24 24">
                                <path d="M12,18V6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,15.31L23.31,12L20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31Z" />
                            </svg>
                        </button>
                        <div class="row relative w-content">
                            <button class="link pill content-start" data-toggle="hover" data-toggle-escapable data-toggle-dismissible aria-pressed="false">
                                <svg class="icon lg md:mr-1" viewBox="0 0 24 24"><path d="M12 4a4 4 0 0 1 4 4 4 4 0 0 1-4 4 4 4 0 0 1-4-4 4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4z" /></svg>
                                <span class="none md:inline"><?= !empty(Session::getUser()->name) ? Session::getUser()->name : 'Unknown'; ?></span>
                            </button>
                            <nav class="absolute lg out-bottom right list navigable bg-faint round shadow p-1 text-left w" style="min-width: 120px;">
                                <form method="post" action="/logout">
                                    <?php new Csrf(); ?>
                                    <button class="link pill" type="submit" title="Logout" aria-label="Logout">
                                        <svg class="icon mr-1" viewBox="0 0 24 24"><path d="M16 17v-3H9v-4h7V7l5 5-5 5M14 2a2 2 0 0 1 2 2v2h-2V4H5v16h9v-2h2v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9z" /></svg>
                                        Logout
                                    </button>
                                </form>
                            </nav>
                        </div>
                    </div>
                </div>
                <main class="bg-inherit clip-x pt-4">
                    <?php new Alerts(); ?>
                    <?php $view->render(); ?>
                </main>
            </div>

            <!-- Session Timeout Modal -->
            <?php new View('components/modalSession'); ?>
        </body>

        </html>
        <?php
    }
}
