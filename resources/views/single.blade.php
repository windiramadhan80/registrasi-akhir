<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kartu Tanda Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/97d7d4947a.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="d-inline">
                    <a @if (Auth::user()->role == '1') href="/redirects"
                    @else
                    href="/ktm" @endif
                        class="btn btn-warning mb-2">Kembali</a>
                </div>

                @if (Auth::user()->role == '1')
                    <form action="/hapus/{{ $mhs->id }}" class="d-inline" method="post">
                        @method('delete')
                        @csrf
                        <button class="btn btn-outline-danger mb-2"
                            onclick="return confirm('Yakin Hapus Data?')">Hapus</button>
                    </form>
                @endif


                <div class="d-inline">
                    <button id="download" class="btn btn-outline-primary mb-2">Download PNG</button>
                </div>
                <div class="card text-bg-light shadow-sm" style="max-width: 690px" id="ktm">
                    <img src="/img/background-ktm.jpg" class="card-img" alt="...">
                    <div class="card-img-overlay">
                        <div class="row mt-4">
                            <div class="col-3 text-end mb-4">
                                <img src="/img/logocwe.png" alt="" width="130px">
                            </div>
                            <div class="col">
                                <h5 class="card-title text-uppercase fw-bold fs-3">politeknik kelapa sawit <br> citra
                                    widya
                                    edukasi</h5>
                                <p class="card-text">Jl. Gapura No. 8 Cibuntu Cibitung Bekasi Jawa Barat</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-9">
                                <table class="table table-sm table-borderless fw-bold ms-3">
                                    <tbody>
                                        <tr>
                                            <td class="pe-0">Nama Lengkap</td>
                                            <td>:</td>
                                            <td>{{ $mhs->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-0">Tempat & Tgl. Lahir</td>
                                            <td>:</td>
                                            <td>{{ $mhs->tempat_lahir }},
                                                {{ $mhs->tanggal_lahir }} {{ $mhs->bulan_lahir }}
                                                {{ $mhs->tahun_lahir }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-0">Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>{{ $mhs->jenis_kelamin }}</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-0">Program Studi</td>
                                            <td>:</td>
                                            <td>{{ $mhs->program_studi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col">
                                <img src="{{ asset('storage/' . $mhs->image) }}" class="rounded d-block mx-auto "
                                    width="100px" alt="...">
                                <p class="text-center mt-1 fw-bold">NIM. {{ $mhs->nim }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js"></script>


    {{-- html2canvas fitur download file image --}}
    <script type="text/javascript">
        const download = document.querySelector('#download');
        download.addEventListener("click", function() {
            screenshot();
        })

        function screenshot() {
            html2canvas(document.getElementById("ktm")).then(function(canvas) {
                downloadImage(canvas.toDataURL(), "KartuTandaMahasiswa.png");
            });
        }

        function downloadImage(uri, filename) {
            const link = document.createElement('a');
            if (typeof link.download !== 'string') {
                window.open(uri);
            } else {
                link.href = uri;
                link.download = filename;
                accountForFirefox(clickLink, link);
            }
        }

        function clickLink(link) {
            link.click();
        }

        function accountForFirefox(click) {
            const link = arguments[1];
            document.body.appendChild(link);
            click(link);
            document.body.removeChild(link);
        }
    </script>
</body>

</html>
