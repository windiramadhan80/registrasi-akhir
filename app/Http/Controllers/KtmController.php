<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class KtmController extends Controller
{
    public function index()
    {
        $ktm = Pendaftaran::latest()->filter(request(['search']))->paginate(15)->withQueryString();
        $data = [
            'ktm' => $ktm
        ];

        return view('home.index', $data);
    }

    public function pencarian(Request $request)
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
        </tr>';
        }

        return response($output);
    }

    public function panduan()
    {
        return view('home.panduan');
    }
}
