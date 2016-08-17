<?php

namespace Weew\ConfigSchema;

use Weew\Config\IConfig;
use Weew\ConfigSchema\Exceptions\ConfigValidationException;
use Weew\ConfigSchema\Nodes\ArrayNode;
use Weew\ConfigSchema\Nodes\BooleanNode;
use Weew\ConfigSchema\Nodes\IArrayNode;
use Weew\ConfigSchema\Nodes\IBooleanNode;
use Weew\ConfigSchema\Nodes\INumericNode;
use Weew\ConfigSchema\Nodes\IStringNode;
use Weew\ConfigSchema\Nodes\IValueNode;
use Weew\ConfigSchema\Nodes\NumericNode;
use Weew\ConfigSchema\Nodes\StringNode;
use Weew\ConfigSchema\Nodes\ValueNode;
use Weew\Validator\IConstraint;
use Weew\Validator\IValidationResult;
use Weew\Validator\IValidator;
use Weew\Validator\Validator;

class ConfigSchema implements IConfigSchema {
    /**
     * @var IConfig
     */
    protected $config;

    /**
     * @var IValidator
     */
    protected $validator;

    /**
     * ConfigSchema constructor.
     *
     * @param IConfig $config
     * @param IValidator $validator
     */
    public function __construct(IConfig $config, IValidator $validator = null) {
        if ( ! $validator instanceof IValidator) {
            $validator = $this->createValidator();
        }

        $this->config = $config;
        $this->validator = $validator;
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IValueNode
     */
    public function hasValue($key, $message = null) {
        return new ValueNode($this, $key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    public function hasString($key, $message = null) {
        return new StringNode($this, $key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return INumericNode
     */
    public function hasNumber($key, $message = null) {
        return new NumericNode($this, $key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IBooleanNode
     */
    public function hasBoolean($key, $message = null) {
        return new BooleanNode($this, $key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IArrayNode
     */
    public function hasArray($key, $message = null) {
        return new ArrayNode($this, $key, $message);
    }

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    public function hasArrayKeys($key, $message = null) {
        $key = s('%s.#', $key);

        return new StringNode($this, $key, $message);
    }

    /**
     * @throws ConfigValidationException
     */
    public function assert() {
        $check = $this->check();

        if ($check->isFailed()) {
            $message = 'Configuration is not valid. ';

            foreach ($check->getErrors() as $index => $error) {
                $message .= s(
                    "\n%s: %s ",
                    $error->getSubject(),
                    $error->getMessage()
                );
            }

            throw new ConfigValidationException($message, $check);
        }
    }

    /**
     * @return IValidationResult
     */
    public function check() {
        return $this->validator->check(
            $this->config->toArray()
        );
    }

    /**
     * @param string $key
     * @param IConstraint $constraint
     *
     * @return IConfigSchema
     */
    public function constraint($key, IConstraint $constraint) {
        $this->validator->addConstraint($key, $constraint);

        return $this;
    }

    /**
     * @param string $key
     * @param IConstraint[] $constraints
     *
     * @return IConfigSchema
     */
    public function constraints($key, array $constraints) {
        $this->validator->addConstraints($key, $constraints);

        return $this;
    }

    /**
     * @return IValidator
     */
    protected function createValidator() {
        return new Validator();
    }
}
