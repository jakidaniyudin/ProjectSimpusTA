<br>
<div class="card">
    <form id="form-kala4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Waktu Ke</label>
                        <select id="jam" class="form-control">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Waktu</label>
                        <input class="form-control" id="waktu" type="time" placeholder="waktu kala 4...">
                    </div>
                    <div class="form-group">
                        <label>Tekanan Darah</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" id="tekanan-darah" type="number"
                                    placeholder="sistol/diastol">
                            </div>
                            <div class="col-sm-6">
                                mmHg
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Nadi</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" id="nadi" type="number" placeholder="nilai nandi...">
                            </div>
                            <div class="col-sm-6">
                                /menit
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Tinggi Fundus Unteri</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" id="fundus" type="number" placeholder="nilai fundus...">
                            </div>
                            <div class="col-sm-6">
                                cm
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label>Kontraksi Uterus</label>
                        <input class="form-control" id="kontraksi" type="text" placeholder="jelaskan">
                    </div>
                    <div class="form-group">
                        <label>Kandung Kemih</label>
                        <input class="form-control" id="kandung-kemi" type="text" placeholder="jelaskan">
                    </div>
                    <div class="form-group">
                        <label>Pendarahan</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <input class="form-control" id="pendarahan" type="number" placeholder="pendarahan...">
                            </div>
                            <div class="col-sm-6">
                                ml
                            </div>
                        </div>

                    </div>
                    <div class="form-group mt-2">
                        <button id="simpan-table" class="btn btn-success btn-sm btn-block">simpan</button>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="table-responsive p-0">
                    <table id="table-kala4" class="table  table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Jam Ke</th>
                                <th>Waktu</th>
                                <th>Tekanan Darah</th>
                                <th>Nadi</th>
                                <th>Tinggi Fundus</th>
                                <th>Kontraksi Uterus</th>
                                <th>Kandung Kemih</th>
                                <th>Pendarahan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data dari localStorage akan dimasukkan di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Masalah Kala IV</label>
                        <textarea class="form-control" id="masalah-kala4" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Penatalaksanaan Masalah</label>
                        <textarea class="form-control" id="penatalaksanaan-masalah" rows="3"
                            placeholder="Enter ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Hasilnya</label>
                        <textarea class="form-control" id="hasilKala4" rows="3" placeholder="Hasilnya ..."></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <button id="simpan-semua" class="btn btn-success btn-sm btn-block">Simpan Semua</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<!-- Modal Konfirmasi Edit -->
