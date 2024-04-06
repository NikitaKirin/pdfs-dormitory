<?php

namespace App\Enums;

enum StudentPaymentTypeEnum: string
{
    case Educational = "Educational";
    case Communal = "Communal";
    case SecurityDeposit = "Security deposit";
}
