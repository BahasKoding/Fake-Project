<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendataan extends Model
{
    use HasFactory;
    protected $table = 'tb_pendataan'; // Nama tabel

    protected $fillable = [
        'no_pendataan',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'umur',
        'alamat',
        'status',
    ];

     // Mendefinisikan relasi satu ke banyak dengan Monitoring
    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'id_pendataan');
    }

    public function formatPenerimaan()
    {
        $id = $this->id;
        $formattedId = sprintf('CP2400%02d', $id);

        return $formattedId;
    }
    public function formatMonitoring()
    {
        $id = $this->id;
        $formattedId = sprintf('MP2400%02d', $id);

        return $formattedId;
    }
}
