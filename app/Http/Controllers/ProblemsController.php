<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    /* The function takes Time Complexity O(n) which n will be size of string && O(1) Space*/
    public function indexOfColumnTitle(string $input_string){
        $res = 0;
        $len = strlen($input_string);

        for($i = 0; $i < $len; $i++)
            $res += (ord($input_string[$i]) - 64) * pow(26, $len - $i - 1);

        return $res;
    }

    /* public function numbersWithoutFive(int $start,int $end){
        $step = 1;
        $counter = 0; // the number of numbers haven't 5
        $skip = 10; /* this will skip number starting with 5 and not only 5
                        like for example from -59 to -49, -599 to -499, 50 to 59, 500 to 599 *//*
        for($start; $start <= $end; $start += $step){
            if(preg_match("[5]", $start)){
                $step = 5;
                $counter--;
                if(preg_match("/^[5]\d+/", $start)){
                    $start += $skip - 1;
                    $skip *= 10;
                    continue;
                }
            }
            $counter += $step;
        }

        $counter -= preg_match("[5]", $end) ? $start - $end: $start - $end - 1;
        $counter = $counter > 0 ? $counter: 0;

        return response()->json(["Number of numbers which doesn't have 5" => $counter]);
    }*/

    // The function takes Time Complexity O(n) which n will be the range between start and end && and O(1) Space
    public function numbersWithoutFive($start, $end){
        $counter = 0;

        for($start; $start <= $end; $start++){
            if(!preg_match("[5]", $start))
                $counter++;
        }

        return response()->json(["Number of numbers which doesn't have 5 " => $counter]);
    }

    function DownToZero($num) {
        if($num <= 3)
            return $num;
        if($num == 4)
            return 3;

    }

    public function minimumStepsToZero(Request $req){
        $numbers = explode(",", $req->numbers);
        $res = array();
        $len = count($numbers);

        for($i = 0; $i< $len; $i++){
            array_push($res,$this->DownToZero((int)$numbers[$i]));
        }

        return response()->json($res);
    }
}
