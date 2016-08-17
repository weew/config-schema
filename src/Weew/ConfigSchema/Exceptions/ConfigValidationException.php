<?php

namespace Weew\ConfigSchema\Exceptions;

use Exception;
use Weew\Validator\IValidationResult;

class ConfigValidationException extends Exception {
    /**
     * @var IValidationResult
     */
    protected $validationResult;

    /**
     * ConfigValidationException constructor.
     *
     * @param string $message
     * @param IValidationResult $validationResult
     */
    public function __construct($message, IValidationResult $validationResult) {
        parent::__construct($message);
        
        $this->validationResult = $validationResult;
    }

    /**
     * @return IValidationResult
     */
    public function getValidationResult() {
        return $this->validationResult;
    }
}
