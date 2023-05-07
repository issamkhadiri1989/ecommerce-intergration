<?php

declare(strict_types=1);

namespace App\Enum;

enum CartStatus: string
{
    case OPENED = 'OPENED';

    case PLACED = 'PLACED';

    case SHIPPED = 'SHIPPED';

    case PENDING = 'PENDING';

    case CANCELED = 'CANCELED';
}
