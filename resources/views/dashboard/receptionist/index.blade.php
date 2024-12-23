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
            <div class="page-date-range">
                <input type="text" id="datepick" class="form-control input-date-predefined">
            </div>
        </div><!-- Page Button Group End -->

    </div><!-- Page Headings End -->

    <!-- Top Report Wrap Start -->
    <div class="row">
        <div class="col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h3 class="title">Data Kunjungan Pasien</h3>
                </div>
                <div class="box-body">

                    <table class="table table-bordered data-table data-table-export">
                        <thead>
                            <tr>
                                <th>Tanggal Pemeriksaan</th>
                                <th>Nama Dokter</th>
                                <th>Nama Pasien</th>
                                <th>No Telkomedika</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2020-01-01</td>
                                <td>Budi</td>
                                <td>Wati</td>
                                <td>123</td>
                                <td>
                                    <span class="badge badge-outline badge-info">sukses</span>
                                </td>
                                <td><button class="button button-sm button-warning">Lihat detail</button></td>
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

    function fetchMedicalRecords(startDate = '', endDate = '') {
        // Initialize DataTable if it isn't already
        const dataTable = $('.data-table').DataTable();

        axios.get(`/api/medical-record/all/patients`, {
                params: {
                    start_date: startDate,
                    end_date: endDate
                }
            })
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
                        record.telkomedika_number,
                        `<span class="badge badge-outline badge-${record.status === 'completed' ? 'info' : 'warning'}">
                        ${record.status === 'completed' ? 'Selesai' : 'Menunggu'}
                    </span>`,
                        `<button class="button button-sm button-warning" onclick="viewDetail('${record.rfid_tag}', '${record.id}')">Lihat Detail</button>`
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

    function viewDetail(rfidTag, medicalId) {
        window.location.href = `/scan-patient-detail-medical-record?id=${rfidTag}&medical-id=${medicalId}`;
    }

    // Listen to date range changes
    $(document).ready(function () {
        // $('#datepick').daterangepicker({
        //     locale: {
        //         format: 'YYYY-MM-DD'
        //     }
        // }, function(start, end) {
        //     const startDate = start.format('YYYY-MM-DD');
        //     const endDate = end.format('YYYY-MM-DD');

        //     // Fetch records based on selected date range
        //     fetchMedicalRecords(startDate, endDate);
        // });


        // $('#datepick').daterangepicker({
        //     startDate: start,
        //     endDate: end,
        //     ranges: {
        //         'Today': [moment(), moment()],
        //         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        //         'Last 60 Days': [moment().subtract(60, 'days'), moment()],
        //         'Last 90 Days': [moment().subtract(90, 'days'), moment()],
        //         'Last 120 Days': [moment().subtract(120, 'days'), moment()],
        //         'Last 150 Days': [moment().subtract(150, 'days'), moment()],
        //         'All Time': ['04/01/2021', moment()],
        //     },
        //     locale: {
        //         format: 'YYYY-MM-DD'
        //     }
        // }, function(start, end) {
        //     const startDate = start.format('YYYY-MM-DD');
        //     const endDate = end.format('YYYY-MM-DD');

        //     // Fetch records based on selected date range
        //     fetchMedicalRecords(startDate, endDate);
        // });
        // cb(start, end);

        // Initial fetch without date filter

        if ($('.input-date-predefined').length) {
            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('.input-date-predefined').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));
            }
            $('.input-date-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'Last 60 Days': [moment().subtract(60, 'days'), moment()],
                    'Last 90 Days': [moment().subtract(90, 'days'), moment()],
                    'Last 120 Days': [moment().subtract(120, 'days'), moment()],
                    'Last 150 Days': [moment().subtract(150, 'days'), moment()],
                    'All Time': ['04/01/2021', moment()],
                },
            }, function (start, end) {
                const startDate = start.format('YYYY-MM-DD');
                const endDate = end.format('YYYY-MM-DD');

                fetchMedicalRecords(startDate, endDate);
            });
        }
        fetchMedicalRecords();
    });

</script>

@endsection
