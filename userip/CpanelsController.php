<?php

class CpanelsController extends AppController{
        
    var $components = array('Messages');
    var $uses = array('CountryMaster');
 /**
 * @param type $msgCode
 * @param type $msgType Provide information if the message is success message or an error message 
 * 0 => Error, 1 => Success, 
 */
    
    function generateMessages($msgCode, $msgType){
        
        $this->autoRender = false;
        if($msgType == '0'){
            $msgResponse = $this->Messages->ErrorMessages($msgCode);
            $this->Session->write('msg', '0');
            $this->Session->setFlash('<div class="alert alert-danger">'.$msgResponse."</div>");
            
        }else if($msgType == '1'){
            
            $msgResponse = $this->Messages->SuccessMessages($msgCode);
            $this->Session->write('msg', '1');
            $this->Session->setFlash('<div class="alert alert-success">'.$msgResponse."</div>");
        }
    }

    function generateAjaxMessages($msgCode, $msgType){
        
        $this->autoRender = false;
        if($msgType == '0'){
            $msgResponse = $this->Messages->ErrorMessages($msgCode);
            return json_encode($msgResponse);
        }else if($msgType == '1'){
            $msgResponse = $this->Messages->SuccessMessages($msgCode);
            return json_encode($msgResponse);
            
        }
    }

    function getCountryList(){
        
        $this->autoRender= false;
        $res = $this->CountryMaster->find('all', array('order'=>'country_name'));
        $countryList = array();
        if(!empty($res)){
            foreach ($res as $key => $value) {
                $countryList[$value['CountryMaster']['id']]=$value['CountryMaster']['country_name'];
            }
        }
        return $countryList;
    
    }
    public function Get_Date($year=null, $month=null, $day=null, $d=null) {
       $this->autoRender = false;
        if ($year == "")
            $year = date('Y');
        if ($month == "")
            $month = date('m');
        if ($day == "")
            $day = date('d');
        if ($d == "")
            $d = date('w');
        return $year."-".$month."-".$day."-".$d;
    }


    public  function div($a,$b) {
        $this->autoRender = false;
        return (int) ($a / $b);
    }


    public function gregorian_to_jalali ($format="yyyy-mm-dd"){
        $this->autoRender = false;
        $week= Array("&#1610;&#1603;&#1588;&#1606;&#1576;&#1607;","&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;","&#1587;&#1607; &#1588;&#1606;&#1576;&#1607;","&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;","&#1662;&#1606;&#1580;&#8204;&#1588;&#1606;&#1576;&#1607;","&#1580;&#1605;&#1593;&#1607;","&#1588;&#1606;&#1576;&#1607;");
        $months = Array("&#1601;&#1585;&#1608;&#1585;&#1583;&#1610;&#1606;","&#1575;&#1585;&#1583;&#1610;&#1576;&#1607;&#1588;&#1578;","&#1582;&#1585;&#1583;&#1575;&#1583;","&#1578;&#1610;&#1585;","&#1605;&#1585;&#1583;&#1575;&#1583;","&#1588;&#1607;&#1585;&#1610;&#1608;&#1585;","&#1605;&#1607;&#1585;","&#1570;&#1576;&#1575;&#1606;","&#1570;&#1584;&#1585;","&#1583;&#1610;","&#1576;&#1607;&#1605;&#1606;","&#1575;&#1587;&#1601;&#1606;&#1583;");
        $d = $this->params->named['date'];
        if (($d)=="")
            $d = $this->Get_Date();

        $g_y = mb_substr($d, 0, 4);
        $g_m = mb_substr($d, 5, 2);
        $g_d = mb_substr($d, 8, 2);
        $d = '1';
        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
        $gy = $g_y-1600;
        $gm = $g_m-1;
        $gd = $g_d-1;
        $g_day_no = 365*$gy+$this->div($gy+3,4)-$this->div($gy+99,100)+$this->div($gy+399,400);
        for ($i=0; $i < $gm; ++$i)
            $g_day_no += $g_days_in_month[$i];
        if ($gm>1 && (($gy%4==0 && $gy%100!=0) || ($gy%400==0)))
        /* leap and after Feb */
        $g_day_no++;
        $g_day_no += $gd;
        $j_day_no = $g_day_no-79;
        $j_np = $this->div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
        $j_day_no = $j_day_no % 12053;
        $jy = 979+33*$j_np+4*$this->div($j_day_no,1461); /* 1461 = 365*4 + 4/4 */
        $j_day_no %= 1461;
        if ($j_day_no >= 366) {
            $jy += $this->div($j_day_no-1, 365);
            $j_day_no = ($j_day_no-1)%365;
        }
        for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
        $j_day_no -= $j_days_in_month[$i];
        $jm = $i+1;
        $jd = $j_day_no+1;
        $jy_s = mb_substr($jy, 2, 2);
        if ($jd<10)
            $jd = "0".$jd;
    
        switch ($format) {
            case "yy M dd D":
                return  ($week[$d]." ".$jd." ".$months[$jm-1]." ".$jy);
                break;
            case "yy/mm/dd":
                if ($jm<10)
                    $jm = "0".$jm;
                return  ($jy_s."/".$jm."/".$jd);
                break;
            case "yyyy-mm-dd":
                if ($jm<10)
                    $jm = "0".$jm;
                return  ($jy."/".$jm."/".$jd);
                break;
            case "dd":
                return  ($jd);
                break;
            case "mm":
                if ($jm<10)
                    $jm = "0".$jm;
                return  ($jm);
                break;
            case "Y":
                return  ($jy);
                break;
            case "yyyy":
                return  ($jy);
                break;
            case "yy":
                return  ($jy_s);
                break;
            default:
        }
    
    }

     public function jalali_to_gregorian(){ 
        $this->autoRender = false;
        $str='';
        $j_y = mb_substr($this->data['date'], 0, 4);
        $j_m = mb_substr($this->data['date'], 5, 2);
        $j_d = mb_substr($this->data['date'], 8, 2);

        $g_days_in_month = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31); 
        $j_days_in_month = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29); 
        $jy = (int)($j_y)-979; 
        $jm = (int)($j_m)-1; 
        $jd = (int)($j_d)-1; 
        $j_day_no = 365*$jy + $this->div($jy, 33)*8 + $this->div($jy%33+3, 4); 
        for ($i=0; $i < $jm; ++$i) 
        $j_day_no += $j_days_in_month[$i]; 

        $j_day_no += $jd; 

        $g_day_no = $j_day_no+79; 
 
        $gy = 1600 + 400*$this->div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */ 
        $g_day_no = $g_day_no % 146097; 
 
        $leap = true; 
        if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ 
        { 
            $g_day_no--; 
            $gy += 100*$this->div($g_day_no,  36524); /* 36524 = 365*100 + 100/4 - 100/100 */ 
            $g_day_no = $g_day_no % 36524; 
 
            if ($g_day_no >= 365) 
                $g_day_no++; 
            else 
                $leap = false; 
        } 
 
        $gy += 4*$this->div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */ 
        $g_day_no %= 1461; 

        if ($g_day_no >= 366) { 
            $leap = false; 

            $g_day_no--; 
            $gy += $this->div($g_day_no, 365); 
            $g_day_no = $g_day_no % 365; 
        } 
 
        for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++) 
            $g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap); 
        $gm = $i+1; 
        $gd = $g_day_no+1; 
        return $gy.'/'.$gm.'/'.$gd ;
    } 
    
}