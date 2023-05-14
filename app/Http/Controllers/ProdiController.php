<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodi = Prodi::orderBy('created_at', 'DESC')->paginate(5);
        $response = [
            'message' =>'Data Prodi',
            'data' => $prodi,
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
            'kd_prodi' => ['required'],
            'nama_prodi' => ['required']
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try {
            $prodi = Prodi::create($request->all());

            $response = [
                'message' => 'Berhasil disimpan',
                'data' => $prodi,
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
        {
            $prodi = Prodi::where('kd_prodi', $id)->firstOrFail();
            if (is_null($prodi)) {
                return $this->sendError('Prodi tidak ditemukan');
            }
            return response()->json([
                'success' => true,
                'message' => 'Data prodi ditemukan',
                'data' => $prodi,
            ]);
        }
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
        {
            $prodi = Prodi::where('kd_prodi', $id);
            $prodi->update($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Data prodi telah diubah.',
                'data' => $prodi,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        {
            $deleteRows = Prodi::where('kd_prodi', $id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data prodi berhasil dihapus.',
                'data' => $deleteRows,
            ]);
        }
    }
}
