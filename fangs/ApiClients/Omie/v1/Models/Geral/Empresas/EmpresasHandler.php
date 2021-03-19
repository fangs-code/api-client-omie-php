<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Empresas;

use Fangs\ApiClients\Omie\v1\OmieApiHandler;

/**
 * Class EmpresasHandler.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1\Models\Geral\Empresas
 * @name    EmpresasHandler
 * @version 1.0.0
 */
class EmpresasHandler extends OmieApiHandler
{
    const ENDPOINT = 'https://app.omie.com.br/api/v1/geral/empresas/';
    const ACTION_LISTAR = 'ListarEmpresas';
    const ACTION_CONSULTAR = 'ConsultarEmpresa';


    /**
     * @param string     $action
     * @param array|null $param
     *
     * @return array
     * @throws \Exception
     */
    private function request(string $action, array $param = null): array
    {
        return $this->call(self::ENDPOINT, $action, $param);
    }

    /**
     * @param array $data
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Empresas\EmpresasEntityOmieModel
     */
    private function hidrateEntity(array $data): EmpresasEntityOmieModel
    {
        $object = new EmpresasEntityOmieModel();
        $object->setIdOmie($data['codigo_empresa']);
        $object->setIdIntegracao($data['codigo_empresa_integracao']);

        return $object;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Empresas\EmpresasEntityOmieModel $entity
     *
     * @return array
     */
    private function mountArrayFromEntity(EmpresasEntityOmieModel $entity): array
    {
        $entityArrayData = [];

        if ($entity->getIdOmie()) {
            $entityArrayData['codigo_empresa'] = $entity->getIdOmie();
        }
        if ($entity->getIdIntegracao()) {
            $entityArrayData['codigo_empresa_integracao'] = $entity->getIdIntegracao();
        }

        return $entityArrayData;
    }

    /**
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Empresas\EmpresasEntityOmieModel[]
     * @throws \Exception
     */
    public function listar(): array
    {
        $list = [];

        $page = 0;

        do {
            $page++;

            $param = [
                'pagina'               => $page,
                'registros_por_pagina' => 500,
            ];

            $result = $this->request(self::ACTION_LISTAR, $param);

            foreach ($result['empresas_cadastro'] as $cadastro) {
                $list[] = $this->hidrateEntity($cadastro);
            }

            $totalPages = $result['total_de_paginas'];

        } while ($page < $totalPages);

        return $list;
    }
}
