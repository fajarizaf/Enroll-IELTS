<script type="text/javascript">
  $(document).ready(function() {
      $('#upphotos').click(function() {
          var valimage = $('.uploadfileimage').val();
          if(valimage == '') {
                        alert = '<div style="color:orange;margin-top:7px;">Please upload a file of your ID copy from your local drive</div>';  
                        $('.resultphoto').html(alert);

          } else {
            var valueImage = $('.uploadfileimage').val();
            $('#uploadphotos').modal('hide'); 
            $('.uploadfile').val(valueImage);
            $('.uploadfile').valid();
          }
      })
  });
</script>


<div id="uploadphotos" class="modal hide fade in" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal"></a>
              <h4>Uplaod ID Card</h4>
            </div>
            <div class="modal-body">
               
              <div class="photosid">
                
              </div>
              <div style="width:250px;float:left;">
                <ul>
                  <li>Recommended dimension of the photo is 500 x 750 and the file size must be smaller than 1MB and must be greater than 50Kb</li>
                </ul>
                 
              </div>

            </div>
            <div class="modal-footer">
                     <input type="file" onChange="JavaScript:AjaxUploads.UploadsFile();" name="uploadidcard[]" id="uploadidcard" style="display:none;" class="uploadidcard">
                     <input type="hidden" name="uploadfileimage" class="uploadfileimage"> 
                     <div name="upload" style="float:left;" id="uploadidcard1" class="btn btn-warning"  value="Upload">Browse Image</div>
                     <img src="<?php echo base_url(); ?>assets/pic/load1.gif" style="margin-top:5px;margin-left:5px;float:left;margin-right:10px;" class="load">
                     <div class="resultphoto" style="float:left;margin-right:10px;margin-left:10px;"></div>
                     <div id="upphotos"  style="float:right;margin-top:0px;"class="btn btn-success" >Upload</div>
            </div>
           
          </div>

