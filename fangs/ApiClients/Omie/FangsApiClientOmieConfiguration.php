<?php
namespace Fangs\ApiClients\Omie;

/**
 * Class FangsApiClientOmieConfiguration.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie
 * @name    FangsApiClientOmieConfiguration
 * @version 1.0.0
 */
class FangsApiClientOmieConfiguration
{
    protected string $appKey;
    protected string $appSecret;


    /**
     * FangsApiClientOmieConfiguration constructor.
     *
     * @param string $appKey
     * @param string $appSecret
     */
    public function __construct(
        string $appKey,
        string $appSecret
    ) {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }


    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * @param string $appKey
     *
     * @return FangsApiClientOmieConfiguration
     */
    public function setAppKey(string $appKey): FangsApiClientOmieConfiguration
    {
        $this->appKey = $appKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * @param string $appSecret
     *
     * @return FangsApiClientOmieConfiguration
     */
    public function setAppSecret(string $appSecret): FangsApiClientOmieConfiguration
    {
        $this->appSecret = $appSecret;

        return $this;
    }
}
