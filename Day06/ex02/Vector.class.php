<?php
require_once 'Vertex.class.php';

class Vector {
    static public $verbose = false;
    private $_x = 0.0;
    private $_y = 0.0;
    private $_z = 0.0;
    private $_w = 0.0;

    static function doc() {
        return file_get_contents("./Vector.doc.txt");
    }
    function __invoke($name) {
        return $this->$name;
    }
    function init($x, $y, $z) {
        $this->_x = $x;
        $this->_y = $y;
        $this->_z = $z;
    }
    function __construct(array $coor) {
        if (!isset($coor['orig']))
            $coor['orig'] = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
        if (isset($coor['dest']))
            $this->init($coor['dest']('_x') - $coor['orig']('_x'),
                        $coor['dest']('_y') - $coor['orig']('_y'),
                        $coor['dest']('_z') - $coor['orig']('_z'));
        if (self::$verbose)
            print($this . " constructed\n");
        return ;
    }
    function __destruct() {
        if (self::$verbose)
            print($this . " destructed\n");
        return ;
    }
    function __toString() {
        $x = number_format($this->_x, 2);
        $y = number_format($this->_y, 2);
        $z = number_format($this->_z, 2);
        $w = number_format($this->_w, 2);
        return "Vector( x: $x, y: $y, z: $z, w: $w )";
    }
    function magnitude() {
        return sqrt($this->_x * $this->_x + $this->_y * $this->_y + $this->_z * $this->_z);
    }
    function normalize() {
        $magn = $this->magnitude();
        return new Vector(array('dest' => 
                new Vertex(array('x' => ($this->_x / $magn),
                                'y' => ($this->_y / $magn),
                                'z' => ($this->_z / $magn)))));
    }
    function add(Vector $rhs) {
        return new Vector(array(
            'dest' => new Vertex(array(
                'x' => $this->_x,
                'y' => $this->_y,
                'z' => $this->_z)),
            'orig' => new Vertex(array(
                'x' => -$rhs('_x'),
                'y' => -$rhs('_y'),
                'z' => -$rhs('_z')))
            )
        );
    }
    function sub(Vector $rhs) {
        return new Vector(array(
            'dest' => new Vertex(array(
                'x' => $this->_x,
                'y' => $this->_y,
                'z' => $this->_z)),
            'orig' => new Vertex(array(
                'x' => $rhs('_x'),
                'y' => $rhs('_y'),
                'z' => $rhs('_z')))
            )
        );
    }
    function opposite() {
        return new Vector(array(
                'dest' => new Vertex(array(
                    'x' => -$this->_x,
                    'y' => -$this->_y,
                    'z' => -$this->_z))));
    }
    function scalarProduct($k) {
        return new Vector(array(
                'dest' => new Vertex(array(
                    'x' => $this->_x * $k,
                    'y' => $this->_y * $k,
                    'z' => $this->_z * $k))));
    }
    function dotProduct(Vector $rhs) {
        return ($this->_x * $rhs('_x') + $this->_y * $rhs('_y') + $this->_z * $rhs('_z'));
    }
    function cos(Vector $rhs) {
        if ($this->magnitude() && $rhs->magnitude())
            return ($this->dotProduct($rhs) / $this->magnitude() / $rhs->magnitude());
        else
            return number_format(0, 2);
    }
    function crossProduct(Vector $rhs) {
        return new Vector(array(
                'dest' => new Vertex(array(
                    'x' => $this->_y * $rhs('_z') - $this->_z * $rhs('_y'),
                    'y' => $this->_z * $rhs('_x') - $this->_x * $rhs('_z'),
                    'z' => $this->_x * $rhs('_y') - $this->_y * $rhs('_x')))));
    }
}

?>