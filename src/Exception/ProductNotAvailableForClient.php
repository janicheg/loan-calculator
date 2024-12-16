<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ProductNotAvailableForClient extends HttpException
{
    protected const MESSAGE = 'Product not available for client';
    public function __construct(string $message = self::MESSAGE)
    {
        parent::__construct(Response::HTTP_NOT_ACCEPTABLE, $message);
    }
}