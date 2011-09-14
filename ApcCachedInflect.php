<?php

namespace Inflect;

class ApcCachedInflect extends Inflect
{
    private $key;
    private $ttl;

    public function __construct($word, $keyPrefix = 'inflect:', $ttl = 3600)
    {
        parent::__construct($word);
        $this->key = $keyPrefix . $word;
        $this->ttl = $ttl;
    }

    public function inflect()
    {
        $success = false;
        $result = apc_fetch($this->key, $success);

        if (!$success) {
            $result = parent::inflect();
            apc_store($this->key, $result, $this->ttl);
        }

        return $result;
    }
}
