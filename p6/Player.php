<?php

class Player
{
    # Properties
    public $hand = [];
    public $playerName;

    # Methods
    public function __construct(string $playerName)
    {
        $this->playerName = $playerName;

    }

    public function getSum()
    {
        $sum = array_sum($this->hand);

        // If sum is greater than 21, check to see if there is an ace in the player's hand. If there is, count the using a 1 instead of an 11.

        if($sum>21){
            if (in_array('A',$this->hand)){
                
                //recalculate the sum using 1 instead of 11
                
            }
        }

        return $sum;
    }

    public function getClassification()
    {
        if($this->age > 18){
            return 'adult';
        } else {
            return 'minor';
        }
    }
}