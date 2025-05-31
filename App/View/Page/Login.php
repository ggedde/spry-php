<?php declare(strict_types=1);
/**
 * Login View
 */

namespace App\View\Page;

use App\View\Common\Alerts;
use App\View\Common\Csrf;
use SpryPhp\Model\PageMeta;
use SpryPhp\Model\View;
use SpryPhp\Provider\Functions;
use SpryPhp\Provider\Request;
use SpryPhp\Provider\Session;

/**
 * Class for Login View
 */
class Login extends View
{
    /**
     * Get the Page Head Meta
     *
     * @return PageMeta
     */
    public function meta(): PageMeta
    {
        return new PageMeta(
            title:       'Login',
            description: 'Login into '.APP_TITLE,
        );
    }

    /**
     * Render the Login View
     */
    public function render(): void
    {
        $loginEmail = Session::get('loginEmail');

        ?>
        <div class="m-auto" style="max-width: 400px;">
            <?php
            new Alerts();
            echo PHP_EOL;
            ?>
            <form method="post">
                <?php new Csrf(); ?>
                <article class="card outline clip shadow r-2 g-0">
                    <header>
                        <h4>Login</h4>
                    </header>
                    <div class="column g-3 p-4 primary show-invalid">
                        <label class="lg">
                            <small class="block mb-2">Email</small>
                            <input type="email" name="email" placeholder=" " autocomplete="email" value="<?= $loginEmail && is_string($loginEmail) ? Functions::escAttr($loginEmail) : ''; ?>" required>
                            <small class="invalid color-error xsf pt-2">Invalid Email Address</small>
                        </label>

                        <label class="lg mb-4">
                            <small class="block mb-2">Password</small>
                            <input type="password" name="password" placeholder=" " autocomplete="current-password" required>
                            <small class="invalid color-error xsf pt-2">Password is Required</small>
                        </label>

                        <button class="primary block" type="submit">Login</button>
                    </div>
                </article>
            </form>
        </div>
        <?php
    }
}
