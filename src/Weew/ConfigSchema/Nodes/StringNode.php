<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\ConfigSchema\IConfigSchema;
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

        $this->constraints([
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
        return $this->constraint(new MinLengthConstraint($min));
    }

    /**
     * @param int $max
     *
     * @return IStringNode
     */
    public function max($max) {
        return $this->constraint(new MaxLengthConstraint($max));
    }

    /**
     * @param int $length
     *
     * @return IStringNode
     */
    public function length($length) {
        return $this->constraint(new LengthConstraint($length));
    }

    /**
     * @return IStringNode
     */
    public function email() {
        return $this->constraint(new EmailConstraint());
    }

    /**
     * @return IStringNode
     */
    public function url() {
        return $this->constraint(new UrlConstraint());
    }

    /**
     * @return IStringNode
     */
    public function alpha() {
        return $this->constraint(new AlphaConstraint());
    }

    /**
     * @return IStringNode
     */
    public function alphanumeric() {
        return $this->constraint(new AlphaNumericConstraint());
    }

    /**
     * @param string $regex
     *
     * @return IStringNode
     */
    public function matches($regex) {
        return $this->constraint(new RegexConstraint($regex));
    }

    /**
     * @param array $values
     *
     * @return IStringNode
     */
    public function allowed(array $values) {
        return $this->constraint(new AllowedConstraint($values));
    }

    /**
     * @param array $values
     *
     * @return IStringNode
     */
    public function forbidden(array $values) {
        return $this->constraint(new ForbiddenConstraint($values));
    }

    /**
     * @return IStringNode
     */
    public function nullable() {
        return $this->constraint(
            new NullableConstraint()
        );
    }
}
