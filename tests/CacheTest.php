<?php

namespace Tests;

use SteveGrunwell\WP_Test_Assertions\CacheAssertions;
use WP_UnitTestCase;

/**
 * @group Cache
 */
class CacheTest extends WP_UnitTestCase
{
    use CacheAssertions;

    public function testAssertHasCacheKey()
    {
        $key = 'cache-' . uniqid();

        $this->assertNotHasCacheKey($key, '', 'The cache should start empty.');

        wp_cache_set($key, 'value');

        $this->assertHasCacheKey($key, '', 'The key should now be set.');
    }

    public function testAssertHasCacheKeyWithGroups()
    {
        $key = 'cache-' . uniqid();

        $this->assertNotHasCacheKey($key, 'group1', 'The cache should start empty.');

        wp_cache_set($key, 'value', 'group1');

        $this->assertHasCacheKey($key, 'group1', 'The key should exist in group1.');
        $this->assertNotHasCacheKey($key, 'group2', 'The key should not exist in group2.');
    }

    public function testAssertHasCacheKeyUsesFoundArgument()
    {
        $key = 'cache-' . uniqid();

        wp_cache_set($key, false);

        $this->assertHasCacheKey($key, '', 'The cached value is FALSE, but it\'s still cached.');
    }

    public function testAssertHasTransient()
    {
        $key = 'transient-' . uniqid();

        $this->assertNotHasTransient($key, 'The cache should start empty.');

        set_transient($key, 'value');

        $this->assertHasTransient($key, 'The transient should now be set.');
    }

    public function testAssertHasTransientUsesStrictComparisons()
    {
        $key = 'transient-' . uniqid();

        set_transient($key, 0);

        $this->assertHasTransient($key, '0 is not the same as a FALSE return.');
    }
}
