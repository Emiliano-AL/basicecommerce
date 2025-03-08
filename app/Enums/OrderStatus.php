<?php

namespace App\Enums;

enum OrderStatus: string
{
    case Pending = 'pending';
    case Processing = 'processing';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
    case Refunded = 'refunded';

    public static function getValues(): array
    {
        return [
            self::Pending,
            self::Processing,
            self::Completed,
            self::Cancelled,
            self::Refunded,
        ];
    }

    public static function make($value): string
    {
        return match ($value) {
            self::Pending => 'Pendiente',
            self::Processing => 'Procesando',
            self::Completed => 'Completado',
            self::Cancelled => 'Cancelado',
            self::Refunded => 'Reembolsado',
        };
    }
}
