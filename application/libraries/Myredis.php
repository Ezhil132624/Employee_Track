<?php
class Myredis
{
    private $redis;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);
    }

    public function set($key, $value, $ttl = 0)
    {
        return $ttl > 0 ? $this->redis->setex($key, $ttl, $value) : $this->redis->set($key, $value);
    }

    public function get($key)
    {
        return $this->redis->get($key);
    }

    public function del($key)
    {
        return $this->redis->del($key);
    }
}
