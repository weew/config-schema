<?php

namespace tests\spec\Weew\ConfigSchema\Nodes;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\IConfigSchema;
use Weew\ConfigSchema\Nodes\IArrayNode;
use Weew\ConfigSchema\Nodes\IBooleanNode;
use Weew\ConfigSchema\Nodes\INumericNode;
use Weew\ConfigSchema\Nodes\IStringNode;
use Weew\ConfigSchema\Nodes\IValueNode;
use Weew\ConfigSchema\Nodes\Node;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\ValidationResult;

/**
 * @mixin Node
 */
class NodeSpec extends ObjectBehavior {
    function let(IConfigSchema $schema) {
        $this->beConstructedWith($schema, 'key');
    }

    function it_is_initializable() {
        $this->shouldHaveType(Node::class);
    }

    function it_calls_has_value_on_schema(
        IConfigSchema $schema,
        IValueNode $node
    ) {
        $schema->hasValue('key', 'message')
            ->shouldBeCalled()
            ->willReturn($node);
        $this->hasValue('key', 'message')
            ->shouldHaveType($node);
    }

    function it_calls_has_string_on_schema(
        IConfigSchema $schema,
        IStringNode $node
    ) {
        $schema->hasString('key', 'message')
            ->shouldBeCalled()
            ->willReturn($node);
        $this->hasString('key', 'message')
            ->shouldHaveType($node);
    }

    function it_calls_has_boolean_on_schema(
        IConfigSchema $schema,
        IBooleanNode $node
    ) {
        $schema->hasBoolean('key', 'message')
            ->shouldBeCalled()
            ->willReturn($node);
        $this->hasBoolean('key', 'message')
            ->shouldHaveType($node);
    }

    function it_calls_has_number_on_schema(
        IConfigSchema $schema,
        INumericNode $node
    ) {
        $schema->hasNumber('key', 'message')
            ->shouldBeCalled()
            ->willReturn($node);
        $this->hasNumber('key', 'message')
            ->shouldHaveType($node);
    }

    function it_calls_has_array_on_schema(
        IConfigSchema $schema,
        IArrayNode $node
    ) {
        $schema->hasArray('key', 'message')
            ->shouldBeCalled()
            ->willReturn($node);
        $this->hasArray('key', 'message')
            ->shouldHaveType($node);
    }

    function it_calls_has_number_keys_on_schema(
        IConfigSchema $schema,
        IStringNode $node
    ) {
        $schema->hasArrayKeys('key', 'message')
            ->shouldBeCalled()
            ->willReturn($node);
        $this->hasArrayKeys('key', 'message')
            ->shouldHaveType($node);
    }

    function it_calls_assert_on_schema(IConfigSchema $schema) {
        $schema->assert()->shouldBeCalled();
        $this->assert();
    }

    function it_calls_check_on_schema(IConfigSchema $schema) {
        $result = new ValidationResult();
        $schema->check()->shouldBeCalled();
        $schema->check()->willReturn($result);

        $this->check()->shouldHaveType($result);
    }

    function it_adds_constraint(IConfigSchema $schema) {
        $constraint = new NotNullConstraint();
        $schema->addConstraint('key', $constraint)->shouldBeCalled();
        $this->addConstraint($constraint)->shouldBe($this);
    }

    function it_adds_constraints(IConfigSchema $schema) {
        $constraints = [new NotNullConstraint()];
        $schema->addConstraints('key', $constraints)->shouldBeCalled();
        $this->addConstraints($constraints)->shouldBe($this);
    }
}
