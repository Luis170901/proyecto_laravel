<x-layouts.layout>
@if (session("mensaje"))
    <div role="alert" class="alert alert-success">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 shrink-0 stroke-current"
            fill="none"
            viewBox="0 0 24 24">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ session("mensaje") }}</span>
    </div>
@endif

    <div class="p-2 flex flex-row justify-start items-center space-x-2">
        <a href="{{route('proyectos.create')}}" class="btn btn-sm btn-primary">Crear Proyecto</a>
        <a href="{{route('home')}}" class="btn btn-sm btn-primary">Volver</a>
    </div>
    <div class="max-h-full overflow-x-auto">
        <table class="table table-xs table-pin-rows table-pin-cols">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Horas Previstas</th>
                    <th>Fecha de Comienzo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyectos as $proyecto)
                    <tr>
                        <td>{{$proyecto->titulo}}</td>
                        <td>{{$proyecto->horas_previstas}}</td>
                        <td>{{$proyecto->fecha_comienzo}}</td>
                        <td>
                            <a href="{{route('proyectos.edit', $proyecto->id)}}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                        <td>
                            <form onsubmit="event.preventDefault()" id="formulario{{$proyecto->id}}" action="{{route('proyectos.destroy', $proyecto->id)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button onclick="confirmDelete({{$proyecto->id}})" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        function confirmDelete(id) {
            swal({
                title: "¿Borrar Proyecto?",
                text: "Esta acción no se puede recuperar",
                icon: "warning",
                buttons: true
            }).then((ok) => {
                if (ok) {
                    document.getElementById("formulario" + id).submit();
                }
            });
        }
    </script>
</x-layouts.layout>
