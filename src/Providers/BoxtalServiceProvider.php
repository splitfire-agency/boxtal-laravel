<?php

namespace Emc\Providers;

use Illuminate\Support\ServiceProvider;

class BoxtalServiceProvider extends ServiceProvider
{
    /**
     * Register service provider.
     */
    public function register()
    {
        // publish configuration file
        $this->publishes(
            [
                $this->configFile() =>
                    $this->app["path.config"] .
                    DIRECTORY_SEPARATOR .
                    "boxtal.php",
            ],
            "config"
        );

        // merge module config if it's not published or some entries are missing
        $this->mergeConfigFrom($this->configFile(), "boxtal");
    }

    /**
     * Get module config file.
     *
     * @return string
     */
    protected function configFile()
    {
        return realpath(__DIR__ . "/../../config/boxtal.php");
    }
}
