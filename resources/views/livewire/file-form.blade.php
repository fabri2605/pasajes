<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create un trip cabron') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mt-8 ml-3 pb-3">

                    <form class="mt-8 pb-3 pl-3" enctype="multipart/form-data" class="mt-8" method="post"
                        action="{{ route('viaje.store') }}">
                        {{ csrf_field() }}

                        <h1>Enter your exel file</h1>

                        <input required name="insertedExel" class="mt-8" type="file" />

                        @if (session('answer'))
                            <div class="mt-8 bg-green-400 border-emerald-600">
                                {{ session('answer') ?? 'File  uploaded!' }}
                            </div>
                        @else
                            <br>
                        @endif
                        <x-button type="submit" class="mt-8 block h-12 w-auto">Cargar</x-button>
                        <a href="/dashboard"><x-button type="button"
                                class="mt-8 block h-12 w-auto">Volver</x-button></a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
