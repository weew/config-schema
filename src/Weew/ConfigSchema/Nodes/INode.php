<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\Validator\IConstraint;

interface INode extends IChainNode {
    /**
     * @param IConstraint $constraint
     *
     * @return INode
     */
    function addConstraint(IConstraint $constraint);

    /**
     * @param IConstraint[] $constraints
     *
     * @return INode
     */
    function addConstraints(array $constraints);
}
