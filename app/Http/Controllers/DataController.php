<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DataRequest;
use Illuminate\Http\Request;
use App\Models\Data;
use DB;

class DataController extends Controller
{

//add data from DB
    public function Submit(DataRequest $req){
        $validated = $req->validated();
        $data = new Data;
        $data->user_id = $req->user()->id;
        $data->variant = $req->variant;
        $data->amountOfData = $req->amountOfData;
        $data->min = $req->min;
        $data->max = $req->max;
        if($req->intOrReal) $data->intOrReal = true;
        else $data->intOrReal = false;
        if($req->normalDistribution){
            $data->stdDeviation = 1;
            $data->normalDistribution = true;
        }
        else{
        $data->stdDeviation = $req->stdDeviation;
        $data->normalDistribution = false;
        }
        if($req->frequencies) $data->frequencies = true;
        else $data->frequencies = false;
        if($req->relativeFrequencies) $data->relativeFrequencies = true;
        else $data->relativeFrequencies = false;
        if($req->average) $data->average = true;
        else $data->average = false;
        if($req->fashion) $data->fashion = true;
        else $data->fashion = false;
        if($req->median) $data->median = true;
        else $data->median = false;
        if($req->dispersion) $data->dispersion = true;
        else $data->dispersion = false;
        if($req->standardDeviation) $data->standardDeviation = true;
        else $data->standardDeviation = false;
        if($req->coefficientOfVariation) $data->coefficientOfVariation = true;
        else $data->coefficientOfVariation = false;
        if($req->decileCoefficient) $data->decileCoefficient = true;
        else $data->decileCoefficient = false;
        if($req->lowerQuartile) $data->lowerQuartile = true;
        else $data->lowerQuartile = false;
        if($req->upperQuartile) $data->upperQuartile = true;
        else $data->upperQuartile = false;
        if($req->levelQuantileP){
            $data->levelP = $req->levelP;
            $data->levelQuantileP = true;
        }
        else {
            $data->levelP = 1;
            $data->levelQuantileP = false;
        }
        if($req->confidenceIntervalWithGammaReliability) $data->confidenceIntervalWithGammaReliability = true;
        else $data->confidenceIntervalWithGammaReliability = false;
        if($req->histogram) $data->histogram = true;
        else $data->histogram = false;
        if($req->cumulata) $data->cumulata = true;
        else $data->cumulata = false;
        
        $data->sample = $this::create_sample($req);

        $data-> save();

        return redirect()->route('last')->with('success','Запис успішно створенно');
    }

//History
    public function OutputAll(Request $req){
        $userId = $req->user()->id;
        $datas = Data::select('*')
            ->where('user_id','=',$userId)
            ->orderBy('id','desc')
            ->get();

        return view('history', compact('datas'));
    }
//Last inout data
    public function OutputLast(Request $req){
        $userId = $req->user()->id;
        $id = Data::where('user_id','=',$userId)
                        ->max('id');
        return view('last', compact('id'));
    }
//delete data from history
    public function Delete($id){
        Data::find($id)->delete();
        return redirect()->route('history')->with('success','Запис успішно видаленно');
    }

    public function SelectData($id){
        return view('last', compact('id'));
    }
//download files with some data
    //Exercise File
    public function VariantDownload($id) {
        $data = Data::select('*')
                ->where('id','=',$id)
                ->get();

        Storage::disk('public')->put('Zavdania.txt','');

        $this::createVariantFile($data);

        return Storage::disk('public')->download('Zavdania.txt');        
    }
    //Answer File
    public function VidpodidiDownload($id) {
        $data = Data::select('*')
                ->where('id','=',$id)
                ->get();

        Storage::disk('public')->put('Vidpovidi.txt','');

        $this::createVidpovidiFile($data);

        return Storage::disk('public')->download('Vidpovidi.txt');
    }
    //Input data File
    public function DataDownload($id) {
        
        $data = Data::select('*')
                ->where('id','=',$id)
                ->get();

        Storage::disk('public')->put('Data.txt','');
        
        $this::createDataFile($data);
        
        return Storage::disk('public')->download('Data.txt');
    }

