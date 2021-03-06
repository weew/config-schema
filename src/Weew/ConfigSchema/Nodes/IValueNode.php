<?php

namespace Weew\ConfigSchema\Nodes;

interface IValueNode extends INode {
    /**
     * @param array $values
     *
     * @return IValueNode
     */
    function allowed(array $values);

    /**
     * @param array $values
     *
     * @return IValueNode
     */
    function forbidden(array $values);

    /**
     * @return IValueNode
     */
    function nullable();
}
