<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class UmkmController extends Controller
{
    public function getUmkm(Request $request)
    {
        $space = new Umkm();
        if ($request->has('kecamatan')) {
            return $space->getUmkm($request->lat, $request->lng, $request->rad, $request->kecamatan)->get();
        } else {
            return $space->getUmkm($request->lat, $request->lng, $request->rad)->get();
        }
    }
}
