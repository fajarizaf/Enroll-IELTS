<script> 
$(document).ready(function() {
   $('#btnnewaccount').click(function() {
                     $('#parentloading').fadeIn('slow');
                     var counter=2;
                      var countdown = setInterval(function(){
                        if (counter == 0) {
                        clearInterval(countdown);
                             $('#parentloading').fadeOut('slow');
                             $('.register-or-login').load(''+base_url+'register/form_candidate/').hide().fadeIn('slow');
                             $('#sticky').sticky('<span style="color:#802222;">please fill out a form below to complete</span>');
                         }
                        counter--;
                      }, 500);                
                 });

   


   $('.search-country').keyup(function() {
                    var keyword = $(this).val(); 
                    var idschedules = $('.codeidschedules').html();
                    var dataString = 'user=' + keyword + '&idschedules=' + idschedules; 
                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterbyuser",
                            data: dataString,
                            success : function(data){  
                               $(".box-list-country").html(data);         
                            }
                        });
      });


   $('.box-list-country').slimScroll({
             width: '703px',
             height:'300px'
         });



      $('.box-list-country').on('click','.css-label', function() {  
          var id = $(this).attr('for');
          var tgl = $(this).attr('tgl');
          var name = $(this).attr('famname');
          var kuota =$('#numbkuota').html();
          var crop =  id +',';
          $( "tr[valuecode="+id+"]" ).remove();
          var listtable = '<tr valuecode="'+id+'"><td style="padding-left:9px;width:120px;border-bottom:1px solid #f0c36d;padding-top:8px;padding-bottom:8px;color:#802222">IDIELTS'+id+'</td><td style="width:200px;border-bottom:1px solid #f0c36d;color:#802222">'+name+'</td><td style="width:10px;border-bottom:1px solid #f0c36d;"><span id="deleteuserlist" value="'+id+'" tgl="'+tgl+'" name="'+name+'" style="margin-right:5px;" class="label label-warning">delete</span></td></tr>';
          $('.value-multiple-user').append(crop);
          $('.no-item').remove();
          $('.list-user-append').append(listtable);
          $('ul[valuecode='+id+']').remove();

                  minkuota = kuota - 1;
                  $('#numbkuota').html(minkuota);

                  if($('#numbkuota').html() == 0 ) {
                    $('.box-list-country').css({'opacity':'0.4','pointer-events':'none'});
                    $('#numbkuota').attr('class','label');
                    $('#sticky').sticky('<span style="color:#802222;">available quota has been exhausted</span>');
                  } else {
                    $('.boxlist').css({'opacity':'1','pointer-events':'auto'});
                  }


      });




      $('.list-user-append').on('click','#deleteuserlist', function() {
          var id = $(this).attr('value');
          var tgl = $(this).attr('tgl');
          var name = $(this).attr('name');
          var kuota = parseInt($('#numbkuota').html(),10);
          $('.value-multiple-user').html($('.value-multiple-user').html().split(id+",").join(""));
          var listtable = '<ul value="'+id+'" valuecode="'+id+'" class="list-country"><li style="width:30px;"><input type="checkbox" name="listuser"  value="'+id+'" id="'+id+'" class="css-checkbox lrg" /><label for="'+id+'" tgl="'+tgl+'" famname="'+name+'" name="checkbox67_lbl" class="css-label lrg web-two-style"></label></li><li style="width:120px;">IDIELTS'+id+'</li><li style="width:150px;">'+tgl+'</li><li style="width:280px;">'+name+'</li></ul>';
          $('.box-list-country').append(listtable);
          $('tr[valuecode='+id+']').remove();


                minkuota = kuota + 1;
                $('#numbkuota').html(minkuota);

                if($('#numbkuota').html() != 0 ) {
                  $('.box-list-country').css({'opacity':'1','pointer-events':'auto'});
                  $('#numbkuota').attr('class','label label-warning'); 
                } else {
                  $('.boxlist').css({'opacity':'0.4','pointer-events':'none'});
                  $('#sticky').sticky('<span style="color:#802222;">available quota has been exhausted</span>');
                }

      });


      $('#registerexistinguser').click(function() {
          $('#parentloading').fadeIn('slow');

                            var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                

                                if($('.value-multiple-user').is(':empty')) {
                                  $('#sticky').sticky('<span style="color:#802222;">the user must be selected</span>');
                                } else {


                                   var idschedules = $('.codeidschedules').html();
                                   var idusers = $('.value-multiple-user').html();

                                   var dataString = 'idusers=' + idusers + '&idschedules=' + idschedules;

                                  $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"register/proses_register_center/",
                                      data: dataString,

                                      success : function(response){
                                          $('#parentloading').fadeOut('slow');
                                               $('#btn-city').attr('class','visited');
                                               $('#btn-date').attr('class','visited');
                                               $('#btn-tos').attr('class','visited');
                                               $('#btn-tos').attr('class','visited');
                                               $('#btn-candidate').attr('class','visited');
                                               $('#btn-finish').attr('class','active');

                                              var testvenue = $('.displaylocation').html();

                                 
                                              $.getJSON( ""+base_url+"register/getschedules/"+idschedules+"", function( data ) {

                                                $.each( data, function( key, val ) {
                                                  $('.result-Test-date').html(val.testdate);
                                                  $('.result-Test-venue').html(testvenue);
                                                  $('.result-Test-module').html(val.module);
                                                  $('.idr').html(val.rupiah);
                                                  $('.dollar').html(val.dollar);
                                                  $('.gbp').html(val.gbp);
                                                });
                       
                                              });


                                                       $('.box-step-results').fadeOut('fast');
                                                       $('.panss').fadeOut('fast');
                                                       $('.box-results').html('<b class="font1" style="color:#802222;">Register successful.</b>  <span style="color:#e44b00;"> -  Your registration was successful. Here are the details:</span>');
                                                       $('.content-tab').animate({ scrollLeft:'3840px' });
                                                       $('#sticky').sticky('<span style="color:#802222;">Register successful.</span>');
                                                       $('.box-tab ul li').attr('action','disabled');
                                      }
                                  });      


                                }

                            }
                              counter--;
                            }, 500);
      });


});

