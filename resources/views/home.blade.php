<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    @include('navbar')
    @auth
        <p class="m-4">Congrats {{ auth()->user()->name }} you are logged in.</p>
        <form action="/logout" method="POST" class="m-4">
            @csrf
            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Logout
                </button>
            </div>
        </form>

        <div class="w-full max-w-lg px-8 pt-6 pb-8 mb-4">
            <h2 class="mt-2">Create a New Post</h2>
            {{-- <form action="/create-post" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Title
                    </label>
                </div>

                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    name="title" type="text" placeholder="Title">
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
                <textarea
                class="block text-gray-700 text-sm font-bold m-2 p-2"
                name="body" id="body"
                placeholder="Post something! :)"></textarea>
                <div class="p-2">
                    @error('body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Create Post
                    </button>
                </div>

            </form> --}}

            @include('modal')
        </div>

        <div class="w-full max-w-lg p-8 m-4">
            <h2>Posts</h2>
            @foreach ($posts as $post)
                <div class="border rounded-xl p-8 m-4 border-amber-600">
                    <h3 class="pb-2 font-bold text-xl first-letter:text-5xl text-fuchsia-600">{{ $post->title }}</h3>

                    <div class="bg-fuchsia-300 p-4 rounded-xl text-lg first-letter:text-5xl first-letter:text-blue-600 text-blue-600">
                        {{ $post->body }}
                    </div>
                    <p class="mt-2">Author: {{ $post->user->name }}</p>

                    @if (auth()->user()->id === $post->user->id)
                        <p class="mt-4">
                            <a href="/edit-post/{{ $post->id }}"
                                class="border border-black bg-blue-600 p-2 rounded-2xl">Edit post</a>
                        <form class="mt-2" action="/delete-post/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button
                                class="border border-black bg-red-600 p-2 rounded-2xl"
                                type="submit">
                                Delete post
                            </button>
                        </form>
                        </p>
                    @else
                        <!-- Blade template to add a new comment -->

                        <form method="post" action="{{ route('createCommemt', $post->id) }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea name="body" rows="3" required class="p-4 border border-black rounded-2xl"></textarea>
                            <button type="submit" class="border border-black bg-lime-400 p-2 rounded-2xl">Add Comment</button>
                        </form>
                    @endif
                    <!-- Blade template to display comments for a post -->
                    <div class=" ">
                        <h2 class="pt-4 pb-4 text-xl font-bold">Comments</h2>
                        @foreach ($post->comments as $comment)
                            <p class="pl-4"><span class="text-green-500 font-semibold">{{ $comment->user->name }}:</span> {{ $comment->body }}</p>
                            @if (auth()->user()->id === $comment->user->id)

                                <form class="pl-4" action="{{ route('deleteComment', $comment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border border-black bg-red-400 p-2 rounded-2xl">Delete comment</button>
                                </form>

                            @endif
                        @endforeach
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="w-full max-w-xs">

            <form action="/register" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf

                <h2 class="mt-2">Register</h2>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        name="name" type="text" placeholder="Name">
                    <div class="p-2">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input name="email"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="text" placeholder="Email">
                    <div class="p-2">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input name="password"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="Password">
                    <div class="p-2">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>

        <div class="w-full max-w-xs">

            <form action="/login" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf

                <h2 class="m-4 text-lg">Login</h2>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="loginemail">
                        Email
                    </label>
                    <input name="loginemail"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="loginemail" type="text" placeholder="Email">
                    <div class="p-2">
                        @error('loginemail')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="loginpassword">
                        Password
                    </label>
                    <input name="loginpassword"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="loginpassword" type="password" placeholder="Password">
                    <div class="p-2">
                        @error('loginpassword')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                        Login
                    </button>
                </div>
            </form>
        </div>
    @endauth

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>
