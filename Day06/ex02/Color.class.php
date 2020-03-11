<?php

class Color {
    static public $verbose = False;
    public $red = 0;
    public $green = 0;
    public $blue = 0;

    static function doc() {
        return file_get_contents("./Color.doc.txt");
    }
    function __construct(array $arr) {
        if (isset($arr['red']))
            $this->red += (integer)$arr['red'];
        if (isset($arr['green']))
            $this->green += (integer)$arr['green'];
        if (isset($arr['blue']))
            $this->blue += (integer)$arr['blue'];
        if (isset($arr['rgb']))
        {
            $this->red = ((integer)$arr['rgb'] & 0xFF0000) >> 16;
            $this->green = ((integer)$arr['rgb'] & 0xFF00) >> 8;
            $this->blue = (integer)$arr['rgb'] & 0xFF;
        }
        if (self::$verbose)
            print($this . " constructed.\n");
        return $this;
    }
    function add(Color $add) {
        return (new Color(
                array('red' => $this->red + $add->red,
                        'green' => $this->green + $add->green,
                        'blue' => $this->blue + $add->blue)));
    }
    function sub(Color $sub) {
        return (new Color(
            array('red' => $this->red - $sub->red,
                'green' => $this->green - $sub->green,
                'blue' => $this->blue - $sub->blue)));
    }
    function mult(float $mult) {
        return (new Color(
                array('red' => (integer)($this->red * $mult),
                        'green' => (integer)($this->green * $mult),
                        'blue' => (integer)($this->blue * $mult)
                    )));
    }
    function __destruct() {
        if (self::$verbose)
            print($this . " destructed.\n");
        return ;
    }
    function __toString() {
        return "Color(r: $this->red, g: $this->green, b: $this->blue)";
    }
}
?>