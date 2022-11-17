<?php

namespace App\Models;

use App\Models\Traits\BelongsToMyFitness;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    use BelongsToMyFitness;

    public const MYFITNESS_FOREIGN_KEY = 'my_fitness_id';
}
