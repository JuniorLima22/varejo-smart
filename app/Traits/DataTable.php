<?php

namespace App\Traits;

trait DataTable
{
    public string $classificarNomeColuna = 'id';
    public string $classificarDirecao = 'desc';
    public string $porPagina = '50';

    public function itemPorPagina(): int
    {
        if ($this->porPagina != null && $this->porPagina < 0)
            return $this->porPagina = $this->porPagina * -1;

        return $this->porPagina = (int)$this->porPagina;
    }

    public function ordenarPor(string $nomeColuna): void
    {
        if ($this->classificarNomeColuna === $nomeColuna) {
            $this->classificarDirecao = ($this->classificarDirecao === 'asc') ? 'desc' : 'asc';
        } else {
            $this->classificarDirecao = 'asc';
        }
        $this->classificarNomeColuna = $nomeColuna;
    }
}
