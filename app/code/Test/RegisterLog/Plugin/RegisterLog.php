<?php

namespace Test\RegisterLog\Plugin;

use Psr\Log\LoggerInterface;
use Test\RegisterLog\Api\RegisterLogInterface;
use Magento\Framework\Registry;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * RegisterLog class
 */
class RegisterLog implements RegisterLogInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(LoggerInterface $logger, ScopeConfigInterface $scopeConfig)
    {
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
    }

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
    public function afterRegister(Registry $registry, $result, $key, $value, $graceful = false)
    {
        $config = 'test_create_log/general/enabled_register';
        if ((bool)$this->scopeConfig->getValue($config) == false) {
            return;
        }

        $this->logger->debug(
            sprintf(
                'Class Rgistry with method register request with params: key: %s, $value: %s, graceful: %s',
                (string)$key,
                $this->convertValue($value),
                (string)$graceful
            )
        );
    }

    /**
     * Register log
     *
     * @param Registry $registry
     * @param mixed $result
     * @param string $key
     * @return string
     */
    public function afterRegistry(Registry $registry, $result, $key)
    {
        $config = 'test_create_log/general/enabled_registry';
        if ((bool)$this->scopeConfig->getValue($config) == false) {
            return $result;
        }

        $this->logger->debug(
            sprintf(
                'Class Rgistry with method registry request with params: key: %s, return: %s',
                (string)$key,
                $this->convertValue($result)
            )
        );
        return $result;
    }

    /**
     * Convert value in string
     *
     * @param mixed $value
     * @return string
     */
    protected function convertValue($value): string
    {
        if (is_object($value)) {
            return (string)get_class($value);
        }

        return (string)$value;
    }
}
