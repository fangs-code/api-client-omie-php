<?php
namespace Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos;

use Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\SubModelos\CaracteristicasSubModelo;
use Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\SubModelos\ClientesSubModelo;
use Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\SubModelos\InfoSubModelo;
use Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\SubModelos\OutrasInfoSubModelo;
use Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\SubModelos\ProdutosSubModelo;
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

        // Info
        $infoSubModelo = new InfoSubModelo();
        $infoSubModelo->setDataInclusao($data['info']['dInc']);
        $infoSubModelo->setHoraInclusao($data['info']['hInc']);
        $infoSubModelo->setUsuarioInclusao($data['info']['uInc']);
        $infoSubModelo->setDataAlteracao($data['info']['dAlt']);
        $infoSubModelo->setHoraAlteracao($data['info']['hAlt']);
        $infoSubModelo->setUsuarioAlteracao($data['info']['uAlt']);
        $infoSubModelo->setImportadoPelaApi($data['info']['cImpAPI']);
        $object->setInfo($infoSubModelo);

        // Produtos
        $produtosSubModelo = new ProdutosSubModelo();
        $produtosSubModelo->setTodosProdutos($data['produtos']['cTodosProdutos']);
        $produtosSubModelo->setCodigoFamilia($data['produtos']['nCodFamilia']);
        $produtosSubModelo->setNcm($data['produtos']['cNCM']);
        $produtosSubModelo->setCodigoCaracteristica($data['produtos']['nCodCaract']);
        $produtosSubModelo->setConteudoCaracteristica($data['produtos']['cConteudo']);
        $produtosSubModelo->setCodigoFornecedor($data['produtos']['nCodFornec']);
        $object->setProdutos($produtosSubModelo);

        // Clientes
        $clientesSubModelo = new ClientesSubModelo();
        $clientesSubModelo->setTodosClientes($data['clientes']['cTodosClientes']);
        $clientesSubModelo->setCodigoTag($data['clientes']['nCodTag']);
        $clientesSubModelo->setDescricaoTag($data['clientes']['cTag']);
        $clientesSubModelo->setUf($data['clientes']['cUF']);
        $object->setClientes($clientesSubModelo);

        // Outras Info
        $outrasInfoSubModelo = new OutrasInfoSubModelo();
        $outrasInfoSubModelo->setCodigoTabelaOriginal($data['outrasInfo']['nCodOrigTab']);
        $outrasInfoSubModelo->setPercentualAcrescimo($data['outrasInfo']['nPercAcrescimo']);
        $outrasInfoSubModelo->setPercentualDesconto($data['outrasInfo']['nPercDesconto']);
        $object->setOutrasInfo($outrasInfoSubModelo);

        // Características
        $caracteristicasSubModelo = new CaracteristicasSubModelo();
        $caracteristicasSubModelo->setTemValidade($data['caracteristicas']['cTemValidade']);
        $caracteristicasSubModelo->setDataInicialValidade($data['caracteristicas']['dDtInicial']);
        $caracteristicasSubModelo->setDataFinalValidade($data['caracteristicas']['dDtFinal']);
        $caracteristicasSubModelo->setTemDesconto($data['caracteristicas']['cTemDesconto']);
        $caracteristicasSubModelo->setDescontoSugerido($data['caracteristicas']['nDescSugerido']);
        $caracteristicasSubModelo->setPercentualDescontoMaximo($data['caracteristicas']['nPercDescMax']);
        $caracteristicasSubModelo->setArredondaPreco($data['caracteristicas']['cArredPreco']);
        $object->setCaracteristicas($caracteristicasSubModelo);

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
        if ($entity->getAtiva()) {
            $entityArrayData['cAtiva'] = $entity->getAtiva();
        }
        if ($entity->getOrigem()) {
            $entityArrayData['cOrigem'] = $entity->getOrigem();
        }

        // Produtos
        if ($entity->getProdutos()) {
            $entityArrayData['produtos'] = [];

            if ($entity->getProdutos()->getTodosProdutos()) {
                $entityArrayData['produtos']['cTodosProdutos'] = $entity->getProdutos()->getTodosProdutos();
            }
            if ($entity->getProdutos()->getCodigoFamilia()) {
                $entityArrayData['produtos']['nCodFamilia'] = $entity->getProdutos()->getCodigoFamilia();
            }
            if ($entity->getProdutos()->getNcm()) {
                $entityArrayData['produtos']['cNCM'] = $entity->getProdutos()->getNcm();
            }
            if ($entity->getProdutos()->getCodigoCaracteristica()) {
                $entityArrayData['produtos']['nCodCaract'] = $entity->getProdutos()->getCodigoCaracteristica();
            }
            if ($entity->getProdutos()->getConteudoCaracteristica()) {
                $entityArrayData['produtos']['cConteudo'] = $entity->getProdutos()->getConteudoCaracteristica();
            }
            if ($entity->getProdutos()->getCodigoFornecedor()) {
                $entityArrayData['produtos']['nCodFornec'] = $entity->getProdutos()->getCodigoFornecedor();
            }
        }

        // Clientes
        if ($entity->getClientes()) {
            $entityArrayData['clientes'] = [];

            if ($entity->getClientes()->getTodosClientes()) {
                $entityArrayData['clientes']['cTodosClientes'] = $entity->getClientes()->getTodosClientes();
            }
            if ($entity->getClientes()->getCodigoTag()) {
                $entityArrayData['clientes']['nCodTag'] = $entity->getClientes()->getCodigoTag();
            }
            if ($entity->getClientes()->getDescricaoTag()) {
                $entityArrayData['clientes']['cTag'] = $entity->getClientes()->getDescricaoTag();
            }
            if ($entity->getClientes()->getUf()) {
                $entityArrayData['clientes']['cUF'] = $entity->getClientes()->getUf();
            }
        }

        // Outras Info
        if ($entity->getOutrasInfo()) {
            $entityArrayData['outrasInfo'] = [];

            if ($entity->getOutrasInfo()->getCodigoTabelaOriginal()) {
                $entityArrayData['outrasInfo']['nCodOrigTab'] = $entity->getOutrasInfo()->getCodigoTabelaOriginal();
            }
            if ($entity->getOutrasInfo()->getPercentualAcrescimo()) {
                $entityArrayData['outrasInfo']['nPercAcrescimo'] = $entity->getOutrasInfo()->getPercentualAcrescimo();
            }
            if ($entity->getOutrasInfo()->getPercentualDesconto()) {
                $entityArrayData['outrasInfo']['nPercDesconto'] = $entity->getOutrasInfo()->getPercentualDesconto();
            }
        }

        // Características
        if ($entity->getCaracteristicas()) {
            $entityArrayData['caracteristicas'] = [];

            if ($entity->getCaracteristicas()->getTemValidade()) {
                $entityArrayData['caracteristicas']['cTemValidade'] = $entity->getCaracteristicas()->getTemValidade();
            }
            if ($entity->getCaracteristicas()->getDataInicialValidade()) {
                $entityArrayData['caracteristicas']['dDtInicial'] = $entity->getCaracteristicas()->getDataInicialValidade();
            }
            if ($entity->getCaracteristicas()->getDataFinalValidade()) {
                $entityArrayData['caracteristicas']['dDtFinal'] = $entity->getCaracteristicas()->getDataFinalValidade();
            }
            if ($entity->getCaracteristicas()->getTemDesconto()) {
                $entityArrayData['caracteristicas']['cTemDesconto'] = $entity->getCaracteristicas()->getTemDesconto();
            }
            if ($entity->getCaracteristicas()->getDescontoSugerido()) {
                $entityArrayData['caracteristicas']['nDescSugerido'] = $entity->getCaracteristicas()->getDescontoSugerido();
            }
            if ($entity->getCaracteristicas()->getPercentualDescontoMaximo()) {
                $entityArrayData['caracteristicas']['nPercDescMax'] = $entity->getCaracteristicas()->getPercentualDescontoMaximo();
            }
            if ($entity->getCaracteristicas()->getArredondaPreco()) {
                $entityArrayData['caracteristicas']['cArredPreco'] = $entity->getCaracteristicas()->getArredondaPreco();
            }
        }

        // Info
        if ($entity->getInfo()) {
            $entityArrayData['info'] = [];

            if ($entity->getInfo()->getDataInclusao()) {
                $entityArrayData['info']['dInc'] = $entity->getInfo()->getDataInclusao();
            }
            if ($entity->getInfo()->getHoraInclusao()) {
                $entityArrayData['info']['hInc'] = $entity->getInfo()->getHoraInclusao();
            }
            if ($entity->getInfo()->getUsuarioInclusao()) {
                $entityArrayData['info']['uInc'] = $entity->getInfo()->getUsuarioInclusao();
            }
            if ($entity->getInfo()->getDataAlteracao()) {
                $entityArrayData['info']['dAlt'] = $entity->getInfo()->getDataAlteracao();
            }
            if ($entity->getInfo()->getHoraAlteracao()) {
                $entityArrayData['info']['hAlt'] = $entity->getInfo()->getHoraAlteracao();
            }
            if ($entity->getInfo()->getUsuarioAlteracao()) {
                $entityArrayData['info']['uAlt'] = $entity->getInfo()->getUsuarioAlteracao();
            }
            if ($entity->getInfo()->getImportadoPelaApi()) {
                $entityArrayData['info']['cImpAPI'] = $entity->getInfo()->getImportadoPelaApi();
            }
        }

        return $entityArrayData;
    }


    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel[]
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
        $array = $this->mountArrayFromEntity($requestModel);

        // Tag [nCodTabPreco] não faz parte da estrutura do tipo complexo [tprIncluirRequest]!
        if ($array['nCodTabPreco']) {
            unset($array['nCodTabPreco']);
        }

        // Tag [cAtiva] não faz parte da estrutura do tipo complexo [tprIncluirRequest]!
        if ($array['cAtiva']) {
            unset($array['cAtiva']);
        }

        // Tag [INFO] não faz parte da estrutura do tipo complexo [tprIncluirRequest]!
        if ($array['info']) {
            unset($array['info']);
        }

        $result = $this->request(self::ACTION_INCLUIR, $array);

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
        $array = $this->mountArrayFromEntity($requestModel);

        // Tag [cAtiva] não faz parte da estrutura do tipo complexo [tprAlterarRequest]!
        if ($array['cAtiva']) {
            unset($array['cAtiva']);
        }

        // Tag [INFO] não faz parte da estrutura do tipo complexo [tprAlterarRequest]!
        if ($array['info']) {
            unset($array['info']);
        }

        $result = $this->request(self::ACTION_ALTERAR, $array);

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

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel $sourceModel
     * @param \Fangs\ApiClients\Omie\v1\Models\Produtos\TabelasDePrecos\TabelaDePrecoEntityOmieModel $targetModel
     *
     * @return array
     */
    public function comparar(TabelaDePrecoEntityOmieModel $sourceModel, TabelaDePrecoEntityOmieModel $targetModel)
    {
        $sourceModelArray = $this->mountArrayFromEntity($sourceModel);
        $targetModelArray = $this->mountArrayFromEntity($targetModel);


        $tabelaDePrecosStructure = [
            //'nCodTabPreco'    => 'nCodTabPreco',
            //'cCodIntTabPreco' => 'cCodIntTabPreco',
            'cNome'           => 'cNome',
            'cCodigo'         => 'cCodigo',
            'cAtiva'          => 'cAtiva',
            'cOrigem'         => 'cOrigem',
            'produtos'        => [
                'cTodosProdutos' => 'cTodosProdutos',
                'nCodFamilia'    => 'nCodFamilia',
                'cNCM'           => 'cNCM',
                'nCodCaract'     => 'nCodCaract',
                'cConteudo'      => 'cConteudo',
                'nCodFornec'     => 'nCodFornec',
            ],
            'clientes'        => [
                'cTodosClientes' => 'cTodosClientes',
                'nCodTag'        => 'nCodTag',
                'cTag'           => 'cTag',
                'cUF'            => 'cUF',
            ],
            'outrasInfo'      => [
                'nCodOrigTab'    => 'nCodOrigTab',
                'nPercAcrescimo' => 'nPercAcrescimo',
                'nPercDesconto'  => 'nPercDesconto',
            ],
            'caracteristicas' => [
                'cTemValidade'  => 'cTemValidade',
                'dDtInicial'    => 'dDtInicial',
                'dDtFinal'      => 'dDtFinal',
                'cTemDesconto'  => 'cTemDesconto',
                'nDescSugerido' => 'nDescSugerido',
                'nPercDescMax'  => 'nPercDescMax',
                'cArredPreco'   => 'cArredPreco',
            ],
        ];

        $comparisonData = [];
        foreach ($tabelaDePrecosStructure as $key => $value) {
            if (in_array($key, ['produtos', 'clientes', 'outrasInfo', 'caracteristicas'])) {
                foreach ($tabelaDePrecosStructure[$key] as $keyArray => $valueArray) {
                    $compareResult = $this->indexComparison($sourceModelArray[$key][$keyArray], $targetModelArray[$key][$keyArray]);
                    if ($compareResult) {
                        $comparisonData[] = $compareResult . " para o índice [$key][$keyArray]";
                    }
                }

            } else {
                $compareResult = $this->indexComparison($sourceModelArray[$key], $targetModelArray[$key]);
                if ($compareResult) {
                    $comparisonData[] = $compareResult . " para o índice [$key]";
                }
            }
        }

        return $comparisonData;
    }

    /**
     * @param $sourceIndex
     * @param $targetIndex
     *
     * @return string|null
     */
    private function indexComparison($sourceIndex, $targetIndex)
    {
        if ($sourceIndex) {
            if ($targetIndex) {
                if ($sourceIndex != $targetIndex) {
                    return 'Valor diferente';
                }
            } else {
                return 'Valor ausente no alvo';
            }
        } else {
            if (isset($targetIndex)) {
                return 'Valor ausente na origem';
            }
        }

        return null;
    }
}


