<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::orderBy('created_at', 'DESC')->paginate(5);
        $response = [
            'message' =>'Data Mahasiswa',
            'data' => $mahasiswa,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim_mahasiswa' => ['required'],
            'nama_mahasiswa' => ['required'],
            'angkatan_mahasiswa' => ['required'],
            'kd_prodi' => ['required']
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $mahasiswa = Mahasiswa::create($request->all());

            $response = [
                'message' => 'Berhasil disimpan',
                'data' => $mahasiswa,
            ];

            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch (QueryException $e){
            return response()->json([
                'message' => 'Gagal ' . $e->errorInfo,
            ]);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::where('nim_mahasiswa', $id)->firstOrFail();
        if (is_null($mahasiswa)) {
            return $this->sendError('Mahasiswa tidak ditemukan');
        }
        return response()->json([
            'success' => true,
            'message' => 'Data Mahasiswa ditemukan',
            'data' => $mahasiswa,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::where('nim_mahasiswa', $id);
        $mahasiswa->update($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Data Mahasiswa telah diubah.',
            'data' => $mahasiswa,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteRows = Mahasiswa::where('nim_mahasiswa', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Mahasiswa berhasil dihapus.',
            'data' => $deleteRows,
        ]);
    }
}
