@extends('layouts.master')

@section('title', 'Pindai Pasien')

@section('style')
@endsection

@section('content')
<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">

        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Pindai Pasien</h3>
            </div>
        </div><!-- Page Heading End -->
    </div><!-- Page Headings End -->

    <div class="row">
        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Tempel Kartu Telekomedika</h4>
                </div>
                <div class="box-body align-self-center justify-content-center">
                    <div class="spinner-grow text-danger" width="3rem" height="3rem">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" width="3rem" height="3rem">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" width="3rem" height="3rem">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" width="3rem" height="3rem">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-grow text-danger" width="3rem" height="3rem">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationRegisteredUserModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kartu terdeteksi</h5>
                    <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="detected-card">
                    <p>Kartu ini adalah milik <b>Naufalia Azzahra</b>, apakah ingin melanjutkan?</p>
                </div>
                <div class="modal-footer">
                    <button class="button button-danger cancelAppointment" data-dismiss="modal">Batal</button>
                    <button id="confirmAppointment" class="button button-info">Lanjut</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationUnregisteredUserModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kartu terdeteksi</h5>
                    <button class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p>Kartu ini belum teregistrasi, lakukan registrasi terlebih dahulu</p>
                </div>
                <div class="modal-footer">
                    <button class="button button-danger cancelAppointment" data-dismiss="modal">Batal</button>
                    <button id="confirmRegisterUser" class="button button-info">Lanjut</button>
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

    const role = "{{ Auth::user()->role }}";
    let selectedLog = null;
    document.addEventListener('DOMContentLoaded', function () {
        let fetchInterval;

        const fetchRFIDLogs = () => {
            axios.get(`/api/rfid/logs/${role}`)
                .then(res => {
                    const response = res.data;
                    if (response.data) {
                        console.log('RFID Logs:', response.data);
                        handleRFIDLogs(response.data);

                        if (fetchInterval) {
                            clearInterval(fetchInterval);
                            console.log('Interval cleared.');
                        }
                    } else {
                        console.log('No new RFID logs');
                    }
                })
                .catch(error => {
                    console.error('Error fetching RFID logs:', error);
                });
        };

        fetchInterval = setInterval(fetchRFIDLogs, 3000);

        fetchRFIDLogs();
    });

    const handleRFIDLogs = (log) => {
        selectedLog = log
        if (log.name) {
            $('#detected-card').html(`Kartu ini adalah milik <b>${log.name}</b>, apakah ingin melanjutkan?`)
            $('#confirmationRegisteredUserModal').modal('show');
        } else {
            if (role == 'receptionist') {
                $('#confirmationUnregisteredUserModal').modal('show');
            }
        }
    };

    const completeLog = (logId) => {
        axios.put(`/api/rfid/logs/${logId}`)
            .then(res => {
                console.log(res.data);
            })
            .catch(error => {
                console.error(error);
            });
    }

    $('#confirmRegisterUser').click(() => {
        completeLog(selectedLog.id)
        $('#confirmationUnregisteredUserModal').modal('hide');
        window.location.href = '/scan-patient-registration?id=' + selectedLog.rfid_tag;
    })

    $('#confirmAppointment').click(() => {
        completeLog(selectedLog.id)
        $('#confirmationRegisteredUserModal').modal('hide');
        window.location.href = '/scan-patient-list-medical-records?id=' + selectedLog.rfid_tag;
    })

    $('.cancelAppointment').click((e) => {
        e.preventDefault()
        completeLog(selectedLog.id)
    })
</script>

@endsection
