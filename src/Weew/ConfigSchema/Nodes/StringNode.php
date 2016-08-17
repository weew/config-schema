<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
use Weew\Validator\Constraints\AllowedConstraint;
use Weew\Validator\Constraints\AlphaConstraint;
use Weew\Validator\Constraints\AlphaNumericConstraint;
use Weew\Validator\Constraints\ForbiddenConstraint;
use Weew\Validator\Constraints\MaxLengthConstraint;
use Weew\Validator\Constraints\MinLengthConstraint;
use Weew\Validator\Constraints\NotNullConstraint;
use Weew\Validator\Constraints\RegexConstraint;
use Weew\Validator\Constraints\StringConstraint;

class StringNode extends Node implements IStringNode {
    /**
     * StringNode constructor.
     *
     * @param IConfigSchema $schema
     * @param string $key
     * @param string $message
     */
    public function __construct(IConfigSchema $schema, $key, $message = null) {
        parent::__construct($schema, $key);

        $this->addConstraints([
            new NotNullConstraint($message),
            new StringConstraint(),
        ]);
    }

    /**
     * @param int $min
     *
     * @return IStringNode
     */
    public function min($min) {
        return $this->addConstraint(new MinLengthConstraint($min));
    }

    /**
     * @param int $max
     *
     * @return IStringNode
     */
    public function max($max) {
        return $this->addConstraint(new MaxLengthConstraint($max));
    }

    /**
     * @return IStringNode
     */
    public function alpha() {
        return $this->addConstraint(new AlphaConstraint());
    }

    /**
     * @return IStringNode
     */
    public function alphanumeric() {
        return $this->addConstraint(new AlphaNumericConstraint());
    }

    /**
     * @param string $regex
     *
     * @return IStringNode
     */
    public function matches($regex) {
        return $this->addConstraint(new RegexConstraint($regex));
    }

    /**
     * @param array $values
     *
     * @return IStringNode
     */
    public function allowed(array $values) {
        return $this->addConstraint(new AllowedConstraint($values));
    }

    /**
     * @param array $values
     *
     * @return IStringNode
     */
    public function forbidden(array $values) {
        return $this->addConstraint(new ForbiddenConstraint($values));
    }
}
