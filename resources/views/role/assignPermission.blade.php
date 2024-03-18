@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Assign permission to role') }}
            </h2>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('assingPermission', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role
                                name</label>
                            <input type="text" name="name" value="{{ $role->name }}"
                                class="
                            bg-gray50
                            border
                            text-gray-900
                            sm:text-sm
                            rounded-lg
                            focus:ring-blue-600
                            focus:border-blue-600
                            block
                            w-full
                            p-2.5
                            dark:bg-gray-700
                            dark:placeholderbg-gray-400
                            dark:text-white
                            dark:focus:ring-blue-500
                            dark:focus:border-blue-500
                            @error('name')
                                border-red-500 dark:border-red-400
                            @enderror
                            ">
                            @error('name')
                                <span class="text-sm text-red-600 dark:text-red-400 space-y-1">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="my-3">
                            <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Select permission
                            </label>
                            @foreach ($permissions as $item)
                                <input type="checkbox" {{ in_array($item->id, $rolePermissions) ? 'checked' :'' }} value="{{ $item->name }}"
                                    name="permission[]"
                                    class="
                            w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500
                            dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600
                            ">
                                <label for="" class="mx-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{ $item->name }}
                                </label>
                            @endforeach
                        </div>

                        <div>
                            <button type="submit"
                                class="px-3
                            py-2
                            my-3
                            text-sm
                            font-medium
                            text-center
                            text-white
                            bg-blue-700
                            rounded-lg
                            hover:bg-blue-800
                            focus:ring-4
                            focus:outline-none
                            focus:ring-blue-300
                            dark:bg-blue-600
                            dark:hover:bg-blue-700
                            dark:focus:ring-blue-800">
                                Assign permission
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
