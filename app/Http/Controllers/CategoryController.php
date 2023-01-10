<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    //
    public function get_data()
    {
        $data = Category::all();

        return response()->json(['message' => 'Get data has been successfully', 'data' => $data], 200);
    }

    public function insert(Request $request)
    {
        $input = $request->all();

        $error = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
        ]);
        DB::beginTransaction();
        try {
            if ($error->fails()) {
                throw new Exception("Data cannot be null");
            }

            $result = Category::create($input);

            if (!$result) {
                throw new Exception("Error insert data");
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Request is Error', 'errors' => $th->getMessage()], 500);
        }

        return response()->json(['message' => 'Input data has been successfully', 'data' => $result], 200);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        DB::beginTransaction();
        try {

            $result = Category::find($id);

            $result->update($input);

            if (!$result) {
                throw new Exception("Error update data");
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Request is Error', 'errors' => $th->getMessage()], 500);
        }

        return response()->json(['message' => 'Update data has been successfully', 'data' => $result], 200);
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {

            $result = Category::find($id);

            $result->delete();

            if (!$result) {
                throw new Exception("Error Delete data");
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Request is Error', 'errors' => $th->getMessage()], 500);
        }

        return response()->json(['message' => 'Delete data has been successfully', 'data' => $result], 200);
    }

    public function get()
    {
        $data = Category::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return "
                    <button class='btn text-white btn-sm icon btn-icon btn-warning Edit' data-value='" . $data->id . "'><i class='fas fa-edit'></i> Edit</button>
                    <button class='btn text-white btn-sm icon btn-icon btn-danger Delete' data-value='" . $data->id . "'><i class='fas fa-trash'></i> Delete</button>
                ";
            })
            ->rawColumns(['action'])->make(true);
    }

    public function get_by_id($id)
    {
        $data = Category::find($id);

        return response()->json(['message' => 'Get category has been successfully', 'data' => $data], 200);
    }
}
