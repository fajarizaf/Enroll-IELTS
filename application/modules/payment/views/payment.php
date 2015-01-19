<script>
  $(document).ready(function() {
    $('#addschedule').css({'width':'770px','margin-left':'-375px'});
    $('#editregistrations').css({'width':'785px','margin-left':'-375px'});

    $('.box-schedule').slimScroll({
             width: '760px',
             height:'400px'
    });

    $('.box-editpayment').slimScroll({
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
                    url: ""+base_url+"payment/filterbydate",
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
                    url: ""+base_url+"payment/filterbyvenue",
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
              $(".box-editpayment").html(data);
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

}

</style>


<div class="content">

<div style="width:215px;float:left;margin-left:0px;margin-top:10px;">
 <input type="text" placeholder="Filter By Date" id="filterdate" name="filterdate">
</div>

<div id="filtertestvenue" style="width:260px;float:left;margin-left:0px;margin-top:10px;">
 <select class="select" id="selectvenues" name="selectvenues">
      <option value="">Filter By Test Venue</option>
    <?php foreach ($venuetest as $rew) { ?>
      <option value="<?php echo $rew->idbranches; ?>"><?php echo $rew->branchname; ?></option> 
    <?php } ?>
   </select>
</div>

<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
<div class="content-user">
  <table id="list-user" class="table table-striped  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:21%;">Test Venue</th>
      <th style="width:11%;">Schedule Date</th>
      <th style="width:10%;">User Code</th>
      <th style="width:13%;">Username</th>
      <th style="width:3%;">Detail Candidate</th>
      <th style="width:3%;">Payment Receipt</th>


    </tr>
    <?php  if($payment) { ?>
    <?php foreach ( $payment as $row ) { ?>
      <tr>
        <td ><h4><?php echo $row->branchname ?></h4><p><?php echo $row->examname ?></p></td>
        <td style="border-left:none;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td style="border-left:none;">IELTS<?php echo substr("00000" . $row->idusers, -6); ?></td>
        <td style="border-left:none;"><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></td>
        <td style="border-left:none;"><div url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
        <td style="border-left:none;"><?php $receipt =  $row->paymentreceipt; if($receipt != '') { ?><span class="label label-warning">Show</span><?php } else {?>n/a<?php } ?></td>
      </tr>
    <?php } ?>
    <?php } else { ?>
      <tr>
        <td colspan="6" >Not Found</td>
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
