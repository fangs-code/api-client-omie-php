<?php

use Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteConsultarRequestOmieModel;
use Fangs\ApiClients\Omie\v1\OmieApiClient;
use Fangs\ApiClients\Omie\v1\OmieApiConfig;

// Composer autoloading
include __DIR__ . '/vendor/autoload.php';




$omieClient = new OmieApiClient(new OmieApiConfig('1291142042190', 'd52d79506dc11997c3d744428f6aab41'));

try {
   // $produtos = $omieClient->produtos()->listar();
    //$clientes = $omieClient->clientes()->listar();
    $requestConsultaCliente = new ClienteConsultarRequestOmieModel();
    //$requestConsultaCliente->setIdOmie(1266023081);
    $requestConsultaCliente->setIdIntegracao("08636395690");
    $cliente = $omieClient->clientes()->consultar($requestConsultaCliente);

    echo "<pre>";
    var_dump($cliente);
    echo "</pre>";
    die;

}catch (Exception $e){
    echo "<pre>";
    var_dump($e);
    echo "</pre>";
    die;
}

