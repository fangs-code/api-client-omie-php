<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Clientes;

use Exception;
use Fangs\ApiClients\Omie\v1\OmieApiHandler;

/**
 * Class ClientesHandler.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1\Models\Geral\Clientes
 * @name    ClientesHandler
 * @version 1.0.0
 */
class ClientesHandler extends OmieApiHandler
{
    const ENDPOINT = 'https://app.omie.com.br/api/v1/geral/clientes/';
    const ACTION_LISTAR = 'ListarClientes';
    const ACTION_CONSULTAR = 'ConsultarCliente';
    const ACTION_INCLUIR = 'IncluirCliente';
    const ACTION_ALTERAR = 'AlterarCliente';
    const ACTION_EXCLUIR = 'ExcluirCliente';
    const ACTION_INCLUIR_OU_ALTERAR_POR_LOTE = 'UpsertClientesPorLote';


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
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel
     */
    private function hidrateEntity(array $data)
    {
        $object = new ClienteEntityOmieModel();
        $object->setIdOmie($data['codigo_cliente_omie']);
        $object->setIdIntegracao($data['codigo_cliente_integracao']);
        $object->setRazaoSocial($data['razao_social']);
        $object->setCnpjCpf($data['cnpj_cpf']);
        $object->setNomeFantasia($data['nome_fantasia']);
        $object->setTelefone1Ddd($data['telefone1_ddd']);
        $object->setTelefone1Numero($data['telefone1_numero']);
        $object->setContato($data['contato']);
        $object->setEndereco($data['endereco']);
        $object->setEnderecoNumero($data['endereco_numero']);
        $object->setBairro($data['bairro']);
        $object->setComplemento($data['complemento']);
        $object->setEstado($data['estado']);
        $object->setCidade($data['cidade']);
        $object->setCep($data['cep']);
        $object->setPais($data['codigo_pais']);
        $object->setTelefone2Ddd($data['telefone2_ddd']);
        $object->setTelefone2Numero($data['telefone2_numero']);
        $object->setFaxDdd($data['fax_ddd']);
        $object->setFaxNumero($data['fax_numero']);
        $object->setEmail($data['email']);
        $object->setHomePage($data['homepage']);
        $object->setInscricaoEstadual($data['inscricao_estadual']);
        $object->setInscricaoMunicipal($data['inscricao_municipal']);
        $object->setInscricaoSuframa($data['inscricao_suframa']);
        $object->setOptanteSimplesNacional($data['optante_simples_nacional']);
        $object->setTipoAtividade($data['tipo_atividade']);
        $object->setCnae($data['cnae']);
        $object->setProdutorRural($data['produtor_rural']);
        $object->setContribuinte($data['contribuinte']);
        $object->setObservacao($data['observacao']);
        $object->setObservacaoDetalhada($data['obs_detalhadas']);
        $object->setRecomendacaoAtraso($data['recomendacao_atraso']);
        $object->setPessoaFisica($data['pessoa_fisica']);
        $object->setExterior($data['exterior']);
        $object->setImportadoApi($data['importado_api']);
        $object->setCidadeIbge($data['cidade_ibge']);
        $object->setValorLimiteCredito($data['valor_limite_credito']);
        $object->setBloquearFaturamento($data['bloquear_faturamento']);
        $object->setNif($data['nif']);
        $object->setInativo($data['inativo']);
        $object->setBloquearExclusao($data['bloquear_exclusao']);

        return $object;
    }

