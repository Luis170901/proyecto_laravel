<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">
            <div>
                <x-input-label for="titulo" value="Título" />
                <span class="block mt-1 w-full">{{ $proyecto->titulo }}</span>
            </div>
            <div>
                <x-input-label for="horas_previstas" value="Horas Previstas" />
                <span class="block mt-1 w-full">{{ $proyecto->horas_previstas }}</span>
            </div>
            <div>
                <x-input-label for="fecha_comienzo" value="Fecha de Comienzo" />
                <span class="block mt-1 w-full">{{ $proyecto->fecha_comienzo }}</span>
            </div>
        </div>
    </div>
</x-layouts.layout>
