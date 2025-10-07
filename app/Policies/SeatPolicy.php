<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Seat;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeatPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Seat');
    }

    public function view(AuthUser $authUser, Seat $seat): bool
    {
        return $authUser->can('View:Seat');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Seat');
    }

    public function update(AuthUser $authUser, Seat $seat): bool
    {
        return $authUser->can('Update:Seat');
    }

    public function delete(AuthUser $authUser, Seat $seat): bool
    {
        return $authUser->can('Delete:Seat');
    }

    public function restore(AuthUser $authUser, Seat $seat): bool
    {
        return $authUser->can('Restore:Seat');
    }

    public function forceDelete(AuthUser $authUser, Seat $seat): bool
    {
        return $authUser->can('ForceDelete:Seat');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Seat');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Seat');
    }

    public function replicate(AuthUser $authUser, Seat $seat): bool
    {
        return $authUser->can('Replicate:Seat');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Seat');
    }

}