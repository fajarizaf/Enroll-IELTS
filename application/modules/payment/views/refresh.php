<table id="list-user" class="table table-striped  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:21%;">Test Venue</th>
      <th style="width:11%;">Schedule Date</th>
      <th style="width:13%;">Candidate Name</th>
      <th style="width:3%;">Detail Candidate</th>
      <th style="width:1%;">Payment Receipt</th>


    </tr>
    <?php  if($refresh) { ?>
    <?php foreach ( $refresh as $row ) { ?>
      <tr>
        <td ><h4 style="color:#333;padding-left:15px;"><?php echo $row->branchname ?></h4><p style="margin-left:15px;"><?php echo $row->examname ?></p></td>
        <td style="border-left:none;"><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td style="border-left:none;"><h4 style="color:orangered;"><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></h4><p>IELTS<?php echo substr("00000" . $row->idusers, -6); ?></p></td>
        <td style="border-left:none;"><div style="margin-top:10px;" url="<?php echo base_url() ?>payment/editpayment/<?php echo $row->idregistrations; ?>/" href="#editregistrations" data-toggle="modal" class="iconedit"></div></td>
        <td style="border-left:none;"><?php $receipt =  $row->paymentreceipt; if($receipt != '') { ?><div style="margin-top:15px;" class="label label-warning">Confirmed</div><?php } else {?>n/a<?php } ?></td>
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