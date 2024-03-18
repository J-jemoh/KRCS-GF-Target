<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Demographics;

class ProcessCsvChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $chunk;
    protected $mapping;
    protected $user_id;

    public function __construct($chunk, $mapping, $user_id)
    {
        $this->chunk = $chunk;
        $this->mapping = $mapping;
        $this->user_id = $user_id;
    }

 public function handle()
    {
        foreach ($this->chunk as $row) {
            // Check if 'sno' field is present and not null before proceeding
            if (isset($row[$this->mapping['SNo']]) && $row[$this->mapping['SNo']] !== null) {
                $data = [];
                foreach ($this->mapping as $header => $column) {
                    $data[$column] = $row[$header] ?? null;
                }
                $data['user_id'] = $this->user_id;

                // Check if 'sno' field is present and not null before proceeding
                if (isset($data['sno']) && $data['sno'] !== null) {
                    $existingRecord = Demographics::where('sno', $data['sno'])
                        ->where('month', $data['month'] ?? null)
                        ->where('year', $data['year'] ?? null)
                        ->first();

                    if ($existingRecord) {
                        $existingRecord->update($data);
                    } else {
                        Demographics::create($data);
                    }
                } else {
                    // Log or handle the case where 'sno' is missing or null
                    Log::error("Missing or null 'sno' field in CSV data");
                }
            } else {
                // Log or handle the case where 'sno' is missing or null
                Log::error("Missing or null 'sno' field in CSV data");
            }
        }
    }

}

