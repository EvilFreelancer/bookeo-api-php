<?php

namespace Bookeo;

use ErrorException;
use BadMethodCallException;
use Bookeo\Endpoints\Availability;
use Bookeo\Endpoints\Settings;
use Bookeo\Helpers\HttpTrait;

/**
 * @property Availability $availability  Availability of time slots
 * @property Settings     $settings      Access account settings
 *
 * Single entry point for all classes
 *
 * @package Bookeo
 */
class Client
{
    use HttpTrait;

    /**
     * @var string
     */
    protected $namespace = __NAMESPACE__ . '\\Endpoints';

    /**
     * Type of query
     *
     * @var string
     */
    protected $type;

    /**
     * Endpoint of query
     *
     * @var string
     */
    protected $endpoint;

    /**
     * Parameters of query
     *
     * @var mixed
     */
    protected $params;

    /**
     * Model of response data
     *
     * @var mixed
     */
    protected $response;

    /**
     * @var array
     */
    protected static $variables = [];

    /**
     * API constructor.
     *
     * @param string|array|Config $config
     * @throws ErrorException
     */
    public function __construct($config)
    {
        // If string then it's a token
        if (\is_string($config)) {
            $config = new Config(['api_key' => $config]);
        }

        // If array then need create object
        if (\is_array($config)) {
            $config = new Config($config);
        }

        // Save config into local variable
        $this->config = $config;

        // Store the client object
        $this->client = new \GuzzleHttp\Client($config->guzzle());
    }

    /**
     * Convert underscore_strings to camelCase (medial capitals).
     *
     * @param string $str
     *
     * @return string
     */
    public function snakeToPascal(string $str): string
    {
        // Remove underscores, capitalize words, squash, lowercase first.
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }

    /**
     * Magic method required for call of another classes
     *
     * @param string $name
     * @return bool|object
     */
    public function __get(string $name)
    {
        if (isset(self::$variables[$name])) {
            return self::$variables[$name];
        }

        // By default return is empty
        $object = '';

        try {

            // Set class name as namespace
            $class = $this->namespace . '\\' . $this->snakeToPascal($name);

            // Try to create object by name
            $object = new $class($this->config);

            // If object is not created
            if (!is_object($object)) {
                throw new BadMethodCallException("Class $class could not to be loaded");
            }

        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            echo $e->getTrace();
        }

        if ($object === '') {
            throw new BadMethodCallException('Wrong type of object');
        }

        return $object;
    }

    /**
     * Magic method required for call of another classes
     *
     * @param string $name
     * @param array  $arguments
     * @return bool|object
     */
    public function __call(string $name, array $arguments)
    {
        // By default return is empty
        $object = '';

        try {

            // Set class name as namespace
            $class = $this->namespace . '\\' . $this->snakeToPascal($name) . 's';

            // Try to create object by name
            $object = new $class($this->config);

            // If object is not created
            if (!is_object($object)) {
                throw new BadMethodCallException("Class $class could not to be loaded");
            }

        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
            echo $e->getTrace();
        }

        if ($object === '') {
            throw new BadMethodCallException('Wrong type of object');
        }

        return call_user_func_array($object, $arguments);
    }

    /**
     * Check if class is exist in folder
     *
     * @param string $name
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset(self::$variables[$name]);
    }

    /**
     * Ordinary dummy setter, it should be ignored (added to PSR reasons)
     *
     * @param string $name
     * @param mixed  $value
     * @throws BadMethodCallException
     */
    public function __set(string $name, $value)
    {
        self::$variables[$name] = $value;
    }
}
