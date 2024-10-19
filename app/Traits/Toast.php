<?php

namespace App\Traits;

trait Toast
{
    protected $registro_cadastrado = 'Registro cadastrado com sucesso!';
    protected $registro_atualizado = 'Registro atualizado com sucesso!';
    protected $registro_deletado = 'Registro deletado com sucesso!';
    protected $registro_nao_encontrado = 'Registro não encontrado!';
    protected $registro_erro_cadastrar = 'Erro ao cadastrar registro!';
    protected $registro_erro_atualizar = 'Erro ao atualizar registro!';
    protected $registro_erro_deletar = 'Erro ao deletar registro!';

    /**
     * Despachar evento de notificação TOAST.
     *
     * @param  string  $titulo
     * @param  string  $mensagem
     * @param  string  $tipo [success|info|warning|danger|maroon]
     * @param  string  $icon [fontawesome]
     * @param  bool    $autohide
     * @param  int     $delay
     */
    private function toast(string $titulo, string $mensagem, string $tipo = null, string $icon = null, int $delay = null, bool $autohide = true, string $position = 'topRight'): void
    {
        $json = json_encode([
            'title' => $titulo,
            'body' => $mensagem,
            'class' => $tipo ?? 'bg-success',
            'icon' => $this->icon($icon),
            'delay' => $delay ?? 5000,
            'autohide' => $autohide ?? true,
            'position' => $position ?? 'topRight'
        ]);

        $this->js(
            "$(document).Toasts('create', $json);"
        );
    }

    private function icon(string $icon = null): ?string
    {
        $icons = [
            'success' => 'fas fa-check-circle fa-lg',
            'info' => 'fas fa-info-circle fa-lg',
            'error' => 'fas fa-times-circle fa-lg',
            'warning' => 'fas fa-exclamation-circle fa-lg'
        ];

        if (array_key_exists($icon, $icons))
            return $icons[$icon];

        return $icon;
    }

    /**
     * Despachar evento de notificação TOAST.
     *
     * @param  string  $mensagem
     * @param  string  $icon [fontawesome]
     * @param  int     $delay
     * @param  bool    $autohide
     */
    public function sucesso(string $mensagem, string $icon = null, int $delay = null, bool $autohide = true, string $position = 'topRight'): void
    {
        $this->toast(
            'Sucesso!',
            $mensagem,
            'bg-success',
            $icon ?? 'success',
            $delay,
            $autohide,
            $position
        );
    }

    /**
     * Despachar evento de notificação TOAST.
     *
     * @param  string  $mensagem
     * @param  string  $icon [fontawesome]
     * @param  int     $delay
     * @param  bool    $autohide
     */
    public function info(string $mensagem, string $icon = null, int $delay = null, bool $autohide = true, string $position = 'topRight'): void
    {
        $this->toast(
            'Informação!',
            $mensagem,
            'bg-info',
            $icon ?? 'info',
            $delay,
            $autohide,
            $position,
        );
    }

    /**
     * Despachar evento de notificação TOAST.
     *
     * @param  string  $mensagem
     * @param  string  $icon [fontawesome]
     * @param  int     $delay
     * @param  bool    $autohide
     */
    public function error(string $mensagem, string $icon = null, int $delay = null, bool $autohide = true, string $position = 'topRight'): void
    {
        $this->toast(
            'Erro!',
            $mensagem,
            'bg-danger',
            $icon ?? 'error',
            $delay,
            $autohide,
            $position,
        );
    }

    /**
     * Despachar evento de notificação TOAST.
     *
     * @param  string  $mensagem
     * @param  string  $icon [fontawesome]
     * @param  int     $delay
     * @param  bool    $autohide
     */
    public function atencao(string $mensagem, string $icon = null, int $delay = null, bool $autohide = true, string $position = 'topRight'): void
    {
        $this->toast(
            'Atenção!',
            $mensagem,
            'bg-warning',
            $icon ?? 'warning',
            $delay,
            $autohide,
            $position,
        );
    }
}
