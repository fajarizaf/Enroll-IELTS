<script>
  $(document).ready(function() {


      $('.search-question').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 

                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterquestion",
                            data: dataString,
                            success : function(data){
               
                               $(".box-list-question").html(data);
                                    
                            }
                        });
      });



                    $('.codequestion').keyup(function() {

                    var keyword = $(this).val(); 
                    var dataString = 'keyword=' + keyword; 
                        $.ajax({
                            type  : "POST",
                            url: ""+base_url+"register/filterquestioncode",
                            data: dataString,
                            success : function(data){
               
                               $('#taking_test').val(keyword);
                               var c = $('input[type="text"]').prev();
                               $('#namequestion').html(data);
                               $('.codequestion').valid();

                            }
                        });
                    });

      $('.box-list-question').on('click','.list-country', function() {
          var country = $(this).attr('value');
          var countrycode = $(this).attr('valuecode');
          $('div[selection=active]').html(country);
          $('div[selection=active]').next().val(countrycode);
          $('div[selection=active]').next().next().val(countrycode);
          $('#question').modal('hide');
          $('div[selection=active]').removeAttr('selection');
          $('.codequestion').valid();
          if(countrycode == '0') {
            $('.question_other').fadeIn('slow');
            $('#other_taking_test').val('');
            $('#other_taking_test').focus();
          } else {
            $('.question_other').fadeOut('slow');
            $('#other_taking_test').val('-');
          }
      });


  });
</script>


<div id="question" class="modal hide fade in" style="display: none; ">
            <div class="modal-header">
              <a class="close" data-dismiss="modal">×</a>
              <h4>Select Answer Questions</h4>
            </div>
            <div class="modal-body">
               
            <input type="text" name="search-question"  class="search-question" style="width:532px;">

                <ul class="list-country" style="border:1px solid #ccc;background:#efefef;-moz-border-radius:3px 3px 3px;-webkit-border-radius:3px 3px 3px;border-radius:3px 3px 3px;">
                   <li class="font1" style="width:30px;color:#333;border-color:#ccc;">No</li>
                   <li class="font1" style="width:410px;color:#333;border-color:#ccc;">Answer Questions Name</li>
                   <li class="font1" style="width:40px;color:#333;border-color:#ccc;">Code</li>
                 </ul>
                 <div class="box-list-question">
               <?php foreach ($question as $row ) { ?>
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

