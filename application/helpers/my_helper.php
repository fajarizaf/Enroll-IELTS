<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function format_time($time) {	
	$exploded = explode(':', $time);	
	pre($exploded);
	$value_1 = $exploded[0] * 1;	
	$value_2 = $exploded[1] * 1;	
	pre($value_1);
	pre($value_2);
	if(is_array($exploded)) {
		if( ($exploded[0] < 24) && ($exploded[1] < 60) && ($value_1 == $exploded[0]) && ($value_2 == $exploded[1]) ) {
			return TRUE;
		}
		return FALSE;
	}
		return FALSE;
}

function format_date($date){
	$timedate = strtotime(substr($date, 0, 10));
	$d = date('j', $timedate);
	$m = date('M', $timedate);
	$y = date('o', $timedate);
	echo $d.'-'.$m.'-'.$y; 
}

function decDate($date){
	$getDate = substr($date,0,10);
	$arrDate = explode('-',$getDate);
	$newDate = @$arrDate[2]."-".@$arrDate[1]."-".@$arrDate[0];
	return $newDate;
}

function my_uppercase($data_post) { //Make a string uppercase	
	if(is_array($data_post)) {					
		foreach($data_post as $key=>$uppered):
			$data[$key] = strtoupper($uppered);
		endforeach;
	}else{
		$data = strtoupper($data_post);
	}
	return $data;
}

function pre($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    echo '<hr />';
}

function l_query(){
    $ci->database =& get_instance();
    pre($ci->database->db->last_query());
}

function alertMsg($code, $msg="") {
    if($msg === "") { /*checking the error message come from. send by yudhi or system*/
        switch($code):
            case 1:
                $res = 'Insert Success';
                $class = 'info';
                break;
            case 2:
                $res = 'Insert Failed';
                $class = 'error';
                break;
            case 3:
                $res = 'Update Success';
                $class = 'info';
                break;
            case 4:
                $res = 'Update Failed';
                $class = 'error';
                break;
            case 5:
                $res = 'Delete Success';
                $class = 'info';
                break;
            case 6:
                $res = 'Delete Failed';
                $class = 'error';
                break;
            case 7:
                $res = 'Verification Failed';
                $class = 'error';
                break;
            case 8:
                $res = 'Logout Success';
                $class = 'info';
                break;
            case 9:
                $res = "<center><b><i>-- Wrong Password --</i></b></center>";
                $class = 'error';
                break;
			case 10:
				$res = "<center><b><i>-- Data Not Found --</i></b></center>";
				$class = "notify";
				break;
			case 11:
				$res = "<center><b><i>-- You Are Not Authorized to Access The Page--</i></b></center>";
				$class = "notify";
				break;
            case 12:
				$res = "<center><b><i>-- Username Not Found --</i></b></center>";
				$class = "error";
				break;
            endswitch;
    }else {
        /*checking is the message for failed or success alert*/
        if($code !== 2)
            $class = 'info';
        else
            $class = 'error';
        $res = $msg;
    }
    $data['message'] = $res;
    $data['class'] = $class;
    return $data;
}

function parse_date($data_post) { 
		$x = "";
		$y = "";
		foreach($data_post as $key=>$d):
			$x .= ",".$key."";
			$y .= ",'".$d."'";
		endforeach;
		$patterns = array("'to_date", "DD-MM-YYYY')'");
		$changed = array("to_date", "DD-MM-YYYY')");
		$data_for_insert = str_replace($patterns, $changed, $y);
				
		$data['fields'] = substr($x, 1);
		$data['values'] = substr($data_for_insert, 1);	
	return $data;
}