    // Створення вибірки
    private function create_sample($data){

        $str = '';
        for($i=1;$i<=$data->variant;$i++){
            $arr_num = [];
            for($j=0;$j<$data -> amountOfData;$j++){
                if($data->intOrReal){
                    if($data->normalDistribution){
                        $num = $this::rand_gen_uniform_float( $data -> min, $data -> max );
                        array_push($arr_num,$num);
                    } 
                    else{
                        $num = $this::stats_rand_gen_normal_float( $data -> min,$data -> max,$data->stdDeviation); 
                        array_push($arr_num,$num);
                    }
                }
                else{
                    if($data->normalDistribution){
                        $num = $this::rand_gen_uniform( $data -> min, $data -> max );                    
                        array_push($arr_num,$num);
                    }
                    else{
                        $num = $this::stats_rand_gen_normal( $data -> min, $data -> max,$data->stdDeviation);
                        array_push($arr_num,$num);
                    }
                }
            }
            $str =$str.implode (' ',$arr_num ).",";
        }
    
        return $str;
    }

/* 
    Створення файлів
*/
//Input data File
    private function createDataFile($datas){
        
        foreach($datas as $data){
        $str = "Вхідні дані:\r\nКількість варіантів : ".$data->variant."\r\nОб'єм даних : ".$data->amountOfData."\r\nЛіва межа даних : ".$data->min."\r\nПрава межа даних : ".$data->max."\r\n";

        if($data->intOrReal) $str = $str."Дані цілі\r\n";
        else $str = $str."Дані дійсні\r\n";
        if($data->normalDistribution) $str = $str."Розподіл рівномірний\r\n";
        else $str = $str."Розподіл нормальний з відхиленням ".$data->stdDeviation."\r\n";
       
        $str = $str."\r\nСтатистики для обчислення : \r\n";

        if($data->frequencies) $str = $str."Частоти\r\n";
        
        if($data->relativeFrequencies) $str = $str."Відносні частоти\r\n";
       
        if($data->average) $str = $str."Середнє\r\n";
        
        if($data->fashion) $str = $str."Мода\r\n";
       
        if($data->median) $str = $str."Медіана\r\n";
        
        if($data->dispersion) $str = $str."Дисперсія\r\n";
        
        if($data->standardDeviation) $str = $str."Стандартне відхилення\r\n";
        
        if($data->coefficientOfVariation) $str = $str."Коефіцієнт варіації\r\n";
        
        if($data->decileCoefficient) $str = $str."Децильний коефіцієнт \r\n";
        
        if($data->lowerQuartile) $str = $str."Нижній квартиль\r\n";
        
        if($data->upperQuartile) $str = $str."Верхній квартиль\r\n";
        
        if($data->levelQuantileP) $str = $str."Квантиль рівня ".$data->levelP."\r\n";
        
        if($data->confidenceIntervalWithGammaReliability) $str = $str."Довірчий інтервал з надійністю  gamma\r\n";
        
        if($data->histogram) $str = $str."Гістограма\r\n";
        
        if($data->cumulata) $str = $str."Камулята\r\n";


        $sample = explode(",", $data->sample);
        $str =$str."\r\n";
        for($i = 1; $i <= $data->variant;$i++){
            $array = explode(" ", $sample[$i-1]);
            $all = implode (', ',$array);

            $str = $str."\r\nВаріант ".$i."\r\n";
            $str = $str."\r\nZ=c(".$all.")\r\n";
        }
        }
        
        Storage::disk('public')->append('Data.txt',$str);

    }
//Exercise File
    private function createVariantFile($datas){
        foreach($datas as $data){
        $str='';
        $sample = explode(",", $data->sample);

            for($i = 1; $i <= $data->variant;$i++){
                $array = explode(" ", $sample[$i-1]);
                $all = implode (', ',$array);

                $str = $str."\r\nВаріант ".$i."\r\n";
                $str = $str."\r\nZ=c(".$all.")\r\n";
                $j=0;
                $str = $str."\r\nЗавдання: \r\n";
                    if($data->frequencies) $str = $str.++$j.") Знайти частоти\r\n";
                    if($data->relativeFrequencies) $str = $str.++$j.") Знайти відносні частоти\r\n";       
                    if($data->average) $str = $str.++$j.") Знайти середнє\r\n";        
                    if($data->fashion) $str = $str.++$j."Знвйти моду\r\n";       
                    if($data->median) $str = $str.++$j.") Знайти медіану\r\n";        
                    if($data->dispersion) $str = $str.++$j.") Знайти дисперсію\r\n";        
                    if($data->standardDeviation) $str = $str.++$j.") Знайти стандартне відхилення\r\n";        
                    if($data->coefficientOfVariation) $str = $str.++$j.") Знайти коефіцієнт варіації\r\n";        
                    if($data->decileCoefficient) $str = $str.++$j.") Знайти децильний коефіцієнт \r\n";        
                    if($data->lowerQuartile) $str = $str.++$j.") Знайти нижній квартиль\r\n";        
                    if($data->upperQuartile) $str = $str.++$j.") Знайти верхній квартиль\r\n";        
                    if($data->levelQuantileP) $str = $str.++$j.") Знайти квантиль рівня ".$data->levelP."\r\n";        
                    if($data->confidenceIntervalWithGammaReliability) $str = $str.++$j.") Знайти довірчий інтервал з надійністю  gamma\r\n";        
                    if($data->histogram) $$str = $str.++$j."Побудувати гістограму\r\n";        
                    if($data->cumulata) $str = $str.++$j."Побудувати камуляту\r\n";
                    $str = $str."\n";
            
            }
        }
        
        Storage::disk('public')->append('Zavdania.txt',$str);
    }
//Answer File
    private function createVidpovidiFile($datas){
        foreach($datas as $data){
            $str='';
            $sample = explode(",", $data->sample);
                for($i = 1; $i <= $data->variant;$i++){
                    $array = explode(" ", $sample[$i-1]);
                    $all = implode (', ',$array);

                    $str = $str."\r\nВаріант ".$i."\r\n";
                    $str = $str."\r\nZ=c(".$all.")\r\n";
                    $j=0;
                        $str = $str."\r\nВсі значення: ".$this::all($array)."\r\n";
                        if($data->frequencies) $str = $str."Частоти: ".$this::frequencies($array)."\r\n";
                        if($data->relativeFrequencies) $str = $str."Відносні частоти: ".$this::relativeFrequencies($array)."\r\n";       
                        if($data->average) $str = $str."Cереднє: ".$this::average($array)."\r\n";    
                        if($data->fashion) $str = $str."Мода: ".$this::fashion($array)."\r\n";
                        if($data->median) $str = $str."Медіана: ".$this::median($array)."\r\n";        
                        if($data->dispersion) $str = $str."Дисперсія: ".$this::dispersion($array)."\r\n";        
                        if($data->standardDeviation) $str = $str."Стандартне відхилення: ".$this::standardDeviation($array)."\r\n";        
                        if($data->coefficientOfVariation) $str = $str."Коефіцієнт варіації: ".$this::coefficientOfVariation($array)."\r\n";        
                        if($data->decileCoefficient) $str = $str."Децильний коефіцієнт: ".$this::decileCoefficient($array)."\r\n";       
                        if($data->lowerQuartile) $str = $str."Нижній квартиль: ".$this::lowerQuartile($array)."\r\n";        
                        if($data->upperQuartile) $str = $str."Верхній квартиль: ".$this::upperQuartile($array)."\r\n";        
                        // if($data->levelQuantileP) $str = $str."Квантиль рівня ".$data->levelP.": ".$this::levelQuantileP($array)."\r\n";       
                        // if($data->confidenceIntervalWithGammaReliability) $str = $str."Довірчий інтервал з надійністю  gamma: ".$this::confidenceIntervalWithGammaReliability($array)."\r\n";        
                        // if($data->histogram) $$str = $str."Побудувати гістограму\r\n";        
                        // if($data->cumulata) $str = $str."Побудувати камуляту\r\n";
                        $str = $str."\n";
                
                }
            }
            
            Storage::disk('public')->append('Vidpovidi.txt',$str);
        }

/* 
    Математичні функції для створення вибірки 
*/
    private function stats_rand_gen_normal($min,$max, $sd=1) :int {
      
        $x = (float)mt_rand()/(float)mt_getrandmax();
        $y = (float)mt_rand()/(float)mt_getrandmax();
        $av = ($max + $min) / 2;
      
        $random_number = sqrt(-2 * log($x)) * cos(2 * pi() * $y) * $sd + $av;
      
        if($random_number < $min || $random_number > $max) {
            $random_number = $this::stats_rand_gen_normal($min, $max,$sd);
        }

        return $random_number;
    }


