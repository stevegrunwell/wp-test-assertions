<?php
/**
 * Cache-related assertions for PHPUnit.
 *
 * @package WP_Test_Assertions
 * @author  Steve Grunwell
 */

namespace SteveGrunwell\WP_Test_Assertions;

trait CacheAssertions
{
    /**
     * Verify that the given cache key exists.
     *
     * @param string $key     The cache key.
     * @param string $group   Optional. The cache group. Default is empty.
     * @param string $message Optional. The error message if the assertion fails. Default is empty.
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException If the expectation fails.
     */
    public function assertHasCacheKey($key, $group = '', $message = '')
    {
        wp_cache_get($key, $group, false, $found);

        $this->assertTrue($found, $message);
    }

    /**
     * Verify that the given cache key does not exist.
     *
     * @param string $key     The cache key.
     * @param string $group   Optional. The cache group. Default is empty.
     * @param string $message Optional. The error message if the assertion fails. Default is empty.
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException If the expectation fails.
     */
    public function assertNotHasCacheKey($key, $group = '', $message = '')
    {
        wp_cache_get($key, $group, false, $found);

        $this->assertFalse($found, $message);
    }

    /**
     * Verify that the given transient exists.
     *
     * @param string $key     The transient key.
     * @param string $message Optional. The error message if the assertion fails. Default is empty.
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException If the expectation fails.
     */
    public function assertHasTransient($key, $message = '')
    {
        $this->assertTrue(false !== get_transient($key));
    }

    /**
     * Verify that the given transient does not exist.
     *
     * @param string $key     The transient key.
     * @param string $message Optional. The error message if the assertion fails. Default is empty.
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException If the expectation fails.
     */
    public function assertNotHasTransient($key, $message = '')
    {
        $this->assertTrue(false === get_transient($key));
    }
}
