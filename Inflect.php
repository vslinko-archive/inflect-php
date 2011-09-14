<?php

namespace Inflect;

class Inflect
{
    const BASE_URL = 'http://export.yandex.ru/inflect.xml?format=json&name=';

    protected $word;
    protected $result;

    public function __construct($word)
    {
        $this->word = $word;
    }

    public function inflect()
    {
        if ($this->result === null) {
            // json_decode returns object
            $this->result = (array) json_decode(file_get_contents(static::BASE_URL . $this->word));
        }

        if (count($this->result) <= 2) {
            throw new \RuntimeException(sprintf('No inflection for "%s"', $this->word));
        }

        unset($this->result['original']);
        // PHP haven't normal lists
        $this->result = array_values($this->result);

        return $this->result;
    }
}
