
      


<?php foreach ($datapayment as $row) { ?>
        <?php $atributes = array ('id' => 'formupdatepayment'); ?> 
        <?php echo form_open('payment/updatepayment', $atributes); ?>    

          <table class="table" style="width:520px;float:left;margin-right:20px;" >

          

                  <tr class="box-proof">
                    <th colspan="3"><img style="width:740px;" src="<?php echo base_url(); ?>upload/<?php echo $row->paymentreceipt ?>"></th>
                  </tr>

                  <tr>
                    <td style="width:400px;">Registrations Centre</td>
                    <td style="width:5px">:</td>
                    <td style="width:400px;"><?php echo $row->partnername ?></td>
                  </tr>

                  <tr>
                    <td style="width:400px;">Test Venue</td>
                    <td style="width:5px">:</td>
                    <td style="width:400px;"><?php echo $row->branchname ?></td>
                  </tr>

                  <tr>
                    <td style="width:400px">Date Of Test</td>
                    <td style="width:10px">:</td>
                    <td><?php echo $this->generated_tanggal->ubahtanggal($row->schdate); ?></td>
                  </tr>
                
                  <tr><td><h4>Registrations Fee</h4></td><td></td><td></td></tr>

                  <tr>
                    <td style="width:400px">Dollar US</td>
                    <td style="width:10px">:</td>
                    <td>USD &nbsp;<?php echo $row->dollar ?></td>
                  </tr>
                  

                  <tr>
                    <td>GBP</td>
                    <td>:</td>
                   <td>GBP &nbsp;<?php echo $row->gbp ?></td>
                  </tr>

                  <tr>
                    <td>Rupiah</td>
                    <td>:</td>
                    <td>IDR &nbsp; <?php echo number_format($row->rupiah,2,",","."); ?></td>
                  </tr>

                  <tr>
                    <td>Payment Status</td>
                    <td>:</td>
                    <td><span style="color:#00a6e3;font-weight:bold"><?php if ($row->paymentreceipt == '') { echo 'Unpaid'; } else if( $row->paymentreceipt != '' && $row->registrationspayment == 'unpaid') { echo 'Awaiting payment confirmation'; } else if( $row->paymentreceipt != '' && $row->registrationspayment == 'PAID')  { echo "PAID"; } ?></span></td>
                  </tr>

                </table>


                <div class="imageproof">
                  <?php if($row->paymentreceipt != '') { ?>
                    <img src="<?php echo base_url() ?>upload/<?php echo $row->paymentreceipt ?>" width="200px">
                  <?php } else { ?>
                    <img src="<?php echo base_url() ?>assets/pic/noimage.jpg" width="200px">
                  <?php } ?>
                </div>


<?php echo form_close(); ?> 


<?php } ?>   

