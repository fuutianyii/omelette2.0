<?php
/*
 * @Author: fuutianyii
 * @Date: 2022-10-12 17:58:32
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-12-01 18:32:08
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
// $url = 'http://fy.iciba.com/ajax.php?a=fy';
// function send_post($url, $post_data) {
//     $postdata = http_build_query($post_data);
//     $options = array(
//       'http' => array(
//         'method' => 'POST',
//         'header' => 'Content-type:application/x-www-form-urlencoded',
//         'content' => $postdata,
//         'timeout' => 15 * 60 // 超时时间（单位:s）
//       )
//     );
//     $context = stream_context_create($options);
//     $result = file_get_contents($url, false, $context);
//     return $result;
//   };
//   function request_by_curl($remote_server, $post_string) {
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, $remote_server);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, 'mypost=' . $post_string);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_USERAGENT, "jb51.net's CURL Example beta");
//     $data = curl_exec($ch);
//     curl_close($ch);
//     return $data;

//   }
  //使用方法
    // $post_data = array('f'=>'auto','t'=>'auto','w'=>'hello');
    // echo request_by_curl($url,$post_data);
header("Access-Control-Allow-Origin: *");
define("CURL_TIMEOUT",   2000);
define("URL",            "https://openapi.youdao.com/api");
define("APP_KEY",        "004f7cff636359e8"); // 替换为您的应用ID
define("SEC_KEY",        "r14PmJh5FpkxxUNqip3evQadY1j0BGDP"); // 替换为您的密钥

function do_request($q)
{
    $salt = create_guid();
    $args = array(
        'q' => $q,
        'appKey' => APP_KEY,
        'salt' => $salt,
    );
    $args['from'] = 'en';
    $args['to'] = 'zh-CHS';
    $args['signType'] = 'v3';
    @$curtime = strtotime("now");
    $args['curtime'] = $curtime;
    $signStr = APP_KEY . truncate($q) . $salt . $curtime . SEC_KEY;
    $args['sign'] = hash("sha256", $signStr);
    // $args['vocabId'] = '您的用户词表ID';
    $ret = call(URL, $args);
    return $ret;
}

// 发起网络请求
function call($url, $args=null, $method="post", $testflag = 0, $timeout = CURL_TIMEOUT, $headers=array())
{
    $ret = false;
    $i = 0;
    while($ret === false)
    {
        if($i > 1)
            break;
        if($i > 0)
        {
            sleep(1);
        }
        $ret = callOnce($url, $args, $method, false, $timeout, $headers);
        $i++;
    }
    return $ret;
}

function callOnce($url, $args=null, $method="post", $withCookie = false, $timeout = CURL_TIMEOUT, $headers=array())
{
    $ch = curl_init();
    if($method == "post")
    {
        $data = convert($args);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_POST, 1);
    }
    else
    {
        $data = convert($args);
        if($data)
        {
            if(stripos($url, "?") > 0)
            {
                $url .= "&$data";
            }
            else
            {
                $url .= "?$data";
            }
        }
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(!empty($headers))
    {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    if($withCookie)
    {
        curl_setopt($ch, CURLOPT_COOKIEJAR, $_COOKIE);
    }
    $r = curl_exec($ch);
    curl_close($ch);
    return $r;
}

function convert(&$args)
{
    $data = '';
    if (is_array($args))
    {
        foreach ($args as $key=>$val)
        {
            if (is_array($val))
            {
                foreach ($val as $k=>$v)
                {
                    $data .= $key.'['.$k.']='.rawurlencode($v).'&';
                }
            }
            else
            {
                $data .="$key=".rawurlencode($val)."&";
            }
        }
        return trim($data, "&");
    }
    return $args;
}

// uuid generator
function create_guid(){
    $microTime = microtime();
    list($a_dec, $a_sec) = explode(" ", $microTime);
    $dec_hex = dechex($a_dec* 1000000);
    $sec_hex = dechex($a_sec);
    ensure_length($dec_hex, 5);
    ensure_length($sec_hex, 6);
    $guid = "";
    $guid .= $dec_hex;
    $guid .= create_guid_section(3);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= create_guid_section(4);
    $guid .= '-';
    $guid .= $sec_hex;
    $guid .= create_guid_section(6);
    return $guid;
}

function create_guid_section($characters){
    $return = "";
    for($i = 0; $i < $characters; $i++)
    {
        $return .= dechex(mt_rand(0,15));
    }
    return $return;
}

function truncate($q) {
    $len = abslength($q);
    return $len <= 20 ? $q : (mb_substr($q, 0, 10) . $len . mb_substr($q, $len - 10, $len));
}

function abslength($str)
{
    if(empty($str)){
        return 0;
    }
    if(function_exists('mb_strlen')){
        return mb_strlen($str,'utf-8');
    }
    else {
        preg_match_all("/./u", $str, $ar);
        return count($ar[0]);
    }
}

function ensure_length(&$string, $length){
    $strlen = strlen($string);
    if($strlen < $length)
    {
        $string = str_pad($string, $length, "0");
    }
    else if($strlen > $length)
    {
        $string = substr($string, 0, $length);
    }
}

// 输入
$word=$_GET["word"];


include("config.php");
$pdo=new PDO("mysql:host=".host.";dbname=".dbname,username,password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
if (!preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$word))
{
    $mysqlselect="select english,chinese,posd,US,UK,exam_type from words where english=:word";
    $mysqlselect=$pdo->prepare($mysqlselect);
    $mysqlselect->execute(array(':word'=>$word));
    $getone=$mysqlselect->fetchAll();
    if ($getone==NULL)
    {
        $ret = do_request($word);
        $ret = json_decode($ret, true);
        print_r(json_encode($ret));
        $mysqlselect="select word_id from words order by word_id desc limit 0,1";
        $mysqlselect=$pdo->prepare($mysqlselect);
        $mysqlselect->execute(array());
        $getone=$mysqlselect->fetch();
        $word_id=$getone[0]+1;
        if (In_array("basic",array_keys($ret)))
        {
            for($n=0;$n<count($ret["basic"]["explains"]);$n++)
            {
                if ((strpos($ret["basic"]["explains"][$n],".")==NULL) & (strpos($ret["basic"]["explains"][$n],".")<5))
                {
                    $posd="名";
                    $chinese=$ret["basic"]["explains"][$n];
                }
                else
                {
                    $posd=substr($ret["basic"]["explains"][$n],0,strpos($ret["basic"]["explains"][$n],"."));
                    $chinese=substr($ret["basic"]["explains"][$n],strpos($ret["basic"]["explains"][$n],".")+1);
                }
                $us=$ret["basic"]["us-phonetic"];
                $uk=$ret["basic"]["uk-phonetic"];
                $exam_type=json_encode($ret["basic"]["exam_type"]);
                $mysqlinsert="INSERT INTO `words`  VALUES(:word_id, :english, :chinese, :posd, :US, :Uk, :exam_type)";
                $mysqlinsert=$pdo->prepare($mysqlinsert);
                $mysqlinsert->execute(array(":word_id"=>$word_id, ":english"=>$word, ":chinese"=>$chinese, ":posd"=>$posd, ":US"=>$us, ":Uk"=>$uk, ":exam_type"=>$exam_type));
                $getone=$mysqlinsert->fetch();

            }
        }       
    }
    else{
        $ret["basic"]["explains"]=[];
        if ($getone[0]["exam_type"] != "")
        {
            // print($getone[0]["exam_type"]);
            $ret["basic"]["exam_type"]=json_decode($getone[0]["exam_type"]);
        }
        else{
            $ret["basic"]["exam_type"]=["暂无"];
        }
        $ret["basic"]["us-phonetic"]=$getone[0]["US"];
        $ret["basic"]["uk-phonetic"]=$getone[0]["UK"];
        $ret["isWord"]=true;
        for($n=0;$n<count($getone);$n++)
        {
            array_push($ret["basic"]["explains"],$getone[$n]["posd"].".".$getone[$n]["chinese"]);
        }
        // print_r($ret);
        print_r(json_encode($ret));
    }

}
else{
    $ret = do_request($word);
    $ret = json_decode($ret, true);
    print_r(json_encode($ret));
}
?>