</script>

<style>
  .list-country:first-child{background: none;color:#333;}
  .list-country:first-child li {border-color: #efefef}

.user-selected .slimScrollDiv {
  border:none;
  margin-top: -20px;
}

.boxlist .slimScrollDiv {
  border-top:none;
}

.table tbody tr:hover td, .table tbody tr:hover th {
  background: none;
}

textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .uneditable-input:focus {
  border-color:#ccc;
}

</style>

<div class="h3" style="padding:0px;padding-bottom:20px;margin-top:-20px;width:400px;float:left;">Existing User List</div>
<div style="float:right;width:150px;padding-bottom:20px;margin-top:-20px;">Kuota Available  &nbsp;
<?php foreach ($kuotaAvailable as $row ) { ?>
<span id="numbkuota" style="padding:10px;padding-top:3px;padding-bottom:3px;" class='label label-warning'><?php echo $row->maxuser ?></span>
<?php } ?>
</div>


<div class="value-multiple-user" style="width:200px;height:20px;border:1px solid #ccc;display:none;"></div>
           
            <input type="text" name="user"  placeholder="Input Registered ID" class="search-country" style="width:99.5%;background-position: 905px 9px ">
              <div class="boxlist" style="width:700px;float:left;">
                 <ul class="list-country" style="border:1px solid #ccc;background:#efefef;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;border-left:none;width:99.5%">
                   <li class="font1" style="width:30px;color:#333;border-color:#ccc;"></li>
                   <li class="font1" style="width:120px;color:#333;border-color:#ccc;font-weight:bold">Registered ID</li>
                   <li class="font1" style="width:150px;color:#333;border-color:#ccc;font-weight:bold">Registration Date</li>
                   <li class="font1" style="width:280px;color:#333;border-color:#ccc;font-weight:bold">Name</li>
                 </ul>


                 <div class="box-list-country">
               <?php foreach ($user_regcenter as $row ) { ?>
                 <ul value="<?php echo $row->idusers ?>" valuecode="<?php echo $row->idusers ?>" class="list-country">
                   <li style="width:30px;">
                      <input type="checkbox" name="listuser"  value="<?php echo $row->idusers; ?>" id="<?php echo $row->idusers; ?>" class="css-checkbox lrg" />
                      <label for="<?php echo $row->idusers; ?>" tgl="<?php echo $this->generated_tanggal->ubahtanggal($row->created); ?>" famname="<?php echo $row->userfamilyname; ?>" name="checkbox67_lbl" class="css-label lrg web-two-style"></label>
                   </li>
                   <li style="width:120px;">IDIELTS<?php echo $row->idusers ?></li>
                   <li style="width:150px;"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?></li>
                   <li style="width:280px;"><?php echo $row->userfamilyname ?></li>
                 </ul>
               <?php } ?>  
                </div>


            </div>

            <div style="width:252px;float:left;">
              <div class="user-selected">
                <table class="table table-stripped">
                  <tr ><td class="font1" style="padding-left:9px;width:110px;border-bottom:1px solid #f0c36d;padding-top:8px;padding-bottom:8px;color:#802222;font-weight:bold;">Registered ID</td>
                  <td class="font1" style="width:200px;border-bottom:1px solid #f0c36d;color:#802222;font-weight:bold;">Name</td><td style="width:10px;border-bottom:1px solid #f0c36d;"></td></tr> 
                </table>
                <table class="table table-stripped">
                  <div class="list-user-append" style="margin-left:0px;padding-top:0px;margin-top:-10px;">

                   <span class="no-item" style="color:#c78425;margin-left:20px;margin-top:3px;">No Item Selected</span>

                  </div>
                </table>

              </div>
              <div id="registerexistinguser"  style="float:left;margin-top:10px;width:225px"class="btn btn-warning">Continue</div>           
            </div>