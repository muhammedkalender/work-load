<?php

namespace App\Provider;

use Exception;

class TaskProviderFactory
{
    /**
     * @param string $provider
     * @return TaskProviderInterface
     * @throws Exception
     */
    public function create(string $provider): TaskProviderInterface
    {
        if ($provider === 'it') {
            return new ITTaskProvider();
        } elseif ($provider === 'business') {
            return new BusinessTaskProvider();
        } else {
            throw new Exception("Unknown provider: $provider");
        }
    }
}