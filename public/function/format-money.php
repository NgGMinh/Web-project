<?php
function money_format($n){
    $n = (string)$n; 
    $n = strrev($n); // Đảo chuỗi
    $result = '';
    for($i = 0; $i < strlen($n); $i++ ){
        if($i%3 == 0 && $i != 0){
            $result.='.';
        }
        $result.=$n[$i];
    }
    $result = strrev($result);

    return $result;
}
