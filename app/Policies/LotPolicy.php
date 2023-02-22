<?php

namespace App\Policies;

use App\Models\Lot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LotPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can edit the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lot  $lot
     * @return mixed
     */
    public function edit(User $user, Lot $lot)
    {
        return $user->id === $lot->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lot  $lot
     * @return mixed
     */
    public function update(User $user, Lot $lot)
    {
        return $user->id === $lot->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Lot  $lot
     * @return mixed
     */
    public function delete(User $user, Lot $lot)
    {
        return $user->id === $lot->user_id;
    }

}
