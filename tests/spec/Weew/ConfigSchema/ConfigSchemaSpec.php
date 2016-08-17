<?php

namespace tests\spec\Weew\ConfigSchema;

use PhpSpec\ObjectBehavior;
use Weew\Config\Config;
use Weew\Config\IConfig;
use Weew\ConfigSchema\ConfigSchema;
use Weew\ConfigSchema\Exceptions\ConfigValidationException;
use Weew\ConfigSchema\Nodes\ArrayNode;
use Weew\ConfigSchema\Nodes\BooleanNode;
use Weew\ConfigSchema\Nodes\NumericNode;
use Weew\ConfigSchema\Nodes\StringNode;
use Weew\ConfigSchema\Nodes\ValueNode;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\IValidator;
use Weew\Validator\ValidationError;
use Weew\Validator\ValidationResult;

/**
 * @mixin ConfigSchema
 */
class ConfigSchemaSpec extends ObjectBehavior {
    function let(IConfig $config, IValidator $validator) {
        $this->beConstructedWith($config, $validator);
    }

    function it_is_initializable() {
        $this->shouldHaveType(ConfigSchema::class);
    }

    function it_can_be_constructed_without_validator() {
        $this->beConstructedWith(new Config());
        $this->shouldHaveType(ConfigSchema::class);
    }

    function it_has_value() {
        $node = new ValueNode($this->getWrappedObject(), 'key', 'message');
        $this->hasValue('key', 'message')
            ->shouldHaveType($node);
    }

    function it_has_string() {
        $node = new StringNode($this->getWrappedObject(), 'key', 'message');
        $this->hasString('key', 'message')
            ->shouldHaveType($node);
    }

    function it_has_number() {
        $node = new NumericNode($this->getWrappedObject(), 'key', 'message');
        $this->hasNumber('key', 'message')
            ->shouldHaveType($node);
    }

    function it_has_boolean() {
        $node = new BooleanNode($this->getWrappedObject(), 'key', 'message');
        $this->hasBoolean('key', 'message')
            ->shouldHaveType($node);
    }

    function it_has_array() {
        $node = new ArrayNode($this->getWrappedObject(), 'key', 'message');
        $this->hasArray('key', 'message')
            ->shouldHaveType($node);
    }

    function it_has_array_keys() {
        $node = new StringNode($this->getWrappedObject(), 'key.#', 'message');
        $this->hasArrayKeys('key', 'message')
            ->shouldHaveType($node);
    }

    function it_adds_constraint(IValidator $validator) {
        $constraint = new NotNullConstraint();
        $validator->addConstraint('key', $constraint)->shouldBeCalled();
        $this->addConstraint('key', $constraint);
    }

    function it_adds_constraints(IValidator $validator) {
        $constraints = [new NotNullConstraint()];
        $validator->addConstraints('key', $constraints)->shouldBeCalled();
        $this->addConstraints('key', $constraints);
    }

    function it_checks(
        IValidator $validator,
        IConfig $config
    ) {
        $result = new ValidationResult();
        $config->toArray()->willReturn(['data']);
        $validator->check(['data'])
            ->shouldBeCalled()
            ->willReturn($result);
        $this->check()->shouldHaveType($result);
    }

    function it_asserts_and_throws_an_exception_if_schema_validation_failed(
        IValidator $validator,
        IConfig $config
    ) {
        $result = new ValidationResult();
        $result->addError(new ValidationError('key', 'value', new NotNullConstraint()));
        $config->toArray()->willReturn(['data']);
        $validator->check(['data'])->willReturn($result);

        $this->shouldThrow(ConfigValidationException::class)
            ->during('assert');
    }

    function it_asserts_and_does_not_throw_an_exception_if_validation_passed(
        IValidator $validator,
        IConfig $config
    ) {
        $result = new ValidationResult();
        $config->toArray()->willReturn(['data']);
        $validator->check(['data'])->willReturn($result);

        $this->assert();
    }
}
