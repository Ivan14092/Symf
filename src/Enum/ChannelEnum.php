<?php

namespace App\Enum;

enum ChannelEnum: string
{
    case INTERNAL = 'internal';
    case EMAIL = 'email';
    case SMS = 'sms';
    case TELEGRAM = 'telegram';
}
