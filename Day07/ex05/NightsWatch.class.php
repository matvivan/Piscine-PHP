<?php

include_once('IFighter.class.php');

class NightsWatch implements IFighter {
    public function fight() {}
    public function recruit($person) {
        if ($person instanceof IFighter)
            $person->fight();
    }
}

?>