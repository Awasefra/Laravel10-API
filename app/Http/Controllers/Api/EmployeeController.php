<?php

namespace App\Http\Controllers\Api;

//import Model "Post"

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//import Resource "PostResource"
use App\Http\Resources\PostResource;
use App\Models\Employee;

//import Facade "Validator"
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all posts
        $employeess = Employee::latest()->get();

        //return collection of posts as a resource
        return new PostResource(true, 'List Data', $employeess);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create 
        $employees = Employee::create([
            'name'     => $request->name,
        ]);

        //return response
        return new PostResource(true, 'Data Berhasil Ditambahkan!', $employees);
    }

    /**
     * show
     *
     * @param  mixed $employees
     * @return void
     */
    public function show($id)
    {
        //find  by ID
        $employees = Employee::find($id);

        //return single post as a resource
        return new PostResource(true, 'Detail Data!', $employees);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $employees
     * @return void
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find  by ID
        $employees = Employee::find($id);


        //update 
        $employees->update([
            'name'     => $request->name,
        ]);


        //return response
        return new PostResource(true, 'Data Berhasil Diubah!', $employees);
    }

    /**
     * destroy
     *
     * @param  mixed $employees
     * @return void
     */
    public function destroy($id)
    {

        //find post by ID
        $employees = Employee::find($id);

        //delete post
        $employees->delete();

        //return response
        return new PostResource(true, 'Data Berhasil Dihapus!', null);
    }
}
