<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Tags;

use Fangs\ApiClients\Omie\v1\OmieApiHandler;

/**
 * Class TagsHandler.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1\Models\Geral\Tags
 * @name    TagsHandler
 * @version 1.0.0
 */
class TagsHandler extends OmieApiHandler
{
    const ENDPOINT = 'https://app.omie.com.br/api/v1/geral/clientetag/';
    const ACTION_LISTAR = 'ListarTags';
    const ACTION_INCLUIR = 'IncluirTags';
    const ACTION_EXCLUIR = 'ExcluirTags';
    const ACTION_EXCLUIR_TODAS = 'ExcluirTodas';


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
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagEntityOmieModel
     */
    private function hidrateEntity(array $data): TagEntityOmieModel
    {
        $object = new TagEntityOmieModel();
        $object->setIdOmie($data['nCodTag']);
        $object->setTag($data['tag']);

        return $object;
    }

    /**
     * @param array $data
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagStatusOmieModel
     */
    private function hidrateStatus(array $data): TagStatusOmieModel
    {
        $object = new TagStatusOmieModel();
        $object->setIdOmieCliente($data['nCodCliente']);
        $object->setIdIntegracaoCliente($data['cCodIntCliente']);
        $object->setCodigoStatus($data['cCodStatus']);
        $object->setDescricaoStatus($data['cDesStatus']);

        return $object;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagEntityOmieModel $entity
     *
     * @return array
     */
    private function mountArrayFromEntity(TagEntityOmieModel $entity): array
    {
        $entityArrayData = [];

        if ($entity->getIdOmie()) {
            $entityArrayData['nCodTag'] = $entity->getIdOmie();
        }
        if ($entity->getTag()) {
            $entityArrayData['tag'] = $entity->getTag();
        }

        return $entityArrayData;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagListarRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagEntityOmieModel[]
     * @throws \Exception
     */
    public function listar(TagListarRequestOmieModel $requestModel): array
    {
        $param = [];

        if ($requestModel->getIdOmieCliente()) {
            $param['nCodCliente'] = $requestModel->getIdOmieCliente();
        }

        $result = $this->request(self::ACTION_LISTAR, $param);

        $list = [];
        foreach ($result['tagsLista'] as $cadastro) {
            $list[] = $this->hidrateEntity($cadastro);
        }

        return $list;
    }

    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagIncluirRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagStatusOmieModel
     * @throws \Exception
     */
    public function incluir(TagIncluirRequestOmieModel $requestModel): TagStatusOmieModel
    {
        $param = [];

        if ($requestModel->getIdOmieCliente()) {
            $param['nCodCliente'] = $requestModel->getIdOmieCliente();
        }

        // Tags
        if ($requestModel->getTags()) {
            $param['tags'] = [];

            foreach ($requestModel->getTags() as $tag) {
                $param['tags'][] = ['tag' => $tag->getTag()];
            }
        }

        $result = $this->request(self::ACTION_INCLUIR, $param);

        return $this->hidrateStatus($result);
    }


    /**
     * @param \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagExcluirTodasRequestOmieModel $requestModel
     *
     * @return \Fangs\ApiClients\Omie\v1\Models\Geral\Tags\TagStatusOmieModel
     * @throws \Exception
     */
    public function excluirTodas(TagExcluirTodasRequestOmieModel $requestModel): TagStatusOmieModel
    {
        $param = [];

        if ($requestModel->getIdOmieCliente()) {
            $param['nCodCliente'] = $requestModel->getIdOmieCliente();
        }

        $result = $this->request(self::ACTION_EXCLUIR_TODAS, $param);

        return $this->hidrateStatus($result);
    }
}
