<?php

namespace App\Controller;

use App\Entity\PurchaseRequest;
use App\ErrorFormatterInterface;
use App\Populator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\PurchaseService;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PurchaseController extends AbstractController
{
    private ErrorFormatterInterface $formatter;

    public function __construct(ErrorFormatterInterface $formatter)
    {
        $this->formatter = $formatter;
    }

    #[Route('/purchase', name: 'app_purchase', methods: 'post')]
    public function index(
        Request $request,
        Populator $populator,
        ValidatorInterface $validator,
        PurchaseService $service
    ): JsonResponse
    {
        /**
         * @var PurchaseRequest $purchaseRequest
         */
        $purchaseRequest = $populator->populate(
            json_decode($request->getContent()),
            new PurchaseRequest()
        );
        $errors = $validator->validate($purchaseRequest);

        if (count($errors)) {
            return $this->json($this->formatter->format($errors), 400);
        }
        try {
            $service->purchase(
                $purchaseRequest->product,
                $purchaseRequest->couponCode,
                $purchaseRequest->taxNumber,
                $purchaseRequest->paymentProcessor
            );
        } catch (Exception $e)
        {
            return $this->json($this->formatter->format($e), 400);
        }

        return $this->json('Paid fully & duly', 200);
    }
}