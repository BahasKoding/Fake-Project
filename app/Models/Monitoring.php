<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $table = 'tb_monitoring';

    protected $fillable = [
        'Jumlah_bantuan',
        'id_pendataan',
    ];
    // Mendefinisikan relasi banyak ke satu dengan Pendataan
    public function pendataan()
    {
        return $this->belongsTo(Pendataan::class, 'id_pendataan');
    }
    public function formatLaporan()
    {
        $id = $this->id;
        return $id ? sprintf('LP2400%02d', $id) : '-';
    }
    public function formatMonitoring()
    {
        $id = $this->id;
        return $id ? sprintf('MP2400%02d', $id) : '-';
    }
}
