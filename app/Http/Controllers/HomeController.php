<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function doc()
    {
        return view('doc');
    }

    public function check(Request $request){
        // array of words to check against
        $data = json_decode(File::get(public_path('storage/data/hasil.json')));
        $words = $data->data;

        $new_text = '';

        // loop through words to find the closest
        $kata = explode(" ", $request->word);
        foreach($kata as $t) {
            // no shortest distance found, yet
            $shortest = -1;
            foreach($words as $word){
                // calculate the distance between the input word,
                // and the current word
                $lev = levenshtein($t, $word);

                // check for an exact match
                if ($lev == 0) {

                    // closest word is this one (exact match)
                    $closest = $word;
                    $shortest = 0;

                    // break out of the loop; we've found an exact match
                    break;
                }

                // if this distance is less than the next found shortest
                // distance, OR if a next shortest word has not yet been found
                if ($lev <= $shortest || $shortest < 0) {
                    // set the closest match, and shortest distance
                    $closest  = $word;
                    $shortest = $lev;
                }
            }
            $new_text .= $closest . " ";   
        }
        return $new_text;
    }
    
    public function checkdoc(Request $request){
        if($request->hasFile('file')){
            $docs = $request->file('file');
            // create your reader object
            $phpWordReader = \PhpOffice\PhpWord\IOFactory::createReader('MsDoc');
            // read source
            if($phpWordReader->canRead($docs)) {
                $phpWord = $phpWordReader->load($docs);
                $text = '';

                $sections = $phpWord->getSections();

                foreach ($sections as $s) {
                    $els = $s->getElements();
                    foreach ($els as $e) {
                        if (get_class($e) === 'PhpOffice\PhpWord\Element\Text') {
                            $text .= $e->getText();
                        } elseif (get_class($e) === 'PhpOffice\PhpWord\Section\TextBreak') {
                            $text .= " \n";
                        } else {
                            throw new Exception('Unknown class type ' . get_class($e));
                        }
                    }
                }

                // array of words to check against
                $data = json_decode(File::get(public_path('storage/data/hasil.json')));
                $words = $data->data;

                // loop through words to find the closest
                $kata = explode(" ", $text);

                // Creating the new document...
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
        
                // Adding an empty Section to the document...
                $section = $phpWord->addSection();
                $fontStyleName = 'FontStyle1';
                $phpWord->addFontStyle(
                    $fontStyleName,
                    array('name' => 'Times New Roman', 'size' => 12, 'color' => '000000')
                );
                $fontStyleName2 = 'FontStyle2';
                $phpWord->addFontStyle(
                    $fontStyleName2,
                    array('name' => 'Times New Roman', 'size' => 12, 'color' => 'ff0000')
                );
                $textrun = $section->addTextRun();
                foreach($kata as $t) {
                    // no shortest distance found, yet
                    $shortest = -1;
                    foreach($words as $word){
                        // calculate the distance between the input word,
                        // and the current word
                        $lev = levenshtein(strtolower($t), $word);
    
                        // check for an exact match
                        if ($lev == 0) {
    
                            // closest word is this one (exact match)
                            $closest = $word;
                            $shortest = 0;
    
                            // break out of the loop; we've found an exact match
                            break;
                        }
    
                        // if this distance is less than the next found shortest
                        // distance, OR if a next shortest word has not yet been found
                        if ($lev <= $shortest || $shortest < 0) {
                            // set the closest match, and shortest distance
                            $closest  = $word;
                            $shortest = $lev;
                        }
                    }
                    if(strtolower($t) == $closest){
                        $textrun->addText(
                            $closest. " ",
                            $fontStyleName
                        );
                    }else{
                        $textrun->addText(
                            $closest. " ",
                            $fontStyleName2
                        );
                    }
                    // Saving the document as OOXML file...
                    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                    $waktu = time();
                    try {
                        $objWriter->save(public_path('storage/res/'.$waktu.'.docx'));
                    } catch (Exception $e) {
                
                    }

                }

                $download = url('/').'/storage/res/'.$waktu.'.docx';
                return $download;                
            }
        }
    }
}
