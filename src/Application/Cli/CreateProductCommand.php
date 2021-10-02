<?php

namespace Application\Cli;

use EasyPrm\ProductCatalog\Command\Product\CreateCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CreateProductCommand
 */
class CreateProductCommand extends Command
{
    protected const ARG_LABEL = 'label';

    protected static $defaultName = 'easyprm:create:product';
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        parent::__construct();
        $this->commandBus = $commandBus;
    }

    protected function configure()
    {
        $this
            ->setDescription('Create a new product');
        $this->addArgument(self::ARG_LABEL, InputArgument::REQUIRED, 'The name of the product to create');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new CreateCommand();
        $command->label = $input->getArgument(self::ARG_LABEL);
        $this->commandBus->dispatch($command);

        return Command::SUCCESS;
    }
}
