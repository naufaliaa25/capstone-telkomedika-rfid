@extends('layouts.master')

@section('title', 'Rekam Medis')

@section('style')
@endsection

@section('content')
<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">

        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Rekam Medis</h3>
            </div>
        </div><!-- Page Heading End -->
        <div class="col-12 col-lg-auto mb-20">
            <div class="buttons-group" style="display: flex;">
                @if (Auth::user()->role == 'receptionist')
                    <button id="addData" class="button button-outline button-info mr-4"">Tambah Data</button>
                @endif
                <!-- <div class=" page-date-range">
                    <input type="text" id="datepick" class="form-control input-date-predefined">
            </div> -->
        </div>
    </div><!-- Page Button Group End -->

</div><!-- Page Headings End -->

<!-- Top Report Wrap Start -->
<div class="row">
    @if (Auth::user()->role === 'doctor')
    <div class="col-lg-8 col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h4 class="title">Penanganan Medis Saat Ini</h4>
            </div>
            <div class="box-body">
                <div class="accordion accordion-icon primary" id="accordionExampleFour">

                    <div class="card secondary">
                        <div class="card-header">
                            <h2><button data-toggle="collapse" data-target="#collapse4One">Rekam Medis</button></h2>
                        </div>
                        <div id="collapse4One" class="collapse show" data-parent="#accordionExampleFour">
                            <div class="card-body">
                                 <p id="current-medical-info"></p>
                                 <button id="ack-medical" class="button button-sm button-warning mb-10" style="float: right;margin-bottom: 20px !important;">Periksa</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Data Rekam Medis Pasien</h3>
            </div>
            <div class="box-body">

                <table class="table table-bordered data-table data-table-export">
                    <thead>
                        <tr>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Nama Dokter</th>
                            <th>Nama Pasien</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2020-01-01</td>
                            <td>Budi</td>
                            <td>Wati</td>
                            <td>
                                <span class="badge badge-outline badge-info">selesai</span>
                                <!-- selesai/menunggu -->
                            </td>
                            <td><button id="detail" class="button button-sm button-warning">Lihat detail</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
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

    const role = "{{ Auth::user()->role }}";
    const tableBody = document.querySelector('.data-table tbody');
    const urlParams = new URLSearchParams(window.location.search);
    const rfid = urlParams.get('id');
    let patientName = ''

    function fetchPatientData() {
        // Fetch patient by RFID
        axios.get(`api/patients/${rfid}`)
            .then(response => {
                const patient = response.data.data;
                const patientId = patient.id;
                patientName = patient.name

                // After fetching the patient, fetch their medical records
                fetchMedicalRecords(patientId);
            })
            .catch(error => {
                console.error("Error fetching patient data:", error);
                alert("Failed to fetch patient data.");
            });
    }

    function fetchMedicalRecords(patientId) {
        // Initialize DataTable if it isn't already
        const dataTable = $('.data-table').DataTable();

        axios.get(`api/medical-record/patients/${patientId}`)
            .then(response => {
                const records = response.data.data;

                // Clear the existing table rows using DataTables API
                dataTable.clear();

                // Populate the table
                records.forEach(record => {
                    if (role === 'doctor' && record.status === 'scheduled') {
                        document.getElementById('current-medical-info').innerHTML = `<b>Nama</b>: ${patientName}<br><b>Keluhan</b>: ${record.reason_for_visit}`
                        document.getElementById('ack-medical').addEventListener('click', () => {
                            window.location.href = `/scan-patient-doctor-ack-medical-record?id=${rfid}&medical-id=${record.id}`;
                        })
                    }
                    if ((role === 'doctor' && record.status !== 'scheduled') || role === "receptionist") {
                        dataTable.row.add([
                            record.created_at.split('T')[0],
                            record.doctor_name,
                            patientName,
                            `<span class="badge badge-outline badge-${record.status === 'completed' ? 'info' : 'warning'}">
                                ${record.status === 'completed' ? 'Selesai' : 'Menunggu'}
                            </span>`,
                            `<button class="button button-sm button-warning" onclick="viewDetail(${record.id})">Lihat Detail</button>`
                        ]);
                    }
                });

                // Redraw the table
                dataTable.draw();
            })
            .catch(error => {
                console.error("Error fetching medical records:", error);
                alert("Failed to fetch medical records.");
            });
    }


    function viewDetail(recordId) {
        // Navigate to the record detail page
        // window.location.href = `/scan-patient-detail-medical-record?id=${recordId}`;
        window.location.href = `/scan-patient-detail-medical-record?id=${rfid}&medical-id=${recordId}`;
    }

    // document.getElementById('addData').addEventListener('click', () => {
    //     // Navigate to the add medical record page
    //     window.location.href = `/scan-patient-add-medical-record?id=${rfid}`;
    // });

    // Fetch data when the page is loaded
    fetchPatientData();


    if (role === 'doctor') {

    } else {
        document.getElementById('addData').addEventListener('click', () => {
            window.location.href = `/scan-patient-add-medical-record?id=${rfid}`;
        });
    }

</script>
@endsection
