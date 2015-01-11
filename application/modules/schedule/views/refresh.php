<table id="list-user" class="table table-striped table-bordered" style="margin-top:10px;"> 
<tr class="headtable">
      <th style="width:21%;">Test Dates</th>
      <th style="width:15%;">Module</th>
      <th style="width:9%;">Day</th>
      <th style="width:42%;">Venue</th>
      <th style="width:3%;">Booked</th>
      <th style="width:3%;">Rest</th>
      <th style="width:3%;"></th>

    </tr>
    <?php  if($schedule) { ?>
    <?php foreach ( $schedule as $row ) { ?>

      <tr <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="background:#efefef;"  <?php  }  ?>>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->examname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $this->generated_tanggal->getDay($row->schdate); ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->branchname; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><span class="label label-warning" style="padding-left:10px;padding-right:10px;"><?php echo $this->showuser->getCountBooked($row->idschedules); ?></span></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><?php echo $row->maxuser; ?></td>
        <td <?php if( $row->schstatus == 2 || $row->schclosingreg < date("Y-m-d H:i:s") ) { ?> style="color:#ccc;"  <?php  }  ?>><div url="<?php echo base_url() ?>schedules/editschedules/<?php echo $row->idschedules; ?>" href="#edituser" data-toggle="modal" class="iconedit"></div></td>
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