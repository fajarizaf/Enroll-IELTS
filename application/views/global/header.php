
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register Online</title>
		<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url() ?>assets/css/font.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url() ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/css/notifError.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/chosen/chosen.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/globalURL.js"></script>
        
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/tab.js"></script>

		<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/selected-master/jquery.fs.selecter.css" />
        <script src="<?php echo base_url() ?>assets/js/selected-master/jquery.fs.selecter.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/selected-master/jquery.fs.selecter.min.js" type="text/javascript"></script>
        
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/js/scroller-master/jquery.fs.scroller.css" />
        <script src="<?php echo base_url() ?>assets/js/scroller-master/jquery.fs.scroller.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>assets/js/scroller-master/jquery.fs.scroller.min.js" type="text/javascript"></script>
          
        <link href="<?php echo base_url(); ?>assets/js/slimscroll/prettify.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slimscroll/prettify.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/slimscroll/jquery.slimscroll.js"></script> 

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/sticky-jquery/sticky.full.js"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/js/sticky-jquery/stickyDashboard.full.css" type="text/css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/post-register.js"></script>

        <link type="text/css" href="<?php echo base_url();?>assets/js/development-bundle/themes/ui-lightness/jquery.ui.all.css" rel="stylesheet" />
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/development-bundle/ui/jquery.ui.dialog.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/upload.js"></script>
       

      
        <style>
                    label.valid {
                        float:right;
                        margin-top: 10px;
                        margin-left: 5px;
                        background: url(<?php echo base_url(); ?>assets/pic/icheck.png);
                        width:20px;
                        height:19px;
                        padding:0px;
                    }
                    
        </style>


        <script type="text/javascript">
            $(document).ready(function() {

                <?php if($this->session->userdata('statususer') == '3') { ?>
                // load form register sebagai user candidate
                     $('.sudahlogin').load(''+base_url+'register/form_candidate_login/');

                 <?php } else if($this->session->userdata('statususer') == '2') { ?>
                 // load form register sebagai user register center
                     $('.sudahlogin').load(''+base_url+'register/form_registercenter/');

                 <?php } ?> 


                 $('#btnnew-registers').click(function() {
                     $('#parentloading').fadeIn('slow');
                     var counter=2;
                      var countdown = setInterval(function(){
                        if (counter == 0) {
                        clearInterval(countdown);
                             $('#parentloading').fadeOut('slow');
                             $('.register-or-login').load(''+base_url+'register/form_candidate/');
                             $('#sticky').sticky('<span style="color:#802222;">please fill out a form below to complete</span>');
                         }
                        counter--;
                      }, 500);                
                 });

                $('.table-date').on('click','input[name=date-test]:checked', function() {
                        var sche = $(this).val();
                        $('.codeidschedules').html(sche);
                 });


            });
        </script>



</head>

<body>
<div class="header">
    <div class="child-header">
    <img src="<?php echo base_url() ?>assets/pic/ielts-logo.png" style="float:left;margin-top:22px;" />
    <img src="<?php echo base_url() ?>assets/pic/bc-logo.png" style="float:left;margin-top:22px;"/>
    <img src="<?php echo base_url() ?>assets/pic/utclogo.png" style="float:right;margin-top:10px;" />
    <?php if($this->session->userdata('login') == 'true') { ?>
        <div class="stat_member">
            <div class="stat_photo">
                <img <?php if($this->session->userdata('images') == '') { ?> src="<?php echo base_url() ?>assets/pic/default.jpg"  <?php } else { ?>  src="<?php echo base_url() ?>upload/<?php echo $this->session->userdata('images') ?>"  <?php } ?> width="105%">
            </div>
            <div class="stat"><span style="font-weight:bold;">Welcome</span><br/><?php echo $this->session->userdata('username'); ?></div>
        </div>
    <?php } else { ?>
        <div class="stat_members">
            
        </div>
    <?php } ?>
    </div>
</div>

<div id="parentloading">
    <div class="font3" id="loading" style="font-weight: bold;">Loading...</div>
</div>

<div class="menu">
    <ul>
        <?php if($this->session->userdata('login') != 'true') { ?>
            <li style="border-top:5px solid #7dab36;"><a href="#">How To Register</a></li>
            <li style="border-top:5px solid #ff6600;"><a href="#">How To Book IELTS</a></li>
            <li class="active" style="border-top:5px solid #00a2c8;"><a href="#">Register</a></li>
        <?php } else { ?>

            <?php foreach ($menuadmin as $row) {   ?>
            <li <?php if($this->uri->segment(1) == $row->controllers ) { ?>  class="active" <?php } ?>  style="border-top:5px solid #<?php echo $row->color  ?>;"><a href="#"><?php echo $row->name ?></a></li>
            <?php } ?>

        <?php } ?>
    </ul>
</div>
