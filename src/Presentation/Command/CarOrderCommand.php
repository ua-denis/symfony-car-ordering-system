<?php

namespace App\Presentation\Command;

use App\Application\DTO\CarOrderDTO;
use App\Application\UseCase\PlaceOrder;
use Exception;
use InvalidArgumentException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:order-car')]
class CarOrderCommand extends Command
{
    private PlaceOrder $placeOrder;

    public function __construct(PlaceOrder $placeOrder)
    {
        parent::__construct();
        $this->placeOrder = $placeOrder;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Place a car order.')
            ->addArgument('type', InputArgument::REQUIRED, 'Car type')
            ->addArgument('engineType', InputArgument::REQUIRED, 'Engine type')
            ->addArgument('engineSize', InputArgument::REQUIRED, 'Engine size')
            ->addArgument('transmissionType', InputArgument::REQUIRED, 'Transmission type')
            ->addArgument('transmissionSpeeds', InputArgument::REQUIRED, 'Number of speeds')
            ->addArgument('body', InputArgument::REQUIRED, 'Body type')
            ->addArgument('color', InputArgument::REQUIRED, 'Color')
            ->addArgument('interior', InputArgument::REQUIRED, 'Interior trim')
            ->addArgument('options', InputArgument::IS_ARRAY | InputArgument::OPTIONAL, 'Additional options', []);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $type = $input->getArgument('type');
        $engineType = $input->getArgument('engineType');
        $engineSize = $input->getArgument('engineSize');
        $transmissionType = $input->getArgument('transmissionType');
        $transmissionSpeeds = (int)$input->getArgument('transmissionSpeeds');
        $body = $input->getArgument('body');
        $color = $input->getArgument('color');
        $interior = $input->getArgument('interior');
        $options = $input->getArgument('options') ?? [];

        try {
            $orderDTO = new CarOrderDTO(
                $type,
                $engineType,
                $engineSize,
                $transmissionType,
                $transmissionSpeeds,
                $body,
                $color,
                $interior,
                $options
            );

            $car = $this->placeOrder->execute($orderDTO);

            $output->writeln('Car order processed successfully:');
            $output->writeln($car->printCharacteristics());

            return Command::SUCCESS;
        } catch (InvalidArgumentException $e) {
            $output->writeln('<error>'.$e->getMessage().'</error>');

            return Command::FAILURE;
        } catch (Exception $e) {
            $output->writeln('<error>An unexpected error occurred: '.$e->getMessage().'</error>');

            return Command::FAILURE;
        }
    }
}