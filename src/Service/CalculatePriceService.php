<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Coupon;
use App\Entity\Product;
use App\Entity\Tax;
use Doctrine\Persistence\ManagerRegistry;

class CalculatePriceService
{
    private ManagerRegistry $doctrine;

    public function __construct(
        ManagerRegistry $doctrine
    )
    {
        $this->doctrine = $doctrine;
    }

    public function do(
        int $productId,
        string $couponCode,
        string $taxNumber
    ): string
    {
        $product = $this->doctrine->getRepository(Product::class)->find($productId);
        $tax = $this->doctrine->getRepository(Tax::class)->findByNumber($taxNumber);
        $coupon = $this->doctrine->getRepository(Coupon::class)->getCouponByCode($couponCode);

        $price = $coupon->applyToPrice($product->getPrice()) * (1 + $tax->getRate()/100);

        return number_format($price, 2);
    }


}