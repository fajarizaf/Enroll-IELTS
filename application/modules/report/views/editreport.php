
      <table class="table" >

          <tr style="border:none;padding-bottom:20px;">
            <td colspan="3" style="border:none;padding:0px;">
            <?php foreach ($dataschedule as $rows ) { ?>
              <div style="margin-bottom:10px;color:#fff;padding:10px;width:97%;height:40px;-moz-border-radius:5px 5px 5px;-webkit-border-radius:5px 5px 5px;border-radius:5px 5px 5px;background:orange;">
                <div style="width:auto;float:left;color:#fff">
                <h3 style="margin-top:-5px;"><?php echo $rows->branchname ?></h3>
                <?php echo $this->generated_tanggal->ubahtanggal($rows->schdate); ?>
                </div>
                <span class="label label-warning" style="margin-left:20px;padding:10px; display:inline-block;margin-top:3px;"><?php echo count($editreport); ?>&nbsp;Candidate</span>
                <a style="float:right;padding-left:15px;padding-right:15px;" href="<?php echo base_url() ?>laporan/createxml/<?php echo $this->uri->segment(3); ?>"><div class="btnxml" ></div></a>
                <a style="float:right;padding-left:15px;padding-right:15px;border-right:1px solid #ffbf4b" href="<?php echo base_url() ?>laporan/createxls/<?php echo $this->uri->segment(3); ?>"><div class="btnxls" ></div></a>            
              </div>
            <?php } ?>  

            </td>
          </tr>  
         <table>



<table id="list-user" class="table table-striped  table-bordered" style="margin-top:0px;">
    <tr class="headtable">

      <th style="width:8%;">Date Of Register</th>
      <th style="width:3%;">Time Of Register</th>
      <th style="width:18%;">User Name</th>
      <th style="width:3%;">City</th>
      <th style="width:3%;">Export</th>
    </tr>
    <?php  if($editreport) { ?>
    <?php foreach ($editreport as $row) { ?>


      <tr>
        <td><?php $this->showuser->getDateRegisteredUser($row->idregistrations); ?></td>
        <td><?php $this->showuser->getDateRegisteredUsertime($row->idregistrations); ?></td>
        <td><?php echo $row->userfirstname.' '.$row->userfamilyname  ?></td>
        <td><?php echo $row->useraddr3  ?></td>
        <td><a href="<?php echo base_url(); ?>report/createpdf/<?php $this->showuser->getidUsers($row->idregistrations); ?>/<?php echo $row->idregistrations; ?>"><div class="iconpdf"></div></a></td>
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



       

