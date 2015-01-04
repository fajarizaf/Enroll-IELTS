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


  
    <?php foreach ( $filter as $row ) { ?>

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