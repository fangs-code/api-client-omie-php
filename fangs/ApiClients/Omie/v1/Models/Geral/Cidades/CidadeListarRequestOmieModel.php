<?php
namespace Fangs\ApiClients\Omie\v1\Models\Geral\Cidades;

/**
 * Class CidadeListarRequestOmieModel.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\Models\Requests
 * @name    CidadeListarRequestOmieModel
 * @version 1.0.0
 */
class CidadeListarRequestOmieModel
{
    protected int $pagina;
    protected int $registrosPorPagina;
    protected string $apenasImportadoApi;
    protected string $ordenarPor;
    protected string $ordemDecrescente;
    protected string $filtrarPorDataDe;
    protected string $filtrarPorDataAte;
    protected string $filtrarApenasInclusao;
    protected string $filtrarApenasAlteracao;
    protected string $filtrarCidadeContendo;
    protected string $filtrarPorUf;
    protected string $filtrarPorCidade;
}
