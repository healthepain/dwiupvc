<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'project_description',
        'project_status',
        'value_project',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_project')
                    ->withPivot('tinggi_kusen', 'lebar_kusen', 'harga_hitam', 'harga_putih')
                    ->withTimestamps();
    }
}
