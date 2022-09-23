<?php

namespace App\Models;

use App\Models\Traits\BelongsToType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Cviebrock\EloquentSluggable\Sluggable;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class MenuItem extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;
    use BelongsToType;
    use SortableTrait;
    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'description',
    ];

    /**
     * @var array<string,string|bool>
     */
    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
        'nova_order_by' => 'DESC',
        'sort_on_has_many' => true,
    ];


    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('menu_item')
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);
            });;
    }

    /**
     * @return array<string, array<string, array<int, string>>>
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'parent.slug'],
            ],
        ];
    }

    /**
     * @param array|null $except
     *
     * @return Model
     */
    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }
}
