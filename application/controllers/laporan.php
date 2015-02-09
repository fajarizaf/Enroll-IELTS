<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('laporan_model');
    }

    public function createxml() {
        $idreg = $this->uri->segment(3);
        $datareport = $this->laporan_model->getreportxml($idreg);
            header('Content-Type: text/xml');
            $this->load->helper('xml'); 
            $dom = xml_dom();        
            $ucles = xml_add_child($dom, 'UCLES');        
            xml_add_attribute($ucles, 'xsi:noNamespaceSchemaLocation', 'Candidate.xsd');        
            xml_add_attribute($ucles, 'xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');        
            $IELTS = xml_add_child($ucles, 'IELTS');        
            $CANDIDATES = xml_add_child($IELTS, 'CANDIDATES');  
            foreach ($datareport as $row) {
              $CANDIDATE = xml_add_child($CANDIDATES, 'CANDIDATE', 'text');
              xml_add_attribute($CANDIDATE, 'YEARSTUDY', strtoupper($row->useryearsofenglishstudy));            
              xml_add_attribute($CANDIDATE, 'TITLE', strtoupper($row->usertitle));            
              xml_add_attribute($CANDIDATE, 'TEST_FORMAT', 'PB');            
              xml_add_attribute($CANDIDATE, 'TEST_DATE', strtoupper(substr($row->schdate,0,10)));            
              xml_add_attribute($CANDIDATE, 'TELEPHONE', strtoupper(substr($row->userphone,0,20)));            
              xml_add_attribute($CANDIDATE, 'STATE', strtoupper(substr($row->useraddr2,0,100)));            
              xml_add_attribute($CANDIDATE, 'SPECIALNEEDS', strtoupper($row->usertakenielts));            
              xml_add_attribute($CANDIDATE, 'SPECIALNEEDSDESC', strtoupper(substr($row->userspecialcondition,0,1000)));            
              xml_add_attribute($CANDIDATE, 'SEX', strtoupper(substr($row->usergender,0,1)));            
              xml_add_attribute($CANDIDATE, 'REASON_ID', strtoupper(substr($row->userwhytaketest,0,2)));
                  xml_add_attribute($CANDIDATE, 'REASON_OTHER', strtoupper(substr($row->userwhytaketest_other,0,500)));	          
              xml_add_attribute($CANDIDATE, 'NATIONALITY', strtoupper(substr($row->usercountryorigin,0,3)));
              xml_add_attribute($CANDIDATE, 'COUNTRYOFRESIDENCE', strtoupper(substr($row->usercountryorigin,0,3)));            
              xml_add_attribute($CANDIDATE, 'LEVEL_ID', strtoupper($row->useroccupationlevel));
                  xml_add_attribute($CANDIDATE, 'LEVEL_OTHER', strtoupper(substr($row->level_other,0,500)));        
              xml_add_attribute($CANDIDATE, 'LASTNAME', strtoupper(substr($row->userfamilyname,0,50)));            
              xml_add_attribute($CANDIDATE, 'LANGUAGE', strtoupper(substr($row->userfirstlanguage,0,3)));
              xml_add_attribute($CANDIDATE, 'JOB_ID', strtoupper(substr($row->useroccupationsector,0,2)));
                  xml_add_attribute($CANDIDATE, 'JOB_OTHER', strtoupper(substr($row->sector_other,0,500)));
              xml_add_attribute($CANDIDATE, 'ID_TYPE', (strtolower($row->useridcard) == 'nic')?"I":"P");
      			  xml_add_attribute($CANDIDATE, 'ID', strtoupper(substr($row->useridnumber,0,30)));
      			  xml_add_attribute($CANDIDATE, 'FIRSTNAME', strtoupper(substr($row->userfirstname,0,50)));
      			  xml_add_attribute($CANDIDATE, 'EMAIL', strtoupper(substr($row->useremail,0,100)));
      			  xml_add_attribute($CANDIDATE, 'EDUCATIONCOMPLETED', strtoupper($row->userlevelofeducation));
      			  xml_add_attribute($CANDIDATE, 'DOB', $row->userdob);
      			  xml_add_attribute($CANDIDATE, 'COUNTRY', strtoupper($row->usertargetcountry));
                  xml_add_attribute($CANDIDATE, 'COUNTRY_OTHER', strtoupper(substr($row->usertargetcountry_other,0,500)));
      			  xml_add_attribute($CANDIDATE, 'AG_MOD', strtoupper(substr($row->examname,0,1)));
      			  xml_add_attribute($CANDIDATE, 'POSTCODE', strtoupper(substr($row->useraddr4,0,20)));
      			  xml_add_attribute($CANDIDATE, 'CITY', strtoupper(substr($row->useraddr3,0,100)));
      			  xml_add_attribute($CANDIDATE, 'ADDRESS1', strtoupper(substr($row->useraddr1,0,100)));
      			  xml_add_attribute($CANDIDATE, 'NOTES', strtoupper(substr($row->usernotes,0,1000)));
            }
            xml_print($dom);
    }


    public function createxls() {
      $idreg = $this->uri->segment(3);
      $data['datareport'] = $this->laporan_model->getreportxls($idreg);
      $this->load->view('reportxls',$data);
    }

}

?>