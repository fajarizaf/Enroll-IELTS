<script>
  $(document).ready(function() {

  $('#list-module').on('click','.iconedit', function() {
          $('tr').removeAttr('status','show');
          $('.down-detail').css({'display':'none'});
          idexams = $(this).attr('value');
          

                            var clases  = $(this).attr('show');
                            var valclas = '#'+clases;
                            $(''+valclas+'').css({'display':'table-row'});
                            $(valclas).attr('status','show');

      });



     $('#list-module').on('click','.icondelete', function() {
        $('.sticky-close').click();
        $('#parentloading').fadeIn('slow');
        var idexams = $(this).attr('value');
        dataString = 'idpartner=' + idexams;

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"partner/deletepartner",
                    data: dataString,
                    dataType:'json',          
                    success : function(data){
                      $('#parentloading').fadeOut('fast');
                                          
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



  $('#list-module').on('click','.btnupdate', function() {
        $('.sticky-close').click();
            $('#parentloading').fadeIn('slow');


            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
               

                      var namemodule = $('tr[status=show] td .partnername').val();
                      var idexams = $('tr[status=show] input[type=hidden]').val();
                      if($('tr[status=show] td input[type=checkbox]').attr('checked')) {
                        var isactive = '1';
                      } else {
                        var isactive = '0';
                      }

                      var dataString = 'partnername=' + namemodule + '&isactives=' + isactive + '&idpartners=' + idexams;

                      $.ajax({
                        type  : "POST",
                        url: ""+base_url+"partner/updatepartner",
                        data: dataString,
                        dataType:'json',          
                        success : function(data){
                                              
                             $.each( data, function(key,val) { 

                                  if(val.status == 'sukses') {
                                    $('#sticky').sticky('<span style="color:#802222;">Update Successfully</span>');
                                    $('tr[status=show]').slideUp('slow');
                                     $('#parentloading').fadeOut('slow'); 

                                        window.location.href =""+base_url+"partner/";

                                  } else {
                                    $('#sticky').sticky('<span style="color:#802222;">Update Unsuccessfully</span>');
                                    $('tr[status=show]').slideUp('slow'); 
                                  }

                             });               
                                                  
                        }
                      });
                      return false;

                }
                counter--;
            }, 500);



    });        


  $('.content-user').on('click','.pagination a', function(e) {
    e.preventDefault();
    //return false;
  });


    $('.content-user').on('click','.pagination a', function() {
        $('#parentloading').fadeIn('slow');
        $('#list-module').css({'opacity':'0.5'});
        var paramUrl = $(this).attr('href');
        $("html, body").animate({ scrollTop: 0 }, "slow");
        
        var counter=1;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('slow');
                $('#list-module').css({'opacity':'1'});

                                            // get Pages 
                                            $.get( ""+paramUrl+"", function( data ) {
                                              $("#list-module").html(data);
                                            });

            }
            counter--;
        }, 500);

    });




    $('#list-user').on('click','.iconedit', function() {
      var url = $(this).attr('url');
          // Refresh List 
            $.get( ""+url+"", function( data ) {
              $(".box-edittest").html(data);
            });
    });


  
     

  });
</script>



<style>
.down-detail table tr td {
  border:none;
}

.selecter .selecter-selected {
  width:140px;
}

.selecter .selecter-options {
  width:164px;
}

}

</style>


<div class="content">

<div id="add-module" href="#addpartner" data-toggle="modal"  style="float:left;margin-top:21px;margin-right:10px;"class="btn btn-warning">Add Partner</div>
<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
<div class="content-user">
  <table id="list-module" class="table table-striped table-bordered" style="margin-top:10px;">
    <tr>
      <th style="width:70%;">Partner Name</th>
      <th style="width:10%;">Status</th>
      <th style="width:4%;">Edit</th>
      <th style="width:4%;">Delete</th>
    </tr>


    <?php $i =1 ?>
    <?php foreach ( $datapartner as $row ) { ?>

      <tr id="<?php echo $row->idpartners ?>" atr="<?php echo $row->idpartners ?>" style="background:#efefef">
        <td><?php echo $row->partnername ?></td>
        <td><?php if($row->partnerstatus == '1') { echo 'enable'; } else { echo 'disable'; }; ?></td>
        <td><div show="show_edit<?php echo $row->idpartners; ?>" value="<?php echo $row->idpartners; ?>" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idpartners; ?>"  class="icondelete"></div></td>
      </tr>

      
      
      <tr class="down-detail" id="show_edit<?php echo $row->idpartners; ?>"   >
      <input type="hidden" name="idpartners" value="<?php echo $row->idpartners; ?>">
            <td colspan="4" style="display:table-cell" >
              <table>
                <tr>
                  <td style="padding-top:14px;">Module Name</td>
                  <td colspan="2"><input type="text" name="partnername" value="<?php echo $row->partnername ?>" class="partnername"></input></td>
                </tr>
                  <tr>
                    <td style="padding-top:14px;">Status</td>
                    <td>
                    <input type="checkbox" name="isactives" <?php if($row->partnerstatus == 1) {echo 'checked';} ?> value="<?php echo $row->partnerstatus; ?>" id="isactives<?php echo $row->idpartners; ?>"  class="css-checkbox lrg" />
                    <label style="margin-top:4px;" for="isactives<?php echo $row->idpartners; ?>"  name="checkbox67_lbl" class="css-label lrg web-two-style"></label>
                    &nbsp;Is Active  
                    </td>
                    <td><input type="submit" name="proses" class="btn btn-success btnupdate" style="float:right;" value="Update"></input></td>
                  </tr>
              </table>
            </td>
      </tr>      
    <?php $i++ ?>
    <?php } ?>
  
  <tr>
      <td colspan="9">
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      </td>
    </tr>

</table>


</div>
</div>
