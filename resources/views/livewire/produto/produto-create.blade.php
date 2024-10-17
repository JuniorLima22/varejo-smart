<div>
    <x-adminlte-card class="shadow">
        <form wire:submit.prevent="store">
            <div class="form-row">
                <div class="col-md-6">
                    <x-adminlte-input type="text" wire:model="nome" name="nome" label="Nome" placeholder="Nome do produto" label-class="required" enable-old-support />
                </div>

                <div class="col-md-6">
                    <x-adminlte-select wire:model="categoria_id" name="categoria_id" label="Categorias" label-class="required" enable-old-support>
                        <option/>
                        @foreach ($categorias as $categoriaPai)
                            <optgroup label="{{ $categoriaPai->nome }}">
                                @foreach ($categoriaPai->subcategorias as $subcategoria)
                                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->nome }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </x-adminlte-select>
                </div>
            </div>            

            <div class="form-row">
                <div class="col-md-4">
                    <x-adminlte-input type="number" wire:model="preco_compra" name="preco_compra" label="Preço de Compra" placeholder="Preço de compra" enable-old-support autocomplete="off" min="0" step="0.01">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="number" wire:model="preco_venda" name="preco_venda" label="Preço de Venda" placeholder="Preço de venda" enable-old-support autocomplete="off" min="0" step="0.01">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="number" wire:model="quantidade" name="quantidade" label="Quantidade em Estoque" placeholder="Quantidade" enable-old-support autocomplete="off" min="0" step="1">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-cubes"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <x-adminlte-textarea name="descricao" wire:model="descricao" label="Descrição" placeholder="Inserir descrição..." rows="5"/>
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
