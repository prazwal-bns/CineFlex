<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Screen;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScreenPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Screen');
    }

    public function view(AuthUser $authUser, Screen $screen): bool
    {
        return $authUser->can('View:Screen');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Screen');
    }

    public function update(AuthUser $authUser, Screen $screen): bool
    {
        return $authUser->can('Update:Screen');
    }

    public function delete(AuthUser $authUser, Screen $screen): bool
    {
        return $authUser->can('Delete:Screen');
    }

    public function restore(AuthUser $authUser, Screen $screen): bool
    {
        return $authUser->can('Restore:Screen');
    }

    public function forceDelete(AuthUser $authUser, Screen $screen): bool
    {
        return $authUser->can('ForceDelete:Screen');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Screen');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Screen');
    }

    public function replicate(AuthUser $authUser, Screen $screen): bool
    {
        return $authUser->can('Replicate:Screen');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Screen');
    }

}