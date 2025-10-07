<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Showtime;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShowtimePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Showtime');
    }

    public function view(AuthUser $authUser, Showtime $showtime): bool
    {
        return $authUser->can('View:Showtime');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Showtime');
    }

    public function update(AuthUser $authUser, Showtime $showtime): bool
    {
        return $authUser->can('Update:Showtime');
    }

    public function delete(AuthUser $authUser, Showtime $showtime): bool
    {
        return $authUser->can('Delete:Showtime');
    }

    public function restore(AuthUser $authUser, Showtime $showtime): bool
    {
        return $authUser->can('Restore:Showtime');
    }

    public function forceDelete(AuthUser $authUser, Showtime $showtime): bool
    {
        return $authUser->can('ForceDelete:Showtime');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Showtime');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Showtime');
    }

    public function replicate(AuthUser $authUser, Showtime $showtime): bool
    {
        return $authUser->can('Replicate:Showtime');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Showtime');
    }

}