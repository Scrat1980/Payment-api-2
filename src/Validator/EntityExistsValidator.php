<?php

namespace App\Validator;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\ConstraintValidator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EntityExistsValidator extends ConstraintValidator
{
    private ManagerRegistry $doctrine;
    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityExists) {
            throw new UnexpectedTypeException($constraint, EntityExists::class);
        }
        $entityOk = $this->doctrine->getRepository($constraint->entity)
            ->findBy([$constraint->property => $value]);
        if ($entityOk === []) {
            $this->setViolation($constraint->message, $value);
        }
        if (($constraint->mode === 'one') && (count($entityOk) > 1)) {
            $this->setViolation($constraint->message, $value);
        }
    }

    protected function setViolation($message, $value): void
    {
        $this->context
            ->buildViolation($message)
            ->setParameter('%value%', (string) $value)
            ->addViolation();
    }
}