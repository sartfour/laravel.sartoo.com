<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class ItemType extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    /*
    protected static function boot() {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('singular_name', 'asc');
        });
    }
    */
    public function setSingularNameAttribute($value)
    {
        $this->attributes['singular_name'] = ucwords($value);
    }

    public function setPluralNameAttribute($value)
    {
        $this->attributes['plural_name'] = ucwords($value);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function items()
    {
    	return $this->hasMany(Item::class);
    }

    public function lists()
    {
    	return $this->hasMany(CustList::class);
    }

    public function getSlugAttribute()
    {
    	return Str::slug($this->singular_name, '-');
    }
}
