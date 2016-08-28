<?php

namespace Weew\ConfigSchema\Nodes;

interface IArrayNode extends INode {
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
     * @param int $length
     *
     * @return IArrayNode
     */
    function length($length);

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

    /**
     * @return IArrayNode
     */
    function nullable();
}
