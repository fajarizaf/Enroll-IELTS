<script type="text/javascript">  $(document).ready(function() {    $('#btnaddpartner').click(function() {      $('.sticky-close').click();      $('.load').fadeIn('fast');    if(!$('.partnername').val()) {        $('.partnername').focus();        $('.load').fadeOut('fast');    } else {      var modulename = $('.partnername').val();        if($('#isactive').is(':checked')) {          var isactive = $('#isactive').val();        } else {          var isactive = '0';        }              var dataString = 'partnername=' + modulename + '&isactive=' + isactive;                var counter=2;                      var countdown = setInterval(function(){                        if (counter == 0) {                        clearInterval(countdown);                          $.ajax({                              type  : "POST",                              url: ""+base_url+"partner/addpartner",                              data: dataString,                              dataType: 'json',                              success : function(data){                                $('.load').fadeOut('fast');                                 $.each( data, function(key,val) {                                   $('.partnername').val('');                                    if( val == 'sukses') {                                     $('#addpartner').modal('hide');                                     $('#sticky').sticky('<span style="color:#802222;">add a new partner successfully</span>');                                     } else {                                     $('#addpartner').modal('hide');                                     $('#sticky').sticky('<span style="color:#802222;">failed to add a new partner</span>');                                     }                                });                                            // Refresh List                                             $.get( ""+base_url+"partner/refreshList", function( data ) {                                              $("#list-module").html(data);                                            });                                  }                          });                        }                  counter--;                }, 500);      }    });   });</script><style>  #formaddschedule .selecter .selecter-selected {    width:230px;  }  #formaddschedule .selecter .selecter-options{    width:254px;  }</style><div id="addpartner" class="modal hide fade in" style="display: none; ">          <div class="modal-header">              <a class="close" data-dismiss="modal">×</a>              <h4>Add Partner</h4>          </div>          <div class="modal-body" style="padding-left:10px;">          <div class="box-addpartner">                <?php $atributes = array ('id' => 'formaddtest'); ?>         <?php echo form_open('partner/addpartner', $atributes); ?>              <table>                      <tr>            <td>Partner Name</td>            <td><input style="width:410px;margin-top:8px;" type="text" name="partnername" class="partnername"></td>          </tr>          <tr>            <td>Status</td>            <td>            <input type="checkbox" name="isactive"  value="1" id="isactive"  class="css-checkbox lrg" />            <label style="margin-top:4px;" for="isactive"  name="checkbox67_lbl" class="css-label lrg web-two-style"></label>            &nbsp;Is Active            </td>          </tr>          </table>        <?php echo form_close(); ?>                    </div>          </div>          <div class="modal-footer">            <input type="submit" style="float:right;" class="btn btn-warning" id="btnaddpartner" value="Add" />             <img class="load" style="margin:0px;float:right;margin-top:5px;margin-right:17px;" src="<?php echo base_url() ?>assets/pic/load1.gif" width="25">          </div>                                                        </div>  