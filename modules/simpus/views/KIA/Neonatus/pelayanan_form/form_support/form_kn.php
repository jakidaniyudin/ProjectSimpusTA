 <div class="row" style="margin-bottom: 15px;">
     <div class="col-md-8">
         <div class="row">
             <div class="col-md-3" style="margin-bottom: 15px;">
                 <a
                     class="btn btn-primary btn-sm btn-block"
                     style="padding-top: 13px; padding-bottom: 13px;"
                     id="custom-tabs-three-form1-tab"
                     data-toggle="pill"
                     href="#custom-tabs-three-form1"
                     role="tab"
                     aria-controls="custom-tabs-three-form1"
                     aria-selected="true">
                     0-6 jam
                 </a>
             </div>
             <div class="col-md-3" style="margin-bottom: 15px;">
                 <a
                     class="btn btn-primary btn-sm btn-block"
                     id="custom-tabs-three-form2-tab"
                     data-toggle="pill"
                     href="#custom-tabs-three-form2"
                     role="tab"
                     aria-controls="custom-tabs-three-form2"
                     aria-selected="false">
                     6-48 jam <br />
                     (KN1)
                 </a>
             </div>
             <div class="col-md-3" style="margin-bottom: 15px;">
                 <a
                     class="btn btn-primary btn-sm btn-block"
                     id="custom-tabs-three-form3-tab"
                     data-toggle="pill"
                     href="#custom-tabs-three-form3"
                     role="tab"
                     aria-controls="custom-tabs-three-form3"
                     aria-selected="false">
                     3-7 hari <br />
                     (KN2)
                 </a>
             </div>
             <div class="col-md-3" style="margin-bottom: 15px;">
                 <a
                     class="btn btn-primary btn-sm btn-block"
                     id="custom-tabs-three-form4-tab"
                     data-toggle="pill"
                     href="#custom-tabs-three-form4"
                     role="tab"
                     aria-controls="custom-tabs-three-form4"
                     aria-selected="false">
                     8-28 hari <br />
                     (KN3)
                 </a>
             </div>
         </div>
     </div>
 </div>
 <div class="tab-content" id="myTabContent" style="margin-top: 20px;">
     <div
         class="tab-pane fade in active"
         id="custom-tabs-three-form1"
         role="tabpanel"
         aria-labelledby="custom-tabs-three-form1-tab">
            <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_kn0.php'); ?>
     </div>
     <div
         class="tab-pane fade in"
         id="custom-tabs-three-form2"
         role="tabpanel"
         aria-labelledby="custom-tabs-three-form2-tab">
            <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_kn1.php'); ?>
     </div>
     <div class="tab-pane fade in" id="custom-tabs-three-form3" role="tabpanel" aria-labelledby="custom-tabs-three-form3-tab">
            <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_kn2.php'); ?>  
     </div>
     <div class="tab-pane fade in" id="custom-tabs-three-form4" role="tabpanel" aria-labelledby="custom-tabs-three-form4-tab">
            <?php $this->load->view('pelayanan/KIA/Neonatus/pelayanan_form/form_support/form_kn3.php'); ?> 
     </div>
 </div>