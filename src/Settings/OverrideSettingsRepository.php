<?php

/*
 * This file is part of Flarum.
 *
 * (c) Toby Zerner <toby.zerner@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flarum\Settings;

class OverrideSettingsRepository implements SettingsRepositoryInterface
{
    protected $inner;

    protected $overrides = [];

    public function __construct(SettingsRepositoryInterface $inner, array $overrides)
    {
        $this->inner = $inner;
        $this->overrides = $overrides;
    }

    public function all()
    {
        return array_merge($this->inner->all(), $this->overrides);
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->overrides)) {
            return $this->overrides[$key];
        }

        return array_get($this->all(), $key, $default);
    }

    public function set($key, $value)
    {
        $this->inner->set($key, $value);
    }

    public function delete($key)
    {
        $this->inner->delete($key);
    }
}
