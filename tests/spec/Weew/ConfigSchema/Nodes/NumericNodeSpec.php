<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\Node;
use Weew\ConfigSchema\Nodes\NumericNode;
use Weew\Validator\Constraints\AllowedConstraint;
use Weew\Validator\Constraints\ForbiddenConstraint;
use Weew\Validator\Constraints\MaxConstraint;
use Weew\Validator\Constraints\MinConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NullableConstraint;
use Weew\Validator\Constraints\NumericConstraint;

/**
 * @mixin NumericNode
 */
class NumericNodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $schema->constraints('key', [
            new NotNullConstraint('message'),
            new NumericConstraint(),
        ])->shouldBeCalled();

        $this->beConstructedWith($schema, 'key', 'message');
    }

    function it_is_initializable() {
        $this->shouldHaveType(NumericNode::class);
        $this->shouldHaveType(Node::class);
    }

    function it_adds_min_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new MinConstraint(10))->shouldBeCalled();
        $this->min(10)->shouldBe($this);
    }

    function it_adds_max_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new MaxConstraint(10))->shouldBeCalled();
        $this->max(10)->shouldBe($this);
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
