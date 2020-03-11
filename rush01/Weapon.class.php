<?php

class Weapon {
    public $damage;

    static function doc() {
        return file_get_contents('./Weapon.doc.txt');
    }
    function __construct() {
        $this->damage = 3;
    }
    function __invoke($name) {
        return $this->$name;
    }
    function __toString() {
        return "$this->damage";
    }
}

?>