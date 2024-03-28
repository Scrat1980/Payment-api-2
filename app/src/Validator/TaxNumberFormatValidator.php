<?php

namespace App\Validator;

use App\Entity\Tax;
use Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TaxNumberFormatValidator extends ConstraintValidator
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof TaxNumberFormat) {
            throw new UnexpectedTypeException($constraint, TaxNumberFormat::class);
        }
        $validFormatsPatterns = $this->doctrine
            ->getRepository(Tax::class)
            ->findAll();

        if (null === $validFormatsPatterns) {
            throw new Exception('No available tax number formats are available in our storage');
        }

        $masterPattern = '/';
        foreach ($validFormatsPatterns as $key => $validFormatsPattern) {
            $masterPattern .= $key ? '|' : '';
            $masterPattern .= $validFormatsPattern->getFormat();
        }
        $masterPattern .= '/';

        if (!preg_match($masterPattern, $value)) {
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