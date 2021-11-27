<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Str;

class CustList extends Model
{
    use SoftDeletes;

    protected $table = 'lists';

    protected $guarded = [];

    private static $_typesArr = [
        1 => 'Best',
        2 => 'Worst'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function itemType()
    {
    	return $this->belongsTo(ItemType::class);
    }

    public function getTypeTextAttribute()
    {
    	return self::$_typesArr[$this->type];
    }

    public function getFullTitleAttribute()
    {
    	return "Top Ten {$this->type_text} {$this->title}";
    }

    public function getSlugAttribute()
    {
    	return Str::slug($this->full_title, '-');
    }
}