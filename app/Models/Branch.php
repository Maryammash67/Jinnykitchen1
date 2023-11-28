<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name', 'location']; // Add other fillable attributes as needed

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_branch', 'branch_id', 'food_id');
    }
}
