<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

class Umkm extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'umkm';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function jenis_umkm()
    {
        return $this->belongsTo(JenisUmkm::class);
    }

    public function getUmkm($latitude, $longitude, $radius, $kecamatan = false)
    {
        $driver = DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME);
        if ($driver === "pgsql") {
            if (!$kecamatan) {
                return $this->select('umkm.*', 'users.name as user_name', 'jenis_umkm.name as jenis_umkm_name', 'kecamatan.name as kecamatan_name')
                    ->selectRaw(
                        '( 6371 *
                        acos( cos( radians(?) ) *
                            cos( radians( cast(latitude as double precision) ) ) *
                            cos( radians( cast(longitude as double precision) ) - radians(?)) +
                            sin( radians(?) ) *
                            sin( radians( cast(latitude as double precision) ) )
                        )
                        ) AS distance',
                        [$latitude, $longitude, $latitude]
                    )
                    ->join('kecamatan', 'kecamatan.id', '=', 'umkm.kecamatan_id')
                    ->join('users', 'users.id', '=', 'umkm.user_id')
                    ->join('jenis_umkm', 'jenis_umkm.id', '=', 'umkm.jenis_umkm_id');
            } else {
                return $this->select('umkm.*', 'users.name as user_name', 'jenis_umkm.name as jenis_umkm_name', 'kecamatan.name as kecamatan_name')
                    ->selectRaw(
                        ' ( 6371 *
                        acos( cos( radians(?) ) *
                            cos( radians( cast(latitude as double precision) ) ) *
                            cos( radians( cast(longitude as double precision) ) - radians(?)) +
                            sin( radians(?) ) *
                            sin( radians( cast(latitude as double precision) ) )
                        )
                        ) AS distance',
                        [$latitude, $longitude, $latitude]
                    )
                    ->join('kecamatan', 'kecamatan.id', '=', 'umkm.kecamatan_id')
                    ->join('users', 'users.id', '=', 'umkm.user_id')
                    ->join('jenis_umkm', 'jenis_umkm.id', '=', 'umkm.jenis_umkm_id')
                    ->whereRaw("kecamatan_id = ?", [$kecamatan]);
            }
        } else if ($driver === "mysql") {
            if (!$kecamatan) {
                return $this->select('umkm.*', 'users.name as user_name', 'jenis_umkm.name as jenis_umkm_name', 'kecamatan.name as kecamatan_name')
                    ->selectRaw(
                        '( 6371 *
                            acos( cos( radians(?) ) *
                                cos( radians( latitude ) ) *
                                cos( radians( longitude ) - radians(?)) +
                                sin( radians(?) ) *
                                sin( radians( latitude ) )
                            )
                        ) AS distance',
                        [$latitude, $longitude, $latitude]
                    )
                    ->join('kecamatan', 'kecamatan.id', '=', 'umkm.kecamatan_id')
                    ->join('users', 'users.id', '=', 'umkm.user_id')
                    ->join('jenis_umkm', 'jenis_umkm.id', '=', 'umkm.jenis_umkm_id')
                    ->havingRaw("distance < ?", [$radius])
                    ->orderBy('distance', 'asc');
            } else {
                return $this->select('umkm.*', 'users.name as user_name', 'jenis_umkm.name as jenis_umkm_name', 'kecamatan.name as kecamatan_name')
                    ->selectRaw(
                        '( 6371 *
                            acos( cos( radians(?) ) *
                                cos( radians( latitude ) ) *
                                cos( radians( longitude ) - radians(?)) +
                                sin( radians(?) ) *
                                sin( radians( latitude ) )
                            )
                        ) AS distance',
                        [$latitude, $longitude, $latitude]
                    )
                    ->join('kecamatan', 'kecamatan.id', '=', 'umkm.kecamatan_id')
                    ->join('users', 'users.id', '=', 'umkm.user_id')
                    ->join('jenis_umkm', 'jenis_umkm.id', '=', 'umkm.jenis_umkm_id')
                    ->whereRaw("kecamatan_id = ?", [$kecamatan])
                    ->havingRaw("distance < ?", [$radius])
                    ->orderBy('distance', 'asc');
            }
        }
    }
}
