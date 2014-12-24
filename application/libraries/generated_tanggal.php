<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
class Generated_tanggal  {

    
    function  __construct() {
        $CI =& get_instance();
	$this->instan = $CI;
    }
    
    
function ubahtanggaldefault($parameter) {
 $datadate = explode('-', $parameter);       
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
 
 $datadateid = array ( 
                        "bulan" => $dateid,
                        "tahun" => $datadate[0],
     
                        );
 $datadategb = implode('-', $datadateid);
 
 
 $datadategb1 = explode('-', $datadategb);
 $datadategb2 = implode(' ', $datadategb1);
 
 return $datadategb2;
 
 
 
}


function getnextmonth($date) {
        $CI =& get_instance();
        $CI->load->model('schedules_model');

        $query = $CI->schedules_model->getnextmonth($date);
        // pendefinisian tanggal awal
        $tgl2 = date('Y-m-d', strtotime('+4 weeks', strtotime($date))); //operasi penjumlahan tanggal sebanyak 6 hari
        echo $this->ubahtanggaldefault($tgl2);//print tanggal
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



function ubahtanggal2($parameter) {
 $datadate = explode('/', $parameter);       
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
 
 $datadateid = array (  "tanggal" => $datadate[0],
                        "bulan" => $dateid,
                        "tahun" => $datadate[2],
     
                        );
 $datadategb = implode('-', $datadateid);
 
 
 $datadategb1 = explode('-', $datadategb);
 $datadategb2 = implode(' ', $datadategb1);
 
 return $datadategb2;
 
 
 
}

function getmonth($date) {
if($date != '') {
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
    return $dateid;
}


}





















}
?>