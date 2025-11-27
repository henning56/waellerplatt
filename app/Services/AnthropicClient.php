<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AnthropicClient
{
    protected string $endpoint;
    protected string $model;
    protected ?string $key;

    public function __construct()
    {
        $this->endpoint = config('services.anthropic.endpoint') ?: 'https://api.anthropic.com/v1';
        $this->model = config('services.anthropic.model', 'claude-haiku-4.5');
        $this->key = config('services.anthropic.key');
    }

    /**
     * Send a simple request and return decoded JSON response.
     * @param string $prompt
     * @param array $options
     * @return array|null
     */
    public function respond(string $prompt, array $options = []): ?array
    {
        $payload = array_merge([
            'model' => $this->model,
            'input' => $prompt,
        ], $options);

        $headers = [
            'Content-Type' => 'application/json',
        ];
        if ($this->key) {
            // Anthropic platform commonly uses x-api-key
            $headers['x-api-key'] = $this->key;
        }

        $res = Http::withHeaders($headers)
            ->timeout(30)
            ->post(rtrim($this->endpoint, '/') . '/responses', $payload);

        if ($res->successful()) {
            return $res->json();
        }

        return ['error' => $res->body(), 'status' => $res->status()];
    }
}
