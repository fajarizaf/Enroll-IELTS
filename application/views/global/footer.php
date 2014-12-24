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

</body>



</html>
