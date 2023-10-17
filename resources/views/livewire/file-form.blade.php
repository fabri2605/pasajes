<form enctype="multipart/form-data" class="mt-8" method="post" action="{{ route('list.store') }}">
    {{ csrf_field() }}

    <h1>Enter your exel file</h1>

    <input name="insertedExel" class="mt-8" type="file" />

    @if (session('answer'))
        <div class="mt-8 bg-green-400 border-emerald-600">
            {{ session('answer') ?? 'File  uploaded!' }}
        </div>
    @endif
    <x-button class="mt-8 block h-12 w-auto">Submit</x-button>
</form>
