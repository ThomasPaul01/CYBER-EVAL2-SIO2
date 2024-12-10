<?php

namespace App\Service;

class LateFeeCalculator
{
    public function calculateLateFee(\DateTime $dueDate, \DateTime $returnDate): float
    {
        $frais = 0.0;
        $daysLate = $returnDate->diff($dueDate)->days;

        if ($daysLate <= 0 or $returnDate < $dueDate) {
            return $frais;
        }
        else{
            for ($i=$daysLate; $i>0; $i--)
            {
                $frais += 0.5;
            }
            return $frais;

        }

    }

}