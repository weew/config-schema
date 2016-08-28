<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\BooleanNode;
use Weew\ConfigSchema\Nodes\Node;
use Weew\Validator\Constraints\BooleanConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NullableConstraint;

/**
 * @mixin BooleanNode
 */
class BooleanNodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $schema->constraints('key', [
            new NotNullConstraint('message'),
            new BooleanConstraint(),
        ])->shouldBeCalled();

        $this->beConstructedWith($schema, 'key', 'message');
    }

    function it_is_initializable() {
        $this->shouldHaveType(BooleanNode::class);
        $this->shouldHaveType(Node::class);
    }

    function it_adds_nullable_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new NullableConstraint())
            ->shouldBeCalled();
        $this->nullable();
    }
}
