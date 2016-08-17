<?php

namespace Weew\ConfigSchema\Nodes;

interface INumericNode extends IChainNode {
    /**
     * @param int $min
     *
     * @return INumericNode
     */
    function min($min);

    /**
     * @param int $max
     *
     * @return INumericNode
     */
    function max($max);

    /**
     * @param array $values
     *
     * @return INumericNode
     */
    function allowed(array $values);

    /**
     * @param array $values
     *
     * @return INumericNode
     */
    function forbidden(array $values);
}
