<?php

namespace Bookeo;

use BadMethodCallException;
use ErrorException;
use GuzzleHttp\Exception\ClientException;
use Bookeo\Interfaces\QueryInterface;

/**
 * @property \Bookeo\Endpoints\Availability $availability Availability of time slots
 * @property \Bookeo\Endpoints\Settings     $settings     Settings of account
 * @property \Bookeo\Endpoints\Webhooks     $webhooks     Manage callback notifications
 * @property \Bookeo\Endpoints\Customers    $customers    Operations to manage customers
 * @property \Bookeo\Endpoints\Payments     $payments     Operations to manage payments
 * @property \Bookeo\Endpoints\Holds        $holds        Operations to create temporary holds before finalizing bookings
 * @property \Bookeo\Endpoints\Bookings     $bookings     Operations to manage bookings
 *
 * @method \Bookeo\Endpoints\Webhooks  webhook(string $webhook_id)
 * @method \Bookeo\Endpoints\Payments  payment(string $payment_id)
 * @method \Bookeo\Endpoints\Customers customer(string $customer_id)
 * @method \Bookeo\Endpoints\Holds     hold(string $hold_id)
 * @method \Bookeo\Endpoints\Bookings  booking(string $booking_id)
 *
 * Single entry point for all classes
 *
 * @package Bookeo
 */
class Client implements QueryInterface
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
     * @var array
     */
    protected static $variables = [];

    /**
     * @var array
     */
    protected $query = [];

    /**
     * API constructor.
     *
     * @param array|Config $config
     *
     * @throws ErrorException
     */
    public function __construct($config)
    {
        // If array then need create object
        if (is_array($config)) {
            $config = new Config($config);
        }

        if ($config instanceof Config) {
            // Save config into local variable
            $this->config = $config;

            // Each request should contain keys
            $this
                ->appendToQuery('secretKey', $config->get('secret_key'))
                ->appendToQuery('apiKey', $config->get('api_key'));

            // Store the client object
            $this->client = new \GuzzleHttp\Client($config->guzzle());

        } else {
            throw new \ErrorException('Config object is invalid');
        }
    }

    /**
     * Append some value to query
     *
     * @param string     $name
     * @param string|int $value
     *
     * @return $this
     */
    protected function appendToQuery(string $name, $value): self
    {
        $this->query[$name] = $value;
        return $this;
    }

    /**
     * Generate ready to use query from array of parameters
     *
     * @return string
     */
    protected function getQuery(): string
    {
        return http_build_query($this->query);
    }

    /**
     * Convert underscore_strings to camelCase (medial capitals).
     *
     * @param string $str
     *
     * @return string
     */
    private function snakeToPascal(string $str): string
    {
        // Remove underscores, capitalize words, squash, lowercase first.
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }

    /**
     * Magic method required for call of another classes
     *
     * @param string $name
     *
     * @return bool|object
     * @throws BadMethodCallException
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

        } catch (ErrorException | ClientException $e) {
            echo $e->getMessage();
        }

        // If object is not created
        if (!is_object($object)) {
            throw new BadMethodCallException("Class $class could not to be loaded");
        }

        return $object;
    }

    /**
     * Magic method required for call of another classes
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return bool|object
     * @throws BadMethodCallException
     */
    public function __call(string $name, array $arguments)
    {
        // By default return is empty
        $object = '';

        // Set class name as namespace
        $class = $this->namespace . '\\' . $this->snakeToPascal($name);

        try {

            // Try to create object by name
            $object = new $class($this->config);

        } catch (ErrorException | ClientException $e) {
            echo $e->getMessage();
        }

        // If object is not created
        if (!is_object($object)) {
            throw new BadMethodCallException("Class $class could not to be loaded");
        }

        return call_user_func_array($object, $arguments);
    }

    /**
     * Check if class is exist in folder
     *
     * @param string $name
     *
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
     *
     * @throws BadMethodCallException
     */
    public function __set(string $name, $value)
    {
        self::$variables[$name] = $value;
    }
}
