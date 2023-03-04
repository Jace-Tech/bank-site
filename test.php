<?php  

// $data = realpath(dirname("/admin/signin.php"));

// echo $data;

// $start_date = '2020-01-01';
// $end_date = '2020-06-30'; 

// $start_date = date_create($start_date);
// $end_date = date_create($end_date);


// for ($date = $start_date; $date <= $end_date; date_add($date, date_interval_create_from_date_string(rand(1, 7) . " days"))) {
//    echo "DATE ->> " . date_format($date, 'Y-m-d') . "\n";
// }

$data = [];

// $data = array_filter($success, function($item) {
//    return $item;
//  });

//  print_r($data);
 if(!$data) print("EMPTY");
 else print("NOT EMPTY");


function hidePhone(string $phone) {
  $digits = str_split($phone, 1);
  $res = "";
  for ($i = 0; $i < count($digits); $i++) {
      if($i >= count($digits) - 4){
        if($i == count($digits) - 4) $res .= '-'; 
        else $res .= $digits[$i];
      }
      else {
          if((strlen($res) + 1) % 5 === 0 && $i < count($digits) - 4) $res .= "-";
          $res .= "*";
      }
  }

  return $res;
}


echo "\n\n" . hidePhone("09052541151");
?>