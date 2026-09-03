<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $fillable = [
        'category_id',
        'type_id',
        'model_id',
        'material_id',
        'variant_id',
        'product_name',
        'lebar_kusen',
        'jumlah_lebar_kusen',
        'tinggi_kusen',
        'jumlah_tinggi_kusen',
        'lebar_daun',
        'jumlah_lebar_daun',
        'tinggi_daun',
        'jumlah_tinggi_daun',
        'harga_kusen',
        'harga_daun',
        'harga_kaca',
        'harga_panel',
        'harga_aksesoris',
    ];

        public function projects()
    {
        return $this->belongsToMany(Project::class, 'product_project')
                    ->withPivot(
                        'tinggi_kusen',
                        'lebar_kusen',
                        'harga_hitam',
                        'harga_putih'
                    )
                    ->withTimestamps();
    }
}
