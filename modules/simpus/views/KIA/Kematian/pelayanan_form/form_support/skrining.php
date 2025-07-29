 <div class="tab-pane fade in" id="skiringIbu">
     <div class="row">
         <div class="col-md-4">
             <form>
                 <div class="form-group">
                     <label for="formSelector" class="form-label">Skrining</label>
                     <select name="formSelector" class="form-control" id="formSelector">
                         <option value="form-tbc">Skrining Tuberkulosis</option>
                         <option value="form-kesehatan">Skrining Masalah Kesehatan</option>
                         <option value="form-gigi-mulut">Skrining Kesehatan Gigi Dan Mulut</option>
                         <option value="form-anemia">Skrining Anemia</option>
                         <option value="form-pre-klamsia">Skrining Pre-Eklamsia</option>
                     </select>
                 </div>
             </form>
         </div>
     </div>

     <div class="row" style="margin-top: 10px;">
         <form id="form-tbc" class="form-container">
             <div class="row" style="margin-bottom: 10px; margin-left: 10px;">
                 <div class="col-md-4">
                     <h4 style="font-weight: bold;">Berdasarkan anamnesis</h4>
                     <p class="text-justify">
                         Gejala penyakit TB tergantung pada lokasi lesi, sehingga dapat
                         menunjukkan manifestasi klinis sebagai berikut:
                     </p>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="batuk2minggu">1. Batuk ≥ 2 minggu</label>
                     <select name="batuk2minggu" class="form-control" id="batuk2minggu">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="batuk-berdahak">2. Batuk Berdahak</label>
                     <select name="batuk-berdahak" class="form-control" id="batuk-berdahak">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="batuk-darah">3. Batuk Berdahak Dapat Bercampur Darah</label>
                     <select name="batuk-darah" class="form-control" id="batuk-darah">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="disertai-nyeri">4. Dapat Disertai Nyeri</label>
                     <select name="disertai-nyeri" class="form-control" id="disertai-nyeri">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="sesak-nafas">5. Sesak Nafas</label>
                     <select name="sesak-nafas" class="form-control" id="sesak-nafas">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
             </div>
             <div class="col-md-6">
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="melaise" class="form-label">1. Melaise</label>
                     <select name="melaise" class="form-control" id="melaise">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="turun-berat-badan" class="form-label">2. Penurunan Berat Badan</label>
                     <select name="turun-berat-badan" class="form-control" id="turun-berat-badan">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="nurun-nafsu-makan" class="form-label">3. Menurunnya Nafsu Makan</label>
                     <select name="nurun-nafsu-makan" class="form-control" id="nurun-nafsu-makan">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="mengigil" class="form-label">4. Menggigil</label>
                     <select name="mengigil" class="form-control" id="mengigil">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="demam" class="form-label">5. Demam</label>
                     <select name="demam" class="form-control" id="demam">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;">
                     <label for="berkeringat" class="form-label">6. Berkeringat di Malam Hari</label>
                     <select name="berkeringat" class="form-control" id="berkeringat">
                         <option value="" selected>Select...</option>
                         <option value="yes">Ya</option>
                         <option value="tidak">Tidak</option>
                     </select>
                 </div>
                 <div class="form-group" style="margin-top: 20px;" style="margin-top: 20px;">
                     <button class="btn btn-success w-100">
                         <i class="bi bi-floppy text-white mr-3"></i>Simpan
                     </button>
                 </div>
             </div>
         </form>

         <form id="form-kesehatan" class="form-container">
             <div class="row" style="margin-bottom: 10px; margin-left: 10px;">
                 <div class="col-md-4">
                     <h4 style="font-weight: bold;">Skrining Kesehatan Jiwa</h4>
                     <p class="text-justify">
                         Petunjuk: Bacalah petunjuk ini seluruhnya sebelum mulai mengisi.
                         Pertanyaan berikut berhubungan dengan masalah yang mungkin
                         mengganggu Anda selama 30 hari terakhir. Apabila Anda menganggap
                         pertanyaan itu Anda alami dalam 30 hari terakhir, berilah tanda
                         silang (X) pada kolom Y (berarti Ya). Sebaliknya, Apabila Anda
                         menganggap pertanyaan itu tidak Anda alami dalam 30 hari
                         terakhir, berilah tanda silang (X) pada kolom T (Tidak). Jika
                         Anda tidak yakin tentang jawabannya, berilah jawaban yang paling
                         sesuai di antara Y dan T. Kami tegaskan bahwa jawaban Anda
                         bersifat rahasia dan akan digunakan hanya untuk membantu
                         pemecahan masalah Anda.
                     </p>
                 </div>
             </div>

             <div class="col-xs-12">
                 <table class="table table-responsive">
                     <thead style="background-color: #e1e1e1">
                         <tr>
                             <th scope="col">No</th>
                             <th scope="col" style="width: 100%">Pertanyaan</th>
                             <th scope="col">Ya</th>
                             <th scope="col">Tidak</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td style="background-color: #e1e1e1">1</td>
                             <td>Apakah Anda sering merasa sakit kepala?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question1" id="radioYa1" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question1" id="radioTidak1" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">2</td>
                             <td>Apakah Anda kehilangan nafsu makan?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question2" id="radioYa2" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question2" id="radioTidak2" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">3</td>
                             <td>Apakah tidur Anda tidak nyenyak?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question3" id="radioYa3" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question3" id="radioTidak3" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">4</td>
                             <td>Apakah Anda mudah merasa takut?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question4" id="radioYa4" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question4" id="radioTidak4" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">5</td>
                             <td>Apakah Anda merasa cemas, tegang, atau khawatir?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question5" id="radioYa5" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question5" id="radioTidak5" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">6</td>
                             <td>Apakah tangan Anda gemetar?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question6" id="radioYa6" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question6" id="radioTidak6" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">7</td>
                             <td>Apakah Anda mengalami gangguan pencernaan?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question7" id="radioYa7" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question7" id="radioTidak7" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">8</td>
                             <td>Apakah Anda merasa sulit berpikir jernih?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question8" id="radioYa8" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question8" id="radioTidak8" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">9</td>
                             <td>Apakah Anda merasa tidak bahagia?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question9" id="radioYa9" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question9" id="radioTidak9" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">10</td>
                             <td>Apakah Anda lebih sering menangis?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question10" id="radioYa10" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question10" id="radioTidak10" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">11</td>
                             <td>Apakah Anda merasa sulit untuk menikmati aktivitas sehari-hari?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question11" id="radioYa11" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question11" id="radioTidak11" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">12</td>
                             <td>Apakah Anda mengalami kesulitan untuk mengambil keputusan?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question12" id="radioYa12" value="1" />
                                         Ya
                                     </label>
                                 </div>
                             </td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question12" id="radioTidak12" value="-1" />
                                         Tidak
                                     </label>
                                 </div>
                             </td>
                         </tr>
                         <tr>
                             <td style="background-color: #e1e1e1">13</td>
                             <td>Apakah aktivitas/tugas sehari-hari Anda terbengkalai?</td>
                             <td>
                                 <div class="radio">
                                     <label>
                                         <input type="radio" name="question13" id="radioYa13" value="1" />
                                         Ya </label>
                                 </div>
                             </td>
                             <td>
                                 <div class