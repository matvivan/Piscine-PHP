<?php

class Ship {
    public $gun;
    public $speed;
    public $health;
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
    function movement($order_x, $order_y, $order_pp) {
        $this->x += $order_x * $order_pp * $this->speed;
        $this->y += $order_y * $order_pp * $this->speed;
        if ($this->x < 0 || $this->x > 99 || $this->y < 0 || $this->y > 149)
            $this->health = 0;
    }
    function shooting($order_x, $order_y, $order_pp, $target) {
        $area_x = $this->x + $order_x * $order_pp * $this->gun->damage;
        $area_y = $this->y + $order_y * $order_pp * $this->gun->damage;
        if (abs($target->x - $area_x) < 5 && abs($target->y - $area_y) < 5)
            $target->health -= $this->gun->damage * $order_pp;
        if (abs($this->x - $area_x) < 5 && abs($this->y - $area_y) < 5)
            $this->health -= $this->gun->damage * $order_pp;
        return array('x'=> $area_x, 'y' => $area_y);
    }
}

?>