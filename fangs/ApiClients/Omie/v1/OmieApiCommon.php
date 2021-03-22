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
     * @param string $sourceIndex
     * @param string $targetIndex
     *
     * @return int|null
     */
    public static function indexComparison(string $sourceIndex, string $targetIndex): ?int
    {
        if ($sourceIndex !== null) {
            if ($targetIndex !== null) {
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

    /**
     * @param int    $compareResult
     * @param string $indexName
     *
     * @return array
     */
    public static function comparisonResultProcessing(int $compareResult, string $indexName): array
    {
        $comparisonData = [
            'texts' => [],
            'diff'  => [
                'notEqual'      => [],
                'emptyOnTarget' => [],
                'emptyOnSource' => [],
            ],
        ];

        switch ($compareResult) {
            case OmieApiCommon::COMPARE_RESULT_VALOR_DIFERENTE:
                $comparisonData['texts'][] = "Valor diferente para o índice $indexName";
                $comparisonData['diff']['notEqual'][] = $indexName;
                break;

            case OmieApiCommon::COMPARE_RESULT_VALOR_AUSENTE_ALVO:
                $comparisonData['texts'][] = "Valor ausente no alvo para o índice $indexName";
                $comparisonData['diff']['emptyOnTarget'][] = $indexName;
                break;

            case OmieApiCommon::COMPARE_RESULT_VALOR_AUSENTE_ORIGEM:
                $comparisonData['texts'][] = "Valor ausente na origem para o índice $indexName";
                $comparisonData['diff']['emptyOnSource'][] = $indexName;
                break;
        }

        return $comparisonData;
    }
}
