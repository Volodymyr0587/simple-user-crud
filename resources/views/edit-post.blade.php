<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="w-full max-w-lg px-8 pt-6 pb-8 mb-4">
        <h2 class="mt-2">Edit Post</h2>
        <form action="/edit-post/{{ $post->id }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Title
                </label>
            </div>

            <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                name="title" type="text" value="{{ $post->title }}" placeholder="Title">
            <div class="p-2">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Body
                </label>
            </div>
            <textarea class="block text-gray-700 text-sm font-bold m-2 p-2" name="body" id="body"
                placeholder="Post something! :)">{{ $post->body }}
            </textarea>
            <div class="p-2">
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Save Post Changes
                </button>
            </div>

        </form>
    </div>
</body>
</html>
