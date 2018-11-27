<?php

class Origin
{
    const LINK = 'link';
    const BANELCO = 'banelco';
    const INPERSON = 'in_person';

    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function link()
    {
        return new static(static::LINK);
    }

    public static function banelco()
    {
        return new static(static::BANELCO);
    }

    public static function inPerson()
    {
        return new static(static::INPERSON);
    }

    public function is(string $value)
    {
        return $this->value === $value;
    }
}
