<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/dropdown.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/font.css" />
<script type="text/javascript" src="<?php echo base_url() ?>/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>/js/dropdown.js"></script>




<div class="nav-left">

<ul style="padding-left:0px;" >
	<li style="padding:0px;border:none;" ><a style="padding-left:24px;width:580px;border:none;" href="#">Test Date Available &nbsp;<?php echo $this->generated_tanggal->ubahtanggaldefault(date("2014-12-30")); ?> - <?php echo $this->generated_tanggal->ubahtanggaldefault('2015-02-30');  ?></a>
	<ul style="width:600px;">
		<?php echo $this->getschedules->sublistschedules("2014-12-30", '2015-02-30'); ?>
	</ul>
	<div style="clear:both"></div>
	</li>
	<li style="padding:0px;border:none;"  ><a style="padding-left:24px;width:580px;border:none;" href="#">Test Date Available &nbsp;<?php echo $this->generated_tanggal->ubahtanggaldefault(date('2015-03-30')); ?> - <?php echo $this->generated_tanggal->ubahtanggaldefault('2015-05-30');  ?></a>
	<ul>
		<?php echo $this->getschedules->sublistschedules("2015-03-30", '2015-05-30'); ?>
	</ul>	
	</li>
	<li style="padding:0px;border:none;"  ><a style="padding-left:24px;width:580px;border:none;" href="#">Test Date Available &nbsp;<?php echo $this->generated_tanggal->ubahtanggaldefault(date('2015-06-30')); ?> - <?php echo $this->generated_tanggal->ubahtanggaldefault('2015-08-30');  ?></a>
	<ul>	
		<?php echo $this->getschedules->sublistschedules("2015-06-30", '2015-08-30'); ?>
	</ul>
	</li>
	<li style="padding:0px;border:none;"  ><a style="padding-left:24px;width:580px;border:none;" href="#">Test Date Available &nbsp;<?php echo $this->generated_tanggal->ubahtanggaldefault(date('2015-09-30')); ?> - <?php echo $this->generated_tanggal->ubahtanggaldefault('2015-12-30');  ?></a>
	<ul>
		<?php echo $this->getschedules->sublistschedules("2015-09-30", '2015-08-30'); ?>
	</ul>
	</li>
<ul>

</div>





