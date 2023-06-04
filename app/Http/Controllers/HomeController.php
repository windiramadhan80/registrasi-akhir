<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $ktm = Pendaftaran::latest()->filter(request(['search']))->paginate(8)->withQueryString();
        $data = [
            'ktm' => $ktm
        ];
        $route = Auth::user()->role;
        if ($route == '1') {
            return view('admin.dashboard', $data);
        } else {
            return view('ktm', $data);
        }
    }

    public function edit($id)
    {
        $data = [
            'mhs' => Pendaftaran::find($id),
        ];
        return view('edit', $data);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:255',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'bulan_lahir' => 'required',
            'tahun_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'image' => 'image|file|max:1024',
            'program_studi' => 'required',
            'nim' => 'required',
        ];
        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage != 'ktm-img/default.jpg') {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('ktm-img');
        }

        Pendaftaran::where('id', $id)
            ->update($validatedData);

        return redirect('/lihat/' . $id)->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $gambar = Pendaftaran::find($id);

        if ($gambar->image != 'ktm-img/default.jpg') {
            Storage::delete($gambar->image);
        }

        Pendaftaran::destroy($id);
        return redirect('/redirects')->with('success', 'Data Berhasil Dihapus!');
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
                <a href="edit/' . $kartu->id . '"><span
                        class="px-2 py-1 font-semibold leading-tight text-yellow-600 bg-yellow-100 rounded-sm ml-3">
                        Edit </span></a>
                <form action="hapus/' . $kartu->id . '" class="inline" method="post">
                ' . method_field("delete") . '' . csrf_field() . '
                    <button
                        class="px-2 py-1 font-semibold leading-tight text-red-600 bg-red-100 rounded-sm ml-3"
                        onclick="return confirm("Yakin Hapus Data?")">Hapus</button>
                </form>
            </td>
        </tr>';
        }

        return response($output);
    }
}
