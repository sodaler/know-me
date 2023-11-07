<?php

namespace App\Listeners;

use App\Events\MediableNoteDeleted;
use App\Services\FileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteRelatedMedia
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly FileService $fileService,
    ) {
    }

    /**
     * Handle the event.
     */
    public function handle(MediableNoteDeleted $event): void
    {
        $media = $event->model->media()->get();
        foreach ($media as $oneMedia) {
            $this->fileService->delete($oneMedia);
        }
    }
}
