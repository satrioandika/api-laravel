<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mahasiswa;

use App\Http\Resources\PostResources;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
     /**
     * @OA\Get(
     *     path="/mahasiswa",
     *     tags={"Mahasiswa"},
     *     operationId="listMahasiswa",
     *     summary="Mahasiswa - Get All",
     *     description="Mengambil Data Mahasiswa",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Berhasil Mengambil Data Mahasiswa",
     *                 "data": {
     *                     {
     *                         "mhs_nim": "351610130604",
     *                         "mhs_nama": "Helya Salsabilla"
     *                     }
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function listMahasiswa(){
        $success = true;
        $message = 'Berhasil mengambil Data Mahasiswa';
        $data = Mahasiswa::all();

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], 200)->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * @OA\Get(
     *     path="/mahasiswa/{id}",
     *     tags={"Mahasiswa"},
     *     operationId="listMahasiswaById",
     *     summary="Mahasiswa - Get By ID",
     *     description="Mengambil Data Mahasiswa Berdasarkan ID",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             default="1",
     *             description="Masukan ID",
     *             example="1"
     *         ),
     *         description="ID Mahasiswa"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Berhasil mengambil Data Mahasiswa",
     *                 "data": {
     *                     "mhs_nim": "0320230010",
     *                     "mhs_nama": "Eko Abdul Goffar"
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function listMahasiswaById($id){
        $success = true;
        $message = 'Berhasil mengambil Data Mahasiswa';
        $data = Mahasiswa::find($id);

        return response()->json([
            'success' => $success,
            'message' => $message,
            'data' => $data
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/mahasiswa/create",
     *     operationId="insertMahasiswa",
     *     tags={"Mahasiswa"},
     *     summary="Mahasiswa Insert",
     *     description="Post data Mahasiswa",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request Body Description",
     *         @OA\JsonContent(
     *             example={
     *                 "mhs_nim": "0320230012",
     *                 "mhs_nama": "Roni"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             example={
     *                 "success": true,
     *                 "message": "Berhasil menambahkan Data Mahasiswa",
     *                 "data": {
     *                     "mhs_nim": "0320230012",
     *                     "mhs_nama": "Roni"
     *                 }
     *             }
     *         )
     *     )
     * )
     */
    public function insertMahasiswa(Request $request){
        $validator = Validator::make($request->all(), [
            'mhs_nim' => 'required',
            'mhs_nama' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        
        $success = true;
        $message = 'Data berhasil disimpan';
        $result = Mahasiswa::create($request->all());
        $data = $result;

            return response()->json([
                'success' => $success,
                'message' => $message,
                'data' => $data
            ], 200);
    }


/**
 * @OA\Put(
 *     operationId="updateMahasiswa",
 *     tags={"Mahasiswa"},
 *     summary="Mahasiswa - Update",
 *     description="Update data Mahasiswa",
 *     path="/mahasiswa/update",
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         description="Request Body Description",
 *         required=true,
 *         @OA\JsonContent(
 *             example={
 *                 "mhs_nim": "0320230012",
 *                 "mhs_nama": "Roni S"
 *             }
 *         ),
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Ok",
 *         @OA\JsonContent(
 *             example={
 *                 "success": true,
 *                 "message": "Data berhasil diubah"
 *             }
 *         ),
 *     ),
 * )
 * 
 * 
 */

 public function updateMahasiswa(Request $request)
 {
     // Define validation rules
     $validator = Validator::make($request->all(), [
         'mhs_nim' => 'required',
         'mhs_nama' => 'required',
     ]);

     // Check if validation fails
     if ($validator->fails()) {
         return response()->json($validator->errors(), 422);
     }

     $success = true;
     $message = 'Data berhasil diubah';

     $data = array(
       "mhs_nama" =>$request->input("mhs_nama")
     );

     $id = $request->input("mhs_nim");
     $result = Mahasiswa::where([
       ['mhs_nim', '=', $id]
     ])->update($data);

     // Make response JSON
     return response()->json([
         'success' => $success,
         'message' => $message,
         'data' => $data,
     ], 200);
 }

/**
* @OA\Delete(
*     operationId="deleteMahasiswa",
*     tags={"Mahasiswa"},
*     summary="Mahasiswa - Delete By ID",
*     description="Delete data Mahasiswa",
*     path="/mahasiswa/delete",
*     security={{ "bearerAuth": {} }},
*     @OA\RequestBody(
*         required=true,
*         description="Request Body Description",
*         @OA\JsonContent(
*             example={
*                 "mhs_nim": 0320230012,
*             },
*         ),
*     ),
*     @OA\Response(
*         response="200",
*         description="Ok",
*         @OA\JsonContent(
*             example={
*                 "success": true,
*                 "message": "Berhasil menghapus Data Mahasiswa",
*             }),
*     ),
* )
*/
public function deleteMahasiswa(Request $request)
{
    $validator = Validator::make($request->all(), [
      "mhs_nim"   => 'required'
    ]);

    if (!$validator) {
        return response()->json($validator->errors(), 422);
    }

    $success = true;
    $message = 'Data berhasil dihapus';

    $id = $request->input("mhs_nim");
    $result = Mahasiswa::where([
        ['mhs_nim', '=', $id]
    ])->delete();

    return response()->json([
        'success' => $success,
        'message' => $message,
        'data'
    ], 200);
}
}
?>