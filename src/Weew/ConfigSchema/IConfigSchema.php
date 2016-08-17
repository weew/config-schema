<?php

namespace Weew\ConfigSchema;

use Weew\ConfigSchema\Nodes\IChainNode;
use Weew\Validator\IConstraint;

interface IConfigSchema extends IChainNode {
    /**
     * @param string $key
     * @param IConstraint $constraint
     *
     * @return IConfigSchema
     */
    function addConstraint($key, IConstraint $constraint);

    /**
     * @param string $key
     * @param IConstraint[] $constraints
     *
     * @return IConfigSchema
     */
    function addConstraints($key, array $constraints);
}
