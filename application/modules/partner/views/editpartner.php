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

      $( "#closingreg" ).datepicker({
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
    $('.box-editschedule').on('change','#closingreg', function() {
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


<?php foreach ($datatest as $rows) { ?>
<?php $atributes = array ('id' => 'formupdatetest'); ?> 
        <?php echo form_open('test/updatestest', $atributes); ?>    

          <table class="table" >
          <input type="hidden" name="idbranches" value="<?php echo $rows->idbranches; ?>">

          <tr>
            <td style="width:270px;">Partner Name</td>
            <td>
             <select style="width:30px;" class="select"  id="selectpartner" name="selectpartner">
                  <option value="<?php echo $rows->idpartners; ?>" ><?php echo $rows->partnername; ?></option>
                <?php foreach ($partner as $row) { ?>
                  <option value="<?php echo $row->idpartners ?>"><?php echo $row->partnername ?></option> 
                <?php } ?> 
             </select>
            </td>
          </tr>

          <tr>
            <td>Registration Center/ Test Venue </td>
            <td>
                    <input type="text" value="<?php echo $rows->branchname ?>" id="testvenuename" name="testvenuename">
            </td>
          </tr>

          <?php
            if($rows->branchphone) { 
              $phone = $rows->branchphone;
              $areacode = explode('|',$phone);
            }
           ?>

          <tr>
            <td>Registration Center/ Test Venue Phone</td>
            <td>
              <input type="text" style="width:50px;float:left;margin-right:15px;" id="areacode" <?php  if($rows->branchphone) {  ?> value="<?php echo $areacode[0] ?>" <?php } ?> name="areacode">
              <input type="text" style="width:145px;float:left;" id="phone" <?php  if($rows->branchphone) {  ?> value="<?php echo $areacode[1] ?>" <?php } ?> name="phone">
            </td>
          </tr>

          <tr>
            <td>Registration Center/ Test Venue Email </td>
            <td>
              <input type="text" id="email" value="<?php echo $rows->branchemail; ?>" name="email">
            </td>
          </tr>

          <tr>
            <td>Registration Center/ Test Venue Email</td>
            <td>
              <textarea name="address" class="address"  style="-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;width:300px;height:100px;" ><?php echo $rows->branchaddr; ?></textarea>
            </td>
          </tr>

          <tr>
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
                    $('label[for=phone]').css({'display':'none'});


                      var counter=2;
                              var countdown = setInterval(function(){
                                if (counter == 0) {
                                clearInterval(countdown);
                                $('.load').fadeOut('slow');

                                $.ajax({
                                      type  : "POST",
                                      url: ""+base_url+"partner/updatepartner",
                                      data: $("#formupdatetest").serialize(),
                                      dataType: "json",
                                      success : function(response){

                                        $.each( response , function(key,val) {
                                          if( val.statuss == 'sukses') {
                                            $('#edittest').modal('hide');

                                            $('#sticky').sticky('<span style="color:#802222;">user has been Updated</span>');

                                            // load content module 
                                            $.get( ""+base_url+"partner/getUpdatePartner/"+val.idpartners+"", function( data ) {
                                              $("#list-user #"+val.idpartners+"").html(data);
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


            
            
              $( "#formupdatetest" ).validate({
                rules: {
                  selectpartner: {
                    required: true
                  },
                  testvenuename: {
                    required: true
                  },
                  areacode: {
                    required: true
                  },
                  phone: {
                    required: true
                  },
                  email: {
                    required: true
                  },
                  address: {
                    required: true
                  }
                }

            });
         });   
        </script>