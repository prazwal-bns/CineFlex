<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Booking');
    }

    public function view(AuthUser $authUser, Booking $booking): bool
    {
        return $authUser->can('View:Booking');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Booking');
    }

    public function update(AuthUser $authUser, Booking $booking): bool
    {
        return $authUser->can('Update:Booking');
    }

    public function delete(AuthUser $authUser, Booking $booking): bool
    {
        return $authUser->can('Delete:Booking');
    }

    public function restore(AuthUser $authUser, Booking $booking): bool
    {
        return $authUser->can('Restore:Booking');
    }

    public function forceDelete(AuthUser $authUser, Booking $booking): bool
    {
        return $authUser->can('ForceDelete:Booking');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Booking');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Booking');
    }

    public function replicate(AuthUser $authUser, Booking $booking): bool
    {
        return $authUser->can('Replicate:Booking');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Booking');
    }

}