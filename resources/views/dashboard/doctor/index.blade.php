@extends('layouts.master')

@section('title', 'Dashboard')

@section('style')
@endsection

@section('content')
<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">

        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Dashboard</h3>
            </div>
        </div><!-- Page Heading End -->
        <div class="col-12 col-lg-auto mb-20">
            <!-- <div class="page-date-range">
                <input type="text" id="datepick" class="form-control input-date-predefined">
            </div> -->
        </div><!-- Page Button Group End -->

    </div><!-- Page Headings End -->

    <!-- Top Report Wrap Start -->
    <div class="row">
    <div class="col-12 mb-30">
        <div class="box">
            <div class="box-head">
                <h3 class="title">Data Antrian Pasien</h3>
            </div>
            <div class="box-body">

            <table class="table table-bordered data-table data-table-export">
                    <thead>
                        <tr>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Nama Dokter</th>
                            <th>Nama Pasien</th>
                            <th>Status</th>
                            <!-- <th>Aksi</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2020-01-01</td>
                            <td>Budi</td>
                            <td>Wati</td>
                            <td>
                                <span class="badge badge-outline badge-info">sukses</span>
                            </td>
                            <!-- <td><button class="button button-sm button-warning">Lihat detail</button></td> -->
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

    const tableBody = document.querySelector('.data-table tbody');
    const doctorId = "{{ Auth::user()->id }}";
    
    function fetchMedicalRecords() {
        // Initialize DataTable if it isn't already
        const dataTable = $('.data-table').DataTable();

        axios.get(`api/medical-record/patients/doctor/${doctorId}`)
            .then(response => {
                const records = response.data.data;

                // Clear the existing table rows using DataTables API
                dataTable.clear();

                // Populate the table
                records.forEach(record => {
                    dataTable.row.add([
                        record.created_at.split('T')[0],
                        record.doctor_name,
                        record.patient_name,
                        `<span class="badge badge-outline badge-${record.status === 'completed' ? 'info' : 'warning'}">
                            ${record.status === 'completed' ? 'Selesai' : 'Menunggu'}
                        </span>`,
                        `<button class="button button-sm button-warning" onclick="viewDetail(${record.id})">Lihat Detail</button>`
                    ]);
                });

                // Redraw the table
                dataTable.draw();
            })
            .catch(error => {
                console.error("Error fetching medical records:", error);
                alert("Failed to fetch medical records.");
            });
    }


    // function viewDetail(recordId) {
    //     // Navigate to the record detail page
    //     window.location.href = `/scan-patient-detail-medical-record?id=${recordId}`;
    // }

    // Fetch data when the page is loaded
    fetchMedicalRecords();
</script>
@endsection