<div class="card card-primary card-outline card-tabs" style="padding-top: 20px;">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab-bayi" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home"
                    role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Kematian Bayi Lahir Mati</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile1-tab" data-toggle="pill"
                    href="#custom-tabs-four-profile1" role="tab" aria-controls="custom-tabs-four-profile1"
                    aria-selected="false">Kematian Bayi Lahir Hidup</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <!-- Tab Kematian Bayi Lahir Mati -->
            <div class="tab-pane fade in" id="custom-tabs-four-home" role="tabpanel"
                aria-labelledby="custom-tabs-four-home-tab">
                <form id="formLahirMati">
                    <div class="card" style="padding-top: 30px;">
                        <div class="card-header">
                            <p class="text-bold">Riwayat Kematian Bayi Lahir Mati</p>
                        </div>
                        <hr style="border:1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="jenisKematian">Jenis Kematian Bayi / Janin</label>
                                                <select name="jenisKematian" id="jenisKematian" class="form-control">
                                                    <option value="237361005">
                                                        Lahir Mati
                                                    </option>
                                                    <option value="237362003">
                                                        Lahir Mati Saat Persalinan
                                                    </option>
                                                    <option value="276506001">Kematian neonatus</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggalKematian">Tanggal dan Jam Kematian</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="date" name="tanggalKematian" id="tanggalKematian"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="time" name="jamKematian" id="jamKematian"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Code Dugaan Kematian Bayi Lahir Mati</label>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php
                                                                print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                                print form_input('formBayiLahirMati', '', 'class="form-control input-sm" id="formBayiLahirMati" required readonly="readonly"');
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-sm">
                                                                    <?php
                                                                    print form_input('formBayiLahirMatiDisplay', '', 'class="form-control input-sm" id="formBayiLahirMatiDisplay" readonly="readonly"');
                                                                    ?>
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            id='cari_kematian_lahir_mati'
                                                                            class="btn btn-info btn-flat">Cari</button>
                                                                        <button type="button"
                                                                            id='del_kematian_lahir_mati'
                                                                            class="btn btn-danger btn-flat">Del</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Deskripsi Dugaan Kematian</label>
                                                        <textarea class="form-control" name="dugaan_detail_lahir_mati"
                                                            id="dugaanDetailLahirMati" rows="3"
                                                            placeholder="Masukkan deskripsi..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Kondisi Ibu Mempengaruhi Janin</label>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php
                                                                print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                                print form_input('formPengaruhIbuLahirMati', '', 'class="form-control input-sm" id="formPengaruhIbuLahirMati" required readonly="readonly"');
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-sm">
                                                                    <?php
                                                                    print form_input('formPengaruhIbuLahirMatiDisplay', '', 'class="form-control input-sm" id="formPengaruhIbuLahirMatiDisplay" readonly="readonly"');
                                                                    ?>
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            id='cari_kondisi_ibu_lahir_mati'
                                                                            class="btn btn-info btn-flat">Cari</button>
                                                                        <button type="button"
                                                                            id='del_kondisi_ibu_lahir_mati'
                                                                            class="btn btn-danger btn-flat">Del</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Deskripsi Ibu Mempengaruhi Janin</label>
                                                        <textarea class="form-control"
                                                            name="detail_pengaruh_ibu_lahir_mati"
                                                            id="detailPengaruhIbuLahirMati" rows="3"
                                                            placeholder="Masukkan deskripsi..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tempatMeninggal">Tempat Meninggal</label>
                                                <select name="tempatMeninggal" id="tempatMeninggal"
                                                    class="form-control">
                                                    <option value="LT000002">Tempat Meninggal Faskes
                                                    </option>
                                                    <option value="LT000003">Tempat Meninggal Non
                                                        Faskes</option>
                                                </select>
                                                <label for="alamatMeninggal">Alamat Meninggal (Faskes / Non
                                                    Faskes)</label>
                                                <textarea name="alamatMeninggal" id="alamatMeninggal"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="jenisTempatMeninggal">Jenis Tempat Meninggal</label>
                                                <select name="jenisTempatMeninggal" id="jenisTempatMeninggal"
                                                    class="form-control">
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
                                                <textarea name="deskripsiLainya" id="deskripsiLainya"
                                                    class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="maserasi">Maserasi ?</label>
                                                <select name="maserasi" id="maserasi" class="form-control">
                                                    <option value="OV000047">Tidak ada maserasi</option>
                                                    <option value="OV000048">Maserasi Tingkat Satu</option>
                                                    <option value="OV000049">Maserasi Tingkat Dua</option>
                                                    <option value="OV000050">Maserasi Tingkat Tiga</option>
                                                    <option value="OV000051">Belum Tahu Ada
                                                        Tidaknya Maserasi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding-top:30px;">
                        <div class="card-header">
                            <p class="text-bold">Riwayat Persalinan</p>
                        </div>
                        <hr style="border:1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Kelainan Bawaan</label>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php
                                                                print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                                print form_input('formKelainanBawaanLahirMati', '', 'class="form-control input-sm" id="formKelainanBawaanLahirMati" required readonly="readonly"');
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-sm">
                                                                    <?php
                                                                    print form_input('formKelainanBawaanLahirMatiDisplay', '', 'class="form-control input-sm" id="formKelainanBawaanLahirMatiDisplay" readonly="readonly"');
                                                                    ?>
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            id='cari_kelainan_bawaan_lahir_mati'
                                                                            class="btn btn-info btn-flat">Cari</button>
                                                                        <button type="button"
                                                                            id='del_kelainan_bawaan_lahir_mati'
                                                                            class="btn btn-danger btn-flat">Del</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Deskripsi Kelainan Bawaan</label>
                                                        <textarea class="form-control" name="deskripsi"
                                                            id="deskripsiKelainanBawaan" rows="3"
                                                            placeholder="Masukkan deskripsi..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="beratLahir">Berat Saat Bayi Lahir</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="text" name="beratLahir" id="beratLahir"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <p class="text-bold">g</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="janinMeninggal">Janin Yang Meninggal untuk Bayi
                                                    Kembar</label>
                                                <select name="janinMeninggal" id="janinMeninggal" class="form-control">
                                                    <option value="OV000398">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan pertama
                                                    </option>
                                                    <option value="OV000399">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan kedua
                                                    </option>
                                                    <option value="OV000400">
                                                        JJanin yang meninggal adalah janin yang lahir pada urutan ketiga
                                                    </option>
                                                    <option value="OV000395">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan keempat
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="caraPersalinan">Cara Persalinan</label>
                                                <select name="caraPersalinan" id="caraPersalinan" class="form-control">
                                                    <option value="289259007">
                                                        Persalinan pervaginam
                                                    </option>
                                                    <option value="200144004">
                                                        Persalinan perabdominam
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding-top:30px;">
                        <div class="card-header">
                            <p class="text-bold">Riwayat Kehamilan</p>
                        </div>
                        <hr style="border:1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="usiaKehamilanLahirMati">Usia Kehamilan Dalam Minggu</label>
                                                <input type="number" class="form-control" name="usiaKehamilanLahirMati"
                                                    id="usiaKehamilanLahirMati" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="janinMeninggal">Jenis Kehamilan
                                                    Kembar</label>
                                                <select name="jenis Kehamilan" id="JenisKehamilan" class="form-control">
                                                    <option value="237244005">
                                                        Single pregnancy
                                                    </option>
                                                    <option value="65147003">
                                                        Kembar 2
                                                    </option>
                                                    <option value="64254006">
                                                        Kembar 3
                                                    </option>
                                                    <option value="OV000394">
                                                        Kehamilan Ganda Empat atau Lebih
                                                    </option>
                                                </select>
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
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="caraPersalinan">Jumlah Anak Hidup</label>
                                                <input type="number" class="form-control" name="anak_hidup"
                                                    id="anakHidup" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="padding-top:30px;">
                        <div class="card-header">
                            <p class="text-bold text-xl">Data Ibu</p>
                        </div>
                        <hr style="border:1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="umurIbu">Umur Ibu Ketika Bayi Meninggal</label>
                                                <input type="text" name="umurIbu" id="umurIbu" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="lamaTinggal">Lama Tinggal</label>
                                                <select name="lamaTinggal" id="lamaTinggal" class="form-control">
                                                    <option value="6 bulan ke atas">6 bulan ke atas</option>
                                                    <option value="Di bawah 6 bulan">Di bawah 6 bulan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" id="simpanLahirMati"
                                        class="btn btn-sm btn-block btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Tab Kematian Bayi Lahir Hidup -->
            <div class="tab-pane fade" id="custom-tabs-four-profile1" role="tabpanel"
                aria-labelledby="custom-tabs-four-profile1-tab">
                <form id="formLahirHidup">
                    <div class="card" style="padding-top: 30px;">
                        <div class="card-header">
                            <p class="text-bold">Riwayat Kematian Bayi Lahir Hidup</p>
                        </div>
                        <hr style="border:1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="lokasiKematianLahirHidup">Lokasi Tempat Bersalin</label>
                                                <input type="text" name="lokasi_kematian_lahir_hidup"
                                                    class="form-control" id="lokasiKematianLahirHidup">
                                            </div>
                                            <div class="form-group">
                                                <label for="AlamatKematianLahirHidup">Alamat Meninggal</label>
                                                <input type="text" name="alamat_kematian_lahir_hidup"
                                                    class="form-control" id="AlamatKematianLahirHidup">
                                            </div>
                                            <div class="form-group">
                                                <label for="jenisKematianHidup">Jenis Kematian Bayi / Janin</label>
                                                <select name="jenisKematianHidup" id="jenisKematianHidup"
                                                    class="form-control">
                                                    <option value="237361005">Lahir Mati
                                                    </option>
                                                    <option value="237362003">
                                                        Lahir Mati Saat Persalinan
                                                    </option>
                                                    <option value="276506001">
                                                        Kematian neonatus
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="usiaSaatMeninggal">Usia Saat Meninggal</label>
                                                <div class="row">
                                                    <div class="col-sm-6 col-lg-6">
                                                        <input type="number" name="usiaSaatMeninggal"
                                                            id="usiaSaatMeninggal" class="form-control">
                                                    </div>
                                                    <div class="col-sm-6 col-lg-6">
                                                        menit
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="beratSaatMeninggal">Berat Saat Meninggal</label>
                                                <div class="row">
                                                    <div class="col-sm-6 col-lg-6">
                                                        <input type="number" name="beratSaatMeninggal"
                                                            id="beratSaatMeninggal" class="form-control">
                                                    </div>
                                                    <div class="col-sm-6 col-lg-6">
                                                        gram
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="panjangSaatMeninggal">Panjang Saat Meninggal</label>
                                                <div class="row">
                                                    <div class="col-sm-6 col-lg-6">
                                                        <input type="number" name="panjangSaatMeninggal"
                                                            id="panjangSaatMeninggal" class="form-control">
                                                    </div>
                                                    <div class="col-sm-6 col-lg-6">
                                                        cm
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="tanggalKematianHidup">Tanggal dan Jam Kematian</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="date" name="tanggalKematianHidup"
                                                            id="tanggalKematianHidup" class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="time" name="jamKematianHidup" id="jamKematianHidup"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Code Dugaan Kematian</label>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php
                                                                print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                                print form_input('formBayiLahirHidup', '', 'class="form-control input-sm" id="formBayiLahirHidup" required readonly="readonly"');
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-sm">
                                                                    <?php
                                                                    print form_input('formBayiLahirHiduPDisplay', '', 'class="form-control input-sm" id="formBayiLahirHiduPDisplay" readonly="readonly"');
                                                                    ?>
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            id='cari_kematian_lahir_hidup'
                                                                            class="btn btn-info btn-flat">Cari</button>
                                                                        <button type="button"
                                                                            id='del_kematian_lahir_hidup'
                                                                            class="btn btn-danger btn-flat">Del</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Deskripsi Dugaan Kematian</label>
                                                        <textarea class="form-control" name="dugaan_detail_lahir_hidup"
                                                            id="dugaan_detail_lahir_hidup" rows="3"
                                                            placeholder="Masukkan deskripsi..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Kondisi Ibu Mempegaruhi Janin</label>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php
                                                                print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                                print form_input('formPengaruhIbuLahirHidup', '', 'class="form-control input-sm" id="codePengaruhIbuKematianHidup" required readonly="readonly"');
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-sm">
                                                                    <?php
                                                                    print form_input('formPengaruhIbuLahirHidupDisplay', '', 'class="form-control input-sm" id="pengaruhIbuKematianHidupDisplay" readonly="readonly"');
                                                                    ?>
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            id='cari_pengaruh_ibu_lahir_hidup'
                                                                            class="btn btn-info btn-flat">Cari</button>
                                                                        <button type="button"
                                                                            id='del_pengaruh_ibu_lahir_hidup'
                                                                            class="btn btn-danger btn-flat">Del</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Deskripsi Kondisi Ibu</label>
                                                        <textarea class="form-control" name="dugaan_detail_lahir_hidup"
                                                            id="detailPengaruhIbuKematianLahirHidup" rows="3"
                                                            placeholder="Masukkan deskripsi..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jenisTempatMeninggalHidup">Jenis Tempat Meninggal</label>
                                                <select name="jenisTempatMeninggalHidup" id="jenisTempatMeninggalHidup"
                                                    class="form-control">
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
                                                <label for="deskripsiLainyaHidup">Deskripsi (Jika Lainya)</label>
                                                <textarea name="deskripsiLainyaHidup" id="deskripsiLainyaHidup"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <p class="text-bold">Riwayat Kehamilan</p>
                        </div>
                        <hr style="border: 1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="gravida">Gravida</label>
                                                        <select name="gravida" id="gravida" class="form-control">
                                                            <option value="1">0</option>
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
                                                            <option value="1">0</option>
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
                                                            <option value="1">0</option>
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
                                                        <input type="text" name="usiaKehamilan" id="usiaKehamilan"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        minggu
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlahAnakHidup">Jumlah Anak Hidup</label>
                                                <input type="number" name="jumlahAnakHidup" id="jumlahAnakHidup"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="jenisKehamilan">Jenis Kehamilan</label>
                                                <select name="jenisKehamilan" id="jenisKehamilan" class="form-control">
                                                    <option value="237244005">Tunggal</option>
                                                    <option value="65147003">Kembar 2</option>
                                                    <option value="64254006">Kembar 3</option>
                                                    <option value="OV000394">Kehamilan Ganda Empat atau Lebih</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-header">
                            <p class="text-bold">Riwayat Persalinan</p>
                        </div>
                        <hr style="border:1px solid black;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="janinMeninggalHidup">Janin yang meninggal (Untuk bayi
                                                    kembar)</label>
                                                <select name="janinMeninggalHidup" id="janinMeninggalHidup"
                                                    class="form-control">
                                                    <option value="JOV000398">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan pertama
                                                    </option>
                                                    <option value="OV000399">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan kedua
                                                    </option>
                                                    <option value="OV000400">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan ketiga
                                                    </option>
                                                    <option value="OV000395">
                                                        Janin yang meninggal adalah janin yang lahir pada urutan keempat
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="beratLahirHidup">Berat Lahir</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="number" name="beratLahirHidup" id="beratLahirHidup"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        gram
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="lingkarKepala">Lingkar Kepala</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <input type="number" name="lingkarKepala" id="lingkarKepala"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        cm
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Kelainan Bawaan</label>
                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <?php
                                                                print form_hidden('kdPoli', $item['kdPoli'], 'class="form-control input-sm" required readonly="readonly"');
                                                                print form_input('formKelainanBawaanLahirHidup', '', 'class="form-control input-sm" id="codeKelainanBawanKematianHidup" required readonly="readonly"');
                                                                ?>
                                                            </div>
                                                            <div class="col-sm-10">
                                                                <div class="input-group input-group-sm">
                                                                    <?php
                                                                    print form_input('formKelainanBawaanLahirHidupDisplay', '', 'class="form-control input-sm" id="kelainanBawaanKematianHidupDisplay" readonly="readonly"');
                                                                    ?>
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            id='cari_kelainan_bawaan_lahir_hidup'
                                                                            class="btn btn-info btn-flat">Cari</button>
                                                                        <button type="button"
                                                                            id='del_kelainan_bawaan_lahir_hidup'
                                                                            class="btn btn-danger btn-flat">Del</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label>Dekripsi Kelainan Bawaan</label>
                                                        <textarea class="form-control" name="dugaan_detail_lahir_hidup"
                                                            id="KelainanBawaanLahirHidupDetail" rows="3"
                                                            placeholder="Masukkan deskripsi..."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="jenisTempatBersalin">Jenis Tempat Bersalin</label>
                                                <select name="jenisTempatBersalin" id="jenisTempatBersalin"
                                                    class="form-control">
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
                                                <label for="deskripsiLainyaBersalin">Deskripsi (Jika Lainya)</label>
                                                <textarea name="deskripsiLainyaBersalin" id="deskripsiLainyaBersalin"
                                                    class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="caraPersalinanHidup">Cara Persalinan</label>
                                                <select name="caraPersalinanHidup" id="caraPersalinanHidup"
                                                    class="form-control">
                                                    <option value="Persalinan pervaginam">Persalinan pervaginam</option>
                                                    <option value="Persalinan perabdominam">Persalinan perabdominam
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" id="btnApgarModal"
                                                    class="btn btn-sm btn-primary btn-block">Apgar
                                                    Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button" id="simpanLahirHidup"
                                        class="btn btn-sm btn-success btn-block">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin mengedit data?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelEdit" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Ya, Edit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ApgarModal" tabindex="-1" role="dialog" aria-labelledby="ApgarModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ApgarModalLabel">Riwayat Apgar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="apgarForm">
                    <div id="apgar-container-parent">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancelEdit" data-dismiss="modal">Simpan</button>
                <button type="button" class="btn btn-primary" id="confirmEdit">Menutup</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery Script -->
