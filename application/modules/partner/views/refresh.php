<table id="list-module" class="table table-striped table-bordered" style="margin-top:10px;">
    <tr>
      <th style="width:70%;">Partner Name</th>
      <th style="width:10%;">Status</th>
      <th style="width:4%;">Edit</th>
      <th style="width:4%;">Delete</th>
    </tr>


    <?php $i =1 ?>
    <?php foreach ( $datapartner as $row ) { ?>

      <tr id="<?php echo $row->idpartners ?>" atr="<?php echo $row->idpartners ?>" style="background:#efefef">
        <td><?php echo $row->partnername ?></td>
        <td><?php echo $row->partnerstatus ?></td>
        <td><div show="show_edit<?php echo $row->idpartners; ?>" value="<?php echo $row->idpartners; ?>" class="iconedit"></div></td>
        <td><div value="<?php echo $row->idpartners; ?>"  class="icondelete"></div></td>
      </tr>

      
      
      <tr class="down-detail" id="show_edit<?php echo $row->idpartners; ?>"   >
      <input type="hidden" name="idpartners" value="<?php echo $row->idpartners; ?>">
            <td colspan="4" style="display:table-cell" >
              <table>
                <tr>
                  <td style="padding-top:14px;">Module Name</td>
                  <td colspan="2"><input type="text" name="partnername" value="<?php echo $row->partnername ?>" class="partnername"></input></td>
                </tr>
                  <tr>
                    <td style="padding-top:14px;">Status</td>
                    <td>
                    <input type="checkbox" name="isactives" <?php if($row->partnerstatus == 1) {echo 'checked';} ?> value="<?php echo $row->partnerstatus; ?>" id="isactives<?php echo $row->idpartners; ?>"  class="css-checkbox lrg" />
                    <label style="margin-top:4px;" for="isactives<?php echo $row->idpartners; ?>"  name="checkbox67_lbl" class="css-label lrg web-two-style"></label>
                    &nbsp;Is Active  
                    </td>
                    <td><input type="submit" name="proses" class="btn btn-success btnupdate" style="float:right;" value="Update"></input></td>
                  </tr>
              </table>
            </td>
      </tr>      
    <?php $i++ ?>
    <?php } ?>
  
  <tr>
      <td colspan="9">
        <div class="pagination"><?php echo $this->pagination->create_links(); ?></div>
      </td>
    </tr>

</table>