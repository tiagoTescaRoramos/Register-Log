<?php

namespace Test\RegisterLog\Api;

use Magento\Framework\Registry;

/**
 * RegisterLogInterface interface
 */
interface RegisterLogInterface
{
    /**
     * Register log
     *
     * @param Registry $registry
     * @param void $result
     * @param string $key
     * @param mixed $value
     * @param bool $graceful
     * @return void
     */
    public function afterRegister(Registry $registry, $result, $key, $value, $graceful = false);

    /**
     * Register log
     *
     * @param Registry $registry
     * @param mixed $result
     * @param string $key
     * @return string
     */
    public function afterRegistry(Registry $registry, $result, $key);
}