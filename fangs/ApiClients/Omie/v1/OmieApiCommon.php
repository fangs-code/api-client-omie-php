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
    /**
     * @param $sourceIndex
     * @param $targetIndex
     *
     * @return string|null
     */
    public static function indexComparison($sourceIndex, $targetIndex)
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
