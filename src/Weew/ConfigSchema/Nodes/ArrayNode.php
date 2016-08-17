<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\Constraints\AllowedSubsetConstraint;
use Weew\Validator\Constraints\ArrayConstraint;
use Weew\Validator\Constraints\ForbiddenSubsetConstraint;
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

        $this->addConstraints([
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
        return $this->addConstraint(
            new MinLengthConstraint($min)
        );
    }

    /**
     * @param int $max
     *
     * @return IArrayNode
     */
    public function max($max) {
        return $this->addConstraint(
            new MaxLengthConstraint($max)
        );
    }

    /**
     * @param array $values
     *
     * @return IArrayNode
     */
    public function allowed(array $values) {
        return $this->addConstraint(
            new AllowedSubsetConstraint($values)
        );
    }

    /**
     * @param array $values
     *
     * @return IArrayNode
     */
    public function forbidden(array $values) {
        return $this->addConstraint(
            new ForbiddenSubsetConstraint($values)
        );
    }
}
