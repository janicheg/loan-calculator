<?php

namespace App\Enum;

enum Environment: string
{
    case PROD = 'PROD';
    case DEV = 'DEV';
    case TEST = 'TEST';
}