<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $fillable = [
        'judul',
        'JenisBuku',
        'Penerbit',
        'Pencipta',
        'TempatTerbit',
        'TahunTerbit',
        'JumlahHalaman',
        'status',
        'foto',
    ];
}
