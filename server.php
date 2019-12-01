<?php
$filename = "assets/data/nitro300.txt";
$h1 = 8.7177;
$hf = -3.4213;

if(!empty($_GET['gas']) && !empty($_GET['temp'])){
    $gas = $_GET['gas'];
    $temp = $_GET['temp'];
    if($gas=='1'){
        if($temp=='300'){
            $filename = "assets/data/Nitro300.txt";
            $h1 = 8.7177;
        }
        else if($temp=='350'){
            $filename = "assets/data/Nitro350.txt";
            $h1 = 10.177;
        }
        else{
            $filename = "assets/data/Nitro373.txt";
            $h1 = 10.849;
        }
        $hf = -3.4213;
    }

    else if($gas=='2'){
        if($temp=='300'){
            $filename = "assets/data/Argon300.txt";
            $h1 = 6.2279;
        }
        else if($temp=='350'){
            $filename = "assets/data/Argon350.txt";
            $h1 = 7.2692;
        }
        else{
            $filename = "assets/data/Argon373.txt";
            $h1 = 7.7480;
        }
        $hf = -4.6948;
    }

    else{
        if($temp=='300'){
            $filename = "assets/data/Oxygen300.txt";
            $h1 = 8.7265;
        }
        else if($temp=='350'){
            $filename = "assets/data/Oxygen350.txt";
            $h1 = 10.205;
        }
        else{
            $filename = "assets/data/Oxygen373.txt";
            $h1 = 10.891;
        }
        $hf = -4.2669;
    }
}

$serveFile = fopen($filename,"r") or die("Unable to open file");
$dataList = array();
fgets($serveFile);
class DataObject{
    function DataObject($x, $y){
        $this->x = $x;
        $this->y = $y;
    }
}

while(!feof($serveFile)){   
    $data = fgets($serveFile);
    if($data==""){
        break;
    }
    $data = explode("\t",$data);
    $x = floatval(trim($data[1]));
    $y = ($h1-floatval(trim($data[5])))/($h1-$hf);
    $dobj = new DataObject($x, $y);
    array_push($dataList, $dobj);
}
fclose($serveFile);
$dataJson = json_encode($dataList);
header('Content-type: application/json');
echo $dataJson;
?>