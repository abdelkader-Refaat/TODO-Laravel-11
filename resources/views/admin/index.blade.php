<x-layout>

    <x-header> All users posts </x-header>
    <section>


        <div class= "flex justify-end">
            @auth
                <a href="/posts/create"
                    class="text-white bg-blue-700 hover:bg-blue-800
                        focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                        me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
                        dark:focus:ring-blue-800">Create</a>
            @endauth
        </div>


    </section>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">

                    </th>
                </tr>
            </thead>
            <tbody>

                @forelse ($posts as $post)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $post->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $post->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $post->created_at }}
                        </td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('admin.posts.edit', $post->id) }}"
                                class="text-white bg-blue-700 hover:bg-blue-800
                            focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5
                            me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none
                            dark:focus:ring-blue-800">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" href="{{ route('admin.posts.destroy', $post->id) }}"type="button"
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800
                                focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2
                                dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a>
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            No posts found
                        </th>
                    </tr>
                @endforelse ($posts as $post )
            </tbody>
        </table>


    </div>
</x-layout>
