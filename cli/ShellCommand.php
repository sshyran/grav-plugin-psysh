<?php
namespace Grav\Plugin\Console;

use Grav\Console\ConsoleCommand;

/**
 * Class ShellCommand
 *
 * @package Grav\Plugin\Console
 */
class ShellCommand extends ConsoleCommand
{
    /**
     * Plugin config
     */
    protected function configure()
    {
        $this
            ->setName("shell")
            ->setDescription("Fire PsySH shell")
            ->setHelp('For advance <info>PsySH</info> usage see: http://psysh.org/#usage')
        ;
    }

    /**
     * Open PsySH shell
     */
    protected function serve()
    {
        /**
         * '/../ usage should be fine
         * Composer does it https://git.io/vSWp9
         */
        require_once __DIR__ . '/../psysh.phar';
        extract(\Psy\Shell::debug(get_defined_vars()));
    }
}
