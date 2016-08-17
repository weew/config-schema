<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\ArrayNode;
use Weew\ConfigSchema\Nodes\Node;
use Weew\Validator\Constraints\AllowedSubsetConstraint;
use Weew\Validator\Constraints\ArrayConstraint;
use Weew\Validator\Constraints\ForbiddenSubsetConstraint;
use Weew\Validator\Constraints\LengthConstraint;
use Weew\Validator\Constraints\MaxLengthConstraint;
use Weew\Validator\Constraints\MinLengthConstraint;
use Weew\Validator\Constraints\NotNullConstraint;

/**
 * @mixin ArrayNode
 */
class ArrayNodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $schema->constraints('key', [
            new NotNullConstraint('message'),
            new ArrayConstraint(),
        ])->shouldBeCalled();

        $this->beConstructedWith($schema, 'key', 'message');
    }

    function it_is_initializable(IConfigSchema $schema) {
        $this->shouldHaveType(ArrayNode::class);
        $this->shouldHaveType(Node::class);
    }

    function it_adds_min_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new MinLengthConstraint(10))->shouldBeCalled();
        $this->min(10)->shouldBe($this);
    }

    function it_adds_max_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new MaxLengthConstraint(10))->shouldBeCalled();
        $this->max(10)->shouldBe($this);
    }

    function it_adds_length_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new LengthConstraint(10))->shouldBeCalled();
        $this->length(10)->shouldBe($this);
    }

    function it_adds_allowed_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new AllowedSubsetConstraint([1, 2]))
            ->shouldBeCalled();
        $this->allowed([1, 2])->shouldBe($this);
    }

    function it_adds_forbidden_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new ForbiddenSubsetConstraint([1, 2]))
            ->shouldBeCalled();
        $this->forbidden([1, 2])->shouldBe($this);
    }
}
