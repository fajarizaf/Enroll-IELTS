<script>
  $(document).ready(function() {
    $('#addschedule').css({'width':'770px','margin-left':'-375px'});
    $('#editreport').css({'width':'785px','margin-left':'-375px'});

    $('.box-schedule').slimScroll({
             width: '760px',
             height:'400px'
    });

    $('.box-editreport').slimScroll({
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
              $(".box-editreport").html(data);
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
<?php if($this->session->userdata('statususer') == '1') { ?>
<div id="add-module" href="#addschedule" data-toggle="modal"  style="float:left;margin-top:21px;margin-right:10px;"class="btn btn-warning">Add Schedule</div>
<?php }?>
<div style="width:165px;float:left;margin-left:0px;margin-top:10px;">
 <select style="width:30px;" class="select" id="searchby" name="searchby">
    <option value="idusers">Search By</option>  
    <option value="idusers">Registered ID</option> 
    <option value="userfamilyname">Name</option>
 </select>
</div>

<?php if($this->session->userdata('statususer') == '1') { ?>
  <div style="width:165px;float:left;margin-left:10px;margin-top:10px;">
   <select style="width:30px;" class="select" id="selectroles" name="selectroles">
      <option value="all">Roles</option> 
      <option value="2">Registration Center</option>
      <option value="3">Candidate</option>
      <option value="9999">Report</option>
   </select>
  </div>
<?php }?>

<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
<div class="content-user">
  <table id="list-user" class="table table-striped  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:11%;">Partner</th>
      <th style="width:21%;">Registration Centre</th>
      <th style="width:10%;">Module</th>
      <th style="width:13%;">Date Test</th>
      <th style="width:2%;">Registered</th>
      <th style="width:1%;">View</th>
    </tr>
    <?php  if($report) { ?>
    <?php foreach ( $report as $row ) { ?>
      <tr>
        <td><p><?php echo $row->partnername ?></p></td>
        <td style="border-left:none;"><?php echo $row->branchname ?></td>
        <td style="border-left:none;"><?php echo $row->examname ?></td>
        <td style="border-left:none;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td style="border-left:none;"><span class="label label-info"><?php $this->showuser->getUserregistered($row->idschedules); ?></span></td>
        <td style="border-left:none;"><div url="<?php echo base_url() ?>report/editreport/<?php echo $row->idschedules; ?>" href="#editreport" data-toggle="modal" class="iconedit"></div></td>
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
