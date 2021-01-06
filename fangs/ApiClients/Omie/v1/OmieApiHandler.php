<?php
namespace Fangs\ApiClients\Omie\v1;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;

/**
 * Class OmieApiHandler.
 *
 * @author  Leonardo de Aguiar <leoaguiarpereira@gmail.com>
 * @package Fangs\ApiClients\Omie\v1
 * @name    OmieApiHandler
 * @version 1.0.0
 */
class OmieApiHandler
{
    protected OmieApiConfig $config;


    /**
     * OmieApiHandler constructor.
     *
     * @param \Fangs\ApiClients\Omie\v1\OmieApiConfig $config
     */
    public function __construct(
        OmieApiConfig $config
    ) {
        $this->config = $config;
    }


    /**
     * @param string     $action
     * @param array|null $param
     *
     * @return array
     */
    private function preparePayload(string $action, array $param = null)
    {
        $payload = [
            'app_key'    => $this->config->getAppKey(),
            'app_secret' => $this->config->getAppSecret(),
            'call'       => $action,
        ];

        if ($param) {
            $payload['param'] = [$param];
        }

        return $payload;
    }

    /**
     * @param string     $endpoint
     * @param string     $action
     * @param array|null $param
     *
     * @return array
     * @throws \Exception
     */
    protected function call(string $endpoint, string $action, array $param = null)
    {
        $guzzleClient = new Client();

        try {
            $res = $guzzleClient->post($endpoint, [
                RequestOptions::JSON => $this->preparePayload($action, $param),
            ]);

            return json_decode($res->getBody(), true);

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $errorData = json_decode((string)$response->getBody(), true);

                throw new Exception($errorData['faultstring']);

            } else {
                $response = $e->getHandlerContext();

                if (isset($response['error'])) {
                    throw new Exception($response['error']);
                } else {
                    throw new Exception("An unknow error ocurred calling: {$endpoint} with action: {$action}");
                }
            }

        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
