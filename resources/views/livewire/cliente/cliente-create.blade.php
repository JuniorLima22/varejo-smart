<div>
    <x-adminlte-card class="shadow">
        <form wire:submit.prevent="store">
            <div class="form-row">
                <div class="col-md-6">
                    <x-adminlte-input type="text" wire:model="nome" name="nome" label="Nome" placeholder="Nome do Cliente" label-class="required" enable-old-support />
                </div>

                <div class="col-md-6">
                    <x-adminlte-input type="text" wire:model="cpf" name="cpf" label="CPF" placeholder="CPF" label-class="required" enable-old-support autocomplete="off" x-mask="999.999.999-99" />
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-6">
                    <x-adminlte-input type="phone" wire:model="telefone" name="telefone" label="Telefone" placeholder="Telefone" enable-old-support x-mask="(99) 99999-9999">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-6">
                    <x-adminlte-input type="text" wire:model="email" name="email" label="E-mail" placeholder="E-mail" label-class="required" enable-old-support autocomplete="off">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-at"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>

            <hr>
            <h4>Endereço</h4>

            <div class="form-row">
                <div class="col-md-4">
                    <x-adminlte-input type="text" wire:model="cep" name="cep" label="CEP" placeholder="CEP" enable-old-support x-mask="99999-999" />
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="text" wire:model="logradouro" name="logradouro" label="Rua" placeholder="Rua" label-class="required" enable-old-support />
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="text" wire:model="numero" name="numero" label="Número" placeholder="Número" enable-old-support />
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4">
                    <x-adminlte-input type="text" wire:model="cidade" name="cidade" label="Cidade" placeholder="Cidade" label-class="required" enable-old-support />
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="text" wire:model="bairro" name="bairro" label="Bairro" placeholder="Bairro" label-class="required" enable-old-support />
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="text" wire:model="complemento" name="complemento" label="Complemento" placeholder="Complemento" enable-old-support />
                </div>
            </div>

            <button type="submit" class="btn btn-success mr-1">
                <span wire:loading wire:target="store">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Carregando...</span>
                </span>
                <i class="fas fa-save" wire:loading.remove wire:target="store"></i>
                Salvar
            </button>

            <x-adminlte-button label="Voltar" icon="fas fa-arrow-circle-left" onclick="window.history.back()" />
        </form>
    </x-adminlte-card>

    @section('js')
    <script>
    </script>
    @stop
</div>
