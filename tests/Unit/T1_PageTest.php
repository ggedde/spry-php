<?php

use App\View\Layout\Page;
use App\View\Page\Login;
use App\View\Page\View404;
use SpryPhp\Provider\Session;

test('Page Tests', function () {

    ob_start();
    new Page(new Login());
    $contents = ob_get_contents();
    ob_end_clean();

    expect($contents)->toContain('<h4>Login</h4>');
    expect($_SESSION)->toBe([]);
    expect(Session::getAlerts())->toBe([]);

    ob_start();
    new Page(new View404());
    $contents = ob_get_contents();
    ob_end_clean();

    expect($contents)->toContain('404 | Page not found');
});
