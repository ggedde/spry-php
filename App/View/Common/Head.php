<?php declare(strict_types=1);
/**
 * Head View
 */

namespace App\View\Common;

use SpryPhp\Model\PageMeta;
use App\View\Assets\JsForceReloadOnBack;
use App\View\Assets\JsPingQueue;

/**
 * Class for Head View
 */
class Head
{
    /**
     * Construct the Head View
     *
     * @param PageMeta|null $meta
     */
    public function __construct(?PageMeta $meta = null)
    {
        if (!$meta) {
            $meta = new PageMeta();
        }
        ?><!doctype html>
<html lang="en-US">
    <head>
        <title><?= $meta->title ? $meta->title.' - ' : ''; ?><?= APP_TITLE; ?></title>
        <meta name="description" content="<?= $meta->description; ?>">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5">

        <meta name="application-name" content="<?= APP_TITLE; ?>">
        <meta name="msapplication-TileColor" content="#888888">
        <meta name="theme-color" content="#ffffff">

        <meta name="robots" content="<?= $meta->index ? 'index' : 'noindex'; ?>, <?= $meta->follow ? 'follow' : 'nofollow'; ?>">

        <link rel="stylesheet" href="/assets/main.min.css">

        <script defer src="/assets/spry.js?load=spryJs"></script>

        <?php new JsForceReloadOnBack(); ?>
        <?php new JsPingQueue(); ?>
        <?= PHP_EOL.$meta->headHtml; ?>

    </head>
        <?php
    }
}
