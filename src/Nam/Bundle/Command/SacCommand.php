<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 10/12/18
 * Time: 1:19 AM
 */

// src/Nam/Bundle/Command/SacCommand.php
namespace Nam\Bundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SacCommand extends Command
{
    protected function configure()
    {
        $this
            // the name of the command (the part after "app/console")
            ->setName('nam:sac')

            // the short description shown while running "php app/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
        ;

        $this
            // configure an argument
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
            // ...
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln(array(
            'User Creator',
            '============',
            '',
        ));

        // outputs a message followed by a "\n"
        $output->writeln('Whoa!');

        // outputs a message without adding a "\n" at the end of the line
        $output->write('You are about to ');
        $output->writeln('create a user.');

        $output->writeln('Username: '.$input->getArgument('username'));
    }
}