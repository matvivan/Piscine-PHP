<?php

class Lannister {
    public function sleepWith($person) {
        if (get_parent_class($person) === self::class)
            echo "Not even if I'm drunk !\n";
        else
            echo "Let's do this.\n";
    }

}

?>