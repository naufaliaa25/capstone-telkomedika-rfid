<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    public function getPatientByRFID($rfid)
    {
        $patient = Patient::where('rfid_tag', $rfid)->first();
        
        if (!$patient) {
            return errorResponse('Patient not found', 404);
        }  

        return successResponse($patient, 'Patient data retrieved successfully', 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:m,f',
            'telkomedika_number' => 'required|string|max:255',
            'rfid_tag' => 'required|string|max:255',
        ]);

        $patient = Patient::create($validated);

        return successResponse($patient, 'Patient data saved successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
