<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Instructions;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function index()
    {
        $instractions = Instructions::all();
        return response()->json($instractions);
    }
}
