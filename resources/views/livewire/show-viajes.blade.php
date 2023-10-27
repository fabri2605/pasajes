<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Viajes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div style="margin: 0 20px;" class="mx-auto {{-- max-w-7xl  sm:px-6 lg:px-8 --}}">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mt-8 pb-3">

                    @if (count($viajes))
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Evento
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cuil
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tarjeta
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Cantidad
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tarifa
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Importe
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Tramo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Fecha
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Hora
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Latitud
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Longitud
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viajes as $viaje)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $viaje->EVENTO }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $viaje->CUIL }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->TARJETA }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->CANTIDAD }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ $viaje->TARIFA }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ $viaje->IMPORTE }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->TRAMO }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->FECHA }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->HORA }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->LATITUD }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $viaje->LONGITUD }}
                                        </td>
                                        <td>
                                            <form class="mt-3" method="post"
                                                action="{{ route('viaje.index' /* , $fileName */) }}">
                                                @csrf
                                                <x-button type="submit">ACTION</x-button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="ml-3 mr-3 mt-3 d-flex justify-content-center">
                            {!! $viajes->links() !!}
                        </div>
                    @else
                        <h1 class="text-center text-2xl font-medium text-gray-900">No hay viajes disponibles!</h1>

                    @endif
                    <a href="/dashboard"><x-button type="button"
                            class="ml-3 mt-8 block h-12 w-auto">Volver</x-button></a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
