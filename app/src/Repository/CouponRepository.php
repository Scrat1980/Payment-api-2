<?php

namespace App\Repository;

use App\Entity\Coupon;
use App\Service\Coupon\FixCalculator;
use App\Service\Coupon\NeutralCalculator;
use App\Service\Coupon\PercentCalculator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coupon>
 *
 * @method Coupon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coupon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coupon[]    findAll()
 * @method Coupon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CouponRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coupon::class);
    }

    public function getCouponByCode(string $code): Coupon
    {
        if ($code) {
            //todo: fix situations where we have more than 1 coupon names in the DB
            $coupon = $this->findOneBy(['name' => $code]);
            $coupon->calculator = match ($coupon->getType()) {
                'FIX' => new FixCalculator(),
                'PERCENT' => new PercentCalculator(),
            };
        } else {
            $coupon = new Coupon();
            $coupon->setValue(0);
            $coupon->calculator = new NeutralCalculator();
        }

        return $coupon;
    }
}
