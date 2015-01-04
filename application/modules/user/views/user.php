<script>
  $(document).ready(function() {

    $('#selectroles').change(function() {
        $('#parentloading').fadeIn('slow');
        $('#list-module').css({'opacity':'0.2'}); 
        
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
                         $('#list-module').css({'opacity':'1'});            
                         $('#list-module').html(data);              
                                              
                      }
                    });
                    return false;

            }
            counter--;
        }, 500);

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

<div id="add-module" href="#addmodule" data-toggle="modal"  style="float:left;margin-top:21px;"class="btn btn-warning">Add Module</div>

<div style="width:165px;float:left;margin-left:10px;margin-top:10px;">
 <select style="width:30px;" class="select" id="searchby" name="searchby">
    <option value="id">Search By</option>  
    <option value="id">Registered ID</option> 
    <option value="username">Username</option>
 </select>
</div>

<div style="width:165px;float:left;margin-left:10px;margin-top:10px;">
 <select style="width:30px;" class="select" id="selectroles" name="selectroles">
    <option value="1">Roles</option> 
    <option value="2">Registration Center</option>
    <option value="3">Candidate</option>
    <option value="9999">Report</option>
 </select>
</div>

 <input type="text" name="search-user"  class="search-admin" style="width:495px;float:left;margin-top:20px;margin-left:10px;">

<div style="clear:both;"></div>


<img style="position:absolute;margin-left:auto;margin-right:auto;left:50%;right:50%;top:500px;" class="load" src="<?php echo base_url() ?>assets/pic/load1.gif" >
  <table id="list-module" class="table table-striped table-bordered" style="margin-top:10px;">
    <tr>
      <th style="width:50%;">Registered ID</th>
      <th style="width:10%;">Registration Date</th>
      <th style="width:4%;">Full Name</th>
      <th style="width:4%;">Status</th>
      <th style="width:4%;">Phone</th>
      <th style="width:40px;">Email</th>
      <th style="width:4%;">Create By</th>
      <th style="width:1%;"></th>
      <th style="width:1%;"></th>

    </tr>


  
    <?php foreach ( $user as $row ) { ?>

      <tr atr="<?php echo $row->idusers ?>">
        <td>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></td>
        <td><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?></td>
        <td><?php echo $row->userfirstname.' '.$row->userfamilyname ?></td>
        <td><?php echo $this->showuser->getStatusUser($row->idroles) ?></td>
        <td><?php echo $row->userphone ?></td>
        <td style="width:40px;"><?php echo $row->useremail ?></td>
        <td><?php echo $this->showuser->getNameUser($row->createdby); ?></td>
        <td><div show="show_edit<?php echo $row->idusers; ?>" value="<?php echo $row->idusers; ?>" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idusers; ?>"  class="icondelete"></div></td>
      </tr>

    <?php } ?>
  
  

</table>
</div>