<script>
    $(document).ready(function() {
        let isEditingLahirMati = false;
        let isEditingLahirHidup = false;

        $('#cari_kematian_lahir_hidup').on('click', function(event) {
            event.preventDefault();
            cari_kematian_lahir_hidup('1');
        })

        $('#cari_kematian_lahir_mati').on('click', function(event) {
            event.preventDefault();
            cari_kematian_lahir_mati('1');
        })

        $('#cari_kondisi_ibu_lahir_mati').on('click', function(event) {
            event.preventDefault();
            cari_kondisi_ibu_lahir_mati('1');
        })

        $('#cari_kelainan_bawaan_lahir_mati').on('click', function(event) {
            event.preventDefault();
            cari_kelainan_bawaan_lahir_mati('1');
        })

        $('#cari_pengaruh_ibu_lahir_hidup').on('click', function(event) {
            event.preventDefault();
            cari_pengaruh_ibu_lahir_hidup('1');
        })


        $('#cari_kelainan_bawaan_lahir_hidup').on('click', function(event) {
            event.preventDefault();
            cari_kelainan_bawaan_lahir_hidup('1');
        })
        //cari_kelainan_bawaan_lahir_mati
        //cari_pengaruh_ibu_lahir_hidup

        //kondisi_ibu_lahir_mati
        // del function

        $('#del_kematian_lahir_hidup').on('click', function(event) {
            event.preventDefault();
            del_kematian_lahir_hidup('1');
        })

        $('#del_kematian_lahir_mati').on('click', function(event) {
            event.preventDefault();
            del_kematian_lahir_mati('1');
        })

        $('#del_kondisi_ibu_lahir_mati').on('click', function(event) {
            event.preventDefault();
            del_kondisi_ibu_lahir_mati('1');
        })

        $('#del_kelainan_bawaan_lahir_mati').on('click', function(event) {
            event.preventDefault();
            del_kelainan_bawaan_lahir_mati('1');
        })

        $('#del_pengaruh_ibu_lahir_hidup').on('click', function(event) {
            event.preventDefault();
            del_pengaruh_ibu_lahir_hidup('1');
        })

        $('#del_kelainan_bawaan_lahir_hidup').on('click', function(event) {
            event.preventDefault();
            del_kelainan_bawaan_lahir_hidup('1');
        })


        function cari_kematian_lahir_hidup(n) {

            ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/popUpBayiLahirHidup/' + n);

        }

        function cari_kematian_lahir_mati(n) {

            ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/popUpBayiLahirMati/' + n);

        }

        function cari_kondisi_ibu_lahir_mati(n) {

            ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/sebabPengaruhIbuLahirMatiPopUP/' + n);

        }

        function cari_kelainan_bawaan_lahir_mati(n) {

            ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/kelainanBawaanPopUpLahirMati/' + n);

        }


        function cari_pengaruh_ibu_lahir_hidup(n) {

            ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/sebabPengaruhIbuLahirHidupPopUp/' + n);

        }

        function cari_kelainan_bawaan_lahir_hidup(n) {

            ajaxmodal('<?php echo base_url() ?>simpus/PopUpController/kelainanBawaanPopUpLahirHidup/' + n);

        }




        function del_kematian_lahir_hidup(n) {

            $('input[name=formBayiLahirHidup]').val('');
            $('input[name=formBayiLahirHiduPDisplay]').val('');

        }

        function del_kematian_lahir_mati(n) {

            $('input[name=formBayiLahirMati]').val('');
            $('input[name=formBayiLahirMatiDisplay]').val('');

        }

        function del_kondisi_ibu_lahir_mati(n) {

            $('input[name=formPengaruhIbuLahirMati]').val('');
            $('input[name=formPengaruhIbuLahirMatiDisplay]').val('');

        }

        function del_kelainan_bawaan_lahir_mati(n) {

            $('input[name=formKelainanBawaanLahirMati]').val('');
            $('input[name=formKelainanBawaanLahirMatiDisplay]').val('');

        }

        function del_pengaruh_ibu_lahir_hidup(n) {

            $('input[name=formPengaruhIbuLahirHidup]').val('');
            $('input[name=formPengaruhIbuLahirHidupDisplay]').val('');

        }

        function del_kelainan_bawaan_lahir_hidup(n) {

            $('input[name=formKelainanBawaanLahirHidup]').val('');
            $('input[name=formKelainanBawaanLahirHidupDisplay]').val('');

        }

        // Fungsi untuk menyimpan data ke localStorage
        function saveToLocalStorage(key, data) {
            localStorage.setItem(key, JSON.stringify(data));
        }

        function buildAPGARContainer(timePoint) {
            // Membuat container utama
            const $container = $('<div>')
                .addClass('col-lg-4')
                .attr('id', `apgar-${timePoint}-container`);

            // Membuat card
            const $card = $('<div>').addClass('card');
            const $cardBody = $('<div>')
                .addClass('card-body')
                .attr('id', `apgar-${timePoint}`);

            // Menambahkan judul
            const $title = $('<h6>').text(`APGAR Menit ${timePoint}`);
            $cardBody.append($title);

            // Daftar komponen APGAR
            const apgarComponents = [{
                    id: `apgar-${timePoint}-appearance`,
                    label: "1.1 Appearance (Warna Kulit)",
                    options: [{
                            value: "LA6722-8",
                            text: "[0] Biru, pucat"
                        },
                        {
                            value: "LA6723-6",
                            text: "[1] Tubuh merah muda, ekstremitas biru"
                        },
                        {
                            value: "LA6724-4",
                            text: "[2] Seluruh tubuh merah muda"
                        }
                    ]
                },
                {
                    id: `apgar-${timePoint}-pulse`,
                    label: "1.2 Pulse (Denyut Jantung)",
                    options: [{
                            value: "LA6716-0",
                            text: "[0] Tidak Ada"
                        },
                        {
                            value: "LA6717-8",
                            text: "[1] <100 /mnt"
                        },
                        {
                            value: "LA6718-6",
                            text: "[2] >=100 /mnt"
                        }
                    ]
                },
                {
                    id: `apgar-${timePoint}-grimace`,
                    label: "1.3 Grimace (Refleks Taktil)",
                    options: [{
                            value: "LA6719-4",
                            text: "[0] Tidak ada respon"
                        },
                        {
                            value: "LA6720-2",
                            text: "[1] Meringis"
                        },
                        {
                            value: "LA6721-0",
                            text: "[2] Terbatuk atau bersin"
                        }
                    ]
                },
                {
                    id: `apgar-${timePoint}-activity`,
                    label: "1.4 Activity (Tonus Otot)",
                    options: [{
                            value: "LA6713-7",
                            text: "[0] Lemas"
                        },
                        {
                            value: "LA6714-5",
                            text: "[1] Sedikit gerakan ekstremitas"
                        },
                        {
                            value: "LA6715-2",
                            text: "[2] Bergerak aktif"
                        }
                    ]
                },
                {
                    id: `apgar-${timePoint}-respiration`,
                    label: "1.5 Respiration (Pernapasan)",
                    options: [{
                            value: "LA6725-1",
                            text: "[0] Tidak ada"
                        },
                        {
                            value: "LA6726-9",
                            text: "[1] Perlahan (tidak teratur)"
                        },
                        {
                            value: "LA6727-7",
                            text: "[2] Menangis kuat"
                        }
                    ]
                }
            ];

            // Membuat elemen select untuk setiap komponen APGAR
            apgarComponents.forEach(component => {
                const $formGroup = $('<div>').addClass('form-group mb-2');
                const $label = $('<label>')
                    .attr('for', component.id)
                    .addClass('form-label')
                    .text(component.label);
                const $select = $('<select>')
                    .attr('id', component.id)
                    .addClass('form-control apgar-select')
                    .attr('data-time-point', timePoint);

                // Menambahkan opsi default "Pilih"
                $select.append($('<option>').attr('value', '').text('Pilih'));

                // Menambahkan opsi ke dalam select
                component.options.forEach(option => {
                    $select.append($('<option>')
                        .attr('value', option.value)
                        .text(option.text)
                    );
                });

                // Menambahkan label dan select ke dalam form group
                $formGroup.append($label, $select);

                // Menambahkan form group ke dalam card body
                $cardBody.append($formGroup);
            });

            // Membuat tabel untuk total skor
            const $totalScoreTable = $('<div>').addClass('form-group mb-2');
            const $table1 = $('<table>').addClass('table table-bordered');
            const $thead1 = $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Total Score'),
                    $('<th>').attr('id', `apgar-${timePoint}-total-score`).text('-')
                )
            );
            $table1.append($thead1);
            $totalScoreTable.append($table1);
            $cardBody.append($totalScoreTable);

            // Membuat tabel untuk klasifikasi
            const $classificationTable = $('<div>').addClass('form-group');
            const $table2 = $('<table>').addClass('table table-bordered');
            const $thead2 = $('<thead>').append(
                $('<tr>').append(
                    $('<th>').text('Klasifikasi'),
                    $('<th>').text('Score')
                )
            );
            const $tbody = $('<tbody>').append(
                $('<tr>').attr('id', `apgar-${timePoint}-classification-row`).append(
                    $('<td>').text('-'),
                    $('<td>').text('-')
                )
            );
            $table2.append($thead2, $tbody);
            $classificationTable.append($table2);
            $cardBody.append($classificationTable);

            // Menambahkan card body ke dalam card
            $card.append($cardBody);

            // Menambahkan card ke dalam container
            $container.append($card);

            return $container;
        }

        // Membuat container APGAR Menit 1

        const obsetri = JSON.parse(localStorage.getItem('Obsetri'));
        console.log(obsetri);

        //mapping data load form BayiLahirHidup

        const fieldMapLahirHidup = {
            // Data Kematian
            lokasiKematian: 'lokasiKematianLahirHidup',
            alamatKematian: 'AlamatKematianLahirHidup',
            jenisKematian: 'jenisKematianHidup',
            usiaSaatMeninggal: 'usiaSaatMeninggal',
            beratSaatMeninggal: 'beratSaatMeninggal',
            panjangSaatMeninggal: 'panjangSaatMeninggal',
            tanggalKematian: 'tanggalKematianHidup',
            jamKematian: 'jamKematianHidup',
            // Dugaan Kematian
            codeDugaanKematianHidup: 'formBayiLahirHidup',
            dugaanKematianHidup: 'formBayiLahirHiduPDisplay',
            detailDugaanKematianHidup: 'dugaan_detail_lahir_hidup',
            // Kondisi Ibu
            codePengaruhIbuHidup: 'codePengaruhIbuKematianHidup',
            pengaruhIbuHidup: 'pengaruhIbuKematianHidupDisplay',
            detailPengaruhIbuHidup: 'detailPengaruhIbuKematianLahirHidup',
            // Tempat Meninggal
            jenisTempatMeninggal: 'jenisTempatMeninggalHidup',
            deskripsiLainya: 'deskripsiLainyaHidup',
            // Riwayat Kehamilan
            gravida: 'gravida',
            partus: 'partus',
            abortus: 'abortus',
            usiaKehamilan: 'usiaKehamilan',
            jumlahAnakHidup: 'jumlahAnakHidup',
            jenisKehamilan: 'jenisKehamilan',
            // Riwayat Persalinan
            janinMeninggalBayiKembar: 'janinMeninggalHidup',
            beratLahir: 'beratLahirHidup',
            lingkarKepala: 'lingkarKepala',
            codeKelainanBawaanHidup: 'codeKelainanBawanKematianHidup',
            kelainanBawaanHidup: 'kelainanBawaanKematianHidupDisplay',
            detailKelainanBawaanHidup: 'KelainanBawaanLahirHidupDetail',
            jenisTempatBersalin: 'jenisTempatBersalin',
            deskripsiLainyaBersalin: 'deskripsiLainyaBersalin',
            caraPersalinan: 'caraPersalinanHidup'
        };


        //mapping for lahir mati
        const fieldMapLahirMati = {
            // Data Kematian
            jenisKematian: 'jenisKematian',
            tanggalKematian: 'tanggalKematian',
            jamKematian: 'jamKematian',
            // Dugaan Kematian
            codeDugaanSebabKematianMati: 'formBayiLahirMati',
            dugaanSebabKematianMati: 'formBayiLahirMatiDisplay',
            detailSebabKematianMati: 'dugaanDetailLahirMati',
            // Kondisi Ibu
            kondisiIbu: 'formPengaruhIbuLahirMati',
            kondisiIbuDisplay: 'formPengaruhIbuLahirMatiDisplay',
            deskripsiKondisi: 'detailPengaruhIbuLahirMati',
            // Tempat Meninggal
            tempatMeninggal: 'tempatMeninggal',
            alamatMeninggal: 'alamatMeninggal',
            jenisTempatMeninggal: 'jenisTempatMeninggal',
            deskripsiLainya: 'deskripsiLainya',
            maserasi: 'maserasi',
            // Riwayat Kehamilan
            usiaKehamilan: 'usiaKehamilanLahirMati',
            gravida: 'gravida',
            partus: 'partus',
            abortus: 'abortus',
            anakHidup: 'anakHidup',
            jenisKehamilan: 'JenisKehamilan',
            // Riwayat Persalinan
            janinMeninggalBayiKembar: 'janinMeninggal',
            beratLahir: 'beratLahir',
            kelainanBawaan: 'formKelainanBawaanLahirMati',
            kelainanBawaanDisplay: 'formKelainanBawaanLahirMatiDisplay',
            deskripsiKelainanBawaan: 'deskripsiKelainanBawaan',
            caraPersalinan: 'caraPersalinan',
            // Data Ibu
            umurIbu: 'umurIbu',
            lamaTinggal: 'lamaTinggal'
        };


        // Fungsi untuk memuat data dari localStorage
        function loadFromLocalStorage(key, formId, fieldMap = {}) {
            try {
                const savedData = JSON.parse(localStorage.getItem(key)) || {};
                console.log('ini datanya' + key);
                console.log(savedData);
                if (Object.keys(savedData).length > 0) {
                    Object.entries(savedData).forEach(([storageKey, fieldData]) => {
                        const fieldName = fieldMap[storageKey] || storageKey;
                        const inputElement = $(`#${formId} #${fieldName}`);
                        if (inputElement.length) {
                            const value = (typeof fieldData === 'object' && fieldData !== null) ?
                                fieldData.value : fieldData;
                            inputElement.val(value);
                        }
                    });

                    // Ubah tombol menjadi "Edit"
                    const saveButton = $(`#${formId} #simpanLahirMati, #${formId} #simpanLahirHidup`);
                    if (saveButton.length) {
                        saveButton.text('Edit')
                            .removeClass('btn-success')
                            .addClass('btn-secondary');
                    }

                    // Nonaktifkan semua input
                    $(`#${formId} input:not(.btn-allow), #${formId} select, #${formId} textarea`).prop('disabled',
                        true);
                }
            } catch (error) {
                console.error('Gagal memuat data:', error);
            }
        }

        function validateFormLahirMati() {
            const form = document.getElementById("formLahirMati");

            const jenisKematian = form.querySelector("#jenisKematian").value;
            const tanggalKematian = form.querySelector("#tanggalKematian").value;
            const jamKematian = form.querySelector("#jamKematian").value;
            const dugaan = form.querySelector("#formBayiLahirMati").value.trim();
            const dugaanDeskripsi = form.querySelector("#dugaanDetailLahirMati").value.trim();
            const pengaruhIbu = form.querySelector("#formPengaruhIbuLahirMati").value.trim();
            const pengaruhDeskripsi = form.querySelector("#detailPengaruhIbuLahirMati").value.trim();
            const tempatMeninggal = form.querySelector("#tempatMeninggal").value;
            const alamatMeninggal = form.querySelector("#alamatMeninggal").value.trim();
            const jenisTempatMeninggal = form.querySelector("#jenisTempatMeninggal").value;
            const deskripsiLainya = form.querySelector("#deskripsiLainya").value.trim();
            const maserasi = form.querySelector("#maserasi").value;

            if (!jenisKematian) {
                swal("Error", "Jenis kematian harus dipilih.", "error");
                return false;
            }

            if (!tanggalKematian) {
                swal("Error", "Tanggal kematian harus diisi.", "error");
                return false;
            }

            if (!jamKematian) {
                swal("Error", "Jam kematian harus diisi.", "error");
                return false;
            }

            if (!dugaan) {
                swal("Error", "Dugaan penyebab kematian harus dipilih.", "error");
                return false;
            }

            if (!dugaanDeskripsi) {
                swal("Error", "Deskripsi penyebab kematian harus diisi.", "error");
                return false;
            }

            if (!pengaruhIbu) {
                swal("Error", "Pengaruh faktor ibu harus dipilih.", "error");
                return false;
            }

            if (!pengaruhDeskripsi) {
                swal("Error", "Deskripsi pengaruh faktor ibu harus diisi.", "error");
                return false;
            }

            if (!tempatMeninggal) {
                swal("Error", "Tempat meninggal harus dipilih.", "error");
                return false;
            }

            if (!alamatMeninggal) {
                swal("Error", "Alamat tempat meninggal harus diisi.", "error");
                return false;
            }

            if (!jenisTempatMeninggal) {
                swal("Error", "Jenis tempat meninggal harus dipilih.", "error");
                return false;
            }

            if (jenisTempatMeninggal === "LT000010" && !deskripsiLainya) {
                swal("Error", "Deskripsi tempat meninggal lainnya harus diisi.", "error");
                return false;
            }

            if (!maserasi) {
                swal("Error", "Status maserasi harus dipilih.", "error");
                return false;
            }

            return true;
        }



        // Logika untuk Kematian Bayi Lahir Mati
        $('#simpanLahirMati').click(function() {
            if ($(this).text() == 'Edit') {
                isEditingLahirMati = true;
                $('#editModal').modal('show');
            } else {
                try {
                    if (validateFormLahirMati()) {
                            // 1. Buat scope form spesifik
                    const $form = $('#formLahirMati');

                        // 2. Ambil data yang sudah ada
                        const existingData = JSON.parse(localStorage.getItem('dataLahirMati')) || {};
                        // 3. Siapkan data baru dalam scope form
                        const newData = {
                            jenisKematian: $form.find('#jenisKematian').val() || null,
                            codeDugaanSebabKematianMati: $form.find('#formBayiLahirMati').val() || null,
                            dugaanSebabKematianMati: $form.find('#formBayiLahirMatiDisplay').val() || null,
                            detailSebabKematianMati: $form.find('#dugaanDetailLahirMati').val() || null,
                            tanggalKematian: $form.find('#tanggalKematian').val() || null,
                            jamKematian: $form.find('#jamKematian').val() || null,
                            kondisiIbu: $form.find('#formPengaruhIbuLahirMati').val() || null,
                            kondisiIbuDisplay: $form.find('#formPengaruhIbuLahirMatiDisplay').val() || null,
                            deskripsiKondisi: $form.find('#detailPengaruhIbuLahirMati').val() || null,
                            tempatMeninggal: $form.find('#tempatMeninggal').val() || null,
                            alamatMeninggal: $form.find('#alamatMeninggal').val() || null,
                            jenisTempatMeninggal: $form.find('#jenisTempatMeninggal').val() || null,
                            deskripsiLainya: $form.find('#deskripsiLainya').val() || null,
                            maserasi: $form.find('#maserasi').val() || null,
                            kelainanBawaan: $form.find('#formKelainanBawaanLahirMati').val() || null,
                            kelainanBawaanDisplay: $form.find('#formKelainanBawaanLahirMatiDisplay')
                                .val() || null,
                            deskripsiKelainanBawaan: $form.find('#deskripsiKelainanBawaan').val() || null,
                            beratLahir: $form.find('#beratLahir').val() || null,
                            janinMeninggalBayiKembar: $form.find('#janinMeninggal').val() || null,
                            jenisKehamilan: $form.find('#JenisKehamilan').val() || null,
                            caraPersalinan: $form.find('#caraPersalinan').val() || null,
                            usiaKehamilanLahirMati: $form.find('#usiaKehamilanLahirMati').val() || null,
                            anakHidup: $form.find('#anakHidup').val() || null,
                            umurIbu: $form.find('#umurIbu').val() || null,
                            lamaTinggal: $form.find('#lamaTinggal').val() || null,
                            gravida: $form.find('#gravida').val() || null,
                            partus: $form.find('#partus').val() || null,
                            abortus: $form.find('#abortus').val() || null
                        };

                        // 4. Gabungkan data (pertahankan ID jika ada)
                        const mergedData = {
                            ...existingData
                        };

                        Object.entries(newData).forEach(([key, value]) => {
                            if (!mergedData[key]) {
                                mergedData[key] = {
                                    id: null,
                                    value
                                };
                            } else {
                                mergedData[key].value = value; // ID tetap dipertahankan
                            }
                        });
                        // 5. Simpan ke localStorage
                        localStorage.setItem('dataLahirMati', JSON.stringify(mergedData));

                        // 6. Update UI
                        $(this).text('Edit').removeClass('btn-success').addClass('btn-secondary');
                        $form.find('input, select, textarea').prop('disabled', true);

                        swal('Data berhasil disimpan!', '', 'success');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal menyimpan data!');
                }
            }
        });


        // Logika untuk Kematian Bayi Lahir Hidup
        $('#simpanLahirHidup').click(function() {
            if ($(this).text() == 'Edit') {
                isEditingLahirHidup = true;
                $('#editModal').modal('show');
            } else {
                try {
                    // 1. Buat scope form spesifik
                    const $form = $('#formLahirHidup');

                    // 2. Ambil data yang sudah ada
                    const existingData = JSON.parse(localStorage.getItem('dataLahirHidup')) || {};

                    // 3. Siapkan data baru dalam scope form
                    const newData = {
                        lokasiKematian: $form.find('#lokasiKematianLahirHidup').val() || null,
                        alamatKematian: $form.find('#AlamatKematianLahirHidup').val() || null,
                        jenisKematianHidup: $form.find('#jenisKematianHidup').val() || null,
                        usiaSaatMeninggal: $form.find('#usiaSaatMeninggal').val() || null,
                        beratSaatMeninggal: $form.find('#beratSaatMeninggal').val() || null,
                        panjangSaatMeninggal: $form.find('#panjangSaatMeninggal').val() || null,
                        tanggalKematianHidup: $form.find('#tanggalKematianHidup').val() || null,
                        jamKematianHidup: $form.find('#jamKematianHidup').val() || null,
                        codeDugaanKematianHidup: $form.find('#codeSebabKematianHidup').val() ||
                            null,
                        dugaanKematianHidup: $form.find('#dugaanSebabKematianHidup').val() ||
                            null,
                        detailDugaanKematianHidup: $form.find(
                            '#detailDugaanLahirHidup').val() || null,
                        codePengaruhIbuHidup: $form.find('#codePengaruhIbuKematianHidup').val() ||
                            null,
                        pengaruhIbuHidup: $form.find('#pengaruhIbuKematianHidupDisplay')
                            .val() || null,
                        detailPengaruhIbuHidup: $form.find('#detailPengaruhIbuKematianLahirHidup')
                            .val() || null,
                        jenisTempatMeninggalHidup: $form.find('#jenisTempatMeninggalHidup').val() ||
                            null,
                        deskripsiLainyaHidup: $form.find('#deskripsiLainyaHidup').val() || null,
                        gravida: $form.find('#gravida').val() || null,
                        partus: $form.find('#partus').val() || null,
                        abortus: $form.find('#abortus').val() || null,
                        usiaKehamilan: $form.find('#usiaKehamilan').val() || null,
                        jumlahAnakHidup: $form.find('#jumlahAnakHidup').val() || null,
                        jenisKehamilan: $form.find('#jenisKehamilan').val() || null,
                        janinMeninggalHidupBayiKembar: $form.find('#janinMeninggalHidup').val() || null,
                        beratLahirHidup: $form.find('#beratLahirHidup').val() || null,
                        lingkarKepala: $form.find('#lingkarKepala').val() || null,
                        codeKelainanBawaanHidup: $form.find('[name="formKelainanBawaanLahirHidup"]')
                            .val() || null,
                        kelainanBawaanHidup: $form.find('[name="formKelainanBawaanLahirHidupDisplay"]')
                            .val() || null,
                        detailKelainanBawaanHidup: $form.find(
                            '#KelainanBawaanLahirHidupDetail').val() || null,
                        jenisTempatBersalin: $form.find('#jenisTempatBersalin').val() || null,
                        deskripsiLainyaBersalin: $form.find('#deskripsiLainyaBersalin').val() || null,
                        caraPersalinanHidup: $form.find('#caraPersalinanHidup').val() || null
                    };

                    // 4. Gabungkan data (pertahankan ID jika ada)
                    const mergedData = {
                        ...existingData
                    };

                    Object.entries(newData).forEach(([key, value]) => {
                        if (!mergedData[key]) {
                            mergedData[key] = {
                                id: null,
                                value
                            };
                        } else {
                            mergedData[key].value = value; // ID tetap dipertahankan
                        }
                    });
                    // 5. Simpan ke localStorage
                    localStorage.setItem('dataLahirHidup', JSON.stringify(mergedData));
                    // 6. Update UI
                    $(this).text('Edit').removeClass('btn-success').addClass('btn-secondary');
                    $form.find('input, select, textarea').prop('disabled', true);
                    alert('Data berhasil disimpan!');
                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal menyimpan data!');
                }
            }
        });

        // Konfirmasi Edit
        $('#confirmEdit').click(function() {
            $('#editModal').modal('hide');
            if (isEditingLahirMati) {
                $('#formLahirMati input, #formLahirMati select, #formLahirMati textarea').prop(
                    'disabled',
                    false);
                $('#simpanLahirMati').text('Simpan').removeClass('btn-secondary').addClass(
                    'btn-success');
                isEditingLahirMati = false;
            }
            if (isEditingLahirHidup) {
                $('#formLahirHidup input, #formLahirHidup select, #formLahirHidup textarea').prop(
                    'disabled', false);
                $('#simpanLahirHidup').text('Simpan').removeClass('btn-secondary').addClass(
                    'btn-success');
                isEditingLahirHidup = false;
            }
        });

        // Batal Edit
        $('#cancelEdit').click(function() {
            $('#editModal').modal('hide');
        });


        //modal APgar
        $('#btnApgarModal').on('click', function() {
            const $apgar1Container = buildAPGARContainer(1);
            const $apgar5Container = buildAPGARContainer(5);
            const $apgar10Container = buildAPGARContainer(10);


            $('#apgar-container-parent')
                .empty()
                .append($apgar1Container, $apgar5Container, $apgar10Container);
            $('#ApgarModal').modal('show');
        });

        // Tutup modal saat tombol "Simpan" atau "Menutup" diklik
        $('#cancelEdit, #confirmEdit').on('click', function() {
            $('#ApgarModal').modal('hide');
        });



        // Memuat data saat halaman dimuat
        loadFromLocalStorage('dataLahirMati', 'formLahirMati', fieldMapLahirMati);
        loadFromLocalStorage('dataLahirHidup', 'formLahirHidup', fieldMapLahirHidup);

    });
</script>