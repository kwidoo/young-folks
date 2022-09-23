<?php

namespace App\Models;

use App\Models\Traits\HasManyMenuItems;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Type extends Model
{
    use HasFactory;
    use HasManyMenuItems;
    use Sluggable;
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'enabled',
    ];

    /**
     * @var array<int,string>
     */
    public $translatable = [
        'name',
    ];

    /**
     * @return array<string, array<string, string>>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
