<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Clientes;

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
    const ACTION_ALTERAR = 'IncluirCliente';
    const ACTION_EXCLUIR = 'ExcluirCliente';

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

    public function incluir()
    {

    }

    public function alterar()
    {

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


}


