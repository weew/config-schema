<?php

namespace tests\spec\Weew\ConfigSchema\Exceptions;

use PhpSpec\ObjectBehavior;
use Weew\ConfigSchema\Exceptions\ConfigValidationException;
use Weew\Validator\IValidationResult;

/**
 * @mixin ConfigValidationException
 */
class ConfigValidationExceptionSpec extends ObjectBehavior {
    function let(IValidationResult $result) {
        $this->beConstructedWith('message', $result);
    }

    function it_is_initializable() {
        $this->shouldHaveType(ConfigValidationException::class);
    }

    function it_returns_validation_result(IValidationResult $result) {
        $this->getValidationResult()->shouldBe($result);
    }
}
