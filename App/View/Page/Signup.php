<?php declare(strict_types=1);
/**
 * Signup View
 */

namespace App\View\Page;

use App\View\Common\Alerts;
use App\View\Common\Csrf;
use SpryPhp\Model\PageMeta;
use SpryPhp\Model\View;

/**
 * Class for Signup View
 */
class Signup extends View
{
    /**
     * Get the Page Head Meta
     *
     * @return PageMeta
     */
    public function meta(): PageMeta
    {
        return new PageMeta(
            title:       'Signup',
            description: 'Signup into '.APP_TITLE,
        );
    }

    /**
     * Render the Signup View
     */
    public function render(): void
    {
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
                        <h4>Signup</h4>
                    </header>
                    <div class="column g-3 p-4 primary show-invalid">
                        <label class="lg">
                            <small class="block mb-2">Name <small class="color-gray ml-2">Your Full Name</small></small>
                            <input type="text" name="name" placeholder=" " autocomplete="name" minlength="2" required>
                            <small class="invalid color-error pt-2">Full Name is Required</small>
                        </label>

                        <label class="lg">
                            <small class="block mb-2">Email <small class="color-gray ml-2">Will Require Verification</small></small>
                            <input type="email" name="email" placeholder=" " autocomplete="email" minlength="5" required>
                            <small class="invalid color-error pt-2">Invalid Email Address</small>
                        </label>

                        <label class="lg mb-3">
                            <small class="block mb-2">Password <small class="color-gray ml-2">Must be a Strong Password</small></small>
                            <input type="password" name="password" placeholder=" " autocomplete="current-password" minlength="8" required>
                            <small class="invalid color-error pt-2">Password is Required</small>
                        </label>

                        <div class="mb-3">
                            <label>
                                <input class="lg" type="checkbox" name="accept" value="1" required>
                                I Agree and Accept to the: <small class="invalid color-error ml-2">This is Required</small>
                            </label>
                            <a class="ml-4" target="_blank" href="/terms">Terms and Conditions</a> and <a target="_blank" href="/privacy">Privacy Policy</a>
                        </div>

                        <button class="primary block" type="submit">Login</button>
                    </div>
                </article>
            </form>
        </div>
        <?php
    }
}
