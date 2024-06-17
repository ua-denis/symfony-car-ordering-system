<?php

namespace App\Presentation\Controller;

use App\Application\DTO\CarOrderDTO;
use App\Application\UseCase\PlaceOrder;
use Exception;
use InvalidArgumentException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CarOrderController extends AbstractController
{
    private PlaceOrder $placeOrder;

    public function __construct(PlaceOrder $placeOrder)
    {
        $this->placeOrder = $placeOrder;
    }

    #[Route('/order', name: 'car_order', methods: ['POST'])]
    public function order(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        try {
            $orderDTO = new CarOrderDTO(
                $data['type'],
                $data['engineType'],
                $data['engineSize'],
                $data['transmissionType'],
                $data['transmissionSpeeds'],
                $data['body'],
                $data['color'],
                $data['interior'],
                $data['options']
            );

            $car = $this->placeOrder->execute($orderDTO);

            return new Response($car->printCharacteristics());
        } catch (InvalidArgumentException $e) {
            return new Response($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return new Response('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}