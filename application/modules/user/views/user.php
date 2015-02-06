<script>
  $(document).ready(function() {
    $('#adduser').css({'width':'770px','margin-left':'-375px'});
    $('#edituser').css({'width':'790px','margin-left':'-395px'});

    $('.box-adduser').slimScroll({
             width: '750px',
             height:'400px'
    });

    $('.box-edituser').slimScroll({
             width: '765px',
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




     $('#list-user').on('click','.icondelete', function() {
        $('.sticky-close').click();
        $('#parentloading').fadeIn('slow');
        var idexams = $(this).attr('value');
        dataString = 'idusers=' + idexams;

            var counter=2;
              var countdown = setInterval(function(){
                if (counter == 0) {
                clearInterval(countdown);

                  $.ajax({
                    type  : "POST",
                    url: ""+base_url+"user/deleteuser",
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



    $('.content-user').on('click','.iconedit', function() {
      var url = $(this).attr('url');
          // Refresh List 
            $.get( ""+url+"", function( data ) {
              $(".box-edituser").html(data);
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
<div id="add-module" href="#adduser" data-toggle="modal"  style="float:left;margin-top:21px;margin-right:10px;"class="btn btn-warning">Add User</div>
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

<input type="text" name="search-user"  class="search-admin" <?php if($this->session->userdata('statususer') == '1') { ?> style="width:512px;float:left;margin-top:20px;margin-left:10px;" <?php } else { ?> style="width:783px;float:left;margin-top:20px;margin-left:10px;background-position: 740px 9px;" <?php } ?> >

<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
<div class="content-user">
  <table id="list-user" class="table table-striped table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:12%;">Registered ID</th>
      <th style="width:15%;">Registration Date</th>
      <th style="width:32%;">Full Name</th>
      <th style="width:8%;">Status</th>
      <th style="width:40px;">Email</th>
      <th style="width:4%;">Create By</th>
      <th style="width:1%;">view</th>
      <th style="width:1%;">delete</th>

    </tr>
    <?php  if($user) { ?>
    <?php foreach ( $user as $row ) { ?>

      <tr atr="<?php echo $row->idusers ?>">
        <td>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></td>
        <td><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?></td>
        <td><?php echo $row->userfirstname.' '.$row->userfamilyname ?></td>
        <td><?php echo $this->showuser->getStatusUser($row->idroles) ?></td>
        <td style="width:40px;"><?php echo $row->useremail ?></td>
        <td><?php echo $this->showuser->getNameUser($row->createdby); ?></td>
        <td><div url="<?php echo base_url() ?>user/edituser/<?php echo $row->idroles; ?>/<?php echo $row->idusers; ?>" href="#edituser" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idusers; ?>"  class="icondelete"></div></td>
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
