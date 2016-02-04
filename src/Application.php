<?php

namespace Sugarcrm\PasswordHash;

use Symfony\Component\Console\Application as Base;

/**
 *
 * Console application
 *
 */
class Application extends Base
{
    /**
     * Ctor
     */
    public function __construct()
    {
        parent::__construct('SugarCRM Password Hash Generator', Hash::VERSION);
    }

    /**
     * {@inhertidoc}
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new HashCommand();
        return $commands;
    }
}
