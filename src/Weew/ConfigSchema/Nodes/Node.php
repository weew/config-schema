<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\IConstraint;
use Weew\Validator\IValidationResult;

class Node implements INode {
    /**
     * @var IConfigSchema
     */
    protected $schema;

    /**
     * @var string
     */
    protected $key;

    /**
     * Node constructor.
     *
     * @param IConfigSchema $schema
     * @param string $key
     */
    public function __construct(IConfigSchema $schema, $key) {
        $this->key = $key;
        $this->schema = $schema;
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IValueNode
     */
    public function hasValue($key, $message = null) {
        return $this->schema->hasValue($key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    public function hasString($key, $message = null) {
        return $this->schema->hasString($key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return INumericNode
     */
    public function hasNumber($key, $message = null) {
        return $this->schema->hasNumber($key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IBooleanNode
     */
    public function hasBoolean($key, $message = null) {
        return $this->schema->hasBoolean($key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IArrayNode
     */
    public function hasArray($key, $message = null) {
        return $this->schema->hasArray($key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    public function hasArrayKeys($key, $message = null) {
        return $this->schema->hasArrayKeys($key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    public function hasArrayValues($key, $message = null) {
        return $this->schema->hasArrayValues($key, $message);
    }

    /**
     * @return null
     */
    public function assert() {
        return $this->schema->assert();
    }

    /**
     * @return IValidationResult
     */
    public function check() {
        return $this->schema->check();
    }

    /**
     * @param IConstraint $constraint
     *
     * @return $this
     */
    public function constraint(IConstraint $constraint) {
        $this->schema->constraint($this->key, $constraint);

        return $this;
    }

    /**
     * @param IConstraint[] $constraints
     *
     * @return $this
     */
    public function constraints(array $constraints) {
        $this->schema->constraints($this->key, $constraints);

        return $this;
    }
}
