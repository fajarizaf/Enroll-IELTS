<table id="list-user" class="table table-striped table-bordered" style="margin-top:10px;"> 
<tr class="headtable">
      <th style="width:11%;">Partner</th>
      <th style="width:21%;">Registration Centre</th>
      <th style="width:10%;">Module</th>
      <th style="width:13%;">Date Test</th>
      <th style="width:2%;">Registered</th>
      <th style="width:1%;">View</th>
    </tr>
    <?php  if($refresh) { ?>
    <?php foreach ( $refresh as $row ) { ?>
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