<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class Item extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $with = ['itemType'];

    /*
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->leftJoin('item_types', 'items.item_type_id', '=', 'item_types.id')->orderBy('item_types.singular_name', 'ASC')->orderBy('name', 'ASC');
        });
    }
    */

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    public function itemType()
    {
    	return $this->belongsTo(ItemType::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function getSlugAttribute()
    {
    	return Str::slug($this->name, '-');
    }
}