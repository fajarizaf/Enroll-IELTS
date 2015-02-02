<script src="<?php echo base_url() ?>assets/js/chosen/chosen.jquery.js" type="text/javascript"></script>
  <script src="<?php echo base_url() ?>assets/js/chosen/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>

<script src="<?php echo base_url();?>assets/js/bootstrap.js" type="text/javascript"></script>


<div class="footerfixed">
  <ul>
    <li style="margin-right:100px;color:#626262;">Copyright 2015. ieltsindonesia.co.id. All rights reserved.</li>
    <li><img src="<?php echo base_url(); ?>assets/pic/f.png" style="width:17px"></li>
    <li><img src="<?php echo base_url(); ?>assets/pic/t.png" style="width:17px"></li>
    <li><img src="<?php echo base_url(); ?>assets/pic/y.png" style="width:17px"></li>
    <li style="float:right;padding-left:20px;"><div style="width:100px;float:left;">Site Design:</div><a href="http://www.dlanet.com" style="float:left;margin-top:-1px;"><img src="<?php echo base_url(); ?>assets/pic/dlanetlogo.png" style="width:60px;" ></a></li>
  </ul>
</div>


</body>



</html>
