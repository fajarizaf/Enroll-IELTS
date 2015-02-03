<script>
  $(document).ready(function() {
    $('#addschedule').css({'width':'770px','margin-left':'-375px'});
    $('#editschedule').css({'width':'770px','margin-left':'-375px'});

   

     $('.search-admin').keyup(function() {

      var valueserch = $(this).val();
      var searchby = $('#searchby').val();
      var idroles = $('#selectroles').val();

                    var keyword = $(this).val(); 
                    var dataString = 'search=' + valueserch + '&searchby=' + searchby + '&idroles=' + idroles; 

                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"user/filter",
                            data: dataString,
                            success : function(data){
               
                               $(".content-user").html(data);
                                    
                            }
                    });
      });

     $('#filterdate').change(function() {
        $('#parentloading').fadeIn('slow');
        $('.content-user').css({'opacity':'0.2'}); 
        
        var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                var idroles = $('#filterdate').val();
                var dataString = 'date=' + idroles;

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"schedule/filterbydate",
                    data: dataString,      
                    success : function(data){
                         $('#parentloading').fadeOut('slow');
                         $('.load').fadeOut('fast');
                         $('.content-user').css({'opacity':'1'});            
                         $('.content-user').html(data);              
                                              
                      }
                    });
                    return false;

            }
            counter--;
        }, 500);

    });



    $('#selectvenues').change(function() {
        $('#parentloading').fadeIn('slow');
        $('.content-user').css({'opacity':'0.2'}); 
        
        var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                var idroles = $('#selectvenues').val();
                var dataString = 'venue=' + idroles;

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"schedule/filterbyvenue",
                    data: dataString,      
                    success : function(data){
                         $('#parentloading').fadeOut('slow');
                         $('.load').fadeOut('fast');
                         $('.content-user').css({'opacity':'1'});            
                         $('.content-user').html(data);              
                                              
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
        $('#list-user').css({'opacity':'0.5'});
        var paramUrl = $(this).attr('href');
        $("html, body").animate({ scrollTop: 0 }, "slow");
        
        var counter=1;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                $('#parentloading').fadeOut('slow');
                $('#list-user').css({'opacity':'1'});

                                            // get Pages 
                                            $.get( ""+paramUrl+"", function( data ) {
                                              $("#list-user").html(data);
                                            });

            }
            counter--;
        }, 500);

    });



    $('#list-user').on('click','.icondelete', function() {
        $('.sticky-close').click();
        $('#parentloading').fadeIn('slow');
        var idexams = $(this).attr('value');
        dataString = 'idschedules=' + idexams;

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"schedule/deleteschedule",
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



    $('#list-user').on('click','.iconedit', function() {
      var url = $(this).attr('url');
          // Refresh List 
            $.get( ""+url+"", function( data ) {
              $(".box-editschedule").html(data);
            });
    });


    $( "#filterdate" ).datepicker({
                    dateFormat: "yy-m-d",
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

  #filtertestvenue .selecter .selecter-selected {
    width:230px;
  }
  #filtertestvenue .selecter .selecter-options{
    width:254px;
  }

  .ui-datepicker-trigger {
    cursor: pointer;
  }

</style>


<div class="content">

<div id="add-module" href="#addschedule" data-toggle="modal"  style="float:left;margin-top:21px;margin-right:10px;"class="btn btn-warning">Add Schedule</div>

<div style="width:215px;float:left;margin-left:0px;margin-top:10px;">
 <input type="text" placeholder="filter by date" id="filterdate" name="filterdate">
</div>

  <div id="filtertestvenue" style="width:215px;float:left;margin-left:10px;margin-top:10px;">
   <select class="select" id="selectvenues" name="selectvenues">
      <option value="">Filter By Registration Centre</option>
    <?php foreach ($venuetest as $rew) { ?>
      <option value="<?php echo $rew->idbranches; ?>"><?php echo $rew->branchname; ?></option> 
    <?php } ?>
   </select>
  </div>


<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
<div class="content-user">
  <table id="list-user" class="table  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:21%;">Test Dates</th>
      <th style="width:15%;">Module</th>
      <th style="width:9%;">Day</th>
      <th style="width:30%;">Registration Centre</th>
      <th style="width:3%;">Booked</th>
      <th style="width:3%;">Rest</th>
      <th style="width:3%;">edit</th>
      <th style="width:3%;">delete</th>
      <th style="width:3%;">status</th>


    </tr>
    <?php  if($schedule) { ?>
    <?php foreach ( $schedule as $row ) { ?>

      <tr atr="<?php echo $row->idschedules ?>" id="<?php echo $row->idschedules; ?>" <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="background:#efefef;"  <?php  }  ?>>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->examname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->getDay($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->branchname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><span class="label label-warning" style="padding-left:10px;padding-right:10px;"><?php echo $this->showuser->getCountBooked($row->idschedules); ?></span></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->maxuser; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><div url="<?php echo base_url() ?>schedule/editschedules/<?php echo $row->idschedules; ?>" href="#editschedule" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idschedules; ?>"  class="icondelete"></div></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?><span class="label label-info" style="padding-left:10px;padding-right:10px;">Full</span><?php } else { echo '-'; } ?></td>
      </tr>
    <?php } ?>
    <?php } else { ?>
       <tr>
        <td colspan="9" >Not Found</td>
       </tr>
      
    <?php } ?>

    <tr>
      <td colspan="9">
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      </td>
    </tr>
</table>


</div>
</div>
