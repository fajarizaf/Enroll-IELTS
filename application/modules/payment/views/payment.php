<script>
  $(document).ready(function() {
    $('#addschedule').css({'width':'770px','margin-left':'-375px'});
    $('#editregistrations').css({'width':'885px','margin-left':'-445px'});
    $('#confirmpayment').css({'width':'385px','margin-left':'-175px'});
    $('#box-tos').css({'width':'785px','margin-left':'-375px','margin-top':'-60px;'});


    $('.box-schedule').slimScroll({
             width: '760px',
             height:'400px'
    });

    $('.box-editpayment').slimScroll({
             width: '857px',
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


    $('.content-user').on('click','div[btn=paid]', function() {
        var idreg = $(this).attr('atr');
        var idschedules = $(this).attr('scd');
        $(this).html('<div class="ajaxload"></div><div style="width:20px;float:left;color:#fff;">proses...</div>');

                  var counter=5;
                      var countdown = setInterval(function(){
                        if (counter == 0) {
                        clearInterval(countdown);


                   $.ajax({
                            type  : "POST",
                            url: ""+base_url+"payment/paid/"+idreg+"/"+idschedules+"",
                            success : function(data){              
                                 $('tr[atr='+idreg+']').css({'background':'#feeda9'}).fadeOut('slow');
                                 $('#sticky').sticky('<span style="color:#802222;">Payment Status Paid</span>'); 
                          
                            }
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



    $('.content-user').on('click','.iconedit', function() {
      var url = $(this).attr('url');
          // Refresh List 
            $.get( ""+url+"", function( data ) {
              $(".box-editpayment").html(data);
            });
    });


  $( "#filterdate" ).datepicker({
                    dateFormat: "yy-m-d",
                  });


  $("input[types=btnconfirm]").click(function() {
    $('.box-succesconfirm').hide('fast');
    $('.box-confirm').fadeIn('fast');
     $('#prosesconfirmpayment').show('fast');  
    

    var idreg = $(this).attr('atr');
    var idregs = $(this).attr('atrs');
    $('.idreg').val(idreg);
    $('.idregs').val(idregs);
  })
  


  



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

#box-tos {
  margin-top:-25%;
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
      <th style="width:14%;">ID card ( KTP / Password )</th>
      <th style="width:16%;">Test Venue</th>
      <th style="width:11%;">Schedule Date</th>
      <?php if($this->session->userdata('statususer') == 3) { ?>
      <th style="width:16%;">Date Of Register</th>
      <th style="width:3%;">Detail</th>
      <th style="width:3%;">Proof of payment</th>
      <?php } else { ?>
      <th style="width:16%;">Candidate Name</th>
      <th style="width:3%;">Detail</th>
      <th style="width:1%;">Payment Receipt</th>
      <?php } ?>


    </tr>
    <?php  if($payment) { ?>
    <?php foreach ( $payment as $row ) { ?>
      <tr  atr="<?php echo $row->idregistrations ?>" id="<?php echo $row->idregistrations ?>" >
        <td ><?php echo $row->useridnumber ?></td>
        <td style="border-left:none;" ><p style="color:#333;padding-left:15px;font-size:16px;"><?php echo $row->branchname ?></p><p style="margin-left:15px;"><?php echo $row->examname ?></p></td>
        <td style="border-left:none;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <?php if($this->session->userdata('statususer') == 3) { ?>
          <?php if($row->paymentreceipt == '') { ?>
            <td style="border-left:none"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?> <span style="margin-left:10px;" class="label label-info"><?php echo $this->generated_tanggal->ubahtanggaltime($row->created); ?></span></td>
            <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
            <td style="border-left:none;"><input href="#confirmpayment" data-toggle="modal" types="btnconfirm"  atrs="<?php echo $row->idregistrations;  ?>" atr="<?php echo $row->useridnumber ?>" type="button" class="btn btn-warning" value="Submit"></td>
          <?php } else { ?>
            <td style="border-left:none"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?> <span style="margin-left:10px;" class="label label-info"><?php echo $this->generated_tanggal->ubahtanggaltime($row->created); ?></span></td>
            <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>  
            <td style="border-left:none;"><input  style="opacity:0.4"  type="button"  class="btn" value="Submited"></td>
          <?php } ?>
        <?php } else { ?>
        <td style="border-left:none;"><h4 style="color:orangered;"><?php echo $row->userfamilyname.' '.$row->userfirstname  ?></h4><p>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></p></td>
        <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
        <td style="border-left:none;"><?php $receipt =  $row->paymentreceipt; if($receipt != '') { ?><div style="margin-top:6px;padding-top:7px;padding-left:8px;cursor:pointer" btn="paid" atr="<?php echo $row->idregistrations ?>" scd="<?php echo $row->idschedules; ?>" class="label label-warning">Uploaded</div><?php } else {?>n/a<?php } ?></td>
        <?php } ?>
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
