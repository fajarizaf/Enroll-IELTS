<table id="list-user" class="table  table-bordered" style="margin-top:10px;">
    <tr class="headtable">
      <th style="width:21%;">Name</th>
      <th style="width:9%;">Phone</th>
      <th style="width:49%;">Address</th>
      <th style="width:12%;">City</th>
      <th style="width:2%;">Edit</th>
      <th style="width:2%;">delete</th>
    </tr>
    <?php  if($test) { ?>
    <?php foreach ( $test as $row ) { ?>

      <tr atr="<?php echo $row->idbranches ?>" id="<?php echo $row->idbranches ?>" style="background:#efefef;">
        <td><?php echo $row->branchname ?></td>
        <td><?php echo $row->branchphone ?></td>
        <td><?php echo $row->branchaddr ?></td>
        <td><?php echo $row->cityname ?></td>
        <td><div url="<?php echo base_url() ?>test/edittest/<?php echo $row->idbranches; ?>" href="#edittest" data-toggle="modal" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idbranches; ?>"  class="icondelete"></div></td>
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