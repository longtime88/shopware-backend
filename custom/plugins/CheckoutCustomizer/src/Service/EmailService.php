<?php declare(strict_types=1);

namespace CheckoutCustomizer\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class EmailService
{
    private HttpClientInterface $client;
    private string $apiUrl;
    private string $apiKey;

    public function __construct(HttpClientInterface $client, string $apiUrl, string $apiKey)
    {
        $this->client = $client;
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->apiKey = $apiKey;
    }

    public function send(string $to, string $subject, string $body): void
    {
        $response = $this->client->request('POST', $this->apiUrl . '/send', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => [
                'to' => $to,
                'subject' => $subject,
                'body' => $body,
            ],
        ]);

        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode >= 300) {
            $content = $response->getContent(false);
            throw new \RuntimeException(sprintf('Email API failed with status %d: %s', $statusCode, $content));
        }
    }
}
