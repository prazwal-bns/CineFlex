<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\BookingSeat;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingSeatPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:BookingSeat');
    }

    public function view(AuthUser $authUser, BookingSeat $bookingSeat): bool
    {
        return $authUser->can('View:BookingSeat');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:BookingSeat');
    }

    public function update(AuthUser $authUser, BookingSeat $bookingSeat): bool
    {
        return $authUser->can('Update:BookingSeat');
    }

    public function delete(AuthUser $authUser, BookingSeat $bookingSeat): bool
    {
        return $authUser->can('Delete:BookingSeat');
    }

    public function restore(AuthUser $authUser, BookingSeat $bookingSeat): bool
    {
        return $authUser->can('Restore:BookingSeat');
    }

    public function forceDelete(AuthUser $authUser, BookingSeat $bookingSeat): bool
    {
        return $authUser->can('ForceDelete:BookingSeat');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:BookingSeat');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:BookingSeat');
    }

    public function replicate(AuthUser $authUser, BookingSeat $bookingSeat): bool
    {
        return $authUser->can('Replicate:BookingSeat');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:BookingSeat');
    }

}