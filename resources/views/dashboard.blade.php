<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <!-- Sección de Tarjetas -->
            <div class="mt-6 grid grid-cols-2 gap-4">
                <!-- Tarjeta de Alumnos -->
                <div class="bg-gray-900 text-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-semibold">Alumnos</h2>
                    <p class="text-gray-300">Visualizar Alumnos</p>
                    <a href="{{ route('alumnos.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded">
                        Ver Alumnos
                    </a>
                </div>

            <!-- Tarjeta de Proyectos -->
            <div class="bg-gray-900 text-white p-6 rounded-lg shadow-lg">
                 <h2 class="text-xl font-semibold">Proyectos</h2>
                    <p class="text-gray-300">Gestionar Proyectos</p>
                    <a href="{{ route('proyectos.index') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded">
                        Ver Proyectos
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
