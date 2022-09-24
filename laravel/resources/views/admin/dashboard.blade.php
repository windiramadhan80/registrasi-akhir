<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- component -->
    @if (Session::has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="container flex justify-center">
        <div class="search mt-5 xl:w-[30%]">
            <input type="search"
                class="form-control min-w-0 inline w-[80%] px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                placeholder="Search" aria-label="Search" aria-describedby="button-addon2" name="search" id="search"
                value="{{ request('search') }}">
        </div>
    </div>
    <section class="container mx-auto p-6 font-mono">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr
                            class="text-md font-semibold tracking-wide text-left text-white bg-blue-600 uppercase border-b border-blue-900">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Lengkap</th>
                            <th class="px-4 py-3">Program Studi</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white alldata">
                        @foreach ($ktm as $k => $kartu)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold text-black">{{ $k + $ktm->firstItem() }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 border">
                                    <div class="flex items-center text-sm">
                                        <div>
                                            <p class="font-semibold text-black">{{ $kartu->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border">{{ $kartu->program_studi }}</td>
                                <td class="px-4 py-3 text-xs border">
                                    <a href="lihat/{{ $kartu->id }}"><span
                                            class="px-2 py-1 font-semibold leading-tight text-green-600 bg-green-100 rounded-sm">
                                            Lihat </span></a>
                                    <a href="edit/{{ $kartu->id }}"><span
                                            class="px-2 py-1 font-semibold leading-tight text-yellow-600 bg-yellow-100 rounded-sm ml-3">
                                            Edit </span></a>
                                    <form action="hapus/{{ $kartu->id }}" class="inline" method="post">
                                        @method('delete')
                                        @csrf
                                        <button
                                            class="px-2 py-1 font-semibold leading-tight text-red-600 bg-red-100 rounded-sm ml-3"
                                            onclick="return confirm('Yakin Hapus Data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tbody class="bg-white searchdata" id="Content">

                    </tbody>
                </table>
                <div class="alldata">
                    {{ $ktm->links() }}
                </div>
            </div>
        </div>
    </section>



    <script type="text/javascript">
        $('#search').on('keyup', function() {
            $value = $(this).val();

            if ($value) {
                $('.alldata').hide();
                $('.searchdata').show();
            } else {
                $('.alldata').show();
                $('.searchdata').hide();
            }

            $.ajax({
                type: 'get',
                url: '{{ URL::to('search') }}',
                data: {
                    'search': $value
                },

                success: function(data) {
                    console.log(data);
                    $('#Content').html(data);
                }
            });
        })
    </script>

</x-app-layout>
