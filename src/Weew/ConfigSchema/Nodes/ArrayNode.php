<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\Constraints\AllowedSubsetConstraint;
use Weew\Validator\Constraints\ArrayConstraint;
use Weew\Validator\Constraints\ForbiddenSubsetConstraint;
use Weew\Validator\Constraints\LengthConstraint;
use Weew\Validator\Constraints\MaxLengthConstraint;
use Weew\Validator\Constraints\MinLengthConstraint;
use Weew\Validator\Constraints\NotNullConstraint;

class ArrayNode extends Node implements IArrayNode {
    /**
     * ArrayNode constructor.
     *
     * @param IConfigSchema $schema
     * @param string $key
     * @param string $message
     */
    public function __construct(IConfigSchema $schema, $key, $message = null) {
        parent::__construct($schema, $key);

        $this->constraints([
            new NotNullConstraint($message),
            new ArrayConstraint(),
        ]);
    }

    /**
     * @param int $min
     *
     * @return IArrayNode
     */
    public function min($min) {
        return $this->constraint(
            new MinLengthConstraint($min)
        );
    }

    /**
     * @param int $max
     *
     * @return IArrayNode
     */
    public function max($max) {
        return $this->constraint(
            new MaxLengthConstraint($max)
        );
    }

    /**
     * @param int $length
     *
     * @return IArrayNode
     */
    public function length($length) {
        return $this->constraint(
            new LengthConstraint($length)
        );
    }

    /**
     * @param array $values
     *
     * @return IArrayNode
     */
    public function allowed(array $values) {
        return $this->constraint(
            new AllowedSubsetConstraint($values)
        );
    }

    /**
     * @param array $values
     *
     * @return IArrayNode
     */
    public function forbidden(array $values) {
        return $this->constraint(
            new ForbiddenSubsetConstraint($values)
        );
    }
}
