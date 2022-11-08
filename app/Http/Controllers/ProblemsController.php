<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    /*  Like Excel Sheet the function will take a string like Excel Column Title such as AA, BA, AAA
        the function will return the index of this string A -> 1, AA -> 27 and so on */
    public function indexOfColumnTitle(string $input_string){
        $res = 0;
        $len = strlen($input_string);

        /*  We getting the char position we have 26 char from A to Z
            so if we move from A to Z We have to move 26 times and from AA to BA Z7 timeS plus the A - Z Movements
            which will equal to 26 + 26 + 1 From A - Z 26 + AA - AZ 26  + AZ - BA 1
        */
        for($i = 0; $i < $len; $i++)
            $res += (ord($input_string[$i]) - 64) * pow(26, $len - $i - 1);

        return $res;
    }

    //the function will return count of numbers between the start number and end number doesn't has 5 in it
    public function numbersWithoutFive(int $start,int $end){
        $step = 1;
        $counter = 0; // the number of numbers haven't 5
        $skip = 10; /* this will skip number starting with 5 and not only 5
                        like for example from -59 to -49, -599 to -499, 50 to 59, 500 to 599 */
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
    }

    function numOfStepsToZero($num) {
        $count=0;
        while ($num > 0) {
            if($num%2==0)   $num = $num/2;
            else    $num--;
            $count++;
        }
        return $count;
    }
    /*  Take an array has some numbers and will return an array with the same original array size
        each index will be the minimum steps to covvert the original number to zero */
    public function minimumStepsToZero(Request $req){
        $numbers = explode(",", $req->numbers);

        $res = array();
        $len = count($numbers);

        for($i = 0; $i< $len; $i++){
            array_push($res, $this->numOfStepsToZero((int)$numbers[$i]));
        }

        return response()->json($res);
    }
}
