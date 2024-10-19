<?php

if (!function_exists('formatar_moeda')) {
    function formatar_moeda($valor): string
    {
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }
}