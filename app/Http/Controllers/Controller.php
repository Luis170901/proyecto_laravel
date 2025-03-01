<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

// Extiende BaseController para heredar funcionalidades básicas de los controladores en Laravel, incluyendo middleware().
abstract class Controller extends BaseController
{
    // Se incluyen estos traits para agregar funcionalidades clave al controlador:
    use AuthorizesRequests, // Permite manejar autorizaciones de usuarios con policies y gates.
        DispatchesJobs, // Facilita la ejecución de tareas en segundo plano con jobs.
        ValidatesRequests; // Proporciona validaciones rápidas en los métodos de los controladores.
}
