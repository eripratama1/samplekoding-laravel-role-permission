@extends('layouts.app')

@section('content')
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manage role') }}
            </h2>
        </div>
    </header>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('info'))
                <div class="p-4 mb-4 text-sm text-white  rounded-lg bg-blue-500 dark:bg-gray-800 dark:text-blue-400 ">
                    <span class="font-medium">{{ session('info') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <div class="my-3 mr-1 flex items-end justify-end">
                            <a href="{{ route('manage-role.create') }}"
                                class="
                            px-3
                            py-2
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
                            dark:focus:ring-blue-800
                            ">Create
                                new role
                            </a>
                        </div>

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Role name</th>
                                    <th scope="col" class="px-6 py-3">Permission name</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $item)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            @if (!empty($item->getPermissionNames()))
                                                @foreach ($item->getPermissionNames() as $itemPermission)
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                        {{ $itemPermission }}
                                                    </span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="px6 py-4">
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ route('manage-role.edit', $item->id) }}"
                                                    class=" px-3
                                                py-2
                                                text-sm
                                                font-medium
                                                text-center
                                                text-white
                                                bg-yellow-700
                                                rounded-lg
                                                hover:bg-yellow-800
                                                focus:ring-4
                                                focus:outline-none
                                                focus:ring-yellow-300
                                                dark:bg-yellow-600
                                                dark:hover:bg-yellow-700
                                                dark:focus:ring-yellow-800">
                                                    Update
                                                </a>

                                                <form action="{{ route('manage-role.destroy', $item->id) }}"
                                                    onsubmit="return confirm('Delete data... ?')" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-3
                                                    py-2
                                                    text-sm
                                                    font-medium
                                                    text-center
                                                    text-white
                                                    bg-red-700
                                                    rounded-lg
                                                    hover:bg-red-800
                                                    focus:ring-4
                                                    focus:outline-none
                                                    focus:ring-red-300
                                                    dark:bg-red-600
                                                    dark:hover:bg-red-700
                                                    dark:focus:ring-red-800">Delete</button>
                                                </form>

                                                <a href="{{ route('manage-role.show', $item->id) }}"
                                                    class=" px-3
                                                py-2
                                                text-sm
                                                font-medium
                                                text-center
                                                text-white
                                                bg-emerald-700
                                                rounded-lg
                                                hover:bg-emerald-800
                                                focus:ring-4
                                                focus:outline-none
                                                focus:ring-emerald-300
                                                dark:bg-emerald-600
                                                dark:hover:bg-emerald-700
                                                dark:focus:ring-emerald-800">
                                                    Assign permission
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
