@extends('layouts.master')

@section('title', 'Periksa Pasien')

@section('style')
<style>
    #prescriptionView {
        display: none;
    }

    @media print {
        #contentBodyAck>*:not(#prescriptionView) {
            display: none;
        }

        .header-right {
            display: none;
        }

        .side-header {
            display: none;
        }
        
        #prescriptionView {
            display: block;
        }
    }

    .prescription-container {
        padding: 20px;
        font-family: Arial, sans-serif;
        border: 1px solid #ccc;
    }

    .prescription-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .prescription-details {
        margin-bottom: 20px;
    }

</style>
@endsection

@section('content')
<div class="content-body" id="contentBodyAck">

    <div class="row justify-content-between align-items-center mb-10">
        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Periksa Pasien</h3>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Form Rekam Medis</h4>
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
                                <input type="text" id="no_telkomedika" class="form-control"
                                    placeholder="Nomor Telkomedika" disabled>
                            </div>
                            <div class="col-12 mb-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-4 mb-20">
                                        <label for="birth_date">Tanggal Lahir</label>
                                        <input type="text" class="form-control input-date-single" id="birth_date"
                                            disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="age">Usia</label>
                                        <input type="text" id="age" class="form-control" placeholder="Usia" disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="gender">Jenis Kelamin</label>
                                        <input type="text" id="gender" class="form-control" placeholder="Jenis Kelamin"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-20 mt-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-4 mb-20">
                                        <label for="weight">Berat Badan</label>
                                        <input type="text" id="weight" class="form-control" placeholder="Berat Badan"
                                            disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="height">Tinggi Badan</label>
                                        <input type="text" id="height" class="form-control" placeholder="Tinggi Badan"
                                            disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-4 mb-20">
                                        <label for="bloodPressure">Tekanan Darah</label>
                                        <input type="text" id="bloodPressure" class="form-control"
                                            placeholder="Tekanan Darah" disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="bodyTemperature">Suhu Tubuh</label>
                                        <input type="text" id="bodyTemperature" class="form-control"
                                            placeholder="Suhu Tubuh" disabled>
                                    </div>
                                    <div class="col-lg-4 mb-20">
                                        <label for="oxygen">Kadar Oksigen</label>
                                        <input type="text" id="oxygen" class="form-control" placeholder="Kadar Oksigen"
                                            disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="complaint">Keluhan</label>
                                <textarea class="form-control" id="complaint" disabled></textarea>
                            </div>

                            <div class="col-lg-12 mb-20">
                                <label for="allergy">Alergi Obat</label>
                                <input type="text" id="allergy" class="form-control" placeholder="Alergi Obat">
                            </div>

                            <div class="col-12 mb-20">
                                <label for="diagnose">Diagnosa</label>
                                <textarea class="form-control" id="diagnose"></textarea>
                            </div>

                            <div class="col-12 mb-20">
                                <label for="prescription">Resep</label>
                                <textarea class="form-control" id="prescription"></textarea>
                            </div>

                            <div class="col-12 mb-20 mt-20 d-flex justify-content-end">
                                <button type="button" class="button button-secondary mr-20" id="backBtn">Kembali</button>
                                <button type="submit" class="button button-info mr-20">Simpan</button>
                                <button type="button" class="button button-warning" data-toggle="tooltip"
                                    data-placement="top" title="Simpan rekam medis dahulu!" id="printPrescription">Cetak
                                    Resep</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="prescriptionView" class="prescription-container">
        <div class="prescription-header">
            <h2>Resep Dokter</h2>
            <p>Tanggal: <span id="prescriptionDate"></span></p>
            <p>No. Resep: <span id="prescriptionNumber"></span></p>
        </div>
        <div class="prescription-details">
            <p>Nama Dokter: <span id="doctorName"></span></p>
            <p>Nama Pasien: <span id="patientName"></span></p>
            <p>Jenis Kelamin: <span id="patientGender"></span></p>
            <p>Usia: <span id="patientAge"></span></p>
        </div>
        <div class="prescription-medicine">
            <h3>Detail Resep:</h3>
            <p id="prescriptionDetails"></p>
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
                        document.getElementById('name').value = data.name;
                        document.getElementById('nim').value = data.nim;
                        document.getElementById('no_telkomedika').value = data.telkomedika_number;
                        document.getElementById('birth_date').value = data.date_of_birth;
                        document.getElementById('gender').value = data.gender === 'm' ? 'Laki-laki' : 'Perempuan';

                        const birthDate = new Date(data.date_of_birth);
                        const currentDate = new Date();
                        let age = currentDate.getFullYear() - birthDate.getFullYear();
                        const month = currentDate.getMonth() - birthDate.getMonth();
                        if (month < 0 || (month === 0 && currentDate.getDate() < birthDate.getDate())) {
                            age--;
                        }

                        document.getElementById('age').value = age;
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
                        document.getElementById('weight').value = data.weight;
                        document.getElementById('height').value = data.height;
                        document.getElementById('bloodPressure').value = data.blood_pressure;
                        document.getElementById('bodyTemperature').value = data.body_temperature;
                        document.getElementById('oxygen').value = data.oxygen_level;
                        document.getElementById('complaint').value = data.reason_for_visit;

                        document.getElementById('check_date').value = data.created_at.split('T')[0];
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });

    // Kirim data rekam medis yang diperbarui
    document.getElementById('medical-record-form').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = {
            diagnose: document.getElementById('diagnose').value,
            prescription: document.getElementById('prescription').value,
            allergy: document.getElementById('allergy').value,
        };

        axios.put(`/api/medical-record/${medicalId}`, formData)
            .then(response => {
                enablePrintButton(formData);
                alert('Berhasil update data rekam medis');
            })
            .catch(error => console.error('Error saving medical record:', error));
    });

    // Aktifkan tombol cetak
    const enablePrintButton = (formData) => {
        document.getElementById('printPrescription').setAttribute('data-original-title', 'Resep siap untuk dicetak!');

        const prescriptionData = {
            date: new Date().toLocaleDateString(),
            number: `TLKM-${document.getElementById('check_date').value.split('-').join('')}-${medicalId}NA`,
            doctorName: "{{Auth::user()->name}}",
            patientName: document.getElementById('name').value,
            gender: document.getElementById('gender').value,
            age: document.getElementById('age').value,
            details: formData.prescription,
        };

        document.getElementById("printPrescription").addEventListener("click", function () {
            const formattedDate = new Date(prescriptionData.date).toLocaleDateString('en-GB').replace(/\//g, '/');
            document.getElementById("prescriptionDate").textContent = formattedDate;
            document.getElementById("prescriptionNumber").textContent = prescriptionData.number;
            document.getElementById("doctorName").textContent = prescriptionData.doctorName;
            document.getElementById("patientName").textContent = prescriptionData.patientName;
            document.getElementById("patientGender").textContent = prescriptionData.gender;
            document.getElementById("patientAge").textContent = prescriptionData.age;
            document.getElementById("prescriptionDetails").textContent = prescriptionData.details;

            window.print();
        });
        
    };

    document.getElementById("backBtn").addEventListener("click", function () {
            window.location.href = `/scan`;
        });
</script>
@endsection
