<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUmkm extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'jenis_umkm';

    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }
}