    private function stats_rand_gen_normal_float($min,$max, $sd=1):float {
     
        $x = (float)mt_rand()/(float)mt_getrandmax();
        $y = (float)mt_rand()/(float)mt_getrandmax();
        $av = ($max + $min) / 2;
      
        $random_number = round(sqrt(-2 * log($x)) * cos(2 * pi() * $y) * $sd + $av,1);
      
        if($random_number < $min || $random_number > $max) {
            $random_number = $this::stats_rand_gen_normal_float($min, $max,$sd);
        }
        
        return $random_number;
    }


    private function rand_gen_uniform ($min,$max):int{
    
        $x = random_int ($min, $max);
    
        if($x<$min || $x>$max) return 0;
        else return $x;
    }


    private function rand_gen_uniform_float($min,$max):float{
    
        $x = rand($min*10, $max*10)/10;
    
        if($x<$min || $x>$max) return 0;
        else return $x;
    }
/* 


    Математичні функції обрахування статистик


*/ 
//Всі значення
    private function all($arr){
        $array = array_count_values($arr);
        $str ='';
        foreach($array as $key=>$value){
            $str=$str.$key." ";
        }
        return $str;
    }
//Частоти
    private function frequencies($arr){
        $array = array_count_values($arr);
        $str ='';
        foreach($array as $key=>$value){
            $str=$str.$value." ";
        }
        return $str;
    }
//Відносні частоти

