<?php declare(strict_types=1);
/**
 * Alerts View
 */

namespace App\View\Common;

/**
 * Class for Alerts View
 */
class Alerts
{
    /**
     * Construct the Alerts View
     */
    public function __construct()
    {
        $alerts = \SpryPhp\Provider\Alerts::get();

        if (!empty($alerts)) {
            ?>
            <div class="alerts-container">
                <?php foreach ($alerts as $alert) { ?>
                    <div class="expand alert-container from-center">
                        <div>
                            <div class="alert outline mx-auto pr-2 mb-2 <?= $alert->type; ?>">
                                <?= $alert->message; ?>
                                <button class="hazy b-0 circle xs icon absolute top right m-1" onclick="this.closest('.open').classList.remove('open')">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    }
}