    /**
     * @param array $data
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteStatusOmieModel
     */
    private function hidrateStatus(array $data)
    {
        $object = new ClienteStatusOmieModel();
        $object->setIdOmie($data['codigo_cliente_omie']);
        $object->setIdIntegracao($data['codigo_cliente_integracao']);
        $object->setCodigoStatus($data['codigo_status']);
        $object->setDescricaoStatus($data['descricao_status']);

        return $object;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel $entity
     *
     * @return array
     */
    private function mountArrayFromEntity(ClienteEntityOmieModel $entity)
    {
        $entityArrayData = [];

        if ($entity->getIdOmie()) {
            $entityArrayData['codigo_cliente_omie'] = $entity->getIdOmie();
        }
        if ($entity->getIdIntegracao()) {
            $entityArrayData['codigo_cliente_integracao'] = $entity->getIdIntegracao();
        }
        if ($entity->getRazaoSocial()) {
            $entityArrayData['razao_social'] = $entity->getRazaoSocial();
        }
        if ($entity->getCnpjCpf()) {
            $entityArrayData['cnpj_cpf'] = $entity->getCnpjCpf();
        }
        if ($entity->getNomeFantasia()) {
            $entityArrayData['nome_fantasia'] = $entity->getNomeFantasia();
        }
        if ($entity->getTelefone1Ddd()) {
            $entityArrayData['telefone1_ddd'] = $entity->getTelefone1Ddd();
        }
        if ($entity->getTelefone1Numero()) {
            $entityArrayData['telefone1_numero'] = $entity->getTelefone1Numero();
        }
        if ($entity->getContato()) {
            $entityArrayData['contato'] = $entity->getContato();
        }
        if ($entity->getEndereco()) {
            $entityArrayData['endereco'] = $entity->getEndereco();
        }
        if ($entity->getEnderecoNumero()) {
            $entityArrayData['endereco_numero'] = $entity->getEnderecoNumero();
        }
        if ($entity->getBairro()) {
            $entityArrayData['bairro'] = $entity->getBairro();
        }
        if ($entity->getComplemento()) {
            $entityArrayData['complemento'] = $entity->getComplemento();
        }
        if ($entity->getEstado()) {
            $entityArrayData['estado'] = $entity->getEstado();
        }
        if ($entity->getCidade()) {
            $entityArrayData['cidade'] = $entity->getCidade();
        }
        if ($entity->getCep()) {
            $entityArrayData['cep'] = $entity->getCep();
        }
        if ($entity->getPais()) {
            $entityArrayData['codigo_pais'] = $entity->getPais();
        }
        if ($entity->getTelefone2Ddd()) {
            $entityArrayData['telefone2_ddd'] = $entity->getTelefone2Ddd();
        }
        if ($entity->getTelefone2Numero()) {
            $entityArrayData['telefone2_numero'] = $entity->getTelefone2Numero();
        }
        if ($entity->getFaxDdd()) {
            $entityArrayData['fax_ddd'] = $entity->getFaxDdd();
        }
        if ($entity->getFaxNumero()) {
            $entityArrayData['fax_numero'] = $entity->getFaxNumero();
        }
        if ($entity->getEmail()) {
            $entityArrayData['email'] = $entity->getEmail();
        }
        if ($entity->getHomePage()) {
            $entityArrayData['homepage'] = $entity->getHomePage();
        }
        if ($entity->getInscricaoEstadual()) {
            $entityArrayData['inscricao_estadual'] = $entity->getInscricaoEstadual();
        }
        if ($entity->getInscricaoMunicipal()) {
            $entityArrayData['inscricao_municipal'] = $entity->getInscricaoMunicipal();
        }
        if ($entity->getInscricaoSuframa()) {
            $entityArrayData['inscricao_suframa'] = $entity->getInscricaoSuframa();
        }
        if ($entity->getOptanteSimplesNacional()) {
            $entityArrayData['optante_simples_nacional'] = $entity->getOptanteSimplesNacional();
        }
        if ($entity->getTipoAtividade()) {
            $entityArrayData['tipo_atividade'] = $entity->getTipoAtividade();
        }
        if ($entity->getCnae()) {
            $entityArrayData['cnae'] = $entity->getCnae();
        }
        if ($entity->getProdutorRural()) {
            $entityArrayData['produtor_rural'] = $entity->getProdutorRural();
        }
        if ($entity->getContribuinte()) {
            $entityArrayData['contribuinte'] = $entity->getContribuinte();
        }
        if ($entity->getObservacao()) {
            $entityArrayData['observacao'] = $entity->getObservacao();
        }
        if ($entity->getObservacaoDetalhada()) {
            $entityArrayData['obs_detalhadas'] = $entity->getObservacaoDetalhada();
        }
        if ($entity->getRecomendacaoAtraso()) {
            $entityArrayData['recomendacao_atraso'] = $entity->getRecomendacaoAtraso();
        }
        if ($entity->getPessoaFisica()) {
            $entityArrayData['pessoa_fisica'] = $entity->getPessoaFisica();
        }
        if ($entity->getExterior()) {
            $entityArrayData['exterior'] = $entity->getExterior();
        }
        if ($entity->getImportadoApi()) {
            $entityArrayData['importado_api'] = $entity->getImportadoApi();
        }
        if ($entity->getCidadeIbge()) {
            $entityArrayData['cidade_ibge'] = $entity->getCidadeIbge();
        }
        if ($entity->getValorLimiteCredito()) {
            $entityArrayData['valor_limite_credito'] = $entity->getValorLimiteCredito();
        }
        if ($entity->getBloquearFaturamento()) {
            $entityArrayData['bloquear_faturamento'] = $entity->getBloquearFaturamento();
        }
        if ($entity->getNif()) {
            $entityArrayData['nif'] = $entity->getNif();
        }
        if ($entity->getInativo()) {
            $entityArrayData['inativo'] = $entity->getInativo();
        }
        if ($entity->getBloquearExclusao()) {
            $entityArrayData['bloquear_exclusao'] = $entity->getBloquearExclusao();
        }

        return $entityArrayData;
    }


    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel[]
     * @throws \Exception
     */
    public function listar()
    {
        $list = [];

        $page = 0;

        do {
            $page++;

            $param = [
                'pagina'               => $page,
                'registros_por_pagina' => 500,
                'apenas_importado_api' => "N",
            ];

            $result = $this->request(self::ACTION_LISTAR, $param);

            foreach ($result['clientes_cadastro'] as $cadastro) {
                $list[] = $this->hidrateEntity($cadastro);
            }

            $totalPages = $result['total_de_paginas'];

        } while ($page < $totalPages);

        return $list;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteConsultarRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel
     * @throws \Exception
     */
    public function consultar(ClienteConsultarRequestOmieModel $requestModel)
    {
        $param = [];

        if ($requestModel->getIdOmie()) {
            $param['codigo_cliente_omie'] = $requestModel->getIdOmie();
        }

        if ($requestModel->getIdIntegracao()) {
            $param['codigo_cliente_integracao'] = $requestModel->getIdIntegracao();
        }

        $result = $this->request(self::ACTION_CONSULTAR, $param);

        return $this->hidrateEntity($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteStatusOmieModel
     * @throws \Exception
     */
    public function incluir(ClienteEntityOmieModel $requestModel)
    {
        $result = $this->request(self::ACTION_INCLUIR, $this->mountArrayFromEntity($requestModel));

        return $this->hidrateStatus($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteStatusOmieModel
     * @throws \Exception
     */
    public function alterar(ClienteEntityOmieModel $requestModel)
    {
        $result = $this->request(self::ACTION_ALTERAR, $this->mountArrayFromEntity($requestModel));

        return $this->hidrateStatus($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteExcluirRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteStatusOmieModel
     * @throws \Exception
     */
    public function excluir(ClienteExcluirRequestOmieModel $requestModel)
    {
        $param = [];

        if ($requestModel->getIdOmie()) {
            $param['codigo_cliente_omie'] = $requestModel->getIdOmie();
        }

        if ($requestModel->getIdIntegracao()) {
            $param['codigo_cliente_integracao'] = $requestModel->getIdIntegracao();
        }

        $result = $this->request(self::ACTION_EXCLUIR, $param);

        return $this->hidrateStatus($result);
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Clientes\ClienteEntityOmieModel[] $requestModels
     *
     * @return array
     */
    public function incluirOuAlterarPorLote(array $requestModels)
    {
        // Separar por lotes de 50 registros
        $chunks = array_chunk($requestModels, 50);
        $chunksResults = [];

        // Processar cada lote
        $chunkNumber = 1;
        foreach ($chunks as $chunkOfRequestModels) {
            $param = [
                "clientes_cadastro" => [],
                "lote"              => $chunkNumber,
            ];

            foreach ($chunkOfRequestModels as $requestModel) {
                $array = $this->mountArrayFromEntity($requestModel);

                if (!isset($array['codigo_cliente_integracao'])) {
                    $array['codigo_cliente_integracao'] = $array['codigo_cliente_omie'];
                }

                $param['clientes_cadastro'][] = $array;
            }

            try {
                $chunksResults[$chunkNumber] = $this->request(self::ACTION_INCLUIR_OU_ALTERAR_POR_LOTE, $param);
            } catch (Exception $e) {
                $chunksResults[$chunkNumber] = $e->getMessage();
            }

            $chunkNumber++;
        }

        return $chunksResults;
    }


}
