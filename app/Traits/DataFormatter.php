<?php

namespace App\Traits;

use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Panther\Client as Panther;

/**
 * Trait TokenApiV2Trait
 * @package App\Http\Traits
 */
trait DataFormatter
{
    public $listphotos;
    public $imglink;
    /**
     * Encrypt text
     * @param string $crypt
     * @param string $key
     * @return string
     */
    public function autosearchtechnologies($record)
    {
        $domain = parse_url($this->url);
        $url = $domain['host'];
        $record[19] = str_replace('image', 'http://' . $url . '/image', $record[19]);
    }

    public function cdk($record)
    {
        $domain = parse_url($this->url);
        $url = $domain['host'];
        $record[19] = str_replace('/sites', 'http://' . $url . '/sites', $record[19]);
    }

    public function autoconnx($record)
    {
        $domain = parse_url($this->url);
        $url = $domain['host'];
        $record[19] = str_replace('/images', 'http://' . $url . '/images', $record[19]);
    }
    public function sm360($record)
    {
        // $this->scrapper = Panther::createChromeClient(base_path("drivers/chromedriver"), null, ["port" => 9559]);
        // $this->imglink = "https" . $record[19];
        //  $this->crawler = $this->scrapper->request('GET', $this->imglink);
        $this->crawler = new Crawler($this->scrapper->getCrawler()->html());
      
        $this->crawler = $this->scrapper->waitFor('#absolute-drawer-container');
        $this->crawler = $this->scrapper->waitFor('#carousel-buttons > div:nth-child(1)');
        //     // $crawler = $this->scrapper->request('GET', $url);
        $nbrimage = count($this->crawler->filter('#drawer-grid')->children('.photo-card'));

        $json = array();
        for ($i = 0; $i < $nbrimage; $i++) {
            $json[] = array("photo urls" => "", "photo" =>  ''. $this->crawler->filter('#drawer-grid')->children('.photo-card')->eq($i)->attr('style') . '');
        }
        return $record[19]=json_encode($json);
        // dd($record[19]);
        // // $json[]=array("photo urls"=>"","photo"=>"testtest");
        // return $this->listphotos = json_encode($json);

    }

    public function getimages($images)
    {

        $data = json_decode($images, true);
        $json = json_decode($images);
        $images = "";
        if (!empty($json)) {
            foreach ($json as $row) {
                $images = $images . $row->{array_keys($data[0])[1]} . ',';
            }
        }
        return substr_replace($images, "", -1);
    }
    public function generatevin($userid, $stock)
    {
        $lg = strlen($userid . trim($stock));
        $nb = 14 - $lg;
        $zr = '';
        for ($i = 0; $i < $nb; $i++) {
            $zr = $zr . '0';
        }
        dd('V12' . $userid . $zr . trim($stock));
        return 'V12' . $userid . $zr . trim($stock);
    }

    public function getraw($record, $userid)
    {
        $fucntion = $this->functionname;
        if (method_exists($this, $this->functionname)) {
           $record[19]= $this->$fucntion($record);
        }
        // $record[19]=$this->listphotos;
       
        is_null($record[14]) ? 'test' : $this->generatevin($userid, $record[4]);
        echo $record[14];
        dd('test');
        if ($record[4] == '') {$record[4] = explode('-', $record[0])[1];}
        // if ($record[4] == '') {$record[4] = explode('-', $record[0])[1];}
        $record = array($userid, $record[4], $record[5], $record[6], $record[7], $record[23], $record[14] !== "" ? $record[14] : $this->generatevin($userid, $record[4]), str_replace(',', '', $record[15])
            , intval(preg_replace('/[^\d. ]/', '', $record[18])), $record[16], $record[17], str_replace(':', '', $record[10]), implode(',', array_unique(explode(',', $this->getimages($record[19])))), utf8_decode($record[22]), "$record[26]", $record[21], $record[11], str_replace(':', '', $record[12])
            , str_replace(':', '', $record[13]), $record[3], "Used", "Certified", preg_replace('/\D/', '', $record[20]), "0", "0", "-", "-", "-", "-", $record[2]
            , "", "none", $record[25]);
        return $record;
    }

}
