<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4 flex items-center justify-between">
                        <div class="text-lg font-bold">
                            Postlar
                        </div>

                        <a href="{{ route('posts.create') }}"
                            class="bg-green-600 px-4 py-2 rounded hover:bg-green-500">
                            + Yeni Post
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2 text-left">ID</th>
                                    <th class="border px-4 py-2 text-left">Title</th>
                                    <th class="border px-4 py-2 text-left">User ID</th>
                                    <th class="border px-4 py-2 text-left">Alətlər</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($postlar as $post)
                                    <tr class="hover:bg-gray-50">

                                        <td class="border px-4 py-2">{{ $post->id }}</td>
                                        <td class="border px-4 py-2">{{ $post->title }}</td>
                                        <td class="border px-4 py-2">{{ $post->user_id }}</td>

                                        <td class="border px-4 py-2 flex gap-2">

                                            <a href="{{ route('posts.edit', $post->id) }}"
                                                class="bg-blue-500  px-3 py-1 rounded hover:bg-blue-400">
                                                Edit
                                            </a>

                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="text-red px-3 py-1 rounded hover:bg-red-400">
                                                    Sil
                                                </button>

                                            </form>

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-gray-500">
                                            Post tapılmadı
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
