<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>
    <div>
        <x-input-label for="titulo" :value="__('Título vacante')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo" 
            :value="old('titulo')"
            placeholder="Titulo vacante"
        />
        <x-input-error :messages="$errors->get('titulo')" class="mt-2 uppercase" />

    </div>
    <div>
        <x-input-label for="salario" :value="__('Salario mensual')" />
        <select
            id="salario"
            wire:model="salario"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Selecciona salario mensual --</option>
            @foreach($salarios as $salario)
                <option value={{$salario->id}}>{{$salario->salario}}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('salario')" class="mt-2 uppercase" />

    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoría')" />
        <select
            id="categoria"
            wire:model="categoria"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
            <option value="">-- Selecciona categoria --</option>
            @foreach($categorias as $categoria)
                <option value={{$categoria->id}}>{{$categoria->categoria}}</option>
            @endforeach            

        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2 uppercase" />
    </div>
    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')"
            placeholder="Empresa: ej. Netflix, Uber, Shopify"
        />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2 uppercase" />

    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo día para postularse')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="date" 
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')"
        />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2 uppercase" />
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripción Puesto')" />
        <textarea
            id="descripcion" 
            wire:model="descripcion"
            placeholder="Descripcion general del puesto, experiencia"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-72"
        ></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2 uppercase" />

    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model="imagen_nueva" 
            accept="image/*"
        />
        <div class="my-5 w-80">
            @if(!$errors->has('imagen_nueva') && $imagen_nueva)
                Imagen: 
                <img src="{{ $imagen_nueva->temporaryUrl() }}">
            @endif
        </div>
        <x-input-error :messages="$errors->get('imagen_nueva')" class="mt-2 uppercase" />
        <div class="my-5 w-80">
            <x-input-label :value="__('Imagen Actual')" />
            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen vacante ' . $titulo}}"
        </div>


    </div>    



    <x-primary-button class="w-full justify-center">
        {{ __('Guardar vacante') }}
    </x-primary-button>


</form>
