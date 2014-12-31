<script>
  $(document).ready(function() {


      $('.search-country').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 

                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filtercountry",
                            data: dataString,
                            success : function(data){
               
                               $(".box-list-country").html(data);
                                    
                            }
                        });
      });


                    $('.codecity').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 
                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filtercountrycode",
                            data: dataString,
                            success : function(data){
               
                               $('#country').val(keyword);
                               var c = $('input[type="text"]').prev();
                               $('#namecountry').html(data);
                               $('.codecity').valid();
                            }
                        });
                    });


                    $('.codecountryorigin').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 
                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filtercountrycode",
                            data: dataString,
                            success : function(data){
               
                               $('#country_origin').val(keyword);
                               var c = $('input[type="text"]').prev();
                               $('#countryorigin').html(data);
                               $('.codecountryorigin').valid();

                            }
                        });
                    });

      $('.box-list-country').on('click','.list-country', function() {
        var type = $('div[selection=active]').attr('id');
          var country = $(this).attr('value');
          var countrycode = $(this).attr('valuecode');
          $('div[selection=active]').html(country);
          $('div[selection=active]').next().next().val(countrycode);
          $('div[selection=active]').next().next().next().val(countrycode);
          $('#listcity').modal('hide');
          if(type == 'countryorigin') {
            $('.codecountryorigin').valid();
          } else {
            $('.codecity').valid();
          }
          $('div[selection=active]').removeAttr('selection');

      });



      $('#country_applying').change(function() {
        var countrycode = $(this).val();
          if(countrycode == '000') {
            $('.other_applying').fadeIn('slow');
            $('#other_country_applying').val('');
            $('#other_country_applying').focus();
          } else {
            $('.other_applying').fadeOut('slow');
            $('#other_country_applying').val('-');
          }
      });


  });
</script>


<div id="listcity" class="modal hide fade in" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h4>Select Country</h4>
            </div>
            <div class="modal-body">
               
                <input type="text" name="search-country"  class="search-country" style="width:532px;">

                 <ul class="list-country" style="border:1px solid #ccc;background:#efefef;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;">
                   <li class="font1" style="width:30px;color:#333;border-color:#ccc;">No</li>
                   <li class="font1" style="width:410px;color:#333;border-color:#ccc;">Country Name</li>
                   <li class="font1" style="width:40px;color:#333;border-color:#ccc;">Code</li>
                 </ul>
                 <div class="box-list-country">
               <?php foreach ($country as $row ) { ?>
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

