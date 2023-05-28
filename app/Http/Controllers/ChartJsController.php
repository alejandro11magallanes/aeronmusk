<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartJsController extends Controller
{
    public function index()
    {
        // Your code to fetch data and prepare the chart
        
        return view('Grafica', [
            // Pass any necessary data to the view
        ]);
    }
}

