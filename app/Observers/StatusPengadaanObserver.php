<?php

namespace App\Observers;

use App\Models\Pengadaan;
use App\Models\StatusPengadaan;

class StatusPengadaanObserver
{
    /**
     * Handle the StatusPengadaan "created" event.
     *
     * @param  \App\Models\StatusPengadaan  $statusPengadaan
     * @return void
     */
    public function created(StatusPengadaan $statusPengadaan)
    {
        $pengadaan = Pengadaan::find($statusPengadaan->pengadaan_id);
        if ($pengadaan) {
            $pengadaan->update(['status' => $statusPengadaan->status]);
        }
    }

    /**
     * Handle the StatusPengadaan "updated" event.
     *
     * @param  \App\Models\StatusPengadaan  $statusPengadaan
     * @return void
     */
    public function updated(StatusPengadaan $statusPengadaan)
    {
        //
    }

    /**
     * Handle the StatusPengadaan "deleted" event.
     *
     * @param  \App\Models\StatusPengadaan  $statusPengadaan
     * @return void
     */
    public function deleted(StatusPengadaan $statusPengadaan)
    {
        //
    }

    /**
     * Handle the StatusPengadaan "restored" event.
     *
     * @param  \App\Models\StatusPengadaan  $statusPengadaan
     * @return void
     */
    public function restored(StatusPengadaan $statusPengadaan)
    {
        //
    }

    /**
     * Handle the StatusPengadaan "force deleted" event.
     *
     * @param  \App\Models\StatusPengadaan  $statusPengadaan
     * @return void
     */
    public function forceDeleted(StatusPengadaan $statusPengadaan)
    {
        //
    }
}
