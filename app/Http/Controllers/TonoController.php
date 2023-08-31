<?php

namespace App\Http\Controllers;

use App\Http\Resources\TonoCollection;
use App\Models\Tono;
use Illuminate\Http\Request;

class TonoController extends Controller
{
    public function index () {
        return new TonoCollection(Tono::all());
    }
}
