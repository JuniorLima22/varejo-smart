<?php

namespace App\Enums;

enum StatusVendaEnum: string
{
    case PENDENTE = 'pendente';
    case PAGO = 'pago';
    case CANCELADO = 'cancelado';
    case ENVIADO = 'enviado';
    case CONCLUIDO = 'concluido';

    public static function valores(): array
    {
        return array_column(self::cases(), 'value');
    }
}
