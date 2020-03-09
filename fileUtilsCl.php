<?php

class Utilis {
   
static public function filterInput($data,$allowed_fields){
	for($i=0;$i<count(array_keys($data));$i++)
		if(!in_array(array_keys($data)[$i],$allowed_fields)) unset($data[array_keys($data)[$i]]);
	return $data;
}

static public function writeJSON($file,$data){
	/*$h=fopen($file,'a+');
	fwrite($h,is_array($data) ? json_encode($data) : $data);
	fclose($h);*/
    //$unjson=readJSON($file);
    //$unjson[count($unjson)-1]=$data;
    $h=fopen($file,'w+');
	fwrite($h,is_array($data) ? json_encode($data) : $data);
	fclose($h);
}

static public function readJSON($file,$index=null){
	$h=fopen($file,'r+');
	$output='';
	while(!feof($h)) $output.=fgets($h);
	fclose($h);
	$output=json_decode($output,true);
	return !isset($index) ? $output : (isset($output[$index]) ? $output[$index] : null);
}

static public function modifyJSON($file,$data,$index){
	$input=readJSON($file);
	$input[$index]=array_replace($input[$index],$data);
	writeJSON($file,$input);
}

static public function deleteJSON($file,$index){
	$input=readJSON($file);
	unset($input[$index]);
    $input = array_values($input);
	writeJSON($file,$input);
}
  
static public function writeCSV($file,$data){
	$h=fopen($file,'w+');
    if (is_array($data)){
        foreach ($data as $fields) {
            fputcsv($h, $fields);
        }   
    }
    else
        fwrite($h,$data. "\n" /* PHP_EOL */);
	fclose($h);
}

static public function readCSV($file, $index=null){
	$h=fopen($file,'r');
	$output='';
	while(!feof($h)) $output.=fgets($h);
	fclose($h);
	$output=explode("\n",$output);
	unset($output[count($output)-1]);
	for($i=0;$i<count($output);$i++) $output[$i]=explode(',',$output[$i]);
	if (!isset($index) || !(array_key_exists($index,$output)))    return $output;	
    else return $output[index];
}

//Takes the filename, a single item of data, the line index, and the index of the individual data item.
static public function modifyCSV($file,$data,$lineIndex,$itemIndex){
	$input=readCSV($file);
	$input[0][$lineIndex][$itemIndex]=$data;
	writeCSV($file,$input);
}

//Takes the filename, the line index, and the index of the individual data item.
static public function deleteCSV($file,$lineIndex,$itemIndex){
	$input=readCSV($file);
	$input[0][$lineIndex][$itemIndex]="null";
	return $input;
}
    
}

?>