<?php

namespace App\Application\UseCase;

use App\Application\DTO\CarOrderDTO;
use App\Contracts\Event\EventDispatcherInterface;
use App\Contracts\Repository\CarRepositoryInterface;
use App\Contracts\Service\EmailServiceInterface;
use App\Contracts\Service\LogServiceInterface;
use App\Contracts\Validation\ValidationStrategyInterface;
use App\Domain\Entity\Car;
use App\Domain\Event\CarProductionCompletedEvent;
use App\Domain\Event\CarProductionStartedEvent;
use App\Domain\Event\OrderPlacedEvent;
use App\Domain\Factory\CarFactoryRegistration;
use InvalidArgumentException;

class PlaceOrder
{
    private CarRepositoryInterface $carRepository;
    private EmailServiceInterface $emailService;
    private LogServiceInterface $logService;
    private ValidationStrategyInterface $validationStrategy;
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(
        CarRepositoryInterface $carRepository,
        EmailServiceInterface $emailService,
        LogServiceInterface $logService,
        ValidationStrategyInterface $validationStrategy,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->carRepository = $carRepository;
        $this->emailService = $emailService;
        $this->logService = $logService;
        $this->validationStrategy = $validationStrategy;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(CarOrderDTO $orderDTO): Car
    {
        $errors = $this->validationStrategy->validate($orderDTO);

        if (count($errors) > 0) {
            $errorMessages = [];

            foreach ($errors as $violation) {
                $errorMessages[$violation->getPropertyPath()] = $violation->getMessage();
            }

            $this->logService->error('Validation failed for car order', ['errors' => $errorMessages]);
            throw new InvalidArgumentException('Invalid order data');
        }

        $car = CarFactoryRegistration::createCarFactory()->createCar(
            $orderDTO->getType(),
            $orderDTO->getEngineType(),
            $orderDTO->getEngineSize(),
            $orderDTO->getTransmissionType(),
            $orderDTO->getTransmissionSpeeds(),
            $orderDTO->getBody(),
            $orderDTO->getColor(),
            $orderDTO->getInterior(),
            $orderDTO->getOptions()
        );

        $this->eventDispatcher->dispatch(new CarProductionStartedEvent($car));
        $this->eventDispatcher->dispatch(new OrderPlacedEvent($car));

        $this->carRepository->save($car);
        $this->logService->info('Car order saved', ['car' => $car]);

        $this->emailService->sendOrderConfirmation('client@example.com', $car);
        $this->logService->info('Order confirmation email sent', ['car' => $car]);

        $this->eventDispatcher->dispatch(new CarProductionCompletedEvent($car));

        return $car;
    }
}