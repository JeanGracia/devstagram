<div>
    {{-- $slot --}}<!-- Do what you can, with what you have, where you are. - Theodore Roosevelt -->

    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}">
                        <img
                            src="{{ asset('uploads') . '/' . $post->imagen }}"
                            alt="Imagen del post {{ $post->titulo }}"
                        >
                    </a>
                </div>
            @endforeach
        </div>
        <div class="my-10">
            {{ $posts->links('pagination::tailwind') }} {{-- Just-in-TimeModetailwind.config.jslinea6 --}}
        </div>
    @else
        <p class="text-center"> No hay posts, sigue a alguien para mostrarte sus posts</p>
    @endif
</div>