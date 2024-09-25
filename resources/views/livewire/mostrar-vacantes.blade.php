<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    @forelse($vacantes as $vacante)
        <div class="p-6 text-gray-900 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">

            <div class="space-y-3">
                <a href="{{ route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">{{$vacante->titulo}}</a>
                <p class="text-sm text-gray-600 font-bold">{{$vacante->empresa}}</p>
                <p class="text-sm text-gray-500">Último día: {{$vacante->ultimo_dia->format('d/m/Y')}}</p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                <a href='{{ route('candidatos.index', $vacante->id)}}' class="bg-slate-800 text-center py-2 px-4 rounded-lg text-white text-xs font-bold uppercase"
                >{{$vacante->candidatos->count()}} 
                @choice('Candidato|Candidatos',$vacante->candidatos->count())
                </a>

                <a href='{{ route('vacantes.edit', $vacante->id)}}' class="bg-blue-800 text-center py-2 px-4 rounded-lg text-white text-xs font-bold uppercase"
                >Editar</a>

                <button
                    wire:click="$dispatch('mostrarAlerta',{{$vacante->id}})"
                    class="bg-red-600 text-center py-2 px-4 rounded-lg text-white text-xs font-bold uppercase"
                >Eliminar</button>
            </div>                

        </div>
    @empty
        <p class="p-3 text-center text-sm text-gray-600">
            No hay vacantes para mostrar
        </p>
    @endforelse

    <div class="flex justify-center mt-10">
        {{ $vacantes->links() }}
    </div>
    
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Livewire.on('mostrarAlerta',vacanteId => {
            Swal.fire({
                title: "Eliminar vacante?",
                text: "No se puede recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('eliminarVacante',[vacanteId])
                    Swal.fire({
                        title: "Eliminada!",
                        text: "Su vacante ha sido eliminada.",
                        icon: "success"
                    });
                }
            });
        });
    </script>

@endpush