function getMyCaptcha($width = 150, $height=30, $expiration = 7200) {
    $CI =& get_instance();
    $rand = getShuffelWord(4);
    $CI->load->helper('captcha');
    $capt = array(
        'word' => $rand,
        'img_path' => './captcha/',
        'img_url' => base_url().'captcha/',
        'img_width' => $width,
        'img_height' => $height,
        'expiration' => $expiration,
        'font_path' => './js/InterstateBold.ttf'
        );
    $cap = create_captcha($capt);
    $dt = array(
        'captcha_time' => $cap['time'],
        'ip_address' => $CI->input->ip_address(),
        'word' => $cap['word']
        );
    $query = $CI->db->insert_string('captcha', $dt);
    $CI->db->query($query);
    return $cap;
}
function getShuffelWord($len){
    $word = array_merge(range('a', 'z'),  range('0', '9'));
    shuffle($word);
    $rand = substr(implode($word), 0,$len);
    return $rand;
}
function cekValidCaptcha($captcha, $ip_address){
    $CI =& get_instance();
    $expiration = time()-7200;
    $CI->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
    $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
    $binds = array($captcha, $ip_address, $expiration);
    $query = $CI->db->query($sql, $binds);
    $row = $query->row();
    $sql = "delete FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
    $CI->db->query($sql, $binds);
    return $row->count == 0?false:true;
}
function cekEmail($email){
    $CI =& get_instance();
    $regex = @$strict ? '/^([.0-9a-z_-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i' : '/^([*+!.&#$¦\'\\%\/0-9a-z^_`{}=?~:-]+)@(([0-9a-z-]+\.)+[0-9a-z]{2,4})$/i';
    if($email=="")return getErr("useremail");
    if(!preg_match($regex, trim($email))){
        return getErr("useremailformat");
    }
    $CI->db->where(array("useremail" => $email));
    if($CI->db->get("users")->num_rows()>0){
        //print_r($CI->db->last_query());
        return getErr("useremailavailable");
    }
    return "";
}
function getErr($errcode, $lang = "idn" ) {
        switch ($lang) {
            case "english":
                break;
            default:
                return errIdn($errcode);
                break;
        }
    }

    function errIdn($errcode) {
        $dt = array(
            'imgpic' => "Please upload your Photo. ",
            'idcard' => "Please upload your ID Card. ",
            'termcondition' => "Please check if you agree with IELTS British Council Term & Condition. ",
            'oldpass' => "Old password doesn't match. ",
            'newpass' => "New password must be filled. ",
            'confpass' => "Confirmation password must be filled or you inputed different char with new password. ",
            'usertitle' => "Choose Title. ",
            'username' => "Username must be filled at least 1 character. ",
            'usernameexist' => "Username Already registered. ",
            'userpass' => "Password must be filled at least 1 character. ",
            'userrepass' => "Your passwrod confirmation doesn't match. ",
            'userfamilyname' => "Family name must be filled. ",
            'userfirstname' => "First name must be filled. ",
            'usergender' => "Choose Gender. ",
            'userphone' => "Phone number must be filled. ",
            'useremail' => "Email must be filled. ",
            'useremailformat' => "Wrong Email Format. ",
            'useremailavailable' => "Email address registered already. ",
            'userreemail' => "Email confirmation doesn't match. ",
            'useraddr' => "Address must be filled, ",
            'useraddr2' => "Country must be choose, ",
            'useraddr3' => "City must be filled, ",
            'useraddr4' => "Zipcode must be filled, ",
            'userdob' => "User Date of Birth must be filled. ",
            'useridcard' => "Choose Identity Document. ",
            'useridnumber' => "ID number must be filled. ",
            'usercountryorigin' => "Choose Country. ",
            'userfirstlanguage' => "Choose First language. ",
            'useroccupationsector' => "Choose Occupation(sector). ",
            'useroccupationsectordescr' => "Occupation(sector) description must be filled. ",
            'useroccupationlevel' => "Choose Occupation(Level). ",
            'useroccupationleveldescr' => "Occupation(Level) description must be filled. ",
            'userwhytaketest' => "Choose a reason to take a test. ",
            'userwhytaketestdescr' => "Reason to take a test must be filled. ",
            'usertargetcountry' => " Choose Country are you applying/intending to go to. ",
            'usertargetcountrydescr' => " Country are you applying/intending to go to must be filled. ",
            'usertakenielts' => "Choose Taken IELTS. ",
            'userlevelofeducation' => "Choose level of education you have completed. ",
            'useryearsofenglishstudy' => "Choose number of Years have you've been studying English. ",
            'userspecialcondition' => "Choose your special needs. ",
            'userspecialconditiondescr' => "Special needs must be filled. ",
            'captcha' => "Wrong Captcha. ",
            "updateusersuccess" => "Update profile has been successed"
        );
        return $dt[$errcode];
    }