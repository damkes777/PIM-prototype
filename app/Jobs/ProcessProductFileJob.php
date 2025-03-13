<?php

namespace App\Jobs;

use App\Livewire\Product\ParseProductFileService;
use App\Models\ProductFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private readonly ProductFile $productFile
    ) {
    }

    public function handle(
        ParseProductFileService $parseProductFileService
    ): void {
        try {
            $parseProductFileService->parseFile($this->productFile);
        } catch (\Throwable $exception) {
            dump($exception->getMessage());
        } finally {
            $this->productFile->is_processing = false;
            $this->productFile->save();
        }
    }
}
