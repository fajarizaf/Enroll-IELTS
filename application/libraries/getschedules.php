<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Getschedules  {

    
    function  __construct() {
        $CI =& get_instance();
	$this->instan = $CI;

    }

    function ubahtanggal($parameter) {
 $filter = explode(' ', $parameter);   
 $datadate = explode('-', $filter[0]);       
 $date = $datadate[1];
 
 switch ($date) {
     case "01": $dateid = "januari";
         break;
     case "02": $dateid = "Februari";
         break;
     case "03": $dateid = "Maret";
         break;
     case "04": $dateid = "April";
         break;
     case "05": $dateid = "Mei";
         break;
     case "06": $dateid = "Juni";
         break;
     case "07": $dateid = "Juli";
         break;
     case "08": $dateid = "Agustus";
         break;
     case "09": $dateid = "September";
         break;
     case "10": $dateid = "Oktober";
         break;
     case "11": $dateid = "November";
         break;
     case "12": $dateid = "Desember";
         break;
 } 
 
 $datadateid = array (  "tanggal" => $datadate[2],
                        "bulan" => $dateid,
                        "tahun" => $datadate[0],
     
                        );
 $datadategb = implode('-', $datadateid);
 
 
 $datadategb1 = explode('-', $datadategb);
 $datadategb2 = implode(' ', $datadategb1);
 
 return $datadategb2;
 
 
 
}


 function getmonthname($parameter) {
 
 switch ($parameter) {
     case "1": $dateid = "Januari";
         break;
     case "2": $dateid = "Februari";
         break;
     case "3": $dateid = "Maret";
         break;
     case "4": $dateid = "April";
         break;
     case "5": $dateid = "Mei";
         break;
     case "6": $dateid = "Juni";
         break;
     case "7": $dateid = "Juli";
         break;
     case "8": $dateid = "Agustus";
         break;
     case "9": $dateid = "September";
         break;
     case "10": $dateid = "Oktober";
         break;
     case "11": $dateid = "November";
         break;
     case "12": $dateid = "Desember";
         break;
 } 
 
 return $dateid;
}


    function examname($id) {
        $CI =& get_instance();
        $CI->load->model('app_model');
        $where['idexams'] = $id;
        $query = $CI->app_model->getSelectedData('exams',$where);
        foreach ( $query as $row ) { ?>
           <?php return $row->examname; ?>
<?php   }
    }

    function location($id) {
        $CI =& get_instance();
        $CI->load->model('app_model');
        $where['idbranches'] = $id;
        $query = $CI->app_model->getSelectedData('branches',$where);
        foreach ( $query as $row ) { ?>
           <?php echo $row->branchname; ?>
<?php   }
    }
    
    
    
    function sublistschedules($month) {
        $CI =& get_instance();
        $CI->load->model('register_model');
        $query = $CI->register_model->getlistschedule($month);
        if($query) { ?>

            <table style="margin-left:0px;">
                    <tr style="background:#efefef;">
                        <th class="font2" style="width:70px;color:#333;padding-right:30px;padding-top:1px;padding-bottom:1px;">Module</th>
                        <th class="font2"  style="width:110px;color:#333;padding-right:30px;padding-top:1px;padding-bottom:1px;">Test Date</th>
                        <th class="font2"  style="width:220px;color:#333;padding:5px;padding-top:1px;padding-bottom:1px;">Test Venue</th>
                        <th class="font2"  style="width:90px;color:#333;padding:5px;padding-top:1px;padding-bottom:1px;">Availability</th>
                    </tr>
                </table>

        <?php
            foreach ( $query as $row ) { ?>
                <li style="width:580px;padding-top:2px;padding-bottom:2px;background:#efefef;"">
                <table style="margin-left:0px;">
                    <tr style="background:#efefef;">
                        <td class="font2" style="width:70px;color:#666;padding-right:30px;padding-top:1px;padding-bottom:1px;"><?php if($this->examname($row->idexams) == 'Academic') {echo "AC";} else if($this->examname($row->idexams) == 'General Training') { echo "GT"; }; ?></td>
                        <td class="font2"  style="width:110px;color:#666;padding-right:30px;padding-top:1px;padding-bottom:1px;"><?php echo $this->ubahtanggal($row->schdate)?></td>
                        <td class="font2"  style="width:220px;color:#666;padding:5px;padding-top:1px;padding-bottom:1px;"><?php echo $this->location($row->idbranches)?></td>
                        <td class="font2"  style="width:90px;color:#666;padding:5px;padding-top:1px;padding-bottom:1px;"><?php  if($row->schclosingreg < date("Y-m-d H:i:s")) { echo "Full"; } else { echo "Available"; }  ?></td>
                    </tr>
                </table>
                </li>
    <?php   }
        } else { ?>
            <li style="width:560px;padding:10px;margin-top:-10px;background:#efefef;">no schedule this month</li>
     <?php   }
    }

    
   
}
?>











