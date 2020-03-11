<?php
    require_once('./Weapon.class.php');
    require_once('./Ship.class.php');

    class Red extends Ship {
        static function doc() {
            return file_get_contents('Red.doc.txt');
        }
        function __invoke($name) {
            return $this->$name;
        }
        function __construct() {
            $this->x = rand(0, 99);
            $this->y = rand(99, 148);
            $this->angle = -90;
            $this->light = "red";
            $this->speed = 2;
            $this->health = 30;
            $this->gun = new Weapon;
        }
        function __toString() {
            if ($this->health > 0)
                return "\t\t#x$this->x"."y".$this->y." {
                    transform: rotate($this->angle"."deg);
                    background-color: $this->light;
                    background-image: url('./src/red_small_front.png');
                    background-size: 100%;
                }\n\t\t#x$this->x"."y".(1 + $this->y)." {
                    transform: rotate($this->angle"."deg);
                    background-color: $this->light;
                    background-image: url('./src/red_small_back.png');
                    background-size: 100%;
                }\n";
            else
                return "";
        }
    }
?>