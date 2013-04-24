<?php print_r('INDEX'); ?>
<?php
$arr = array
  (
  "name" => "peter griffin",
  "age" => "41asd",
  "email" => "peter@example.com",
  );

$filters = array
  (
  "name" => array
    (
    "filter"=>FILTER_CALLBACK,
    "flags"=>FILTER_FORCE_ARRAY,
    "options"=>"ucwords"
    ),
  "age" => array
    (
    "filter"=>FILTER_SANITIZE_NUMBER_INT,
    "options"=>array
      (
      "min_range"=>1,
      "max_range"=>120
      )
    ),
  "email"=> FILTER_VALIDATE_EMAIL,
  );

print_r(filter_var_array($arr, $filters));
?> 

