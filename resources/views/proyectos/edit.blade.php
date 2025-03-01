<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">
            <form action="{{ route('proyectos.update', $proyecto->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="titulo" value="Título" />
                        <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" value="{{ $proyecto->titulo }}" required />
                    </div>
                    <div>
                        <x-input-label for="horas_previstas" value="Horas Previstas" />
                        <x-text-input id="horas_previstas" class="block mt-1 w-full" type="number" name="horas_previstas" value="{{ $proyecto->horas_previstas }}" required />
                    </div>
                    <div>
                        <x-input-label for="fecha_comienzo" value="Fecha de Comienzo" />
                        <x-text-input id="fecha_comienzo" class="block mt-1 w-full" type="date" name="fecha_comienzo" value="{{ $proyecto->fecha_comienzo }}" required />
                    </div>
                </div>
                <div class="flex flex-row justify-between p-3">
                    <button class="btn btn-warning" type="submit">Guardar</button>
                    <a href="{{ route('proyectos.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.layout>
