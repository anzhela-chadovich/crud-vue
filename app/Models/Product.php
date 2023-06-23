<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'category',
        'quantity',
        'price',
        'image'];

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search='')
    {
        return $query->where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('category','LIKE','%'.$search.'%');
    }
    protected $dates = ['delete_at'];
}

