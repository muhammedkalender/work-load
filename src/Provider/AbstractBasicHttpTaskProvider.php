<?php

namespace App\Provider;

use App\Entity\Task;
use App\Model\ProviderError;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractBasicHttpTaskProvider implements TaskProviderInterface
{
    private $method;
    private $uri;
    protected $httpClient;

    public function __construct(string $method, string $uri, array $clientOptions = ['timeout' => 10])
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->httpClient = new Client($clientOptions);
    }

    /**
     * @return Task[]
     */
    protected abstract function mapTasks(array $unmappedTaskArray): array;

    public function fetchTasks()
    {
        try {
            $response = $this->httpClient->request($this->getMethod(), $this->getUri());

            if ($response->getStatusCode() == 200) {
                $unmappedTaskArray = json_decode($response->getBody()->getContents(), true);

                return $this->mapTasks($unmappedTaskArray);
            } else {
                return new ProviderError('Unexpected status code: ' . $response->getStatusCode());
            }
        } catch (GuzzleException|Exception $e) {
            return new ProviderError($e->getMessage());
        }
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}