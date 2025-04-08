<?php

declare(strict_types=1);
/**
 * Head View
 */

namespace App\View\Common;

use App\View\Assets\JsForceReloadOnBack;
use App\View\Assets\JsPingQueue;
use App\View\Assets\JsSessionTimer;

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
        ?><!doctype html>
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

            <?php new JsForceReloadOnBack(); ?>
            <?php new JsPingQueue(); ?>

        </head>
        <?php
    }
}
