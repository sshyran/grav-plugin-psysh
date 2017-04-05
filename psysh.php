<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class PsyshPlugin extends Plugin
{
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * PLUGIN EVENTS
     */
    public function onPluginsInitialized()
    {
        $this->require_binary();
    }


    /**
     * PLUGIN METHODS
     */
    protected function require_binary()
    {
        /**
         * Update with `wget https://git.io/psysh -O psysh.phar`
         * More at http://psysh.org
         */
        $psysh_binary = __DIR__.'/psysh.phar';

        ob_start(); // Fix https://git.io/vSlBs
        require($psysh_binary);
        ob_end_clean();
    }

    /**
     * Once the plugin load, this must be usable
     * from anywhere within: Grav core, any plugins
     * and any theme.
     *
     * Thus, it might be possible that something
     * is not properly instanciated. It must be
     * strongly validated.
     *
     * Also, this must not crash if the plugin is
     * disabled.
     *
     * Use \Grav\Plugin\PsyshPlugin::fire_shell();
     */

    static function fire_shell()
    {
        $grav = \Grav\Common\Grav::instance();
        if(!$grav) return;
        if(!isset($grav['config'])) return;
        $psysh_enabled = $grav['config']->get('plugins.psysh.enabled');
        if(!$psysh_enabled) return;

        eval(\Psy\sh());
    }
}
