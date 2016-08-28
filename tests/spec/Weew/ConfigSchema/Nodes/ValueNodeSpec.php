<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\Node;
use Weew\ConfigSchema\Nodes\ValueNode;
use Weew\Validator\Constraints\AllowedConstraint;
use Weew\Validator\Constraints\ForbiddenConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NullableConstraint;

/**
 * @mixin ValueNode
 */
class ValueNodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $schema->constraint('key', new NotNullConstraint('message'))
            ->shouldBeCalled();

        $this->beConstructedWith($schema, 'key', 'message');
    }

    function it_is_initializable() {
        $this->shouldHaveType(ValueNode::class);
        $this->shouldHaveType(Node::class);
    }

    function it_adds_allowed_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new AllowedConstraint([1, 2]))
            ->shouldBeCalled();
        $this->allowed([1, 2])->shouldBe($this);
    }

    function it_adds_forbidden_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new ForbiddenConstraint([1, 2]))
            ->shouldBeCalled();
        $this->forbidden([1, 2])->shouldBe($this);
    }

    function it_adds_nullable_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new NullableConstraint())
            ->shouldBeCalled();
        $this->nullable();
    }
}
