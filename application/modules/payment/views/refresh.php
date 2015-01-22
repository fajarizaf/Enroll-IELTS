<table id="list-user" class="table table-striped  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:11%;">ID Registrations</th>
      <th style="width:21%;">Test Venue</th>
      <th style="width:11%;">Schedule Date</th>
      <?php if($this->session->userdata('statususer') == 3) { ?>
      <th style="width:16%;">Date Of Register</th>
      <th style="width:3%;">Detail</th>
      <th style="width:3%;">Confirm Payment</th>
      <?php } else { ?>
      <th style="width:16%;">Candidate Name</th>
      <th style="width:3%;">Detail</th>
      <th style="width:1%;">Payment Receipt</th>
      <?php } ?>


    </tr>
    <?php  if($refresh) { ?>
    <?php foreach ( $refresh as $row ) { ?>
      <tr  atr="<?php echo $row->idregistrations ?>" id="<?php echo $row->idregistrations ?>" >
        <td >REG<?php echo substr("00000" . $row->idregistrations, -6); ?></td>
        <td style="border-left:none;" ><h4 style="color:#333;padding-left:15px;"><?php echo $row->branchname ?></h4><p style="margin-left:15px;"><?php echo $row->examname ?></p></td>
        <td style="border-left:none;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <?php if($this->session->userdata('statususer') == 3) { ?>
          <?php if($row->paymentreceipt == '') { ?>
            <td style="border-left:none"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?> <span style="margin-left:10px;" class="label label-info"><?php echo $this->generated_tanggal->ubahtanggaltime($row->created); ?></span></td>
            <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
            <td style="border-left:none;"><input href="#confirmpayment" data-toggle="modal" types="btnconfirm"  atrs="<?php echo $row->idregistrations;  ?>" atr="REG<?php echo substr("00000" . $row->idregistrations, -6); ?>" type="button" class="btn btn-warning" value="Confirm"></td>
          <?php } else { ?>
            <td style="border-left:none"><?php echo $this->generated_tanggal->ubahtanggal($row->created); ?> <span style="margin-left:10px;" class="label label-info"><?php echo $this->generated_tanggal->ubahtanggaltime($row->created); ?></span></td>
            <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>  
            <td style="border-left:none;"><input  style="opacity:0.4"  type="button"  class="btn" value="Confirmed"></td>
          <?php } ?>
        <?php } else { ?>
        <td style="border-left:none;"><h4 style="color:orangered;"><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></h4><p>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></p></td>
        <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
        <td style="border-left:none;"><?php $receipt =  $row->paymentreceipt; if($receipt != '') { ?><div style="margin-top:6px;padding-top:7px;padding-left:8px;cursor:pointer" btn="paid" atr="<?php echo $row->idregistrations ?>" class="label label-warning">Uploaded</div><?php } else {?>n/a<?php } ?></td>
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