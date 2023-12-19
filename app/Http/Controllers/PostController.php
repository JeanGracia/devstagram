<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\File as FacadesFile;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        //dd(auth()->user());
        //dd($user);

        $posts = Post::where('user_id', $user->id)->latest()->paginate(12);//consulta que se puede paginar
        //dd($posts);

        return view('dashboard', [
            'user'  => $user,
            'posts' => $posts,
        ]);
    }

    /**El método "create" se utiliza para mostrar el formulario de creación de un recurso. Generalmente se utiliza para renderizar una vista que contiene el formulario HTML donde el usuario puede ingresar los datos necesarios para crear un nuevo recurso. */
    public function create()
    {
        //dd('Creando Posts...');
        return view('posts.create'); 
    }

    /**El método "store" se utiliza para manejar la solicitud de creación de un recurso. Recibe los datos enviados por el usuario a través del formulario y los utiliza para crear y guardar un nuevo registro en la base de datos. */
    public function store(Request $request)
    {
        //dd('Creación de una publicación');

        $this->validate($request, [
            'titulo'      => 'required|max:255',
            'descripcion' => 'required',
            'imagen'      => 'required'
        ]);

        /* Post::create([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen'      => $request->imagen,
            'user_id'     => auth()->user()->id
        ]); */

        $request->user()->posts()->create([
            'titulo'      => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen'      => $request->imagen,
            'user_id'     => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        //dd('Creando Posts...');
        return view('posts.show', [
            'user'  => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        //dd('Eliminando', $post->id);

        $this->authorize('delete', $post);
        $post->delete();

        //eliminar la imagen de storage
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
