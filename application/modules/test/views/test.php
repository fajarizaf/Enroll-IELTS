<script>
  $(document).ready(function() {
    $('#addtestvenue').css({'width':'770px','margin-left':'-375px'});
    $('#addtestvenue').css({'width':'770px','margin-left':'-375px'});

    $('.box-addtest').slimScroll({
             width: '760px',
             height:'400px'
    });

    $('.box-edittest').slimScroll({
             width: '760px',
             height:'380px'
    });

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


    $('#selectroles').change(function() {
        $('#parentloading').fadeIn('slow');
        $('.content-user').css({'opacity':'0.2'}); 
        
        var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);
                var idroles = $('#selectroles').val();
                var dataString = 'selectroles=' + idroles;

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"user/filterByRoles",
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



    $('#list-user').on('click','.iconedit', function() {
      var url = $(this).attr('url');
          // Refresh List 
            $.get( ""+url+"", function( data ) {
              $(".box-editschedule").html(data);
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

<div id="add-module" href="#addtestvenue" data-toggle="modal"  style="float:left;margin-top:21px;margin-right:10px;"class="btn btn-warning">Add Test Venue</div>
<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
<div class="content-user">
  <table id="list-user" class="table  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:21%;">Name</th>
      <th style="width:9%;">Phone</th>
      <th style="width:49%;">Address</th>
      <th style="width:2%;">Action</th>
    </tr>
    <?php  if($test) { ?>
    <?php foreach ( $test as $row ) { ?>

      <tr style="background:#efefef;">
        <td><?php echo $row->branchname ?></td>
        <td><?php echo $row->branchphone ?></td>
        <td><?php echo $row->branchaddr ?></td>
        <td><div url="<?php echo base_url() ?>test/edittest/<?php echo $row->idbranches; ?>/<?php echo $row->idusers; ?>" href="#edituser" data-toggle="modal" class="iconedit"></div></td>
      </tr>
    <?php } ?>
    <?php } else { ?>
      <p>Not Found</p>
      
    <?php } ?>

    <tr>
      <td colspan="9">
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      </td>
    </tr>
</table>


</div>
</div>
