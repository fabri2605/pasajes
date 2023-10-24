<div class="mt-8 ml-3 pb-3">
    <label>Select the file</label>
    @foreach (glob(storage_path('app/public/exels/*')) as $filePath)
        @php
            $fileName = basename($filePath);
        @endphp
        <form class="mt-3" method="post" action="{{ route('list.show', $fileName) }}">
            @csrf
            <x-button type="submit">{{ $fileName }}</x-button>
        </form>
    @endforeach
    <a href="/dashboard"><x-button type="button" class="mt-8 block h-12 w-auto">Volver</x-button></a>
</div>
