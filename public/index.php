<?php

chdir(dirname(__DIR__));
require_once __DIR__ . '/../vendor/autoload.php';


use RockEinstein\Lib\Model\ConnectionProviderArray;
use RockEinstein\Lib\Model\EntityManagerProviderImp;
use RockEinstein\Lib\Api\ControllerProviderImp;
use RockEinstein\Lib\Model\Model;
use RockEinstein\Lib\Api\App;

\Zend\Uri\UriFactory::registerScheme('chrome-extension', 'Zend\Uri\Uri');

// Contexto de conexão padrão
$context = 'production';

// Se houver um arquivo com nome específico, muda para o
// contexto de desenvolvimento
if (file_exists( __DIR__ . '/devel.context')) {
    $context = 'devel';
}

$connectionFile = __DIR__ . '/../config/connection.php';
$connectionProvider = ConnectionProviderArray::makeFromArrayFile(
    $connectionFile
);
$connectionProvider->setContext($context);

$entitiesPaths = array(__DIR__ . '/../src/Rock/Api/Entity/');
$entityManagerProvider = new EntityManagerProviderImp(
    $entitiesPaths,
    $connectionProvider,
    true
);
Model::$entityManagerProvider = $entityManagerProvider;

$controllerProvider = ControllerProviderImp::makeFromArrayFile(
    __DIR__ . '/../config/routes.php'
);
$restApp = new App($controllerProvider);
$restApp->run();
