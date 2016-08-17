<?php

namespace Weew\ConfigSchema\Nodes;

interface IArrayNode extends IChainNode {
    /**
     * @param int $min
     *
     * @return IArrayNode
     */
    function min($min);

    /**
     * @param int $max
     *
     * @return IArrayNode
     */
    function max($max);

    /**
     * @param array $values
     *
     * @return IArrayNode
     */
    function allowed(array $values);

    /**
     * @param array $values
     *
     * @return IArrayNode
     */
    function forbidden(array $values);
}