<?php

namespace App\Traits;

trait Modal
{
    /**
     * Despachar evento de modal.
     *
     * @param  string  $modalId
     * @param  string  $metodo show|hide
     */
    public function modal(string $modalId, string $metodo = 'show'): void
    {
        $this->js(
            "$('#$modalId').modal('$metodo');"
        );
    }
}
