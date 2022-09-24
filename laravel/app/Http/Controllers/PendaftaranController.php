<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendaftaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createktm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'bulan_lahir' => 'required',
            'tahun_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'program_studi' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('ktm-img');
        }

        Pendaftaran::create($validatedData);
        return redirect('/pendaftaran')->with('success', 'Pendaftaran berhasil!');
    }

    public function daftarktm()
    {
        $ktm = Pendaftaran::latest()->filter(request(['search']))->paginate(8)->withQueryString();
        $data = [
            'ktm' => $ktm
        ];

        return view('ktm', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = [
            'mhs' => Pendaftaran::find($id),
        ];
        return view('single', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftaran  $pendaftaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
    }

    public function search(Request $request)
    {
        $ktm = Pendaftaran::latest()->filter(request(['search']))->paginate(200)->withQueryString();

        $output =
            '<tr>
            <td></td>
            </tr>';
        foreach ($ktm as $k => $kartu) {

            $output .=
                '<tr class="text-gray-700">
            <td class="px-4 py-3 border">
                <div class="flex items-center text-sm">
                    <div>
                        <p class="font-semibold text-black">' . $k + $ktm->firstItem() . '</p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 border">
                <div class="flex items-center text-sm">
                    <div>
                        <p class="font-semibold text-black">' . $kartu->name . '</p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-ms font-semibold border">' . $kartu->program_studi . '</td>
            <td class="px-4 py-3 text-xs border">
                <a href="lihat/' . $kartu->id . '"><span
                        class="px-2 py-1 font-semibold leading-tight text-green-600 bg-green-100 rounded-sm">
                        Lihat </span></a>
            </td>
        </tr>';
        }

        return response($output);
    }
}
