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

use Skymeyer\Sugarcrm\PasswordHash\Hash;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 *
 * Hash generator command
 *
 */
class HashCommand extends Command
{
    /**
     * {inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('generate')
            ->setDescription('Generate password hash (defaults to bcrypt)')
            ->addArgument(
                'password',
                InputArgument::REQUIRED,
                'Clear text password'
            )
            ->addOption(
                'type',
                '',
                InputOption::VALUE_REQUIRED,
                'Supported types: bcrypt (default), sha256 or sha512'
            )
        ;
    }

    /**
     * {inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $hash = new Hash();
        $password = $input->getArgument('password');
        $type = $input->getOption('type') ? $input->getOption('type') : 'bcrypt';

        switch ($type) {
            case 'sha256':
                $out = $hash->generateSha256($password);
                break;

            case 'sha512':
                $out = $hash->generateSha512($password);
                break;

            case 'bcrypt':
                $out = $hash->generateBcrypt($password);
                break;

            default:
                throw new \RuntimeException("Invalid hash type specified");
        }

        $output->writeln($out);
    }
}