    private function relativeFrequencies($arr){
        $newArr = array_count_values($arr);
        $chastotaArr=[];
        $str ='';
        foreach($newArr as $value){
	        array_push($chastotaArr,$value);
        }
        $lenghtArr=count($arr);
        array_walk($chastotaArr, function(&$v) use($lenghtArr) {$v /= $lenghtArr;});
        foreach($chastotaArr as $chastotaNew){
                $str = $str.round($chastotaNew,4)." ";
        }
        return $str;
    }
//Середнє
    private function average($arr){
        $sum = 0;
        foreach($arr as $num){
            $sum += $num;
        }
        $averageValue = $sum/count($arr);
        return $averageValue;
    }
//Мода
    private function fashion($arr){
        $number = array_count_values($arr);
        $moda = array_keys($number, max($number));
        sort($moda);
        $str = '';
        foreach ($moda as $modaNew) {
            $str = $str.$modaNew . " ";
        }
        return $str;
    }
// Медіана
    private function median($arr){

        $count = count($arr);
        asort($arr);
        $mid  = floor(($count - 1) / 2);
        $keys = array_slice(array_keys($arr), $mid, (1 === $count % 2 ? 1 : 2));
        $sum  = 0;
        foreach ($keys as $key) {
            $sum += $arr[$key];
        }
        return $sum / count($keys);
    }
// Дисперсія
    private function dispersion($arr){
        $n = count($arr);
        $mean = array_sum($arr) / $n;
        $carry = 0.0;
        foreach ($arr as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        }
        $serkvd = sqrt($carry / $n);
        $dispersion = $serkvd*$serkvd*($n/($n-1));
        return $dispersion;
    }
// Стандартне відхилення
    private function standardDeviation($arr){
        $num_of_elements = count($arr); 
        $variance = 0.0; 
        $average = array_sum($arr)/$num_of_elements; 
        foreach($arr as $i) 
        { 
            $variance += pow(($i - $average), 2); 
        } 

        return (float)sqrt($variance/$num_of_elements); 
    }
// Коефіцієнт варіації
    private function coefficientOfVariation($arr){
        return $this::standardDeviation($arr)/$this::average($arr);
    }
// Децильний коефіцієнт
    private function decileCoefficient($arr){
        return $this::Quartile($arr, 0.9)/$this::Quartile($arr, 0.1);
    }
// Нижній квартиль
    private function lowerQuartile($arr){
        return $this::Quartile($arr, 0.25);
    }
// Верхній квартиль
    private function upperQuartile($arr){
        return $this::Quartile($arr, 0.75);
    }
// Квантиль рівня P

// Довірчий інтервал з надійністю  gamma

//Квартиль
    private function Quartile($Array, $Quartile){
        sort($Array);
        $pos = (count($Array) - 1) * $Quartile;
        $base = floor($pos);
        $rest = $pos - $base;
        if( isset($Array[$base+1]) ) {
        return $Array[$base] + $rest * ($Array[$base+1] - $Array[$base]);
        }
        else{
            return $Array[$base];
        }
    }
}
