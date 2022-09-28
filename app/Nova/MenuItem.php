<?php

namespace App\Nova;

use Cviebrock\EloquentSluggable\Sluggable;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Kalnoy\Nestedset\NodeTrait;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Outl1ne\NovaTranslatable\HandlesTranslatable;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Markdown;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class MenuItem extends Resource
{
    use HandlesTranslatable;
    use HasSortableRows;


    //hide
    public static $displayInNavigation = false;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\MenuItem::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Boolean::make(__('Enabled'), 'enabled')->sortable()->default(true),
            Images::make(__('Image'), 'menu_item')
                ->conversionOnIndexView('thumb'),

            BelongsTo::make('Type', 'type', Type::class),

            Text::make(__('Name'), 'name')->sortable()->translatable([
                'ru' => 'Русский',
                'lv' => 'Latviešu',
            ]),
            BelongsTo::make(__('Parent'), 'parent', MenuItem::class)->nullable()->sortable(),

            Markdown::make(__('Description'))->translatable([
                'ru' => 'Русский',
                'lv' => 'Latviešu',
            ]),

            HasMany::make(__('Children'), 'children', MenuItem::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
