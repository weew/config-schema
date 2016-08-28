<?php

namespace Weew\ConfigSchema\Nodes;

interface IBooleanNode extends INode {
    /**
     * @return IBooleanNode
     */
    function nullable();
}
