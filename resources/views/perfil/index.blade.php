@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input
                        id="username"
                        type="text"
                        name="username"
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg
                        @error('username')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input
                        id="imagen"
                        type="file"
                        name="imagen"
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png"
                    />
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Correo
                    </label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Tu correo de registro"
                        class="border p-3 w-full rounded-lg 
                        @error('email')
                            border-red-500
                        @enderror"
                        value="{{ auth()->user()->email }}"
                    />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña actual
                    </label>
                    <input
                        id="oldpassword"
                        name="oldpassword"
                        type="password"
                        placeholder="Ingresa tu contraseña actual"
                        class="border p-3 w-full rounded-lg
                        @error('oldpassword')
                            border-red-500
                        @enderror"
                    />

                    @error('oldpassword')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña nueva
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Ingresa tu nueva contraseña"
                        class="border p-3 w-full rounded-lg
                        @error('password')
                            border-red-500 
                        @enderror"
                    />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Confirma tu contraseña nueva
                    </label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        placeholder="Repetir contraseña nueva"
                        class="border p-3 w-full rounded-lg"
                    />
                </div>

                <input
                    type="submit"
                    value="Guardar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>
@endsection