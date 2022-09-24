<x-app-layout>
    <div class="bg-gray-50 min-h-screen flex flex-col">
        <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2">
            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                @if (Session::has('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <h1 class="mb-8 text-xl text-center uppercase">Pendaftaran <br>Kartu Tanda Mahasiswa</h1>
                <a href="/createktm"
                    class="w-full text-center py-3 mt-2 rounded bg-green-500 text-white hover:bg-green-600 focus:outline-none my-1 uppercase"
                    type="submit">Create KTM</a>
            </div>
        </div>
    </div>

</x-app-layout>
