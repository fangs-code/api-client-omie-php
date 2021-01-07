<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Produtos;

use Fangs\ApiClients\Omie\v1\OmieApiHandler;

/**
 * Class ProdutosHandler.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1\Models\Geral\Produtos
 * @name    ProdutosHandler
 * @version 1.0.0
 */
class ProdutosHandler extends OmieApiHandler
{
    const ENDPOINT = 'https://app.omie.com.br/api/v1/geral/produtos/';
    const ACTION_LISTAR = 'ListarProdutos';


    /**
     * @param string     $action
     * @param array|null $param
     *
     * @return array
     * @throws \Exception
     */
    private function request(string $action, array $param = null)
    {
        return $this->call(self::ENDPOINT, $action, $param);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function listar()
    {
        $produtosList = [];

        $page = 0;

        do {
            $page++;

            $param = [
                'pagina'                 => $page,
                'registros_por_pagina'   => 500,
                'apenas_importado_api'   => "N",
                'filtrar_apenas_omiepdv' => "N",
            ];

            $result = $this->request(self::ACTION_LISTAR, $param);

            foreach ($result['produto_servico_cadastro'] as $cadastro) {
                $produtoOmie = new ProdutoEntityOmieModel();
                //$produtoOmie->setCodigoProduto($cadastro['codigo_produto']);

                $produtosList[] = $produtoOmie;
            }

            $totalPages = $result['total_de_paginas'];

        } while ($page < $totalPages);

        return $produtosList;
    }

    public function incluir()
    {

    }

    public function alterar()
    {

    }

    public function excluir()
    {

    }

    public function consultar()
    {

    }
}