<div class="modal fade" id="editModalKala4" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengedit data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="button" class="btn btn-primary" id="confirm-edit">Ya</button>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    const storageKeyAtas = 'dataFormAtas';
    const storageKeyBawah = 'dataFormBawah';
    let dataAtas = JSON.parse(localStorage.getItem(storageKeyAtas)) || [];
    console.log('ini data dari kala4 detail');
    console.log(dataAtas);

    // Inisialisasi data saat halaman dimuat
    renderTable();
    populateFormBawah();


    function validateTableForm() {
        const jam = document.getElementById('jam').value;
        const waktu = document.getElementById('waktu').value;
        const tekananDarah = document.getElementById('tekanan-darah').value;
        const nadi = document.getElementById('nadi').value;
        const fundus = document.getElementById('fundus').value;
        const kontraksi = document.getElementById('kontraksi').value.trim();
        const kandungKemih = document.getElementById('kandung-kemi').value.trim();
        const pendarahan = document.getElementById('pendarahan').value;

        // Validasi kosong
        if (!waktu) {
            swal("Error", "Waktu observasi harus diisi.", "error");
            return false;
        }
        if (!tekananDarah) {
            swal("Error", "Tekanan darah harus diisi.", "error");
            return false;
        }
        if (!nadi) {
            swal("Error", "Nadi harus diisi.", "error");
            return false;
        }
        if (!fundus) {
            swal("Error", "Tinggi fundus harus diisi.", "error");
            return false;
        }
        if (!kontraksi) {
            swal("Error", "Kontraksi uterus harus dijelaskan.", "error");
            return false;
        }
        if (!kandungKemih) {
            swal("Error", "Kandung kemih harus dijelaskan.", "error");
            return false;
        }
        if (!pendarahan) {
            swal("Error", "Pendarahan harus diisi.", "error");
            return false;
        }

        // Parsing nilai numerik (gunakan Number atau parseFloat)
        const tekananDarahValue = Number(tekananDarah);
        const nadiValue = Number(nadi);
        const fundusValue = Number(fundus);
        const pendarahanValue = Number(pendarahan);

        // Validasi jika input bukan angka
        if (isNaN(tekananDarahValue) || isNaN(nadiValue) || isNaN(fundusValue) || isNaN(pendarahanValue)) {
            swal("Error", "Masukkan nilai numerik yang valid.", "error");
            return false;
        }

        // Validasi nilai tidak wajar
        if (tekananDarahValue < 40 || tekananDarahValue > 250) {
            swal("Error", "Tekanan darah harus berada antara 40 - 250 mmHg.", "error");
            return false;
        }
        if (nadiValue < 30 || nadiValue > 200) {
            swal("Error", "Nadi harus bernilai antara 30 - 200 /menit.", "error");
            return false;
        }
        if (fundusValue < 0 || fundusValue > 50) {
            swal("Error", "Tinggi fundus harus berada antara 0 - 50 cm.", "error");
            return false;
        }
        if (pendarahanValue < 0 || pendarahanValue > 1000) {
            swal("Error", "Pendarahan harus berada antara 0 - 1000 ml.", "error");
            return false;
        }

        return true;
    }


    function validateSummaryForm() {
        const masalah = document.getElementById('masalah-kala4').value.trim();
        const penatalaksanaan = document.getElementById('penatalaksanaan-masalah').value.trim();
        const hasil = document.getElementById('hasilKala4').value.trim();

        if (!masalah || !penatalaksanaan || !hasil) {
            swal("Error", "Semua kolom ringkasan (masalah, penatalaksanaan, hasil) harus diisi!", "error");
            return false;
        }

        return true;
    }


    // Menyimpan data dari form di atas tabel ke localStorage
    $('#simpan-table').on('click', function(e) {
        e.preventDefault();
        if (validateTableForm()) {
            let saveDataDetail = {};
            try {
                const raw = localStorage.getItem(storageKeyAtas);

                if (raw && raw !== 'undefined') {
                    const parsed = JSON.parse(raw);
                    if (parsed && typeof parsed === 'object' && !Array.isArray(parsed)) {
                        saveDataDetail = parsed;
                    }
                }
            } catch (e) {
                console.warn('LocalStorage rusak, inisialisasi ulang:', e);
                saveDataDetail = {};
            }

            const waktuKe = $('#jam').val();
            const keyName = `waktuKe${waktuKe}`;

            const data = {
                waktu: $('#waktu').val() || '',
                tekananDarah: $('#tekanan-darah').val() || '',
                nadi: $('#nadi').val() || '',
                tinggiFundus: $('#fundus').val() || '',
                kontraksiUterus: $('#kontraksi').val() || '',
                kandungKemih: $('#kandung-kemi').val() || '',
                pendarahan: $('#pendarahan').val() || ''
            };

            const existingEntry = saveDataDetail[keyName] || {};

            // Jika tidak ada id (misalnya backend belum kirim), kita biarkan kosong/null
            const id = existingEntry.id || null;

            // Simpan/update data dengan id jika ada
            saveDataDetail[keyName] = {
                ...(id ? {
                    id
                } : {}),
                value: data
            };

            // Simpan ke localStorage
            localStorage.setItem(storageKeyAtas, JSON.stringify(saveDataDetail));

            renderTable();
            swal('berhasil!!','berhasil tersimpan pada local','success');
        }

      
    });



    // Menghapus data dari tabel dan localStorage
    $(document).on('click', '.btn-delete', function() {
        const key = $(this).data('key'); // ambil key dari tombol, misalnya "waktuKe2"
        const raw = localStorage.getItem(storageKeyAtas);
        if (!raw) return;

        try {
            const saveData = JSON.parse(raw);
            if (saveData.hasOwnProperty(key)) {
                delete saveData[key]; // hapus berdasarkan key
                localStorage.setItem(storageKeyAtas, JSON.stringify(saveData));
                renderTable(); // re-render table setelah delete
                alert(`Data ${key} berhasil dihapus!`);
            } else {
                console.warn(`Key ${key} tidak ditemukan dalam data.`);
            }
        } catch (e) {
            console.error('Error saat delete data:', e);
        }
    });


    // Menyimpan data dari form di bawah tabel ke localStorage
    $('#simpan-semua').on('click', function(e) {
        e.preventDefault();
        if ($(this).text() === 'Edit') {
            $('#editModalKala4').modal('show'); // Tampilkan modal konfirmasi edit
            return;
        }


        if (validateSummaryForm()) {
            let saveDataDetail = JSON.parse(localStorage.getItem(storageKeyBawah)) || {};

            let dataAtas = JSON.parse(localStorage.getItem(storageKeyAtas)) || [];

            // Hitung jumlah entri yang sudah ada (tanpa menghitung properti dengan ID kalau ada)
            const existingKeys = Object.keys(dataAtas).filter(key => dataAtas[key] &&
                dataAtas[key].value);


            if (existingKeys.length > 3) {
                swal('Form Invalid', 'Maks Pengisian Kala 4 Hanya 3 kali','warning')
                return; // Skip penyimpanan
            }

            const data = {
                masalahKalaIV: $('#masalah-kala4').val(),
                penatalaksanaanMasalah: $('#penatalaksanaan-masalah').val(),
                hasil: $('#hasilKala4').val()
            };

            console.log('ini data yang kosong: ' + data.hasil);

            for (const key in data) {
                if (saveDataDetail[key]) {
                    // Jika key sudah ada, perbarui value-nya saja
                    saveDataDetail[key].value = data[key];
                } else {
                    // Jika key belum ada, buat objek baru tanpa id
                    saveDataDetail[key] = {
                        value: data[key]
                    };
                }
            }

            localStorage.setItem(storageKeyBawah, JSON.stringify(saveDataDetail));
            
            populateFormBawah(); // Update form dengan data terbaru setelah menyimpan
            swal('Berhasil Disimpan', 'Data Kala 4 Berhasil Disimpan di local','success')
        }

     
     
    });


    // Mengaktifkan form dan mengubah tombol Edit kembali menjadi Simpan Semua
    $('#confirm-edit').on('click', function() {
        $('#form-kala4 :input').prop('disabled', false);
        $('#simpan-semua').prop('disabled', false);
        $('#simpan-semua').text('Simpan Semua').removeClass('btn-primary').addClass('btn-success');
        $('#editModalKala4').modal('hide');
    });

    // Fungsi untuk merender tabel dari localStorage
    function renderTable() {
        let dataAtas = {};
        const raw = localStorage.getItem(storageKeyAtas);
        console.log('ini data yang sudah jadi');
        console.log(raw);

        try {
            if (raw && raw !== 'undefined') {
                const parsed = JSON.parse(raw);
                if (parsed && typeof parsed === 'object' && !Array.isArray(parsed)) {
                    dataAtas = parsed;
                }
            }
        } catch (e) {
            console.error('Error parsing localStorage data:', e);
        }

        console.log('ini data yang sudah jadi');
        console.log(dataAtas);

        $('#simpan-table').prop('disabled', Object.keys(dataAtas).length >= 3);

        const tableBody = $('#table-kala4 tbody');
        tableBody.empty();

        Object.entries(dataAtas).forEach(([key, entry], index) => {
            const data = entry?.value || {};

            const row = `
            <tr>
                <td>${key}</td>
                <td>${data.waktu || ''}</td>
                <td>${data.tekananDarah|| ''}</td>
                <td>${data.nadi || ''}</td>
                <td>${data.tinggiFundus || ''}</td>
                <td>${data.kontraksiUterus || ''}</td>
                <td>${data.kandungKemih || ''}</td>
                <td>${data.pendarahan || ''}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-delete" data-key="${key}">
                        Delete
                    </button>
                </td>
            </tr>
        `;
            tableBody.append(row);
        });
    }






    // Fungsi untuk mengisi form di bawah tabel dari localStorage
    function populateFormBawah() {
        const dataBawah = JSON.parse(localStorage.getItem(storageKeyBawah)) || {};
        console.log('ini data bawah');
        console.log(dataBawah);

        const isDataValid = Object.keys(dataBawah).length > 0;

        if (isDataValid) {
            $('#form-kala4 :input').prop('disabled', true);
            $('#simpan-semua').prop('disabled', false);
            $('#simpan-semua').text('Edit').removeClass('btn-success').addClass('btn-secondary');
        } else {
            $('#form-kala4 :input').prop('disabled', false);
            $('#simpan-semua').prop('disabled', false);
            $('#simpan-semua').text('Simpan').removeClass('btn-secondary').addClass('btn-success');
        }

        $('#masalah-kala4').val(dataBawah.masalahKalaIV?.value || '');
        $('#penatalaksanaan-masalah').val(dataBawah.penatalaksanaanMasalah?.value || '');
        $('#hasilKala4').val(dataBawah.hasil?.value || '');
    }

});
</script>