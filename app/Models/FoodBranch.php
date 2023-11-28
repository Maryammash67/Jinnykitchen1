<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodBranch extends Model
{
    use HasFactory;
    protected $table = 'food_branch';

    protected $fillable = ['food_id', 'branch_id','quantity']; // Add other fillable attributes as needed

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
