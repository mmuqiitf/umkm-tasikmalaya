<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getUmkm($latitude, $longitude, $radius)
    {
        return $this->select('umkm.*')
            ->selectRaw(
                '( 6371 *
                    acos( cos( radians(?) ) *
                        cos( radians( latitude ) ) *
                        cos( radians(longitude ) - radians(?)) +
                        sin( radians(?) ) *
                        sin( radians( latitude ) )
                    )
                ) AS distance',
                [$latitude, $longitude, $latitude]
            )
            ->havingRaw("distance < ?", [$radius])
            ->orderBy('distance', 'asc');
    }
}
