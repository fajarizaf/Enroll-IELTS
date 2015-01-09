   <table id="list-user" class="table table-striped table-bordered" style="margin-top:10px;">  
    <tr>
      <th style="width:12%;">Registered ID</th>
      <th style="width:15%;">Registration Date</th>
      <th style="width:32%;">Full Name</th>
      <th style="width:8%;">Status</th>
      <th style="width:40px;">Email</th>
      <th style="width:4%;">Create By</th>
      <th style="width:1%;"></th>
      <th style="width:1%;"></th>

    </tr>


    <?php  if($refreshlist) { ?>
    <?php foreach ( $refreshlist as $row ) { ?>

      <tr atr="<?php echo $row->idusers ?>">
        <td>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></td>
        <td><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?></td>
        <td><?php echo $row->userfamilyname.' '.$row->userfirstname ?></td>
        <td><?php echo $this->showuser->getStatusUser($row->idroles) ?></td>
        <td style="width:40px;"><?php echo $row->useremail ?></td>
        <td><?php echo $this->showuser->getNameUser($row->createdby); ?></td>
       <td><div url="<?php echo base_url() ?>user/edituser/<?php echo $row->idroles; ?>/<?php echo $row->idusers; ?>" href="#edituser" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idusers; ?>"  class="icondelete"></div></td>
      </tr>

    <?php } ?>
    <?php } else { ?>
      <tr>
      <td colspan="9" style="color:#333">filtering user as a <?php echo $this->showuser->getStatusUser($this->input->post('selectroles')); ?> is not found</td>
      </tr>
    <?php } ?>

      <tr>
      <td colspan="9">
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      </td>
      </tr>

    </table>
