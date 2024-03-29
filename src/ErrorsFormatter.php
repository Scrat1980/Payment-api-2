<?php

namespace App;

use App\ErrorFormatterInterface;

class ErrorsFormatter implements ErrorFormatterInterface
{
    public function format($errors): array
    {
        if (!is_iterable($errors)) {
            return [$errors->getMessage()];
        }

        $output = [];
        foreach ($errors as $error) {
            $output[] = $error->getMessage();
        }

        return $output;
    }
}