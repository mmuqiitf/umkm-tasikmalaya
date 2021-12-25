<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function getUmkm(Request $request)
    {
        $space = new Umkm();
        return $space->getUmkm($request->lat, $request->lng, $request->rad)->get();
    }
}
