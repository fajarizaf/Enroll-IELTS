<script>
  $(document).ready(function() {

     $('#list-module').on('click','.iconedit', function() {
          $('.down-detail').css({'display':'none'});
          idexams = $(this).attr('value');

                            var clases  = $(this).attr('show');
                            var valclas = '#'+clases;
                            $(''+valclas+'').css({'display':'table-row'});

      });



     $('#list-module').on('click','.icondelete', function() {
        $('.sticky-close').click();
        $('#parentloading').fadeIn('slow');
        var idexams = $(this).attr('value');
        dataString = 'idexams=' + idexams;

          var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"module/deletemodule",
                    data: dataString,
                    dataType:'json',          
                    success : function(data){
                                          
                         $.each( data, function(key,val) { 
                                
                                $('tr[atr='+val+']').css({'background':'#feeda9'}).fadeOut('slow');
                                $('#sticky').sticky('<span style="color:#802222;">Delete Successfully</span>'); 
                    
                         });               
                                              
                      }
                    });
                    return false;

            }
            counter--;
        }, 500);         
        
      });

  
     $('#module-update').submit(function() {
            $('.sticky-close').click();
            $('#parentloading').fadeIn('slow');

            
            $.ajax({
              type  : "POST",
              url: $(this).attr('action'),
              data: $(this).serialize(),
              dataType:'json',          
              success : function(data){
                                    
                   $.each( data, function(key,val) { 

                        if(val == 'sukses') {
                          $('#sticky').sticky('<span style="color:#802222;">Update Successfully</span>'); 
                        } else {
                          $('#sticky').sticky('<span style="color:#802222;">Update Unsuccessfully</span>'); 
                        }

                   });               
                                        
              }
            });
            return false;
    });


      $('#list-module').on('click','.css-label', function() {
        var fors = $(this).attr('for');
        if($('#'+fors+'').attr('checked')) {
            $('#'+fors+'').val('0');
        } else {
            $('#'+fors+'').val('1');
        }
     });

     

  });
</script>



<style>
.down-detail table tr td {
  border:none;
}

</style>


<div class="content">

<div id="add-module" href="#addmodule" data-toggle="modal"  style="float:left;margin-top:10px;"class="btn btn-warning">Add Module</div>

<div style="clear:both;"></div>



  <table id="list-module" class="table table-striped table-bordered" style="margin-top:10px;">
    <tr>
      <th style="width:70%;">Name</th>
      <th style="width:10%;">Status</th>
      <th style="width:4%;">Edit</th>
      <th style="width:4%;">Delete</th>
    </tr>


    <?php $i =1 ?>
    <?php foreach ( $module as $row ) { ?>

      <tr atr="<?php echo $row->idexams ?>">
        <td><?php echo $row->examname ?></td>
        <td><?php echo $row->examstatus ?></td>
        <td><div show="show_edit<?php echo $row->idexams; ?>" value="<?php echo $row->idexams; ?>" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idexams; ?>"  class="icondelete"></div></td>
      </tr>

      <?php $attributes = array('class' => 'module-update', 'id' => 'module-update'); ?>
      <?php echo form_open('module/updatemodule',$attributes);  ?>
      <input type="hidden" name="idexams" value="<?php echo $row->idexams; ?>">
      <tr class="down-detail" id="show_edit<?php echo $row->idexams; ?>"  >
            <td colspan="4" style="display:table-cell" >
              <table>
                <tr>
                  <td style="padding-top:14px;">Module Name</td>
                  <td colspan="2"><input type="text" name="modulename" value="<?php echo $row->examname ?>" class="shownamemodule"></input></td>
                </tr>
                  <tr>
                    <td style="padding-top:14px;">Status</td>
                    <td>
                    <input type="checkbox" name="isactives" <?php if($row->examstatus == 1) {echo 'checked';} ?> value="<?php echo $row->examstatus; ?>" id="isactives<?php echo $row->idexams; ?>"  class="css-checkbox lrg" />
                    <label style="margin-top:4px;" for="isactives<?php echo $row->idexams; ?>"  name="checkbox67_lbl" class="css-label lrg web-two-style"></label>
                    &nbsp;Is Active  
                    </td>
                    <td><input type="submit" name="proses" class="btn btn-success" style="float:right;" value="Update"></input></td>
                  </tr>
              </table>
            </td>
      </tr>      
    <?php $i++ ?>
    <?php } ?>
    <?php echo form_close(); ?>
  

</table>
</div>
