<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\Constraints\AllowedConstraint;
use Weew\Validator\Constraints\ForbiddenConstraint;
use Weew\Validator\Constraints\NotNullConstraint;

class ValueNode extends Node implements IValueNode {
    /**
     * ValueNode constructor.
     *
     * @param IConfigSchema $schema
     * @param string $key
     * @param string $message
     */
    public function __construct(IConfigSchema $schema, $key, $message = null) {
        parent::__construct($schema, $key);

        $this->constraint(
            new NotNullConstraint($message)
        );
    }

    /**
     * @param array $values
     *
     * @return IValueNode
     */
    public function allowed(array $values) {
        return $this->constraint(new AllowedConstraint($values));
    }

    /**
     * @param array $values
     *
     * @return IValueNode
     */
    public function forbidden(array $values) {
        return $this->constraint(new ForbiddenConstraint($values));
    }
}
