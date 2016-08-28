<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\Constraints\BooleanConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NullableConstraint;

class BooleanNode extends Node implements IBooleanNode {
    /**
     * BooleanNode constructor.
     *
     * @param IConfigSchema $schema
     * @param string $key
     * @param string $message
     */
    public function __construct(IConfigSchema $schema, $key, $message = null) {
        parent::__construct($schema, $key);

        $this->constraints([
            new NotNullConstraint($message),
            new BooleanConstraint(),
        ]);
    }

    /**
     * @return IBooleanNode
     */
    public function nullable() {
        return $this->constraint(
            new NullableConstraint()
        );
    }
}

