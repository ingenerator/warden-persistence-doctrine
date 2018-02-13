<?php
# Bootstrap for running unit tests
error_reporting(E_ALL | E_STRICT);

// Autoload mocks and test-support helpers that should not autoload in the main app
$mock_loader = new \Composer\Autoload\ClassLoader;
$mock_loader->addPsr4('test\\mock\\Ingenerator\\Warden\\Persistence\\Doctrine\\', [__DIR__.'/mock/']);
$mock_loader->addPsr4('test\\unit\\Ingenerator\\Warden\\Persistence\\Doctrine\\', [__DIR__.'/unit/']);
$mock_loader->addPsr4('test\\integration\\Ingenerator\\Warden\\Persistence\\Doctrine\\', [__DIR__.'/integration/']);

$mock_loader->register();

require_once __DIR__.'/../vendor/ingenerator/warden-core/test/integration/Repository/UserRepositoryTest.php';
