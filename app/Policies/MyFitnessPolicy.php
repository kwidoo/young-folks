<?php

namespace App\Policies;

use App\Models\MyFitness;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MyFitnessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('viewAny', MyFitness::class) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MyFitness  $myFitness
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, MyFitness $myFitness)
    {
        return $user->can('view', $myFitness) || $user->hasAnyRole(['SuperAdmin']);;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create', MyFitness::class) || $user->hasAnyRole(['SuperAdmin']);;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MyFitness  $myFitness
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, MyFitness $myFitness)
    {
        return $user->can('update', $myFitness) || $user->hasAnyRole(['SuperAdmin']);;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MyFitness  $myFitness
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, MyFitness $myFitness)
    {
        return $user->can('delete', $myFitness) || $user->hasAnyRole(['SuperAdmin']);;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MyFitness  $myFitness
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, MyFitness $myFitness)
    {
        return $user->can('restore', $myFitness) || $user->hasAnyRole(['SuperAdmin']);;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\MyFitness  $myFitness
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, MyFitness $myFitness)
    {
        return $user->can('forceDelete', $myFitness) || $user->hasAnyRole(['SuperAdmin']);;
    }
}
