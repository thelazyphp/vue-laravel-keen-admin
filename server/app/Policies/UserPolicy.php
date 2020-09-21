<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return (bool) $user->company;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->id == $model->id
            || ((bool) $user->company
                && (bool) $model->company
                && $user->company->id == $model->company->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return (bool) $user->company
            && ($user->isAdmin() || $user->isManager());
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->id != $model->id
            && (bool) $user->company
            && (bool) $model->company
            && $user->company->id == $model->company->id
            && ($user->isAdmin()
                || $user->isManager() && !$model->isAdmin());
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->id != $model->id
            && (bool) $user->company
            && (bool) $model->company
            && $user->company->id == $model->company->id
            && ($user->isAdmin()
                || $user->isManager() && !$model->isAdmin());
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function activate(User $user, User $model)
    {
        return $user->id != $model->id
            && $user->isAdmin()
            && !$model->isAdmin()
            && (bool) $user->company
            && (bool) $model->company
            && $user->company->id == $model->company->id;
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function deactivate(User $user, User $model)
    {
        return $user->id != $model->id
            && $user->isAdmin()
            && !$model->isAdmin()
            && (bool) $user->company
            && (bool) $model->company
            && $user->company->id == $model->company->id;
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function updateProfile(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function updateAccount(User $user, User $model)
    {
        return $user->id == $model->id;
    }

    /**
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function updateCompany(User $user, User $model)
    {
        return $user->isAdmin()
            && $user->id == $model->id;
    }
}
