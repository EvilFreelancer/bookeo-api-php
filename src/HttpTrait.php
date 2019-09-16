<?php

namespace Bookeo;

use GuzzleHttp\Exception\GuzzleException;
use ErrorException;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

/**
 * @author  Paul Rock <paul@drteam.rocks>
 * @link    https://drteam.rocks
 * @license MIT
 * @package Bookeo
 */
trait HttpTrait
{
    /**
     * Initial state of some variables
     *
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * Object of main config
     *
     * @var Config
     */
    protected $config;

    /**
     * Request executor with timeout and repeat tries
     *
     * @param string $type   Request method
     * @param string $url    endpoint url
     * @param mixed  $params List of parameters
     *
     * @return null|ResponseInterface
     * @throws GuzzleException
     * @throws ErrorException
     */
    private function repeatRequest($type, $url, $params): ?ResponseInterface
    {
        $type = strtoupper($type);

        for ($i = 1; $i < $this->config->get('tries'); $i++) {

            if ($params === null) {
                // Execute the request to server
                $result = $this->client->request($type, $this->config->get('base_uri') . $url);
            } else {
                // Execute the request to server
                $result = $this->client->request($type, $this->config->get('base_uri') . $url, [RequestOptions::FORM_PARAMS => $params->toArray()]);
            }

            // Check the code status
            $code   = $result->getStatusCode();
            $reason = $result->getReasonPhrase();

            // 200 - success with non empty body
            // 201 - success without body
            // 204 - successfully deleted
            if ($code === 200 || $code === 201 || $code === 204) {
                return $result;
            }

            // If not "too many requests", then probably some bug on remote or our side
            if ($code !== 429) {
                throw new ErrorException($code . ' ' . $reason);
            }

            // Waiting in seconds
            sleep($this->config->get('seconds'));
        }

        // Return false if loop is done but no answer from server
        return null;
    }

    /**
     * Execute request and return response
     *
     * @return null|object Array with data or NULL if error
     */
    public function exec()
    {
        return $this->doRequest($this->type, $this->endpoint, $this->params);
    }

    /**
     * Execute query and return RAW response from remote API
     *
     * @return null|ResponseInterface RAW response or NULL if error
     */
    public function raw(): ?ResponseInterface
    {
        return $this->doRequest($this->type, $this->endpoint, $this->params, true);
    }

    /**
     * Make the request and analyze the result
     *
     * @param string $type     Request method
     * @param string $endpoint Api request endpoint
     * @param mixed  $params   List of parameters
     * @param bool   $raw      Return data in raw format
     *
     * @return null|object|ResponseInterface Array with data, RAW response or NULL if error
     */
    private function doRequest($type, $endpoint, $params = null, bool $raw = false)
    {
        // Null by default
        $response = null;

        try {
            // Execute the request to server
            $result = $this->repeatRequest($type, $endpoint, $params);

            if (null === $result) {
                throw new ErrorException('Empty result');
            }

            // Return RAW result if required
            $response = $raw ? $result : json_decode($result->getBody(), false);

        } catch (ErrorException | GuzzleException $e) {
            echo $e->getMessage() . "\n";
            echo $e->getTrace();
        }

        return $response;
    }

}
