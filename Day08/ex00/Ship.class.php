<?php

class Ship {
    public $x;
    public $y;
    public $angle;
    public $light;

    static function doc() {
        return file_get_contents('./Ship.doc.txt');
    }
    function __invoke($name) {
        return static::$name;
    }
}

?>