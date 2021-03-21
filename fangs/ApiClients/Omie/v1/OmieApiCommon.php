<?php
namespace Fangs\ApiClients\Omie\v1;

/**
 * Class OmieApiCommon.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1
 * @name    OmieApiCommon
 * @version 1.0.0
 */
class OmieApiCommon
{
    const COMPARE_RESULT_VALOR_DIFERENTE = 1;
    const COMPARE_RESULT_VALOR_AUSENTE_ALVO = 2;
    const COMPARE_RESULT_VALOR_AUSENTE_ORIGEM = 3;


    /**
     * @param $sourceIndex
     * @param $targetIndex
     *
     * @return string|null
     */
    public static function indexComparison($sourceIndex, $targetIndex): ?string
    {
        if ($sourceIndex) {
            if ($targetIndex) {
                if ($sourceIndex != $targetIndex) {
                    return self::COMPARE_RESULT_VALOR_DIFERENTE;
                }
            } else {
                return self::COMPARE_RESULT_VALOR_AUSENTE_ALVO;
            }
        } else {
            if (isset($targetIndex)) {
                return self::COMPARE_RESULT_VALOR_AUSENTE_ORIGEM;
            }
        }

        return null;
    }
}
