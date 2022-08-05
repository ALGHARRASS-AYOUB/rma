<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Tables
                </div>
            </div>
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.tables.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-800 rounded-lg">new Table</a>
            </div>
        </div>
    </div>

    @php
    function getColor($status){
        if($status==='avaliable')
            return 'green-600';

            if($status==='unavaliable')
            return 'red-600';

            if($status==='pending')
            return 'yellow-400';
    }
@endphp

      {{-- table information  --}}
      <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        Name
                    </th>
                    <th scope="col" class="py-3 px-6">
                        location
                    </th>

                    <th scope="col" class="py-3 px-6">
                        number of guests
                    </th>

                    <th scope="col" class="py-3 px-6">
                        status
                    </th>
                    <th scope="col" class="py-3 px-6">
                        options
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tables as $table)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">


                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $table->name }}
                    </td>

                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $table->location }}
                    </td>

                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $table->guests_number  }}
                    </td>

                    <td scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex items-center">

                           @php
                              echo '<div class="h-2.5 w-2.5 rounded-full bg-'.getColor($table->status).' mr-2"></div>';
                           @endphp
                           {{ $table->status  }}
                        </div>

                    </td>

                     {{-- options --}}
                     <td scope="row" class="py-2 px-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.tables.edit',$table->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-900 rounded-lg text-white"  data-modal-toggle="update-modal" >Edit</a>
                            <form action="{{ route('admin.tables.destroy',$table->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete ?')" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-900 text-white">
                            @csrf
                            @method('DELETE')
                            <button type="submit" >Delete</button>
                            </form>
                        </div>
                    </td>
                    {{-- endoption --}}

                </tr>
                @endforeach
                </tbody>
        </table>
    </div>

</x-admin-layout>

