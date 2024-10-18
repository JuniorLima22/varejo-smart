<div>
    <x-adminlte-card class="shadow">
        <form wire:submit.prevent="update" >
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
                                    <option value="{{ $subcategoria->id }}" @selected($subcategoria->id == $categoria_id)>{{ $subcategoria->nome }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </x-adminlte-select>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-4">
                    <x-adminlte-input type="number" wire:model="preco_compra" name="preco_compra" label="Preço de Compra" placeholder="Preço de compra" label-class="required" enable-old-support autocomplete="off" min="0" step="0.01">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="number" wire:model="preco_venda" name="preco_venda" label="Preço de Venda" placeholder="Preço de venda" label-class="required" enable-old-support autocomplete="off" min="0" step="0.01">
                        <x-slot name="appendSlot">
                            <div class="input-group-text text-dark">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>

                <div class="col-md-4">
                    <x-adminlte-input type="number" wire:model="quantidade" name="quantidade" label="Quantidade em Estoque" placeholder="Quantidade" label-class="required" enable-old-support autocomplete="off" min="0" step="1">
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

            <div class="form-row">
                <div class="col-sm-12 col-md-6">
                    <x-adminlte-input-file name="imagem_temporario" wire:model.defer="imagem_temporario" label="Imagem" placeholder="Imagem" legend="Carregar" enable-old-support>
                        <x-slot name="prependSlot">
                            <div class="input-group-text bg-lightblue">
                                <i class="fas fa-upload"></i>
                            </div>
                        </x-slot>
                        <x-slot name="bottomSlot">
                            <span class="text-sm text-gray">
                                Somente imagem png, jpg ou webp, resolução recomendada 220x220
                            </span>
                        </x-slot>
                    </x-adminlte-input-file>
                </div>
            </div>

            <div class="form-row">
                <div class="col-sm-12 col-md-6">
                    @if ($imagem_url)
                        <div>
                            <p class="text-bold">Visualização da imagem</p>
                            <img src="{{ asset('storage/' . $imagem_url) }}" class="img-thumbnail rounded mx-auto mb-3 h-50">
                        </div>
                    @endif
                </div>

                <div class="col-sm-12 col-md-6">
                    <p class="text-bold" wire:loading wire:target="imagem_temporario">
                        Carregando imagem...
                    </p>
                    @if ($imagem_temporario)
                        <div wire:loading.class="d-none">
                            <p class="text-bold">Visualização da imagem</p>
                            <img src="{{ $imagem_temporario->temporaryUrl() }}"
                            class="img-thumbnail rounded mx-auto mb-3 h-50">
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success mr-1">
                <span wire:loading wire:target="update">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Carregando...</span>
                </span>
                <i class="fas fa-save" wire:loading.remove wire:target="update"></i>
                Salvar
            </button>

            <x-adminlte-button label="Voltar" icon="fas fa-arrow-circle-left" onclick="window.history.back()" />
        </form>
    </x-adminlte-card>
</div>
