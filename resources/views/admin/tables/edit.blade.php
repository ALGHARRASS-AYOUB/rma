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
                <a href="{{ route('admin.tables.index') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-800 rounded-lg">⤶  Tables table</a>
            </div>
        </div>
    </div>



    <div class="container bg-gray-100 m-3 p-8 rounded-lg">
        <form enctype="multipart/form-data" action="{{ route('admin.tables.update',$table->id) }}" method="POST">
            @csrf
            @method('PUT')
            {{-- <div class="grid md:grid-cols-2 md:gap-6"> --}}
                <div class="relative z-0 mb-6 w-full group">
                    <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="{{ $table->name }}" value="{{ $table->name }}" required="">
                    <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
            {{-- </div> --}}
                </div>

                    {{-- <div class="grid md:grid-cols-2 md:gap-6"> --}}
                        <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="guests_number" id="guests_number" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $table->guests_number }}" placeholder="{{ $table->guests_number }}" required="">
                            <label for="guests_number" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Number Of guests</label>
                        {{-- </div> --}}
                        </div>


                        {{-- <div class="relative z-0 mb-6 w-full group">
                            <input type="text" name="location" id="location" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
                            <label for="location" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Location</label>

                        </div> --}}


                        <div class="flex  flex-wrap ">
                            {{-- status division --}}
                            <div class="relative z-0 mb-6 w-full group border-2 border-blue-600 rounded-lg p-2">
                                {{-- <input type="text" name="status" id="status" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "> --}}
                                {{-- <label for="status" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label> --}}
                            {{-- </div> --}}

                            <fieldset>
                                <legend class="p-1  mb-2 outline-blue-500">STAUTS</legend>
                                <div class="flex items-center mb-4">
                                  <input id="status-1" type="radio" name="status" value="pending" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @checked($table->status==='pending')>
                                  <label for="status-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{-- @foreach (App\Enums\TableLocation::cases() as $location )
                                        {{ $location }}
                                    @endforeach --}}
                                    Pending
                                  </label>
                                </div>

                                <div class="flex items-center mb-4">
                                    <input id="status-1" type="radio" name="status" value="avaliable" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @checked($table->status==='avaliable')>
                                    <label for="status-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                      {{-- @foreach (App\Enums\TableLocation::cases() as $location )
                                          {{ $location }}
                                      @endforeach --}}
                                      Avaliable
                                    </label>
                                  </div>

                                  <div class="flex items-center mb-4">
                                    <input id="status-1" type="radio" name="status" value="unavaliable" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @checked($table->status==='unavaliable')>
                                    <label for="status-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                      {{-- @foreach (App\Enums\TableLocation::cases() as $location )
                                          {{ $location }}
                                      @endforeach --}}
                                      Unavaliable
                                    </label>
                                  </div>

                              </fieldset>

                            </div>
                            {{-- end status --}}

                            {{-- location div --}}
                            <div class="relative z-0 mb-6 w-full group border-2 border-blue-600 rounded-lg p-2">
                                {{-- <input type="text" name="location" id="location" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "> --}}
                                {{-- <label for="location" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Status</label> --}}
                            {{-- </div> --}}

                            <fieldset>
                                <legend class="p-1  mb-2 outline-blue-500">LOCATION</legend>
                                <div class="flex items-center mb-4">
                                  <input id="location-1" type="radio" name="location" value="outside" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @checked($table->location==='outside')>
                                  <label for="location-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    {{-- @foreach (App\Enums\TableLocation::cases() as $location )
                                        {{ $location }}
                                    @endforeach --}}
                                    outside
                                  </label>
                                </div>

                                <div class="flex items-center mb-4">
                                    <input id="location-1" type="radio" name="location" value="inside" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @checked($table->location==='inside')>
                                    <label for="location-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                      {{-- @foreach (App\Enums\TableLocation::cases() as $location )
                                          {{ $location }}
                                      @endforeach --}}
                                      inside
                                    </label>
                                  </div>

                                  <div class="flex items-center mb-4">
                                    <input id="location-1" type="radio" name="location" value="inside vip" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" @checked($table->location==='inside vip')>
                                    <label for="location-1" class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                      {{-- @foreach (App\Enums\TableLocation::cases() as $location )
                                          {{ $location }}
                                      @endforeach --}}
                                      inside vip
                                    </label>
                                  </div>

                              </fieldset>

                            </div>
                            {{-- end location div --}}
                        </div>







            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>
    </div>

</x-admin-layout>

