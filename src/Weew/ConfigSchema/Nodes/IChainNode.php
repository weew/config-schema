<?php

namespace Weew\ConfigSchema\Nodes;

use Weew\Validator\IValidationResult;

interface IChainNode {
    /**
     * @param string $key
     * @param string $message
     *
     * @return IValueNode
     */
    function hasValue($key, $message = null);

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    function hasString($key, $message = null);

    /**
     * @param string $key
     * @param string $message
     *
     * @return INumericNode
     */
    function hasNumber($key, $message = null);

    /**
     * @param string $key
     * @param string $message
     *
     * @return IBooleanNode
     */
    function hasBoolean($key, $message = null);

    /**
     * @param string $key
     * @param string $message
     *
     * @return IArrayNode
     */
    function hasArray($key, $message = null);

    /**
     * @param string $key
     * @param string $message
     *
     * @return IStringNode
     */
    function hasArrayKeys($key, $message = null);

    /**
     * @return null
     */
    function assert();

    /**
     * @return IValidationResult
     */
    function check();
}
