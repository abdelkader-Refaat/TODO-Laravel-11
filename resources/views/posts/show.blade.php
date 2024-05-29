<x-layout>
    @session('message')
    <div class="p-4 mb-4 mt-6 text-sm text-green-800 rounder-lg bg-green-50 dark:bg-gray-800 dark:text-green-400">
       <span class="font-medium">{{session('message')}} </span>
    </div>
@endsession
    <section class="mt-4">

        <div class= "flex justify-end">
            <div class= "flex justify-between">
                @can('update', $post)
                    <a href="{{ route('posts.edit', $post->id) }}"
                        class="text-white bg-blue-700 hover:bg-blue-800
                    focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                    me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
                    dark:focus:ring-blue-800">Edit</a>
                @endcan
                @can('delete', $post)
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" href="{{ route('posts.destroy', $post->id) }}"type="button"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800
                        focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2
                        dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
                        </button>
                    </form>
                @endcan

            </div>
        </div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 bg-slate-50 dark:bg-slate-200 rounded-lg">
            <h1 class="text-3xl text-indigo-600 mt-4 text-center font-bold dark:text-indigo-400"> {{ $post->title }}</h1>
            <main class="mt-2">
                <p class="text-lg text-center text-gray-700 text-bold dark:text-gray-400 p-4">{{ $post->content }}</p>
                <p class="text-lg text-center text-gray-700 text-bold dark:text-gray-400 p-4"> created at {{ $post->created_at }}</p>
            </main>
        </div>
    </section>

</x-layout>
