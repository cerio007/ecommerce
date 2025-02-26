<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description', 'stock_quantity', 'category'];
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('price', 'like','%'. request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('stock_quantity', 'like','%'. request('search') . '%')
                ->orWhere('category', 'like', '%' . request('search') . '%');
        }
    }
    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
