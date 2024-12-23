@extends('layouts.master')

@section('title', 'Rekam Medis')

@section('style')
@endsection

@section('content')
<div class="content-body">


    <!-- Page Headings Start -->
    <div class="row justify-content-between align-items-center mb-10">

        <!-- Page Heading Start -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Detail Rekam Medis</h3>
            </div>
        </div><!-- Page Heading End -->

    </div><!-- Page Headings End -->

    <div class="row">
        <!-- Edit Rows Start -->
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h2 class="title">Informasi Rekam Medis</h2>
                </div>
                <div class="box-body">
                    <!-- Grouped Row: General Information -->
                    <div class="row">
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>No Rekam Medis</b></label>
                            <p id="medicalId">-</p>
                        </div>
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Tanggal Pemeriksaan</b></label>
                            <p id="date">-</p>
                        </div>
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Nama Dokter</b></label>
                            <p id="doctorName">-</p>
                        </div>
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Nama Pasien</b></label>
                            <p id="patientName">-</p>
                        </div>
                    </div>

                    <!-- Grouped Row: Patient Metrics -->
                    <div class="row">
                        <div class="col-4 mb-5">
                            <label for="" class="col-form-label"><b>Usia</b></label>
                            <p id="age">-</p>
                        </div>
                        <div class="col-4 mb-5">
                            <label for="" class="col-form-label"><b>Tinggi Badan</b></label>
                            <p id="height">-</p>
                        </div>
                        <div class="col-4 mb-5">
                            <label for="" class="col-form-label"><b>Berat Badan</b></label>
                            <p id="weight">-</p>
                        </div>
                    </div>

                    <!-- Individual Fields: Medical Details -->
                    <div class="row">
                        <div class="col-4 mb-5">
                            <label for="" class="col-form-label"><b>Kadar Oksigen</b></label>
                            <p id="oxygenLevel">-</p>
                        </div>
                        <div class="col-4 mb-5">
                            <label for="" class="col-form-label"><b>Tekanan Darah</b></label>
                            <p id="bloodPressure">-</p>
                        </div>
                        <div class="col-4 mb-5">
                            <label for="" class="col-form-label"><b>Suhu Tubuh</b></label>
                            <p id="bodyTemperature">-</p>
                        </div>
                    </div>

                    <!-- Grouped Row: Additional Information -->
                    <div class="row">
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Keluhan</b></label>
                            <p id="complaints">-</p>
                        </div>
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Diagnosa</b></label>
                            <p id="diagnosis">-</p>
                        </div>
                    </div>

                    <!-- Individual Fields: Prescriptions and Status -->
                    <div class="row">
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Alergi Obat</b></label>
                            <p id="drugAllergy">-</p>
                        </div>
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Resep</b></label>
                            <p id="prescription">-</p>
                        </div>
                        <div class="col-12 mb-5">
                            <label for="" class="col-form-label"><b>Status</b></label>
                            <p id="status">-</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit Rows End -->
    </div>

</div><!-- Content Body End -->

@endsection

@section('script')
<!--Moment-->
<script src="assets-template/js/plugins/moment/moment.min.js"></script>

<!--Daterange Picker-->
<script src="assets-template/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets-template/js/plugins/daterangepicker/daterangepicker.active.js"></script>
<script src="assets-template/js/plugins/datatables/datatables.min.js"></script>
<script src="assets-template/js/plugins/datatables/datatables.active.js"></script>
<script>
    setTimeout(() => {
        loadingFalse();
    }, 100);

    const urlParams = new URLSearchParams(window.location.search);
    const rfid = urlParams.get('id');
    const medicalId = urlParams.get('medical-id');
    let patientId = null;

    window.addEventListener('DOMContentLoaded', function () {
    if (rfid && medicalId) {
        // Ambil data pasien
        axios.get(`/api/patients/${rfid}`)
            .then(response => {
                const data = response.data.data;
                if (data.message) {
                    alert(data.message);
                } else {
                    patientId = data.id;
                    document.getElementById('patientName').innerText = data.name;
                    document.getElementById('date').innerText = data.date_of_birth;

                    const birthDate = new Date(data.date_of_birth);
                    const currentDate = new Date();
                    let age = currentDate.getFullYear() - birthDate.getFullYear();
                    const month = currentDate.getMonth() - birthDate.getMonth();
                    if (month < 0 || (month === 0 && currentDate.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    document.getElementById('age').innerText = age;
                }
            })
            .catch(error => console.error('Error:', error));

        // Ambil data rekam medis
        axios.get(`/api/medical-record/${medicalId}`)
            .then(response => {
                const data = response.data.data;
                if (data.message) {
                    alert(data.message);
                } else {
                    const number = `TLKM-${data.created_at.split('T')[0].split('-').join('')}-${medicalId}NA`;
                    
                    document.getElementById('medicalId').innerText = number;
                    document.getElementById('weight').innerText = data.weight;
                    document.getElementById('height').innerText = data.height;
                    document.getElementById('bloodPressure').innerText = data.blood_pressure;
                    document.getElementById('bodyTemperature').innerText = data.body_temperature;
                    document.getElementById('oxygenLevel').innerText = data.oxygen_level;
                    document.getElementById('complaints').innerText = data.reason_for_visit;
                    document.getElementById('diagnosis').innerText = data.diagnose || '-';
                    document.getElementById('drugAllergy').innerText = data.allergy || '-';
                    document.getElementById('prescription').innerText = data.prescription || '-';
                    document.getElementById('status').innerText = data.status === 'completed' ? 'Selesai' : status === 'scheduled' ? 'Menunggu Dokter' : '-';
                    document.getElementById('date').innerText = data.created_at.split('T')[0];
                    document.getElementById('doctorName').innerText = data.doctor_name || '-';
                    
                }
            })
            .catch(error => console.error('Error:', error));
    }
});


</script>
@endsection
