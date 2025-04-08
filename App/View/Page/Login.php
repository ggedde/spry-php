<?php declare(strict_types=1);
/**
 * Login View
 */

namespace App\View\Page;

use SpryPhp\Model\View;
use SpryPhp\Provider\Session;

/**
 * Class for Login View
 */
class Login extends View
{
    /**
     * Render the Login View
     */
    public function render()
    {
        ?>
        <form method="post" onsubmit="formSubmit(event)">
            <div class="mw-400 m-auto">
                <article class="outline clip shadow g-0">
                    <header>
                        <h4>Login</h4>
                    </header>
                    <div class="p-3 primary show-invalid">
                        <label class="lg my-3">
                            <input type="hidden" name="csrf" value="<?= Session::getCsrf(); ?>">
                            <input type="password" name="password" placeholder=" " autocomplete="current-password" required>
                            <sup class="color-primary">Password</sup>
                        </label>

                        <button class="mt-2 primary block" type="submit">Login</button>
                    </div>
                </article>
            </div>
        </form>
        <?php
    }
}
