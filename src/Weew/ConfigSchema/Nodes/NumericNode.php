<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\Constraints\AllowedConstraint;
use Weew\Validator\Constraints\ForbiddenConstraint;
use Weew\Validator\Constraints\MaxConstraint;
use Weew\Validator\Constraints\MinConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NumericConstraint;

class NumericNode extends Node implements INumericNode {
    /**
     * NumericNode constructor.
     *
     * @param IConfigSchema $schema
     * @param string $key
     * @param string $message
     */
    public function __construct(IConfigSchema $schema, $key, $message = null) {
        parent::__construct($schema, $key);

        $this->addConstraints([
            new NotNullConstraint($message),
            new NumericConstraint(),
        ]);
    }

    /**
     * @param int $min
     *
     * @return INumericNode
     */
    public function min($min) {
        return $this->addConstraint(
            new MinConstraint($min)
        );
    }

    /**
     * @param int $max
     *
     * @return INumericNode
     */
    public function max($max) {
        return $this->addConstraint(
            new MaxConstraint($max)
        );
    }

    /**
     * @param array $values
     *
     * @return INumericNode
     */
    public function allowed(array $values) {
        return $this->addConstraint(
            new AllowedConstraint($values)
        );
    }

    /**
     * @param array $values
     *
     * @return INumericNode
     */
    public function forbidden(array $values) {
        return $this->addConstraint(
            new ForbiddenConstraint($values)
        );
    }
}
