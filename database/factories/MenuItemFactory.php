<?php

namespace Database\Factories;

use App\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    protected $model = MenuItem::class;

    public function definition()
    {
        return [
            'parent_id' => null,
            'sort_order' => 0,
            'name' => [
                'ru' => fake('ru')->word,
                'lv' => fake('lv')->word,
            ],
            'description' => [
                'ru' => fake('ru')->sentence,
                'lv' => fake('lv')->sentence,
            ],
        ];
    }

    public function withName($name)
    {
        return $this->state(function (array $attributes) use ($name) {
            $attributes['name'] = $name;
            return $attributes;
        });
    }

    public function withDescription($description)
    {
        return $this->state(function (array $attributes) use ($description) {
            $attributes['description'] = $description;
            return $attributes;
        });
    }

    public function withParent(MenuItem $parent)
    {
        return $this->state(function (array $attributes) use ($parent) {
            $attributes['parent_id'] = $parent->id;
            $attributes['sort_order'] = $parent->children()->max('sort_order') + 1;
            return $attributes;
        });
    }
}
