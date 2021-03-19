<?php
namespace Fangs\ApiClients\Omie\v1;

use Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClientesHandler;
use Fangs\ApiClients\Omie\v1\Models\Geral\Empresas\EmpresasHandler;
use Fangs\ApiClients\Omie\v1\Models\Geral\Produtos\ProdutosHandler;
use Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagsHandler;
use Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelasDePrecosHandler;


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
    protected EmpresasHandler $empresas;
    protected ProdutosHandler $produtos;
    protected TabelasDePrecosHandler $tabelasDePrecos;
    protected ClientesHandler $clientes;
    protected TagsHandler $tags;


    /**
     * OmieApiClient constructor.
     *
     * @param \Fangs\ApiClients\Omie\v1\OmieApiConfig $config
     */
    public function __construct(
        OmieApiConfig $config
    ) {
        $this->empresas = new EmpresasHandler($config);
        $this->produtos = new ProdutosHandler($config);
        $this->tabelasDePrecos = new TabelasDePrecosHandler($config);
        $this->clientes = new ClientesHandler($config);
        $this->tags = new TagsHandler($config);
    }


    /**
     * @return bool
     */
    public function testConfiguration(): bool
    {
        try {
            $this->empresas->listar();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Empresas\EmpresasHandler
     */
    public function empresas(): EmpresasHandler
    {
        return $this->empresas;
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Produtos\ProdutosHandler
     */
    public function produtos(): ProdutosHandler
    {
        return $this->produtos;
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelasDePrecosHandler
     */
    public function tabelasDePrecos(): TabelasDePrecosHandler
    {
        return $this->tabelasDePrecos;
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClientesHandler
     */
    public function clientes(): ClientesHandler
    {
        return $this->clientes;
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagsHandler
     */
    public function tags(): TagsHandler
    {
        return $this->tags;
    }
}
