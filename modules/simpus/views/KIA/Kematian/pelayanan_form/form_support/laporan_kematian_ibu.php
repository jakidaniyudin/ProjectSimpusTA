 <form id="formLaporanKematianIbu">
     <div class="card" style="padding-top: 20px;">
         <div class="card-header">
             <h4>Pengiriman data Lokasi Kematian</h4>
         </div>
         <hr style="border: 1px solid black;">
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="form-group">
                         <label for="tempatMeninggal">Tempat Meninggal</label>
                         <select name="tempatMeninggal" id="tempatMeninggal" class="form-control">
                             <option value="LT000002">Tempat Meninggal Faskes
                             </option>
                             <option value="LT000003">Tempat Meninggal Non
                                 Faskes</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label for="alamatKematian">Alamat Kematian</label>
                         <textarea name="alamatKematian" class="form-control" id="alamatKematian"></textarea>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="card">
         <div class="card-body">
             <div class="row">
                 <div class="col-lg-6">
                     <h6 class="text-bold">Riwayat Kematian Ibu</h6>

                     <div class="form-group">
                         <div class="row">
                             <div class="col-sm-4">
                                 <label for="">Umur saat Meninggal</label>
                                 <input type="number" class="form-control" id="year">
                             </div>
                             <div class="col-sm-8">
                                 <p class="text-start" style="margin-top: 30px;">Year</p>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                        <label for="tanggalKematian">Tanggal dan Jam Kematian</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="date" name="tanggalKematian" id="tanggalMeninggal"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="time" name="waktuKematian" id="waktuMeninggal"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>                        
                     <div class="form-group">
                         <label for="masaKematian">Masa terjadi kematian ibu</label>
                         <select name="masaKematian" id="masaKematian" class="form-control">
                             <option value="1156679005">
                                 Saat Hamil
                             </option>
                             <option value="1156682000">
                                 Saat Melahirkan
                             </option>
                             <option value="255410009">
                                 Nifas/Pasca Keguguran</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <div class="row">
                             <div class="col-lg-12">
                                 <label>Code Dugaan Kematian Ibu</label>
                                 <div class="row">
                                     <div class="col-sm-2">
                                         <?php
                                            print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                            print form_input('codeFormKematianIbu', '', 'class="form-control input-sm" id="dugaanSebabKematian" required readonly="readonly"');
                                            ?>
                                     </div>
                                     <div class="col-sm-10">
                                         <div class="input-group input-group-sm">
                                             <?php
                                                print form_input('formKematianIbuDisplay', '', 'class="form-control input-sm" id="display_sebab_kematian" readonly="readonly"');
                                                ?>
                                             <div class="input-group-btn">
                                                 <button type="button" id='cari_kematian_ibu'
                                                     class="btn btn-info btn-flat">Cari</button>
                                                 <button type="button" id='del_kematian_ibu'
                                                     class="btn btn-danger btn-flat">Del</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-12">
                                 <label>Deskripsi Dugaan Kematian Ibu</label>
                                 <textarea class="form-control" name="dugaan_detail_ibu" id="dugaan_detail_ibu" rows="3"
                                     placeholder="Masukkan deskripsi..."></textarea>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="jenisTempatMeninggal">Jenis Tempat Meninggal</label>
                         <select name="jenisTempatMeninggal" id="jenisTempatMeninggal" class="form-control">
                             <option value="OT000006">RS Pemerintah</option>
                             <option value="OT000007">RS Swasta</option>
                             <option value="102">Puskesmas</option>
                             <option value="OT000002">Puskesmas Pembantu</option>
                             <option value="OT000010">Klinik Medis Utama</option>
                             <option value="OT000011">Klinik Medis Pratama</option>
                             <option value="101">Dokter Praktik Mandiri
                             </option>
                             <option value="OT000004">Bidan Praktik Mandiri</option>
                             <option value="OT000008">Rumah Bersalin</option>
                             <option value="OT000001">Poskesdes/Polindes/Poskes
                             </option>
                             <option value="264362003">Rumah</option>
                             <option value="LT000007">Rumah
                                 Dukun/Penolong tradisional</option>
                             <option value="LT000008">Dalam
                                 perjalanan dari rumah/masyarakat</option>
                             <option value="LT000009">Dalam perjalanan ke
                                 faskes lain</option>
                             <option value="LT000010">Lainya</option>
                             <option value="LT000011">Belum tahu</option>
                         </select>
                         <label for="deskripsiLainya">Deskripsi (Jika Lainya)</label>
                         <textarea name="deskripsiLainya" class="form-control" id="deskripsiLainya"></textarea>
                     </div>
                     <div class="form-group">
                         <div class="row">
                             <div class="col-sm-4">
                                 <label for="gravida">Gravida</label>
                                 <select name="gravida" id="gravida" class="form-control">
                                     <option value="0">0</option>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                     <option value="4">4</option>
                                     <option value="5">5</option>
                                     <option value="6">6</option>
                                     <option value="7">7</option>
                                     <option value="8">8</option>
                                     <option value="9">9</option>
                                     <option value="10">10</option>
                                 </select>
                             </div>
                             <div class="col-sm-4">
                                 <label for="partus">Partus</label>
                                 <select name="partus" id="partus" class="form-control">
                                     <option value="0">0</option>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                     <option value="4">4</option>
                                     <option value="5">5</option>
                                     <option value="6">6</option>
                                     <option value="7">7</option>
                                     <option value="8">8</option>
                                     <option value="9">9</option>
                                     <option value="10">10</option>
                                 </select>
                             </div>
                             <div class="col-sm-4">
                                 <label for="abortus">Abortus</label>
                                 <select name="abortus" id="abortus" class="form-control">
                                     <option value="0">0</option>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                     <option value="4">4</option>
                                     <option value="5">5</option>
                                     <option value="6">6</option>
                                     <option value="7">7</option>
                                     <option value="8">8</option>
                                     <option value="9">9</option>
                                     <option value="10">10</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="usiaKehamilan">Usia Kehamilan</label>
                         <div class="row">
                             <div class="col-sm-6">
                                 <input type="number" class="form-control" id="usiaKehamilan">
                             </div>
                             <div class="col-sm-6">
                                 <p class="text-start text-bold">Minggu</p>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label for="periodeNifas">Periode Nifas</label>
                         <input type="number" class="form-control" id="periodeNifas">
                     </div>
                     <div class="form-group">
                         <button id="simpanKematianIbuButton" type="button"
                             class="btn btn-success btn-block btn-sm">simpan</button>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </form>

 <!-- Modal -->
 <div class="modal fade" id="confirmationModalIbu" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Apakah Anda yakin ingin mengedit data?
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                 <button type="button" class="btn btn-primary" id="confirmEditButton">Ya, Edit</button>
             </div>
         </div>
     </div>
 </div>

 <script>
     $(document).ready(function() {
         const form = $('#formLaporanKematianIbu');
         const saveButton = $('#simpanKematianIbuButton');
         const inputs = form.find('input, select, textarea');
         const localStorageKey = 'KematianIbu';
         const buttonMenuIbu = $('#custom-tabs-four-profile-tab');

         $('#cari_kematian_ibu').on('click', function(event) {
             event.preventDefault();
             cari_kematian_ibu('1');
         })
         $('#del_kematian_ibu').on('click', function(event) {
             event.preventDefault();
             del_kematian_ibu('1');
         })

         function cari_kematian_ibu(n) {

             ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/popUpKematianIbu/' + n);

         }

         function del_kematian_ibu(n) {

             $('input[name=codeFormKematianIbu]').val('');
             $('input[name=formKematianIbuDisplay]').val('');

         }


         // Fungsi untuk menyimpan data ke localStorage
         function saveToLocalStorage() {
             const existingDataKematianIbu = JSON.parse(localStorage.getItem(localStorageKey)) ?? {};
             const updatedData = {
                 ...existingDataKematianIbu
             };
             inputs.each(function() {
                 const inputName = $(this).attr('id');
                 const inputValue = $(this).val();

                 if (updatedData[inputName]) {
                     updatedData[inputName].value = inputValue
                 } else {
                     updatedData[inputName] = {
                         value: inputValue
                     };
                 }
             });
             if (Object.keys(updatedData).length === 0) {
                 swal('Form Invalid', 'Data tidak boleh kosong','warning');
             } else {
                 localStorage.setItem(localStorageKey, JSON.stringify(updatedData));
                 swal('Data berhasil disimpan', '', 'success');
             }


         }

         // Fungsi untuk memuat data dari localStorage
         function loadFromLocalStorage() {
             const savedData = localStorage.getItem(localStorageKey);
             console.log(savedData);

             if (savedData != 'null') {
                 console.log('aku bisa masuk');
                 try {
                     const formData = JSON.parse(savedData);
                     console.log('Data loaded from localStorage:', formData);

                     inputs.each(function() {
                         const key = $(this).attr('id');
                         // Hanya set value jika data ada dan tidak null/undefined
                         if (formData.hasOwnProperty(key) && formData[key] != null) {
                             $(this).val(formData[key].value);
                         }
                     });


                     disableForm();
                     saveButton.text('Edit').removeClass('btn-success').addClass('btn-secondary');

                 } catch (e) {
                     console.error('Error parsing localStorage data:', e);
                     // Biarkan form tetap kosong jika parsing error
                 }
             } else {
                 
                 // Tidak melakukan apa-apa, biarkan form dalam state default-nya
             }
         }

         // Fungsi untuk menonaktifkan form
         function disableForm() {
             inputs.prop('disabled', true);
         }

         // Fungsi untuk mengaktifkan form
         function enableForm() {
             inputs.prop('disabled', false);
         }
        
         function validateFormKematianIbu() {
            const tempatMeninggal = document.getElementById("tempatMeninggal").value;
            const alamatKematian = document.getElementById("alamatKematian").value.trim();
            const umurMeninggal = parseInt(document.getElementById("year").value);
            const tanggalMeninggal = document.getElementById("tanggalMeninggal").value;
            const waktuMeninggal = document.getElementById("waktuMeninggal").value;

            const masaKematian = document.getElementById("masaKematian").value;
            const dugaanSebabKematian = document.getElementById("dugaanSebabKematian").value.trim();
            const jenisTempatMeninggal = document.getElementById("jenisTempatMeninggal").value;
            const deskripsiLainya = document.getElementById("deskripsiLainya").value.trim();
            const usiaKehamilan = parseInt(document.getElementById("usiaKehamilan").value);
            const periodeNifas = parseInt(document.getElementById("periodeNifas").value);

            // Tempat Meninggal wajib dipilih
            if (!tempatMeninggal) {
                swal("Error", "Tempat meninggal harus dipilih.", "error");
                return false;
            }


            // Alamat Kematian wajib diisi
            if (!alamatKematian) {
                swal("Error", "Alamat kematian harus diisi.", "error");
                return false;
            }

            // Umur saat meninggal wajib angka dan realistis (0-120)
            if (isNaN(umurMeninggal)) {
                swal("Error", "Umur saat meninggal harus diisi dengan angka.", "error");
                return false;
            }
            if (umurMeninggal < 0 || umurMeninggal > 120) {
                swal("Error", "Umur saat meninggal harus antara 0 sampai 120 tahun.", "error");
                return false;
            }

            // Tanggal meninggal wajib diisi dan valid
            if (!tanggalMeninggal) {
                swal("Error", "Tanggal meninggal harus diisi.", "error");
                return false;
            }
            
            if (!waktuMeninggal) {
                swal("Error", "Waktu meninggal harus diisi.", "error");
                return false;
            }

            const tanggalWaktuGabung = new Date(`${tanggalMeninggal}T${waktuMeninggal}`);
            const sekarang = new Date();

            // Validasi jika waktu meninggal melebihi waktu sekarang
            if (tanggalWaktuGabung > sekarang) {
                swal("Error", "Waktu meninggal tidak boleh melebihi waktu saat ini.", "error");
                return false;
            }

            if (isNaN(Date.parse(tanggalMeninggal))) {
                swal("Error", "Tanggal meninggal tidak valid.", "error");
                return false;
            }

            // Masa Kematian wajib dipilih
            if (!masaKematian) {
                swal("Error", "Masa terjadi kematian ibu harus dipilih.", "error");
                return false;
            }

            // Code Dugaan Kematian Ibu wajib diisi
            if (!dugaanSebabKematian) {
                swal("Error", "Kode dugaan kematian ibu harus diisi.", "error");
                return false;
            }

            // Jika jenis tempat meninggal "Lainya", deskripsi wajib diisi
            if (jenisTempatMeninggal === "LT000010" && !deskripsiLainya) {
                swal("Error", "Deskripsi untuk jenis tempat meninggal 'Lainya' harus diisi.", "error");
                return false;
            }

            // Usia kehamilan jika diisi harus angka dan logis (0-50 minggu)
            if (!isNaN(usiaKehamilan)) {
                if (usiaKehamilan < 0 || usiaKehamilan > 50) {
                    swal("Error", "Usia kehamilan harus antara 0 sampai 50 minggu.", "error");
                    return false;
                }
            }

            // Periode nifas jika diisi harus angka dan logis (0-90 hari)
            if (!isNaN(periodeNifas)) {
                if (periodeNifas < 0 || periodeNifas > 90) {
                    swal("Error", "Periode nifas harus antara 0 sampai 90 hari.", "error");
                    return false;
                }
            }

            return true;
        }

         // Event listener untuk tombol simpan/edi
         saveButton.on('click', function() {
             if (saveButton.text() === 'simpan') {
                if (validateFormKematianIbu()) {
                    saveToLocalStorage(); // Simpan ke localStorage
                    disableForm();
                    saveButton.text('Edit').removeClass('btn-success').addClass('btn-secondary');
                    
                   
                }
              
             } else {
                 $('#confirmationModalIbu').modal('show');
             }
         });

         // Event listener untuk tombol konfirmasi edit
         $('#confirmEditButton').on('click', function() {
             enableForm();
             saveButton.text('simpan').removeClass('btn-secondary').addClass('btn-success');
             $('#confirmationModalIbu').modal('hide');
         });

         // Memuat data dari localStorage saat halaman dimuat
         loadFromLocalStorage();

     });
 </script>