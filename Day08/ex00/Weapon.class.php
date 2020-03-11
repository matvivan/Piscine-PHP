<?php

class Weapon {
    public $damage;

    static function doc() {
        return file_get_contents('./Weapon.doc.txt');
    }
    function __construct() {
        $this->damage = 3;
    }
    function __invoke() {
        return $this->damage;
    }
}

?>