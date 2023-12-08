<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data = Student::all();

            return ApiFormatter::createApi(200, 'Success', $data);
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'alamat' => 'required',
                'email' => 'required|email',
            ]);

            $student = Student::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email
            ]);

            return ApiFormatter::createApi(200, 'Success', $student);
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
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
        try {
            $student = Student::findOrFail($id);

            return ApiFormatter::createApi(200, 'Success', $student);
        } catch (Exception $error) {
            return ApiFormatter::createApi(400, 'Failed');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        {
            try {
                $student = Student::find($id);
    
                if ($student) {
                    return ApiFormatter::createApi(200, 'Success', $student);
                } else {
                    return ApiFormatter::createApi(404, 'Student not found');
                }
    
            } catch (Exception $error) {
                return ApiFormatter::createApi(500, 'Internal Server Error');
            }
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
            try {
                $request->validate([
                    'nama' => 'required',
                    'alamat' => 'required',
                    'email' => 'required',
                ]);
    
                $student = Student::find($id);
    
                if ($student) {
                    $student->update([
                        'nama' => $request->nama,
                        'alamat' => $request->alamat,
                        'email' => $request->email
                    ]);
    
                    return ApiFormatter::createApi(200, 'Success', $student);
                } else {
                    return ApiFormatter::createApi(404, 'Student not found');
                }
    
            } catch (Exception $error) {
                return ApiFormatter::createApi(500, 'Internal Server Error');
            }
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
        try {
            $student = Student::find($id);

            if ($student) {
                $student->delete();
                return ApiFormatter::createApi(200, 'Success', 'Student deleted successfully');
            } else {
                return ApiFormatter::createApi(404, 'Student not found');
            }

        } catch (Exception $error) {
            return ApiFormatter::createApi(500, 'Internal Server Error');
        }
    }
}
