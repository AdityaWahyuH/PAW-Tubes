<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Position;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'List Barang';


        // ELOQUENT
        $employees = Employee::all();
        return view('employee.index', [
            'pageTitle' => $pageTitle,
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create Employee';
        // ELOQUENT
        $positions = Position::all();
        return view('employee.create', compact('pageTitle', 'positions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Get File
        $file = $request->file('cv');
        if ($file != null) {
            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();
            // Store File
            $file->store('public/files');
        }
        // ELOQUENT
        $employee = new Employee;
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;
        if ($file != null) {
            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
        }
        $employee->save();
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'Employee Detail';

        // ELOQUENT
        $employee = Employee::find($id);

        return view('employee.show', compact('pageTitle', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit Employee';

        // ELOQUENT
        $positions = Position::all();
        $employee = Employee::find($id);

        return view('employee.edit', compact(
            'pageTitle',
            'positions',
            'employee'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar.',
            'numeric' => 'Isi :attribute dengan angka.',
        ];

        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);

        $validator = Validator::make($request->all(), [
            'cv' => 'required|file|mimes:pdf,doc,docx',
        ], $messages);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Hapus file CV lama jika ada
        if ($employee->encrypted_filename && Storage::exists('public/files/' . $employee->encrypted_filename)) {
            Storage::delete('public/files/' . $employee->encrypted_filename);
        }

        // Upload file CV baru
        $file = $request->file('cv');
        if ($file) {
            $originalFilename = $file->getClientOriginalName();
            $encryptedFilename = $file->hashName();
            $file->store('public/files');

            $employee->original_filename = $originalFilename;
            $employee->encrypted_filename = $encryptedFilename;
        }

        // Update data employee
        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->email = $request->email;
        $employee->age = $request->age;
        $employee->position_id = $request->position;

        $employee->save();

        return redirect()->route('employees.index');
    }


    public function destroy(string $id)
    {
        // Cari employee berdasarkan ID
        $employee = Employee::find($id);

        // Cek apakah file CV ada
        if ($employee->encrypted_filename) {
            $cvPath = 'public/files/' . $employee->encrypted_filename;

            // Hapus file dari storage jika ada
            if (Storage::exists($cvPath)) {
                Storage::delete($cvPath);
            }
        }

        // Hapus data employee dari database
        $employee->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('employees.index');
    }

    public function downloadFile($employeeId)
    {
        $employee = Employee::find($employeeId);
        $encryptedFilename = 'public/files/' . $employee->encrypted_filename;
        $downloadFilename =
            Str::lower($employee->firstname . '_' . $employee->lastname . '_cv.pdf');
        if (Storage::exists($encryptedFilename)) {
            return Storage::download($encryptedFilename, $downloadFilename);
        }
    }
    public function getData(Request $request)
{
    $employees = Employee::with('position');

    if ($request->ajax()) {
        return datatables()->of($employees)
            ->addIndexColumn()
            ->addColumn('actions', function($employee) {
                return view('employee.actions', compact('employee'));
            })
            ->toJson();
    }
}
}
