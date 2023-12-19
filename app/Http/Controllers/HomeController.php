<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* En Laravel, un controlador es una clase PHP que maneja solicitudes HTTP y gestiona la respuesta de la aplicación.

    Un controlador invocable: es un tipo especial de controlador que le permite definir un método mágico __invoke() en lugar de definir múltiples métodos de acción como index(), store(), show() etc...

    Se utiliza para permitir que una clase pueda ser invocada como si fuera una función. Esto significa que puedes llamar a una instancia de la clase directamente

    Usando un controlador invocable, puedes definir una única acción para una ruta particular, y Laravel llamará automáticamente al __invoke()método cuando se solicite esa ruta. */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        /* auth() es una función helper en Laravel que devuelve una instancia del objeto Auth, que representa al usuario autenticado actualmente.

        auth()->user() devuelve el modelo del usuario autenticado actualmente.

        followings es una relación definida en el modelo de usuario que devuelve una colección de los usuarios a los que el usuario autenticado sigue.

        pluck('id') obtiene los valores de la columna 'id' de cada modelo en la colección de usuarios seguidos.

        toArray() convierte la colección de valores de 'id' en un array. */

        //Obtener a quienes seguimos
        /* $followings = auth()->user()->followings->pluck('id')->toArray();
        dd($followings); */

        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);

        //dd($posts);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
