<?php
require_once __DIR__.'/bootstrap.php.cache';
require_once __DIR__.'/AppKernel.php';

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;

// clear test env cache
if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {
    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s --no-warmup',
        __DIR__,
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));
}

// create a "test" kernel
$kernel = new AppKernel('test', true);
$kernel->boot();

$application = new Application($kernel);
$application->setAutoExit(false);

executeCommand($application, "doctrine:schema:create");
executeCommand($application, "doctrine:fixtures:load");

/**
 * Enables us to run commands in a fancy way. Fatch.
 */
function executeCommand($application, $command, array $options = array()) {
    $options["--env"] = "test";
    $options["--quiet"] = true;
    $options = array_merge($options, array('command' => $command));

    $updateInput = new ArrayInput($options);
    $updateInput->setInteractive(false);
    $application->run($updateInput);
}