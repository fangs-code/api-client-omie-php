<?php
namespace Fangs\ApiClients\Omie\Models\Requests;

use Fangs\ApiClients\Omie\Models\Entities\CidadeEntityOmieModel;

/**
 * Class CidadeListarResponseOmieModel.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\Models\Requests
 * @name    CidadeListarResponseOmieModel
 * @version 1.0.0
 */
class CidadeListarResponseOmieModel
{
    protected int $pagina;
    protected int $totalDePaginas;
    protected int $registros;
    protected int $totalDeRegistros;

    /**
     * @var CidadeEntityOmieModel[]
     */
    protected array $listaCidades;

}
