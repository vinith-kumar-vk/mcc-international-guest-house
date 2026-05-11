<?php

namespace App\Jobs;

use App\Models\WebhookEndpoint;
use App\Models\WebhookLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DispatchWebhookJob implements ShouldQueue
{
    use Queueable;

    public $endpoint;
    public $event;
    public $payload;
    public $tries = 3;
    public $backoff = [60, 300, 600]; // Retry after 1 min, 5 mins, 10 mins

    /**
     * Create a new job instance.
     */
    public function __construct(WebhookEndpoint $endpoint, $event, $payload)
    {
        $this->endpoint = $endpoint;
        $this->event = $event;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $payloadJson = json_encode($this->payload);
        $signature = $this->endpoint->secret 
            ? hash_hmac('sha256', $payloadJson, $this->endpoint->secret) 
            : null;

        $startTime = microtime(true);
        
        try {
            $response = Http::withHeaders(array_filter([
                'X-Webhook-Signature' => $signature,
                'Content-Type' => 'application/json',
                'User-Agent' => 'MCC-IGH-Webhook/1.0',
            ]))->post($this->endpoint->url, $this->payload);

            $this->logDelivery(
                $response->status(),
                $response->body(),
                null
            );

            if (!$response->successful()) {
                throw new \Exception("Webhook delivery failed with status " . $response->status());
            }

        } catch (\Exception $e) {
            $this->logDelivery(
                null,
                null,
                $e->getMessage()
            );

            throw $e; // Re-throw to trigger retry
        }
    }

    protected function logDelivery($status, $body, $error)
    {
        WebhookLog::create([
            'endpoint_id' => $this->endpoint->id,
            'event' => $this->event,
            'payload' => $this->payload,
            'response_status' => $status,
            'response_body' => $body,
            'retry_count' => $this->attempts() - 1,
            'error' => $error,
        ]);
    }
}
