<?php

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\HasHistories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, HasAuthor, HasHistories;

    protected $guarded = [];

    public function scopeMainCategories(Builder $query): void
    {
        $query->where('parent_id', 0);
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::slug($value),
        );
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
