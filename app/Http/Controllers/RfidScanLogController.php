<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RfidScanLog;

class RfidScanLogController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rfid_tag' => 'required|string|max:255',
            'role' => 'required|string|max:255',
        ]);

        $log = RfidScanLog::create($validated);

        return successResponse($log, 'Log data saved successfully', 201);
    }

    public function updateLogStatus($id) {
        $log = RfidScanLog::find($id);

        if (!$log) {
            return errorResponse('Log not found', 404);
        }

        $log->update([
            'status' => 'done',
        ]);

        return successResponse($log, 'Log status updated successfully');
    }

    public function getLogByRole($role) {
        $logs = RfidScanLog::select('rfid_scan_logs.*', 'patients.name')
                            ->where('role', $role)
                            ->leftJoin('patients', 'rfid_scan_logs.rfid_tag', '=', 'patients.rfid_tag')
                            ->where('status', 'waiting')
                            ->first();

        return successResponse($logs, 'Logs data retrieved successfully', 200);
    }

}
