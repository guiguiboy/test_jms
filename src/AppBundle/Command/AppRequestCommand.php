<?php

namespace AppBundle\Command;

use AppBundle\Rest\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class AppRequestCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:request')
            ->setDescription('Performs HTTP requests')
            //->addArgument('argument', InputArgument::OPTIONAL, 'Argument description')
            //->addOption('option', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$argument = $input->getArgument('argument');

        /*if ($input->getOption('option')) {
            // ...
        }*/

        /** @var Client $client */
        $client = $this->getContainer()->get(Client::class);
        $client->getUser('guiguiboy');
        $client->getUserAsync('guiguiboy2');



        $output->writeln('Command result.');
    }

}
