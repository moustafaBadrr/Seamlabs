<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

class ProblemSolvingController extends Controller
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
        // $counter = 0;
        // $counter2 = 0;
        // for($start; $start < $end; $start++){
        //     if(preg_match("[5]", (string)$start)){
        //         $counter2++;
        //         continue;
        //     }
        //     $counter++;
        // }
        // return response()->json([
        //     "inc"=>$counter,
        //     "non"=>$counter2
        // ]);
    }


    function downToZero($n){
        // if ($n <= 3)
        //     return $n;

        // return $n % 2 == 0 ? 3 : 4;
    }
    /*  Take an array has some numbers and will return an array with the same original array size
        each index will be the minimum steps to covvert the original number to zero */
    public function minimumStepsToZero($numbers){
        // $numbers = explode(",", $numbers);

        // $len = count($numbers);
        // for($i = 0; $i< $len; $i++){
        //     $numbers[$i] = $this->downToZero((int)$numbers[$i]);
        // }
        // return response()->json($numbers);
    }
}
