<div class="col-12">

            <div class="card-header p-3 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-fisik-tab" data-toggle="pill" href="#custom-tabs-one-fisik" role="tab" aria-controls="custom-tabs-one-fisik" aria-selected="true">Data Fisik >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-PB-tab" data-toggle="pill" href="#custom-tabs-one-PB" role="tab" aria-controls="custom-tabs-one-PB" aria-selected="false">PB/U >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-BB-tab" data-toggle="pill" href="#custom-tabs-one-BB" role="tab" aria-controls="custom-tabs-one-BB" aria-selected="true">BB/U >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-TB-tab" data-toggle="pill" href="#custom-tabs-one-TB" role="tab" aria-controls="custom-tabs-one-TB" aria-selected="false">TB/U >> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-LK-tab" data-toggle="pill" href="#custom-tabs-one-LK" role="tab" aria-controls="custom-tabs-one-LK" aria-selected="false">LK/U >> </a>
                    </li>
                </ul>
            </div>

        <section class="content-header">
            <h5 class="text-danger font-weight-bold">Pengiriman Data Antropometri</h5>
        </section>

        <section class="content">
            <form>
                <div class="row">
                    <!-- Input Fields -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>1. Tanggal dan Waktu Pengukuran</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>2. Berat Badan (BB)</label>
                                <textarea class="form-control" rows="1"></textarea>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>3. Kenaikan Berat Badan Adekuat</label>
                            <select class="form-control">
                                <option>Select...</option>
                                <option>Iya</option>
                                <option>Tidak</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>4. Panjang Badan (PB)</label>
                                <textarea class="form-control" rows="1"></textarea>
                            </select>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>5. Tinggi Badan (TB)</label>
                                <textarea class="form-control" rows="1"></textarea>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>6. Lingkar Lengan Atas (LiLA)</label>
                                <textarea class="form-control" rows="1"></textarea>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>7. Lingkar Kepala (LK)</label>
                                <textarea class="form-control" rows="1"></textarea>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>8. Catatan Tambahan</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> SIMPAN
                    </button>
                </div>
            </form>
        </section>
</div>
