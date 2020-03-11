<?php

class UnholyFactory {
    private $line = array();

    public function absorb($fighter) {
        if (get_parent_class($fighter) === "Fighter") {
            if (isset($this->line[$fighter->name]))
                echo "(Factory already absorbed a fighter of type $fighter->name)\n";
            else {
                $this->line[$fighter->name] = $fighter;
                echo "(Factory absorbed a fighter of type $fighter->name)\n";
            }
        }
        else
            echo "(Factory can't absorb this, it's not a fighter)\n";
    }
    public function fabricate($unit) {
        if (isset($this->line[$unit]))
        {
            echo "(Factory fabricates a fighter of type $unit)\n";
            return $this->line[$unit];
        }
        else
        {
            echo "(Factory hasn't absorbed any fighter of type $unit)\n";
            return NULL;
        }
    }
}

?>