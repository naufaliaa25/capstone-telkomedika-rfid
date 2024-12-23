@extends('layouts.master')

@section('title', 'Registrasi Pasien')

@section('style')
@endsection

@section('content')
<div class="content-body">

    <div class="row justify-content-between align-items-center mb-10">

        <div class="col-12 col-lg-auto mb-20">
            <div class="page-heading">
                <h3>Registrasi Pasien</h3>
            </div>
        </div><!-- Page Heading End -->
    </div><!-- Page Headings End -->

    <div class="row">
        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-head">
                    <h4 class="title">Form Registrasi Pasien</h4>
                </div>
                <div class="box-body">
                    <form id="patient-registration-form">
                        @csrf <!-- CSRF token for security -->
                        <div class="row mbn-20">
                            <div class="col-12 mb-20">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="nim">NIM</label>
                                <input type="text" id="nim" name="nim" class="form-control" placeholder="NIM" required>
                            </div>
                            <div class="col-12 mb-20">
                                <label for="no_telkomedika">Nomor Telkomedika</label>
                                <input type="text" id="no_telkomedika" name="telkomedika_number" class="form-control" placeholder="Nomor Telkomedika" required>
                            </div>
                            <div class="col-12 mb-20">
                                <div class="row mbn-20">
                                    <div class="col-lg-6 mb-20">
                                        <label for="date_of_birth">Tanggal Lahir</label>
                                        <!-- <input type="date" id="date_of_birth" name="date_of_birth" class="form-control input-date-single" placeholder="yyyy-mm-dd" required> -->
                                        <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" 
                                            value="{{ old('date_of_birth', isset($patient) ? $patient->date_of_birth : '') }}" required>

                                    </div><!-- Single Date Picker -->
                                    <div class="col-lg-6 mb-20">
                                        <label for="gender">Jenis Kelamin</label>
                                        <select id="gender" name="gender" class="form-control" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="m">Laki-laki</option>
                                            <option value="f">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
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
    const urlParams = new URLSearchParams(window.location.search);
    const rfid = urlParams.get('id');

    document.getElementById('patient-registration-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);

        const data = {
            rfid_tag: rfid,
        };
        
        formData.forEach((value, key) => {
            data[key] = value;
        });

        axios.post('/api/patients', data)
            .then(response => {
                if (response.data) {
                    alert('Data pasien berhasil disimpan.');
                    this.reset(); 
                    window.location.href = '/scan-patient-list-medical-records?id=' + rfid;
                }
            })
            .catch(error => {
                if (error.response && error.response.data.errors) {
                    let errorMessage = 'Gagal menyimpan data pasien:\n';
                    for (const [key, messages] of Object.entries(error.response.data.errors)) {
                        errorMessage += `${key}: ${messages.join(', ')}\n`;
                    }
                    alert(errorMessage);
                } else {
                    alert('Terjadi kesalahan saat menyimpan data pasien.');
                }
            });
    });

    setTimeout(() => {
        loadingFalse();
    }, 50);
</script>
@endsection
