<?php

namespace App\Entity\Interfaces;

interface ContainsDateRange
{
    public function getDateStart(): \DateTime;

    public function getDateEnd(): \DateTime;
}
