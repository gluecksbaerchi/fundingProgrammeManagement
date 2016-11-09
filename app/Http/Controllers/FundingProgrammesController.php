<?php
/**
 * Created by PhpStorm.
 * User: Carolin
 * Date: 09.11.2016
 * Time: 12:54
 */

namespace App\Http\Controllers;

class FundingProgrammesController extends Controller
{
    public function show()
    {
        return view('pages.funding_programmes.index');
    }
}
