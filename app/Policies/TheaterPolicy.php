<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Theater;
use Illuminate\Auth\Access\HandlesAuthorization;

class TheaterPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Theater');
    }

    public function view(AuthUser $authUser, Theater $theater): bool
    {
        return $authUser->can('View:Theater');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Theater');
    }

    public function update(AuthUser $authUser, Theater $theater): bool
    {
        return $authUser->can('Update:Theater');
    }

    public function delete(AuthUser $authUser, Theater $theater): bool
    {
        return $authUser->can('Delete:Theater');
    }

    public function restore(AuthUser $authUser, Theater $theater): bool
    {
        return $authUser->can('Restore:Theater');
    }

    public function forceDelete(AuthUser $authUser, Theater $theater): bool
    {
        return $authUser->can('ForceDelete:Theater');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Theater');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Theater');
    }

    public function replicate(AuthUser $authUser, Theater $theater): bool
    {
        return $authUser->can('Replicate:Theater');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Theater');
    }

}