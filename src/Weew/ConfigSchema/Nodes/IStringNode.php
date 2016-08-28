<?php

namespace Weew\ConfigSchema\Nodes;

interface IStringNode extends INode {
    /**
     * @param int $min
     *
     * @return IStringNode
     */
    function min($min);

    /**
     * @param int $max
     *
     * @return IStringNode
     */
    function max($max);

    /**
     * @param int $length
     *
     * @return IStringNode
     */
    function length($length);

    /**
     * @return IStringNode
     */
    function email();

    /**
     * @return IStringNode
     */
    function url();

    /**
     * @return IStringNode
     */
    function alpha();

    /**
     * @return IStringNode
     */
    function alphanumeric();

    /**
     * @param string $regex
     *
     * @return IStringNode
     */
    function matches($regex);

    /**
     * @param array $values
     *
     * @return IStringNode
     */
    function allowed(array $values);

    /**
     * @param array $values
     *
     * @return IStringNode
     */
    function forbidden(array $values);

    /**
     * @return IStringNode
     */
    function nullable();
}
