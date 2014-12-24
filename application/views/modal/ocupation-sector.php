<script>
  $(document).ready(function() {


      $('.search-sector').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 

                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filtersector",
                            data: dataString,
                            success : function(data){
               
                               $(".box-list-sector").html(data);
                                    
                            }
                        });
      });



                    $('.codesector').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 
                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filtersectorcode",
                            data: dataString,
                            success : function(data){
               
                               $('#sectors').val(keyword);
                               var c = $('input[type="text"]').prev();
                               $('#namesector').html(data);
                               $('.codesector').valid();

                            }
                        });
                    });

      $('.box-list-sector').on('click','.list-country', function() {
          var country = $(this).attr('value');
          var countrycode = $(this).attr('valuecode');
          $('div[selection=active]').html(country);
          $('div[selection=active]').next().next().val(countrycode);
          $('div[selection=active]').next().next().next().val(countrycode);
          $('#sector').modal('hide');
          $('div[selection=active]').removeAttr('selection');
          $('.codesector').valid();
          if(countrycode == '00') {
            $('.sector_other').fadeIn('slow');
            $('#sector_other').val('');
            $('#sector_other').focus();
          } else {
            $('.sector_other').fadeOut('slow');
            $('#sector_other').val('-');
          }
      });


  });
</script>


<div id="sector" class="modal hide fade in" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h4>Select Occupation Sector</h4>
            </div>
            <div class="modal-body">
               
            <input type="text" name="search-sector"  class="search-sector" style="width:532px;">

                <ul class="list-country" style="border:1px solid #ccc;background:#efefef;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;">
                   <li class="font1" style="width:30px;color:#333;border-color:#ccc;">No</li>
                   <li class="font1" style="width:410px;color:#333;border-color:#ccc;">Occupation Sector Name</li>
                   <li class="font1" style="width:40px;color:#333;border-color:#ccc;">Code</li>
                 </ul>
                 <div class="box-list-sector">
               <?php foreach ($sector as $row ) { ?>
                 <ul value="<?php echo $row->name ?>" valuecode="<?php echo $row->code ?>" class="list-country">
                   <li style="width:30px;"><?php echo $row->no ?></li>
                   <li style="width:410px;"><?php echo $row->name ?></li>
                   <li style="width:60px;"><?php echo $row->code ?></li>
                 </ul>
               <?php } ?>  
                </div>
                        
                        
                        
                      
                    
                    


            </div>
            <div class="modal-footer">
            
            </div>
           
          </div>

