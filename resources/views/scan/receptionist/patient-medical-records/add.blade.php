@extends('layouts.master')

@section('title', 'Tambah Rekam Medis')

@section('style')
@endsection

@section('content')
<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Tambah Rekam Medis</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Form Tambah Rekam Medis</h4>
                </div>
                <div class="box-body">
                    <form id="medical-record-form">
                        <div class="row mbn-20">
                            <div class="col-12 mb-20">
                                <label for="name">Nama</label>
                                <input type="text" id="name" class="form-control" placeholder="Nama" disabled>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <label for="check_date">Tanggal Pemeriksaan</label>
                                <input type="text" class="form-control input-date-single" id="check_date" disabled>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="nim">NIM</label>
                                <input type="text" id="nim" class="form-control" placeholder="NIM" disabled>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="no_telkomedika">Nomor Telkomedika</label>
                                <input type="text" id="no_telkomedika" class="form-control" placeholder="Nomor Telkomedika" disabled>
                            </div>
                            <div class="col-12 mb-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-4 mb-20">
                                        <label for="birth_date">Tanggal Lahir</label>
                                        <input type="text" class="form-control input-date-single" id="birth_date" disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="age">Usia</label>
                                        <input type="text" id="age" class="form-control" placeholder="Usia" disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="gender">Jenis Kelamin</label>
                                        <input type="text" id="gender" class="form-control" placeholder="Jenis Kelamin" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-20 mt-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-4 mb-20">
                                        <label for="weight">Berat Badan</label>
                                        <input type="text" id="weight" class="form-control" placeholder="Berat Badan">
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="height">Tinggi Badan</label>
                                        <input type="text" id="height" class="form-control" placeholder="Tinggi Badan">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-4 mb-20">
                                        <label for="bloodPressure">Tekanan Darah</label>
                                        <input type="text" id="bloodPressure" class="form-control" placeholder="Tekanan Darah">
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="bodyTemperature">Suhu Tubuh</label>
                                        <input type="text" id="bodyTemperature" class="form-control" placeholder="Suhu Tubuh">
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="oxygen">Kadar Oksigen</label>
                                        <input type="text" id="oxygen" class="form-control" placeholder="Kadar Oksigen">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="complaint">Keluhan</label>
                                <textarea class="form-control" id="complaint"></textarea>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="doctor">Pilih Dokter</label>
                                <select id="doctor" class="form-control">
                                    <option value="">Pilih Dokter</option>
                                </select>
                            </div>

                            <div class="col-12 mb-20 mt-20 d-flex justify-content-end">
                                <button type="button" class="button button-secondary mr-20">Batal</button>
                                <button type="submit" class="button button-info">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="assets-template/js/plugins/moment/moment.min.js"></script>
<script src="assets-template/js/plugins/daterangepicker/daterangepicker.js"></script>
<script src="assets-template/js/plugins/daterangepicker/daterangepicker.active.js"></script>
<script src="assets-template/js/plugins/datatables/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    setTimeout(() => {
        loadingFalse();
    }, 50);

    const urlParams = new URLSearchParams(window.location.search);
    const rfid = urlParams.get('id');
    let patientId = null;
    window.addEventListener('DOMContentLoaded', function() {
        if (rfid) {
            axios.get(`/api/patients/${rfid}`)
                .then(response => {
                    const data = response.data.data;
                    if (data.message) {
                        alert(data.message);
                    } else {
                        patientId = data.id;
                        document.getElementById('name').value = data.name;
                        document.getElementById('nim').value = data.nim;
                        document.getElementById('no_telkomedika').value = data.telkomedika_number;
                        document.getElementById('birth_date').value = data.date_of_birth;
                        document.getElementById('gender').value =  data.gender === 'm' ? 'Laki-laki' : 'Perempuan';

                        const birthDate = new Date(data.date_of_birth);
                        const currentDate = new Date();
                        const age = currentDate.getFullYear() - birthDate.getFullYear();
                        const month = currentDate.getMonth() - birthDate.getMonth();
                        if (month < 0 || (month === 0 && currentDate.getDate() < birthDate.getDate())) {
                            age--; // Adjust if the birthday hasn't occurred yet this year
                        }

                        document.getElementById('age').value = age;
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        axios.get('/api/doctors')
            .then(response => {
                const doctors = response.data.data;
                const doctorSelect = document.getElementById('doctor');
                doctors.forEach(doctor => {
                    const option = document.createElement('option');
                    option.value = doctor.id;
                    option.textContent = doctor.name;
                    doctorSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching doctors:', error));
    });

    document.getElementById('medical-record-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = {
            patient_id: patientId, // assuming RFID corresponds to patient_id
            doctor_id: document.getElementById('doctor').value,
            receptionist_id: "{{ Auth::user()->id }}",
            
            weight: document.getElementById('weight').value,
            height: document.getElementById('height').value,
            blood_pressure: document.getElementById('bloodPressure').value,
            body_temperature: document.getElementById('bodyTemperature').value,
            oxygen_level: document.getElementById('oxygen').value,
            reason_for_visit: document.getElementById('complaint').value,
        };

        axios.post('/api/medical-record', formData)
            .then(response => {
                alert('Berhasil menyimpan data dan terkirim ke dokter');
                window.location.href = '/scan'
            })
            .catch(error => {
                alert('Lengkapi data terlebih dahulu');
                console.error('Error saving medical record:', error);
            });
    });
</script>
@endsection
