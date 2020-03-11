<?php
require_once 'Color.class.php';

class Vertex {
    static public $verbose = False;
    private $_x = 0;
    private $_y = 0;
    private $_z = 0;
    private $_w = 1;
    private $_color;

    static function doc() {
        return file_get_contents("./Vertex.doc.txt");
    }
    function __invoke($name) {
        return $this->$name;
    }
    public function set_param(array $param) {
        if (isset($param['x']))
            $this->_x = $param['x'];
        if (isset($param['y']))
            $this->_y = $param['y'];
        if (isset($param['z']))
            $this->_z = $param['z'];
        if (isset($param['w']))
            $this->_w = $param['w'];
        if (isset($param['color']))
            $this->_color = $param['color'];
        else
            $this->_color = new Color(array('rgb' => 0xFFFFFF));
        return ;
    }
    function __construct(array $param) {
        if (isset($param['x']) && isset($param['y']) && isset($param['z']))
            $this->set_param($param);
        if (self::$verbose)
            print($this . " constructed.\n");
        return ;
    }
    function __destruct() {
        if (self::$verbose)
            print($this . " destructed.\n");
        return ;
    }
    function __toString() {
        $x = number_format($this->_x, 2);
        $y = number_format($this->_y, 2);
        $z = number_format($this->_z, 2);
        $w = number_format($this->_w, 2);
        if (self::$verbose)
            return "Vertex( x: $x y: $y z: $z w: $w $this->_color)";
        else
            return "Vertex( x: $x y: $y z: $z w: $w )";
    }
}

?>