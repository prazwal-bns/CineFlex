<?php

namespace App\Observers;

use App\Models\Screen;

class ScreenObserver
{
    /**
     * Handle the Screen "created" event.
     */
    public function created(Screen $screen): void
    {
        $screen->generateSeats();
    }

    /**
     * Handle the Screen "updated" event.
     */
    public function updated(Screen $screen): void
    {
        if ($screen->isDirty('capacity')) {
            // Delete existing seats
            $screen->seats()->delete();
            // Generate new seats
            $screen->generateSeats();
        }
    }

    /**
     * Handle the Screen "deleted" event.
     */
    public function deleted(Screen $screen): void
    {
        //
    }

    /**
     * Handle the Screen "restored" event.
     */
    public function restored(Screen $screen): void
    {
        //
    }

    /**
     * Handle the Screen "force deleted" event.
     */
    public function forceDeleted(Screen $screen): void
    {
        //
    }
}
