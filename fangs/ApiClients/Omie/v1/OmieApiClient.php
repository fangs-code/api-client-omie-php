<?php
namespace Fangs\ApiClients\Omie\v1;

use Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClientesHandler;
use Fangs\ApiClients\Omie\v1\Models\Geral\Produtos\ProdutosHandler;


/**
 * Class OmieApiClient.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1
 * @name    OmieApiClient
 * @version 1.0.0
 */
class OmieApiClient
{
    protected ProdutosHandler $produtos;
    protected ClientesHandler $clientes;


    /**
     * OmieApiClient constructor.
     *
     * @param \Fangs\ApiClients\Omie\v1\OmieApiConfig $config
     */
    public function __construct(
        OmieApiConfig $config
    ) {
        $this->produtos = new ProdutosHandler($config);
        $this->clientes = new ClientesHandler($config);
    }

    /**
     * @return bool
     */
    public function testConfiguration()
    {
        try {
            $this->clientes->listar();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Produtos\ProdutosHandler
     */
    public function produtos(): ProdutosHandler
    {
        return $this->produtos;
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClientesHandler
     */
    public function clientes(): ClientesHandler
    {
        return $this->clientes;
    }
}
