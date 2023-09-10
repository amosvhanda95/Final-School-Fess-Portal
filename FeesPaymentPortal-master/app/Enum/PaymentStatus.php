<?php

namespace App\Enum;

enum PaymentStatus : int
{
    case Captured  = 1;
    case Confirmed   = 2;
    case  Queued   = 3;
    case SentToEthix  = 4;
    case Cancelled = 5;
    case Completed = 6;
    case Expired = 7;
}
