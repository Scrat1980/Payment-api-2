<?php

namespace App\Controller;

use App\Entity\PriceRequest;
use App\ErrorFormatterInterface;
use App\Populator;
use App\Service\CalculatePriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PriceController extends AbstractController
{
    private ErrorFormatterInterface $formatter;
    public function __construct(ErrorFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }
    #[Route('/calculate-price', name: 'app_product', methods: 'post')]
    public function index(
        Request $request,
        Populator $populator,
        ValidatorInterface $validator,
        CalculatePriceService $calculatePriceService
    ): JsonResponse
    {
        /**
         * @var PriceRequest $priceRequest
         */
        $priceRequest = $populator->populate(
            json_decode($request->getContent()),
            new PriceRequest()
        );
        $errors = $validator->validate($priceRequest);
        if (count($errors)) {
            return $this->json($this->formatter->format($errors), 400);
        }

        $price = $calculatePriceService->do(
            $priceRequest->product,
            $priceRequest->couponCode,
            $priceRequest->taxNumber
        );

        return $this->json($price);
    }
}
