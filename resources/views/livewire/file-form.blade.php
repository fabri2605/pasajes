<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <form id="exelForm" class="mt-8 mx-3 pb-3 px-3" enctype="multipart/form-data" class="mt-8" method="post"
                    action="{{ route('viaje.store') }}">
                    {{ csrf_field() }}

                    <h1>Ingresa el archivo exel correspondiente</h1>

                    {{-- <input required name="insertedExel" class="mt-8" type="file" /> --}}

                    <div class="flex items-center justify-center w-full py-3">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 py-3">Solo seran admitidos archivos
                                    formato exel</p>
                            </div>
                            <input name="insertedExel" id="dropzone-file" type="file" class="hidden" />
                        </label>
                    </div>


                    <p id="uploadedFileName" class="text-center text-gray-500 dark:text-gray-400"></p>

                    <div id="cargando" style="color: rgba(93, 0, 255, 0.579); display: none; transition: 1s"
                        class="text-center ease-in-out duration-300 mt-8 text-info-500">Cargando los registros por favor
                        espere (tiempo estimado 1 min)</div>

                    @error('insertedExel')
                        <div class="ease-in-out duration-300 mt-8 text-red-500">{{ $message }}</div>
                    @enderror

                    @if (session('answer'))
                        <div class="ease-in-out duration-300 mt-8 text-green-600">{{ session('answer') }}</div>
                    @elseif (session('error'))
                        <div>
                            <h2>{{ session('error') }}</h2>

                        </div>
                    @else
                        <br>
                    @endif

                    <div class="mt-5">
                        <x-button disabled="false" id="cargarButton" type="submit"
                            class="block h-12 w-auto">Cargar</x-button>

                        <a href="/dashboard">
                            <x-button type="button" class="block h-12 w-auto">
                                Volver</x-button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
