<script>
  $(document).ready(function() {


      $('.search-level').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 

                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterlevel",
                            data: dataString,
                            success : function(data){
               
                               $(".box-list-level").html(data);
                                    
                            }
                        });
      });



                    $('.codelevel').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 
                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterlevelcode",
                            data: dataString,
                            success : function(data){
               
                               $('#levelss').val(keyword);
                               var c = $('input[type="text"]').prev();
                               $('#namelevel').html(data);
                               $('.codelevel').valid();

                            }
                        });
                    });

      $('.box-list-level').on('click','.list-country', function() {
          var country = $(this).attr('value');
          var countrycode = $(this).attr('valuecode');
          $('div[selection=active]').html(country);
          $('div[selection=active]').next().next().val(countrycode);
          $('div[selection=active]').next().next().next().val(countrycode);
          $('#levels').modal('hide');
          $('div[selection=active]').removeAttr('selection');
          $('.codelevel').valid();
          if(countrycode == '0') {
            $('.level_other').fadeIn('slow');
            $('#level_other').val('');
            $('#level_other').focus();
          } else {
            $('.level_other').fadeOut('slow');
            $('#level_other').val('-');
          }
      });


  });
</script>


<div id="levels" class="modal hide fade in" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h4>Select Occupation Level</h4>
            </div>
            <div class="modal-body">
               
            <input type="text" name="search-level"  class="search-level" style="width:532px;">

                <ul class="list-country" style="border:1px solid #ccc;background:#efefef;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;">
                   <li class="font1" style="width:30px;color:#333;border-color:#ccc;">No</li>
                   <li class="font1" style="width:410px;color:#333;border-color:#ccc;">Occupation Level Name</li>
                   <li class="font1" style="width:40px;color:#333;border-color:#ccc;">Code</li>
                 </ul>
                 <div class="box-list-level">
               <?php foreach ($level as $row ) { ?>
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

