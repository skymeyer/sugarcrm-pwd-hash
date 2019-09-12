<?php

/*
 * This file is part of the skymeyer/sugarcrm-pwd-hash package.
 *
 * (c) Jelle Vink <jelle.vink@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Skymeyer\Sugarcrm\PasswordHash;

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
