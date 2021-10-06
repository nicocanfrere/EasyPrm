<?php

namespace Application\Cli;

use EasyPrm\Core\Exception\ValidationException;
use EasyPrm\ProductCatalog\Command\Product\CreateCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
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
        $io = new SymfonyStyle($input, $output);
        try {
            $command = new CreateCommand();
            $command->setLabel($input->getArgument(self::ARG_LABEL));
            $this->commandBus->dispatch($command);
            $io->success('Product ' . $input->getArgument(self::ARG_LABEL) . ' created');

            return Command::SUCCESS;
        } catch (HandlerFailedException | ValidationException $exception) {
            if ($exception instanceof HandlerFailedException) {
                $exception = $exception->getPrevious();
            }
            foreach ($exception->getErrors() as $error) {
                $io->error((string)$error);
            }

            return Command::FAILURE;
        } catch (\Exception $exception) {
            $io->error($exception->getMessage());

            return Command::FAILURE;
        }
    }
}
