<?php

namespace Bookeo;

class Config
{
    /**
     * List of allowed parameters
     */
    public const ALLOWED = [
        'user_agent',
        'base_uri',
        'secret_key'.
        'api_key',
        'timeout',
        'tries',
        'seconds'
    ];

    /**
     * List of minimal required parameters
     */
    public const REQUIRED = [
        'user_agent',
        'base_uri',
        'timeout',
        'secret_key'.
        'api_key',
    ];

    /**
     * List of configured parameters
     *
     * @var array
     */
    private $_parameters;

    /**
     * Config constructor.
     *
     * @param array $parameters List of parameters which can be set on object creation stage
     * @throws \ErrorException
     */
    public function __construct(array $parameters = [])
    {
        // Set default parameters of client
        $this->_parameters = [
            // Errors must be disabled by default, because we need to get error codes
            // @link http://docs.guzzlephp.org/en/stable/request-options.html#http-errors
            'http_errors' => false,

            // Wrapper settings
            'tries'       => 2,  // Count of tries
            'seconds'     => 10, // Waiting time per each try

            // Main parameters
            'timeout'     => 20,
            'user_agent'  => 'Bookeo PHP Client',
            'base_uri'    => 'https://api.bookeo.com/v2'
        ];

        // Overwrite parameters by client input
        foreach ($parameters as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Set parameter by name
     *
     * @param string               $name  Name of parameter
     * @param string|bool|int|null $value Value of parameter
     * @return \Bookeo\Config
     * @throws \ErrorException
     */
    public function set($name, $value): self
    {
        if (!\in_array($name, self::ALLOWED, false)) {
            throw new \ErrorException("Parameter \"$name\" is not in available list [" . implode(',', self::ALLOWED) . ']');
        }

        // Add parameters into array
        $this->_parameters[$name] = $value;
        return $this;
    }

    /**
     * Get available parameter by name
     *
     * @param string $name
     * @return string|bool|int|null
     */
    public function get(string $name)
    {
        return $this->_parameters[$name] ?? null;
    }

    /**
     * Get all available parameters
     *
     * @return array
     */
    public function all(): array
    {
        return $this->_parameters;
    }

    /**
     * Return all ready for Guzzle parameters
     *
     * @return array
     */
    public function guzzle(): array
    {
        return [
            // 'base_uri'        => $this->get('base_uri'), // By some reasons base_uri option is not work anymore
            'timeout'         => $this->get('timeout'),
            'track_redirects' => false,
            'debug'           => true,
            'headers'         => [
                'User-Agent' => $this->get('user_agent'),
                'X-API-KEY'  => $this->get('api_key'),
            ]
        ];
    }


    /**
     * Validate preconfigured parameters
     *
     * @return bool
     */
    public function validate(): bool
    {
        foreach (self::REQUIRED as $item) {
            if (false === array_key_exists($item, $this->_parameters)) {
                return false;
            }
        }
        return true;
    }
}
