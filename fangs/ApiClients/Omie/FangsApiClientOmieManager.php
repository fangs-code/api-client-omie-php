<?php
namespace Fangs\ApiClients\Omie;

/**
 * Class FangsApiClientOmieManager.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie
 * @name    FangsApiClientOmieManager
 * @version 1.0.0
 */
class FangsApiClientOmieManager
{
    protected FangsApiClientOmieConfiguration $configuration;


    /**
     * FangsApiClientOmieManager constructor.
     *
     * @param \Fangs\ApiClients\Omie\FangsApiClientOmieConfiguration $configuration
     */
    public function __construct(
        FangsApiClientOmieConfiguration $configuration
    ) {
        $this->configuration = $configuration;
    }


    /**
     * @return array
     * @throws \Exception
     */
    private function requestBootstrap(string $action)
    {
        return [
            'app_key'    => $this->configuration->getAppKey(),
            'app_secret' => $this->configuration->getAppSecret(),
            'call'       => $action,
        ];
    }


    public function request(){

    }
}
