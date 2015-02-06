<style>
  .table tr td {
    padding:4px;
  }
   .table tr th {
    padding:4px;
  }
  table {
    width:100%;
  }
  .label {
    font-weight:normal;
  }
</style>    


<?php foreach ($datauser as $row) { ?>
        <?php $atributes = array ('id' => 'formupdateuser'); ?> 
        <?php echo form_open('user/updateuser', $atributes); ?>    

          <table class="table" >
          <tr style="border:none;margin-top:-10px;">
            <td colspan="3" style="border:none;">
              <div style="margin-bottom:10px;color:#fff;padding:10px;width:98%;height:40px;-moz-border-radius:5px 5px 5px;-webkit-border-radius:5px 5px 5px;border-radius:5px 5px 5px;background:#00a6e3;">
                <div style="width:280px;float:left;color:#fff">
                    <div style="width:auto;float:left;height:50px;color:#fff;margin-right:25px;">
                    <h3 style="margin-top:-5px;color:#fff;"><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></h3>
                    Registration Centre
                    </div>

                    <div style="float:left;height:37px;width:auto;" id="countreg" class="label label-info">
                    <a href="<?php echo base_url() ?>payment/filterbyregcenter/<?php echo $row->idusers ?>">
                    <div style="padding:10px;margin-top:-5px;"><h3 style="color:#fff;"><?php $this->showuser->getregisteredregcenter($row->idusers);  ?></h3></div>
                    </a>  
                    </div>

                </div>


                  <div class="stat_photo" style="float:right;">
                    <img <?php if($row->userphoto == '') { ?> src="<?php echo base_url() ?>assets/pic/default.jpg"  <?php } else { ?>  src="<?php echo base_url() ?>upload/<?php echo $row->userphoto ?>"  <?php } ?> width="105%">
                  </div>
              </div>
            </td>
          </tr> 


                  <tr>
                    <th style="width:400px;">Registered ID</th>
                    <th style="width:5px">:</th>
                    <th style="width:400px;">IELTS<?php echo substr("00000" . $row->idusers, -6); ?></th>
                  </tr>

          <tr>

          
            <td style="width:300px;">Username  </td>
            <td style="width:5px;">:</td>
            <td>
              <?php echo $row->username ?>
            </td>
          </tr>

          <tr>
            <td>Last Name (family name/surname)* * </td>
            <td>:</td>
            <td>
              <?php echo $row->userfamilyname ?>
            </td>
          </tr>

          <tr>
            <td>First (given) name(s) * </td>
            <td>:</td>
            <td>
              <?php echo $row->userfirstname ?>
            </td>
          </tr>

          <tr>
            <td>Phone Number * </td>
            <td>:</td>
            <td>
              <?php echo $row->userphone ?>
            </td>
          </tr>

          <tr>
            <td>Email Address * </td>
            <td>:</td>
            <td>
              <?php echo $row->useremail ?>
            </td>
          </tr>

          <tr>
            <td>Address * </td>
            <td>:</td>
            <td>
              <?php echo $row->useraddr1 ?>
            </td>
          </tr>

          <tr>
            <td>City * </td>
            <td>:</td>
            <td>
              <?php echo $row->useraddr3 ?>
            </td>
          </tr>
          

          </table>


<?php echo form_close(); ?> 


<?php } ?>   

