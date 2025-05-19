<?php

namespace App\Enum;

enum DeliveryStatusEnum: string
{
    case CREATED = 'created';
    case QUEUED = 'queued';
    case DELIVERED = 'delivered';
    case FAILED = 'failed';
}
