<script type="text/javascript">  $(document).ready(function() {    $('#selectpartner').change(function() {      $('#testvenue').next().remove();      var partner = $(this).val();      var dataString = 'partner=' + partner;                   $.ajax({                            type  : "POST",                            url: ""+base_url+"schedule/getTestschedule/"+partner+"",                            success : function(data){                                               $('#testvenue').html(data);                                $("#testvenue").attr('class','select');                                $(".select").selecter();                                                                }                    });         });    $( "#date_of_birth" ).datepicker({                    showOn: "button",                    buttonImage: "<?php echo base_url(); ?>assets/pic/calendar.jpg",                    buttonImageOnly: true,                    dateFormat: "yy-m-d",                  });     $( ".closingreg" ).datepicker({                    showOn: "button",                    buttonImage: "<?php echo base_url(); ?>assets/pic/calendar.jpg",                    buttonImageOnly: true,                    dateFormat: "yy-m-d",                  });    $('#selectpartner').change(function() {                    $('#selectpartner').valid();                });    $('#testvenue').change(function() {                    $('#testvenue').valid();                });    $('#module').change(function() {                    $('#module').valid();                });    $('#date_of_birth').change(function() {                    $('#date_of_birth').valid();                });    $('.closingreg').change(function() {                    $('.closingreg').valid();                });   });</script><style>  #formaddschedule .selecter .selecter-selected {    width:230px;  }  #formaddschedule .selecter .selecter-options{    width:254px;  }</style><div id="addschedule" class="modal hide fade in" style="display: none; ">          <div class="modal-header">              <a class="close" data-dismiss="modal">×</a>              <h4>Add Schedule</h4>          </div>          <div class="modal-body" style="padding-left:10px;">          <div class="box-schedule">                <?php $atributes = array ('id' => 'formaddschedule'); ?>         <?php echo form_open('schedule/addschedule', $atributes); ?>              <table class="table" >                    <tr>            <td style="width:270px;">Partner</td>            <td>             <select style="width:30px;" class="select"  id="selectpartner" name="selectpartner">             <option value="">Select Partner</option>                <?php foreach ($partner as $row) { ?>                  <option value="<?php echo $row->idpartners ?>"><?php echo $row->partnername ?></option>                 <?php } ?>              </select>            </td>          </tr>          <tr>            <td>Test Venue * </td>            <td>                    <select id="testvenue" class="select" name="testvenue"  style="width:320px;height:40px;">                        <option value="">Select Test Venue</option>                    </select>            </td>          </tr>          <tr>            <td>Module * </td>            <td>              <select  class="select"  id="module" name="module">                  <option value="">Select Module</option>                  <option value="4">Academic</option>                  <option value="3">General Training</option>               </select>            </td>          </tr>          <tr>            <td>Test Date * </td>            <td>              <input type="text" id="date_of_birth" name="date_of_birth">            </td>          </tr>          <tr>            <td>Closing Registration * </td>            <td>              <input type="text" name="closingreg" class="closingreg">            </td>          </tr>          <tr>            <td>Dollar (US) * </td>            <td>              <input type="text" name="dollar" class="dollar">            </td>          </tr>          <tr>            <td>GBP * </td>            <td>              <input type="text" name="gbp" class="gbp">            </td>          </tr>          <tr>            <td>Rupiah * </td>            <td>              <input type="text" name="rupiah" class="rupiah">            </td>          </tr>          <tr>            <td>Maximum User * </td>            <td>              <input type="text" name="maximumuser" class="maximumuser">            </td>          </tr>          <tr>            <td>Status</td>            <td>            <input type="radio" name="isactive"  value="1" id="isactivesss"  class="css-checkbox lrg" />                        &nbsp;Is Active            <input style="margin-left:7px;" type="radio" name="isactive"  value="2" id="isactivess"  class="css-checkbox lrg" />                    &nbsp;Not Active            </td>          </tr>            <td></td>            <td><input type="submit" style="float:left;" class="btn btn-warning" id="btnaddmodule" value="Add" />                <img class="load" style="margin:0px;float:left;margin-top:5px;margin-left:10px;" src="<?php echo base_url() ?>assets/pic/load1.gif" width="25">                        </td>          </tr>          </table>        <?php echo form_close(); ?>           <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>         <script>          $(document).ready(function() {                    jQuery.validator.setDefaults({                success: "valid",                submitHandler: function(form) {                     $('.load').fadeIn('slow');                      var counter=2;                              var countdown = setInterval(function(){                                if (counter == 0) {                                clearInterval(countdown);                                $('.load').fadeOut('slow');                                $.ajax({                                      type  : "POST",                                      url: ""+base_url+"schedule/addschedule",                                      data: $("#formaddschedule").serialize(),                                      dataType: "json",                                      success : function(response){                                        $.each( response , function(key,val) {                                          if( val == 'sukses') {                                            $('#addschedule').modal('hide');                                            $('#sticky').sticky('<span style="color:#802222;">user has been added</span>');                                                                                       // load content module                                             $.get( "schedule/getNewSchedule", function( data ) {                                              $("#list-user tr:first").after(data).css({'display':'table-row'});                                              $(data).effect("highlight", {color: '#feeda9'}, 2000);                                            });                                            $('#formaddschedule input[type=text]').val('');                                            var validator = $( "#formaddschedule" ).validate();                                            validator.resetForm();                                            $('input[name=isactive]').attr('checked',false);                                          }                                          });                                        }                                });                            }                        counter--;                      }, 500);                }              });                                      $( "#formaddschedule" ).validate({                rules: {                  selectpartner: {                    required: true                  },                  testvenue: {                    required: true                  },                  module: {                    required: true                  },                  date_of_birth: {                    required: true                  },                  closingreg: {                    required: true                  },                  dollar: {                    required: true                  },                  gbp: {                    required: true                  },                  rupiah: {                    required: true                  },                  maximumuser: {                    required: true                  },                  isactive: {                    required: true                  }                }            });         });           </script>          </div>          </div>                                                        </div>  