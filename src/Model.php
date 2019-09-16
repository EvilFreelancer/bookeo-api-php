<?php

namespace Bookeo;

use InvalidArgumentException;

class Model
{
    /**
     * Model constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * List of allowed fields
     *
     * @return array
     * @codeCoverageIgnore
     */
    protected function allowed(): array
    {
        return [];
    }

    /**
     * @var array
     */
    private $required = [];

    /**
     * @param array $required
     */
    public function setRequired(array $required): void
    {
        $this->required = $required;
    }

    /**
     * List of required fields
     *
     * @return array
     */
    private function required(): array
    {
        return $this->required;
    }

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        return $this->variables[$name];
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @throws InvalidArgumentException
     */
    public function __set(string $name, $value)
    {
        if (!array_key_exists($name, $this->allowed())) {
            throw new InvalidArgumentException("Argument $name is not allowed [" . implode(',', $this->allowed()) . ']');
        }

        $this->variables[$name] = $value;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name): bool
    {
        return isset($this->variables[$name]);
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     */
    public function toArray(): array
    {
        $missing = array_diff_key(array_flip($this->required()), $this->variables);

        if (!empty($missing)) {
            throw new InvalidArgumentException('Keys missing [' . implode(',', $missing) . ']');
        }

        return $this->variables;
    }
}
