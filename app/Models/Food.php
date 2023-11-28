<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['foodtitle', 'image', 'description', 'category'];

    public function attributes()
{
    return $this->hasMany(FoodAttribute::class);
}

public function branches() : BelongsToMany
{
    return $this->belongsToMany(Branch::class, 'food_branch')->withPivot('quantity');
}

}
