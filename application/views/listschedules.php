<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/dropdown.css" />
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/dropdown.js"></script>




<div class="nav-left">

<ul style="padding-left:0px;background:#efefef;" >
	<?php foreach ($monthavailable as $row) {  ?>
		<li style="padding:0px;border:none;border-bottom:1px solid #fff;" ><a style="padding-left:24px;width:580px;border:none;" href="#"><?php echo $this->getschedules->getmonthname($row->vbn); ?></a>
		<ul style="width:600px;padding-bottom:50px;">
			<?php echo $this->getschedules->sublistschedules($row->vbn); ?>
		</ul>
		<div style="clear:both"></div>
		</li>
	<?php  } ?>
<ul>

</div>





