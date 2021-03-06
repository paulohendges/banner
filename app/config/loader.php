<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir
    ]
)->register();


$loader->registerNamespaces(
    array(
        "App" => $config->application->libraryDir.'/app',
        "Db" => $config->application->libraryDir.'/db',
        "Model" => $config->application->modelsDir
    )
)->register();