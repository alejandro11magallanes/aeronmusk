<?php

namespace App\Charts;
use ConsoleTVs\Charts\Classes\Chart;

class SampleChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $this->labels(['Enero', 'Febrero', 'Marzo'])
             ->dataset('Ventas 2023', 'bar', [150, 220, 180])
             ->options([
                 'responsive' => true,
                 'maintainAspectRatio' => false,
             ]);
    }
}
