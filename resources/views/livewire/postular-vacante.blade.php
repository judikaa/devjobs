<div class="bg-gray-100 p-5 mt-10 flex flex-col justify-center items-center">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h3 class="text-center text-2xl font-bold my-4">
        Postularme a esta vacante
        
    </h3>
    

    @if(session()->has('mensaje'))
        <p class="uppercase border border-green-600 bg-green-100 
        text-green-600 font-bold p-2 my-5 text-sm rounded-lg">
            {{ session('mensaje') }}
        </p>
    @else
        @if(session()->has('mensaje_error'))
            <p class="uppercase border border-red-600 bg-red-100 
            text-red-600 font-bold p-2 my-5 text-sm rounded-lg">
                {{ session('mensaje_error') }}
            </p>
        @else
            <form wire:submit.prevent='postularme' class="w-96 mt-5" action="">
                <div class="mb-4">
                    <x-input-label for="cv" :value="__('Curriculum Vitae')" />
                    <x-text-input 
                        id="cv" 
                        type="file" 
                        accept=".pdf"
                        wire:model="cv"
                        class="block mt-1 w-full"
                    />
                    <x-input-error :messages="$errors->get('cv')" class="mt-2 uppercase" />
                    
                </div>

                <x-primary-button class="my-5">
                    {{ __('Postularme') }}
                </x-primary-button>
            
            </form>
        @endif
    @endif
</div>
