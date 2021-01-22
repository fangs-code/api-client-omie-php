<?php
namespace Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos;

use Fangs\ApiClients\Omie\v1\OmieApiHandler;

/**
 * Class TabelasDePrecosHandler.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos
 * @name    TabelasDePrecosHandler
 * @version 1.0.0
 */
class TabelasDePrecosHandler extends OmieApiHandler
{
    const ENDPOINT = 'https://app.omie.com.br/api/v1/produtos/tabelaprecos/';
    const ACTION_LISTAR = 'ListarTabelasPreco';
    const ACTION_CONSULTAR = 'ConsultarTabelaPreco';
    const ACTION_INCLUIR = 'IncluirTabelaPreco';
    const ACTION_ALTERAR = 'AlterarTabelaPreco';
    const ACTION_EXCLUIR = 'ExcluirTabelaPreco';


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
     * @param array $data
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel
     */
    private function hidrateEntity(array $data)
    {
        $object = new TabelaDePrecoEntityOmieModel();
        $object->setIdOmie($data['nCodTabPreco']);
        $object->setIdIntegracao($data['cCodIntTabPreco']);
        $object->setNome($data['cNome']);
        $object->setCodigo($data['cCodigo']);
        $object->setAtiva($data['cAtiva']);
        $object->setOrigem($data['cOrigem']);


        // Produtos

        // Clientes

        // Outras Info

        // Características

        // Info

        return $object;
    }

    /**
     * @param array $data
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoStatusOmieModel
     */
    private function hidrateStatus(array $data)
    {
        $object = new TabelaDePrecoStatusOmieModel();
        $object->setIdOmie($data['nCodTabPreco']);
        $object->setIdIntegracao($data['cCodIntTabPreco']);
        $object->setCodigoStatus($data['cCodStatus']);
        $object->setDescricaoStatus($data['cDesStatus']);

        return $object;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel $entity
     *
     * @return array
     */
    private function mountArrayFromEntity(TabelaDePrecoEntityOmieModel $entity)
    {
        $entityArrayData = [];

        if ($entity->getIdOmie()) {
            $entityArrayData['nCodTabPreco'] = $entity->getIdOmie();
        }
        if ($entity->getIdIntegracao()) {
            $entityArrayData['cCodIntTabPreco'] = $entity->getIdIntegracao();
        }
        if ($entity->getNome()) {
            $entityArrayData['cNome'] = $entity->getNome();
        }
        if ($entity->getCodigo()) {
            $entityArrayData['cCodigo'] = $entity->getCodigo();
        }


        // Produtos

        // Clientes

        // Outras Info

        // Características

        // Info


        return $entityArrayData;
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function listar()
    {
        $list = [];

        $page = 0;

        do {
            $page++;

            $param = [
                'nPagina'       => $page,
                'nRegPorPagina' => 500,
            ];

            $result = $this->request(self::ACTION_LISTAR, $param);

            foreach ($result['listaTabelasPreco'] as $cadastro) {
                $list[] = $this->hidrateEntity($cadastro);
            }

            $totalPages = $result['nTotPaginas'];

        } while ($page < $totalPages);

        return $list;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoConsultarRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel
     * @throws \Exception
     */
    public function consultar(TabelaDePrecoConsultarRequestOmieModel $requestModel)
    {
        $param = [];

        if ($requestModel->getIdOmie()) {
            $param['nCodTabPreco'] = $requestModel->getIdOmie();
        }

        if ($requestModel->getIdIntegracao()) {
            $param['cCodIntTabPreco'] = $requestModel->getIdIntegracao();
        }

        $result = $this->request(self::ACTION_CONSULTAR, $param);

        return $this->hidrateEntity($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoStatusOmieModel
     * @throws \Exception
     */
    public function incluir(TabelaDePrecoEntityOmieModel $requestModel)
    {
        $result = $this->request(self::ACTION_INCLUIR, $this->mountArrayFromEntity($requestModel));

        return $this->hidrateStatus($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoStatusOmieModel
     * @throws \Exception
     */
    public function alterar(TabelaDePrecoEntityOmieModel $requestModel)
    {
        $result = $this->request(self::ACTION_ALTERAR, $this->mountArrayFromEntity($requestModel));

        return $this->hidrateStatus($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoExcluirRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoStatusOmieModel
     * @throws \Exception
     */
    public function excluir(TabelaDePrecoExcluirRequestOmieModel $requestModel)
    {
        $param = [];

        if ($requestModel->getIdOmie()) {
            $param['nCodTabPreco'] = $requestModel->getIdOmie();
        }

        if ($requestModel->getIdIntegracao()) {
            $param['cCodIntTabPreco'] = $requestModel->getIdIntegracao();
        }

        $result = $this->request(self::ACTION_EXCLUIR, $param);

        return $this->hidrateStatus($result);
    }
}


