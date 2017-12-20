<?php
/**
 * Created by PhpStorm.
 * User: Son Minh
 * Date: 11/27/2017
 * Time: 10:16 AM
 */

namespace App;


class helper
{
    function setHeaderContent(){
        header('Content-Type: application/json; charset=utf-8');
    }
    function ResponseJson($Data) // trả về lỗi ResultCode = 1 và ResultMessage
    {
        $this->setHeaderContent();
        //return $this->_json_encode($Data);
        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            //return json_encode($Data, JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK|JSON_PRESERVE_ZERO_FRACTION);
            return json_encode($Data, JSON_UNESCAPED_UNICODE);
        } else {
            return json_encode($Data);
        }
    }
    function formatNumber($number){
        return number_format($number, 0, ',', '.');
    }
    function getGuid()
    {
        if(function_exists('com_create_guid')){
            $uuid = com_create_guid();
        }
        else
        {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        }
        $uuid = str_replace(array('{','}'),array('',''),$uuid);
        return $uuid;
    }//End function getGuid

    function removeDau($str) {
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }//End function removeDau
    function create_link($str)
    {
        $str2=$this->removeDau($str);
        $str3 = strtolower(str_replace(' ', '-', $str2));
        return preg_replace('/[^A-Za-z0-9\-]/', '', $str3);
    }
    function _json_encode($val)
    {
        if ($val === null) return 'null';
        if ($val === true) return 'true';
        if ($val === false) return 'false';
        if (is_numeric($val)) return $val;
        if (is_string($val)){ $val = str_replace("\r\n","<br>",$val);;return '"'.addslashes($val).'"';}

        $assoc = false;
        $i = 0;
        foreach ($val as $k=>$v){
            if ($k !== $i++){
                $assoc = true;
                break;
            }
        }
        $res = array();
        foreach ($val as $k=>$v){
            $v = $this->_json_encode($v);
            if ($assoc){
                $k = '"'.addslashes($k).'"';
                $v = $k.':'.$v;
            }
            $res[] = $v;
        }
        $res = implode(',', $res);
        return ($assoc)? '{'.$res.'}' : '['.$res.']';
    }

    function _json_encode_query($val)
    {
        if (is_string($val)){ $val = str_replace("\r\n","<br>",$val);;return '"'.addslashes($val).'"';}
        if (is_numeric($val)) return $val;
        if ($val === null) return 'null';
        if ($val === true) return 'true';
        if ($val === false) return 'false';

        $assoc = false;
        $i = 0;
        foreach ($val as $k=>$v){
            if ($k !== $i++){
                $assoc = true;
                break;
            }
        }
        $res = array();
        foreach ($val as $k=>$v){
            $v = $this->_json_encode_query($v);
            if(substr($k, 0,1) == 'i') $v = str_replace('"','',$v);
            if ($assoc){
                $k = '"'.addslashes($k).'"';
                $v = $k.':'.$v;
            }
            $res[] = $v;
        }
        $res = implode(',', $res);
        return ($assoc)? '{'.$res.'}' : '['.$res.']';
    }

    function drawMenu($ListMenu, $Parent){
        if(empty($ListMenu)){ return '';}
        $li = '';
        foreach($ListMenu as $item){
            if($item['Parent'] != $Parent) continue;
            $li .="<li>".PHP_EOL;
            $display = ($item['Display'])?'':'style="display:none"';
            if(!empty($item['Module']) && !empty($item['Action']))
                $li.='<a href="index.php?module='.$item['Module'].'&action='.$item['Action'].'" title="'.$item['Title'].'" '.$display.'><i class="'.$item['Icon'].'"></i> '.$item['Title'].'</a>'.PHP_EOL;
            else
                $li .='<a href="javascript:void()" title="'.$item['Title'].'"><i class="'.$item['Icon'].'" '.$display.'></i> '.$item['Title'].'</a>'.PHP_EOL;
            $li1 = $this->drawMenu($ListMenu, $item['ID']);
            if($li1 != ''){
                $li.= '<ul>'.PHP_EOL.$li1.'</ul>'.PHP_EOL;
            }
            $li.='</li>'.PHP_EOL;
        }
        return $li;
    }
    public function customSearch($keyword, $arrayToSearch){
        foreach($arrayToSearch as $key => $arrayItem){
            if( stristr( $arrayItem, $keyword ) ){
                return $arrayItem;
            }
        }
    }
    public function SearchArray($key,$field,$array){
        $result=array();
        foreach ($array as $k=>$v){
            if(stripos($v[$field], $key) !== false){
                array_push($result,$v);
            }
        }
        return $result;
    }
}