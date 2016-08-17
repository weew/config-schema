<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\BooleanNode;
use Weew\ConfigSchema\Nodes\Node;

/**
 * @mixin BooleanNode
 */
class BooleanNodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $this->beConstructedWith($schema, 'key', 'message');
    }

    function it_is_initializable() {
        $this->shouldHaveType(BooleanNode::class);
        $this->shouldHaveType(Node::class);
    }
}
