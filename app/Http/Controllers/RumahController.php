<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use Illuminate\Http\Request;
use App\Http\Resources\RumahResource;
use Illuminate\Support\Facades\Storage;

class RumahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $geoJSONdata = Rumah::all();

        return response()->json($geoJSONdata);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'latitude' => 'required|string|max:50',
        //     'longitude' => 'required|string|max:50',
        //     'pekerjaan' => 'required|string|max:50',
        //     'nik' => 'required|string|max:50',
        //     'nokk' => 'required|string|max:50',
        //     'alamat' => 'required|string',
        //     'keterangan' => 'required|string',
        //     'tempat_lahir' => 'required|string|max:50',
        //     'tanggal_lahir' => 'required|date',
        //     'foto_sebelum.*' => 'image|mimes:jpeg,png,jpg,gif',
        //     'foto_sesudah.*' => 'image|mimes:jpeg,png,jpg,gif',
        // ]);

        $rumah = $request->all();

        $files = [];

        if($request->hasfile('foto_sebelum'))
         {
            foreach($request->file('foto_sebelum') as $file)
            {
                $name = time().rand(1,50).'.'.$file->extension();
                $file->move(public_path('img/fotosebelum'), $name);
                $files[] = $name;
            }
         }


        // if($request->hasfile('foto_sesudah'))
        //  {
        //     foreach($request->file('foto_sesudah') as $file)
        //     {
        //         $name = time().rand(1,50).'.'.$file->extension();
        //         $file->move(public_path('img/fotosesudah'), $name);
        //         $files[] = $name;
        //     }
        //  }
        $rumah->foto_sebelum = json_encode($files); // Assuming you want to store file names in JSON format
        // $rumah->foto_sesudah = json_encode($files); // You can adjust this based on your database structure

        $save = Rumah::create($rumah);

        return redirect()->route('admin.beranda')->withSuccess('Marker Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rumah $rumah)
    {
        return view('admin.show', compact('rumah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rumah $rumah)
    {
        return view('admin.show', compact('rumah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rumah $rumah)
    {
        $rumahData = $request->all();

        $files = [];

        if ($request->hasfile('foto_sebelum')) {
            foreach ($request->file('foto_sebelum') as $file) {
                $name = time() . rand(1, 50) . '.' . $file->extension();
                $file->move(public_path('img/fotosebelum'), $name);
                $files[] = $name;
            }
        }

        $rumahData['foto_sebelum'] = json_encode($files);

        $rumah->update($rumahData);

        return redirect()->route('admin.beranda')->withSuccess('Marker Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rumah $rumah)
    {
        $existingPhotos = json_decode($rumah->foto_sebelum, true) ?? [];

        foreach ($existingPhotos as $photo) {
            $photoPath = public_path('img/fotosebelum') . '/' . $photo;
            if (File::exists($photoPath)) {
                File::delete($photoPath);
            }
        }

        $rumah->delete();

        return redirect()->route('admin.beranda')->withSuccess('Marker Berhasil Dihapus');
    }
}
