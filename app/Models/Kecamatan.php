<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kecamatan';

    public function umkm()
    {
        return $this->hasMany(Umkm::class);
    }
}
