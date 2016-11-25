<?php
namespace Tzsk\Push\Factory;


use Gomoob\Pushwoosh\Client\Pushwoosh;
use InvalidArgumentException;

class PusherFactory
{
    /**
     * Make a new Pushwoosh client.
     *
     * @return \Gomoob\Pushwoosh\Client\Pushwoosh
     */
    public function make()
    {
        $config = $this->getConfig();

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig()
    {
        $cnf = config('push');
        $config = $cnf['connections'][$cnf['default']];
        $keys = ['key', 'token'];

        foreach ($keys as $key) {
            if (!array_key_exists($key, $config)) {
                throw new InvalidArgumentException("Missing configuration key [$key].");
            }
        }

        return array_only($config, $keys);
    }

    /**
     * Get the Pushwoosh client.
     *
     * @param string[] $auth
     *
     * @return \Gomoob\Pushwoosh\Client\Pushwoosh
     */
    protected function getClient(array $auth)
    {
        return Pushwoosh::create()
            ->setApplication($auth['key'])
            ->setAuth($auth['token']);
    }
}