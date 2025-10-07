<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Movie;
use Illuminate\Auth\Access\HandlesAuthorization;

class MoviePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Movie');
    }

    public function view(AuthUser $authUser, Movie $movie): bool
    {
        return $authUser->can('View:Movie');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Movie');
    }

    public function update(AuthUser $authUser, Movie $movie): bool
    {
        return $authUser->can('Update:Movie');
    }

    public function delete(AuthUser $authUser, Movie $movie): bool
    {
        return $authUser->can('Delete:Movie');
    }

    public function restore(AuthUser $authUser, Movie $movie): bool
    {
        return $authUser->can('Restore:Movie');
    }

    public function forceDelete(AuthUser $authUser, Movie $movie): bool
    {
        return $authUser->can('ForceDelete:Movie');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Movie');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Movie');
    }

    public function replicate(AuthUser $authUser, Movie $movie): bool
    {
        return $authUser->can('Replicate:Movie');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Movie');
    }

}