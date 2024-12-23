<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;

class MedicalRecordController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:users,id',
            'receptionist_id' => 'required|exists:users,id',
            'weight' => 'required|numeric',
            'height' => 'required|integer',
            'oxygen_level' => 'required|integer',
            'blood_pressure' => 'required|string',
            'body_temperature' => 'required|numeric',
            'reason_for_visit' => 'required|string',
        ]);

        $record = MedicalRecord::create([
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $validated['doctor_id'],
            'receptionist_id' => $validated['receptionist_id'],
            'status' => 'scheduled',
            'weight' => $validated['weight'],
            'height' => $validated['height'],
            'oxygen_level' => $validated['oxygen_level'],
            'blood_pressure' => $validated['blood_pressure'],
            'body_temperature' => $validated['body_temperature'],
            'reason_for_visit' => $validated['reason_for_visit'],
        ]);

        return successResponse($record, 'Medical Record data saved successfully', 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'diagnose' => 'required|string',
            'prescription' => 'required|string',
            'allergy' => 'required|string',
        ]);

        $record = MedicalRecord::find($id);

        if (!$record) {
            return errorResponse('Medical Record not found', 404);
        }

        $record->update([
            'status' => 'completed',
            'diagnose' => $validated['diagnose'],
            'prescription' => $validated['prescription'],
            'allergy' => $validated['allergy'],
        ]);

        return successResponse($record, 'Medical Record data updated successfully', 200);
    }

    public function getMedicalRecordByPatientId($id) {
        $records = MedicalRecord::where('patient_id', $id)
                                    ->join('users', 'medical_records.doctor_id', '=', 'users.id')
                                    ->select('medical_records.*', 'users.name as doctor_name')
                                    ->get();

        return successResponse($records, 'Medical Record data retrieved successfully', 200);
    }

    public function getMedicalRecordById($id) {
        $record = MedicalRecord::where('medical_records.id', $id)
                        ->leftJoin('users as doctors', 'medical_records.doctor_id', '=', 'doctors.id')
                        ->select(
                            'doctors.name as doctor_name', 
                            'medical_records.*'
                        )
                        ->first();

        return successResponse($record, 'Medical Record data retrieved successfully', 200);
    }

    public function getAllMedicalRecord(Request $request) {
        // Ambil parameter tanggal dari request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
    
        // Pastikan waktu awal dan akhir sesuai kebutuhan
        if ($startDate) {
            $startDate = $startDate . ' 00:00:00';
        }
        if ($endDate) {
            $endDate = $endDate . ' 23:59:59';
        }
    
        // Query dengan filter rentang tanggal
        $records = MedicalRecord::leftJoin('users as doctors', 'medical_records.doctor_id', '=', 'doctors.id')
                                ->leftJoin('patients', 'medical_records.patient_id', '=', 'patients.id')
                                ->select(
                                    'medical_records.*', 
                                    'doctors.name as doctor_name', 
                                    'patients.name as patient_name',
                                    'patients.telkomedika_number as telkomedika_number',
                                    'patients.rfid_tag as rfid_tag'
                                )
                                ->when($startDate && $endDate, function($query) use ($startDate, $endDate) {
                                    return $query->whereBetween('medical_records.created_at', [$startDate, $endDate]);
                                })
                                ->get();
    
        return successResponse($records, 'All Medical Record data retrieved successfully', 200);
    }
    

    public function getAllMedicalRecordByDoctorId($id) {
        $records = MedicalRecord::where('medical_records.doctor_id', $id)
                                ->where('medical_records.status', 'scheduled')
                                ->leftJoin('users as doctors', 'medical_records.doctor_id', '=', 'doctors.id')
                                ->leftJoin('patients', 'medical_records.patient_id', '=', 'patients.id')
                                ->select(
                                    'medical_records.*', 
                                    'doctors.name as doctor_name', 
                                    'patients.name as patient_name'
                                )
                                ->get();
    
        return successResponse($records, 'All Medical Record data retrieved successfully', 200);
    }
    
}
