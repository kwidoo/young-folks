<?php

namespace App\Policies;

use App\Models\Training;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingPolicy
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
        return $user->can('viewAny', Training::class) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Training $training)
    {
        return $user->can('view', $training) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create', Training::class) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Training $training)
    {
        return $user->can('update', $training) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Training $training)
    {
        return $user->can('delete', $training) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Training $training)
    {
        return $user->can('restore', $training) || $user->hasAnyRole(['SuperAdmin']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Training  $training
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Training $training)
    {
        return $user->can('forceDelete', $training) || $user->hasAnyRole(['SuperAdmin']);
    }
}
