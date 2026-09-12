<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProject extends Model
{
        protected $table = 'product_project';

    protected $fillable = [
        'product_id',
        'project_id',
        'tinggi_kusen',
        'lebar_kusen',
        'harga_hitam',
        'harga_putih',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
