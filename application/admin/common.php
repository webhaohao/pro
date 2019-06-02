<?php
function array_diff_assoc2_deep($array1, $array2) { 
            $ret = array(); 
            foreach ($array1 as $k => $v) {     
            if (!isset($array2[$k])) $ret[$k] = $v; 
            else if (is_array($v) && is_array($array2[$k])) $ret[$k] = array_diff_assoc2_deep($v, $array2[$k]); 
            else if ($v !=$array2[$k]) $ret[$k] = $v; 
            else 
            {
                unset($array1[$k]);
            }
            
            } 
            return $ret; 
}