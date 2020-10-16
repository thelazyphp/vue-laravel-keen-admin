<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersService
{
    /**
     * Register a new user.
     *
     * @param  array  $payload
     * @return \App\Models\User
     */
    public function register($payload)
    {
        $payload['password'] = Hash::make($payload['password']);

        return User::create($payload);
    }

    /**
     * Update user.
     *
     * @param  \App\Models\User  $user
     * @param  array  $payload
     * @return \App\Models\User
     */
    public function update(User $user, $payload)
    {
        return tap($user)->update($payload);
    }

    /**
     * Delete user.
     *
     * @param  \App\Models\User  $user
     * @return null|bool
     */
    public function delete(User $user)
    {
        return $user->delete();
    }

    /**
     * Update the user profile.
     *
     * @param  \App\Models\User  $user
     * @param  array  $payload
     * @return \App\Models\User
     */
    public function updateProfile(User $user, $payload)
    {
        return tap($user)->update($payload);
    }

    /**
     * Update the user account.
     *
     * @param  \App\Models\User  $user
     * @param  array  $payload
     * @return \App\Models\User
     */
    public function updateAccount(User $user, $payload)
    {
        $payload['password'] = Hash::make($payload['new_password']);

        return tap($user)->update($payload);
    }

    /**
     * Delete the user account.
     *
     * @param  \App\Models\User  $user
     * @return null|bool
     */
    public function deleteAccount(User $user)
    {
        return $this->delete($user);
    }
}
