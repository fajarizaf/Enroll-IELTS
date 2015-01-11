<script type="text/javascript">
  $(document).ready(function() {
      $(".select").selecter();



      $('.box-editschedule').on('change','#selectpartners', function() {
      $('#testvenues').next().remove();
      var partner = $(this).val();
      var dataString = 'partner=' + partner;

                   $.ajax({
                            type  : "POST",
                            url: ""+base_url+"schedule/getTestschedule/"+partner+"",
                            success : function(data){              
                                $('#testvenues').html(data);
                                $("#testvenues").attr('class','select');
                          
                            }
                    });    
      });



      $( "#date_of_births" ).datepicker({
                    showOn: "button",
                    buttonImage: "<?php echo base_url(); ?>assets/pic/calendar.jpg",
                    buttonImageOnly: true,
                    dateFormat: "yy-m-d",

                  }); 

      $( ".closingreg" ).datepicker({
                    showOn: "button",
                    buttonImage: "<?php echo base_url(); ?>assets/pic/calendar.jpg",
                    buttonImageOnly: true,
                    dateFormat: "yy-m-d",

                  });


    $('.box-editschedule').on('change','#selectpartners', function() {
                    $('#selectpartners').valid();
                });
    $('.box-editschedule').on('change','#testvenues', function() {
                    $('#testvenues').valid();
                });
    $('.box-editschedule').on('change','#modules', function() {
                    $('#modules').valid();
                });
    $('.box-editschedule').on('change','#date_of_birth', function() {
                    $('#date_of_birth').valid();
                });
    $('.box-editschedule').on('change','.closingreg', function() {
                    $('.closingreg').valid();
                });


  });  
</script>


<style>
  #formupdateschedule .selecter .selecter-selected {
    width:230px;
  }
  #formupdateschedule .selecter .selecter-options{
    width:254px;
  }
</style>


<?php foreach ($dataschedules as $rows) { ?>
<?php $atributes = array ('id' => 'formupdateschedule'); ?> 
        <?php echo form_open('schedule/updateschedule', $atributes); ?>    

          <table class="table" >
          <input type="hidden" name="idschedules" value="<?php echo $rows->idschedules; ?>">
          <tr>
            <td style="width:270px;">Partner</td>
            <td>
             <select style="width:30px;" class="select"  id="selectpartners" name="selectpartners">
             <option value="<?php echo $idpartner; ?>"><?php echo $partnername; ?></option>
                <?php foreach ($partner as $row) { ?>
                  <option value="<?php echo $row->idpartners ?>"><?php echo $row->partnername ?></option> 
                <?php } ?> 
             </select>
            </td>
          </tr>

          <tr>
            <td>Test Venue * </td>
            <td>
                    <select id="testvenues"  name="testvenues"  style="width:320px;height:40px;">
                        <option value="<?php echo $rows->idbranches ?>"><?php echo $rows->branchname ?></option>
                        <?php foreach ($partnerselected as $rew ) { ?>
                        <option value="<?php echo $rows->idbranches ?>"><?php echo $rew->branchname ?></option>      
                        <?php } ?>
                    </select>
            </td>
          </tr>

          <tr>
            <td>Module * </td>
            <td>
              <select  class="select"  id="modules" name="modules">
                  <option value="<?php echo $rows->idexams ?>"><?php echo $rows->examname ?></option>
                  <option value="4">Academic</option>
                  <option value="3">General Training</option>  
             </select>
            </td>
          </tr>

          <tr>
            <td>Test Date * </td>
            <td>
              <input type="text" id="date_of_births" value="<?php echo $rows->schdate ?>" name="date_of_birth">
            </td>
          </tr>

          <tr>
            <td>Closing Registration * </td>
            <td>
              <input type="text" name="closingreg" value="<?php echo $rows->schclosingreg ?>" class="closingreg">
            </td>
          </tr>

          <tr>
            <td>Dollar (US) * </td>
            <td>
              <input type="text" name="dollar" value="<?php echo $rows->dollar ?>" class="dollar">
            </td>
          </tr>

          <tr>
            <td>GBP * </td>
            <td>
              <input type="text" name="gbp" value="<?php echo $rows->gbp ?>" class="gbp">
            </td>
          </tr>

          <tr>
            <td>Rupiah * </td>
            <td>
              <input type="text" name="rupiah" value='<?php echo $rows->rupiah ?>' class="rupiah">
            </td>
          </tr>

          <tr>
            <td>Maximum User * </td>
            <td>
              <input type="text" name="maximumuser" value="<?php echo $rows->maxuser ?>" class="maximumuser">
            </td>
          </tr>

          <tr>
            <td>Status</td>
            <td>
            <?php if($rows->schstatus == 1 ) { ?>
              <input type="radio" checked="checked" name="isactive"  value="1"  class="css-checkbox lrg" />
            <?php } else { ?>
              <input type="radio" name="isactive"  value="1"  class="css-checkbox lrg" />
            <?php } ?>
            &nbsp;Is Active

            <?php if($rows->schstatus == 2 ) { ?>
            <input style="margin-left:7px;" checked="checked" type="radio" name="isactive"  value="2"  class="css-checkbox lrg" />
            <?php } else { ?>
            <input style="margin-left:7px;" type="radio" name="isactive"  value="2"  class="css-checkbox lrg" />
            <?php } ?>
            &nbsp;Not Active


            </td>
          </tr>
            <td></td>
            <td><input type="submit" style="float:left;" class="btn btn-warning" id="btnaddmodule" value="Update" />
                <img class="load" style="margin:0px;float:left;margin-top:5px;margin-left:10px;" src="<?php echo base_url() ?>assets/pic/load1.gif" width="25">
            
            </td>
          </tr>

          </table>

        <?php echo form_close(); ?> 
        <?php } ?>

          <script src="<?php echo base_url();?>assets/js/jquery.validate.js"></script> 
        <script>
          $(document).ready(function() {
      
              jQuery.validator.setDefaults({
                success: "valid",
                submitHandler: function(form) { 
                    $('.load').fadeIn('slow');


                      var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                $('.load').fadeOut('slow');

                                $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"schedule/updateschedule",
                                      data: $("#formupdateschedule").serialize(),
                                      dataType: "json",
                                      success : function(response){

                                        $.each( response , function(key,val) {
                                          if( val.statuss == 'sukses') {
                                            $('#editschedule').modal('hide');
                                            $('#sticky').sticky('<span style="color:#802222;">user has been Updated</span>');

                                               

                                            // load content module 
                                            $.get( ""+base_url+"schedule/getUpdateSchedule/"+val.idschedules+"", function( data ) {
                                              $("#list-user #"+val.idschedules+"").html(data);
                                            });

                                           


                                          }  
                                        });  


                                      }
                                });  


                          }
                        counter--;
                      }, 500);

                }
              });
            
            
              $( "#formupdateschedule" ).validate({
                rules: {
                  selectpartners: {
                    required: true
                  },
                  testvenues: {
                    required: true
                  },
                  modules: {
                    required: true
                  },
                  date_of_birth: {
                    required: true
                  },
                  closingreg: {
                    required: true
                  },
                  dollar: {
                    required: true
                  },
                  gbp: {
                    required: true
                  },
                  rupiah: {
                    required: true
                  },
                  maximumuser: {
                    required: true
                  },
                  isactive: {
                    required: true
                  }
                }

            });
         });   
        </script>