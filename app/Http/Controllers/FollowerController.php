<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    /* Cuando tienes una relación de muchos a muchos, generalmente necesitas una tabla intermedia que actúe como un puente entre las dos tablas principales. Al utilizar el método attach(), puedes agregar registros a esta tabla intermedia para establecer las relaciones entre los registros de las dos tablas principales. */

    public function store(User $user)
    {
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    /* El método detach() se utiliza en el contexto de las relaciones de muchos a muchos para eliminar la asociación entre dos registros. */
    public function destroy(User $user)
    {
        $user->followers()->detach( auth()->user()->id );
        return back();
    }
}
