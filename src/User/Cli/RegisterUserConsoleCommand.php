<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 21.04.15
 * Time: 14:05
 */

namespace User\Cli;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use User\Command\RegisterUser;

class RegisterUserConsoleCommand extends ContainerAwareCommand
{
    protected function configure(){
        $this
            ->setName('user:register')
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('country', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new RegisterUser();
        $command->email = $input->getArgument('email');
        $command->password = $input->getArgument('password');
        $command->country = $input->getArgument('country');

        // Vaidation
        $constrainedViolationList = $this->getContainer()->get('validator')->validate($command);
        if (count($constrainedViolationList)>0){
            $output->writeln((string)$constrainedViolationList);
            return 1;
        }

        $this->getContainer()->get('command_bus')->handle($command);
    }
}