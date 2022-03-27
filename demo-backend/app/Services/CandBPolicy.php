<?php

namespace App\Services;

class CandBPolicy
{
    private  $late_rate;

    /**
     * @param $late_rate
     */
    public function __construct($late_rate)
    {
        $this->late_rate = $late_rate;
    }

    public function truDiMuon($phut_di_muon)
    {
        return $phut_di_muon * $this->late_rate;
    }
}
