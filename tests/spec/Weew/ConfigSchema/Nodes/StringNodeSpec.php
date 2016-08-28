<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\Node;
use Weew\ConfigSchema\Nodes\StringNode;
use Weew\Validator\Constraints\AllowedConstraint;
use Weew\Validator\Constraints\AlphaConstraint;
use Weew\Validator\Constraints\AlphaNumericConstraint;
use Weew\Validator\Constraints\EmailConstraint;
use Weew\Validator\Constraints\ForbiddenConstraint;
use Weew\Validator\Constraints\LengthConstraint;
use Weew\Validator\Constraints\MaxLengthConstraint;
use Weew\Validator\Constraints\MinLengthConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\NullableConstraint;
use Weew\Validator\Constraints\RegexConstraint;
use Weew\Validator\Constraints\StringConstraint;
use Weew\Validator\Constraints\UrlConstraint;

/**
 * @mixin StringNode
 */
class StringNodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $schema->constraints('key', [
            new NotNullConstraint('message'),
            new StringConstraint(),
        ])->shouldBeCalled();

        $this->beConstructedWith($schema, 'key', 'message');
    }

    function it_is_initializable() {
        $this->shouldHaveType(StringNode::class);
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

    function it_adds_email_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new EmailConstraint())->shouldBeCalled();
        $this->email()->shouldBe($this);
    }

    function it_adds_url_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new UrlConstraint())->shouldBeCalled();
        $this->url()->shouldBe($this);
    }

    function it_adds_alpha_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new AlphaConstraint())->shouldBeCalled();
        $this->alpha()->shouldBe($this);
    }

    function it_adds_alphanumeric_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new AlphaNumericConstraint())->shouldBeCalled();
        $this->alphanumeric()->shouldBe($this);
    }

    function it_adds_matches_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new RegexConstraint('regex'))->shouldBeCalled();
        $this->matches('regex')->shouldBe($this);
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

    function it_adds_custom_constraint(IConfigSchema $schema) {
        $constraint = new NotNullConstraint();
        $schema->constraint('key', $constraint)->shouldBeCalled();
        $this->constraint($constraint)->shouldBe($this);
    }

    function it_adds_nullable_constraint(IConfigSchema $schema) {
        $schema->constraint('key', new NullableConstraint())
            ->shouldBeCalled();
        $this->nullable();
    }
}
