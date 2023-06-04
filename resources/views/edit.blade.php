<x-app-layout>
    <div class="bg-gray-50 min-h-screen flex flex-col">
        <div class="container max-w-xl mx-auto flex-1 flex flex-col items-center justify-center px-2 my-4">
            <div class="bg-white px-6 py-8 rounded shadow-md text-black w-full">
                <h1 class="mb-8 text-xl text-center uppercase">Pendaftaran <br>Kartu Tanda Mahasiswa</h1>
                <form action="/edit/{{ $mhs->id }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="text" class="block border border-grey-light w-full p-3 rounded" name="name"
                        @error('name') is-invalid @enderror id="name" placeholder="Nama Lengkap"
                        value="{{ $mhs->name }}">
                    @error('name')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    <h6 class="mt-4">Jenis Kelamin</h6>
                    <div class="inline">
                        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio"
                            name="jenis_kelamin" id="jenis_kelamin1" value="Laki-Laki"
                            {{ $mhs->jenis_kelamin == 'Laki-Laki' ? 'checked' : '' }}>
                        <label class="form-check-label" for="jenis_kelamin1">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="inline ml-5">
                        <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio"
                            name="jenis_kelamin" id="jenis_kelamin2" value="Perempuan"
                            {{ $mhs->jenis_kelamin == 'Perempuan' ? 'checked' : '' }}>
                        <label class="form-check-label" for="jenis_kelamin2">
                            Perempuan
                        </label>
                    </div>

                    @error('jenis_kelamin')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    <input type="text" class="block border border-grey-light w-full p-3 rounded mt-4"
                        name="tempat_lahir" @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                        placeholder="Tempat Lahir" value="{{ $mhs->tempat_lahir }}">
                    @error('tempat_lahir')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    <select
                        class="border border-grey-light w-1/4 p-3 rounded mt-4 @error('tanggal_lahir') is-invalid @enderror"
                        name="tanggal_lahir" id="tanggal_lahir">
                        <option value="">Tanggal</option>
                        @for ($h = 1; $h <= 31; $h++)
                            <option value="{{ $h }}" {{ $mhs->tanggal_lahir == $h ? 'selected' : '' }}>
                                {{ $h }}
                            </option>
                        @endfor
                    </select>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    <select
                        class="border border-grey-light w-1/4 p-3 rounded mt-4 @error('bulan_lahir') is-invalid @enderror"
                        name="bulan_lahir" id="bulan_lahir">
                        <option value="" selected>Bulan</option>
                        @for ($b = 0; $b < 12; $b++)
                            @php
                                $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            @endphp
                            <option value="{{ $nama_bulan[$b] }}"
                                {{ $mhs->bulan_lahir == $nama_bulan[$b] ? 'selected' : '' }}>
                                {{ $nama_bulan[$b] }}</option>
                        @endfor
                    </select>
                    @error('bulan_lahir')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    <select
                        class="border border-grey-light w-1/4 p-3 rounded mt-4 @error('tahun_lahir') is-invalid @enderror"
                        name="tahun_lahir" id="tahun_lahir">
                        <option value="">Tahun</option>
                        @for ($t = 2022; $t >= 1990; $t--)
                            <option value="{{ $t }}" {{ $mhs->tahun_lahir == $t ? 'selected' : '' }}>
                                {{ $t }}
                            </option>
                        @endfor
                    </select>
                    @error('tahun_lahir')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    {{-- <select
                        class="block border border-grey-light w-full p-3 rounded mt-4 @error('program_studi') is-invalid @enderror"
                        name="program_studi" id="program_studi">
                        <option value="">Pilih Program Studi</option>
                        @for ($p = 0; $p < 5; $p++)
                            @php
                                $prodi = ['Teknologi Rekayasa Perangkat Lunak', 'Teknologi Produksi Tanaman Perkebunan', 'Teknologi Pengolahan Hasil Kelapa Sawit', 'Budidaya Perkebunan Kelapa Sawit', 'Manajemen Logistik'];
                            @endphp
                            <option value="{{ $prodi[$p] }}"
                                {{ $prodi[$p] == old('program_studi') ? 'selected' : '' }}>
                                {{ $prodi[$p] }}</option>
                        @endfor

                    </select> --}}
                    <select
                        class="block border border-grey-light w-full p-3 rounded mt-4 @error('program_studi') is-invalid @enderror"
                        name="program_studi" id="program_studi">
                        <option value="" selected>Pilih Program Studi</option>
                        <option value="Teknologi Rekayasa Perangkat Lunak"
                            {{ $mhs->program_studi == 'Teknologi Rekayasa Perangkat Lunak' ? 'selected' : '' }}>
                            Teknologi Rekayasa Perangkat Lunak
                        </option>
                        <option value="Teknologi Produksi Tanaman Perkebunan"
                            {{ $mhs->program_studi == 'Teknologi Produksi Tanaman Perkebunan' ? 'selected' : '' }}>
                            Teknologi Produksi Tanaman Perkebunan
                        </option>
                        <option value="Teknologi Pengolahan Hasil Kelapa Sawit"
                            {{ $mhs->program_studi == 'Teknologi Pengolahan Hasil Kelapa Sawit' ? 'selected' : '' }}>
                            Teknologi Pengolahan Hasil Kelapa Sawit
                        </option>
                        <option value="Budidaya Perkebunan Kelapa Sawit"
                            {{ $mhs->program_studi == 'Budidaya Perkebunan Kelapa Sawit' ? 'selected' : '' }}>Budidaya
                            Perkebunan Kelapa Sawit</option>
                        <option value="Manajemen Logistik"
                            {{ $mhs->program_studi == 'Manajemen Logistik' ? 'selected' : '' }}>Manajemen Logistik
                        </option>

                    </select>
                    @error('program_studi')
                        <div class="invalid-feedback text-red-600">{{ $message }}</div>
                    @enderror

                    <h6 class="mt-4">Photos</h6>
                    <img src="{{ asset('storage/' . $mhs->image) }}" class="img-preview img-thumbnail my-2"
                        width="80px">
                    <div class="mb-1">
                        <input type="hidden" name="oldImage" value="{{ $mhs->image }}">
                        <input type="file" @error('image') is-invalid @enderror name="image" id="image"
                            onchange=previewImage()>
                        @error('image')
                            <div class="invalid-feedback text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <input class="block border border-grey-light w-full p-3 rounded mt-4" type="number" name="nim"
                        class="form-control @error('nim') is-invalid @enderror" id="nim"
                        placeholder="Nomor Induk Mahasiswa" value="{{ $mhs->nim }}">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <button
                        class="w-full text-center py-3 mt-4 rounded bg-green-500 text-white hover:bg-green-600 focus:outline-none my-1 uppercase"
                        type="submit">Update</button>

                    <p class="text-center mt-4">&copy; Politeknik Citra Widya Edukasi {{ date('Y') }}</p>

                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
</x-app-layout>
