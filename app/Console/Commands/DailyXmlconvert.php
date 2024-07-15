<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DailyXmlconvert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xmlconvert:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $list = array(
            "dr5" => "https://psxdigital.com/powersports-marketing-automation/hooks/inventory/dR5/v12",
            "emm" => "https://psxdigital.com/powersports-marketing-automation/hooks/inventory/emm/v12",
            "ddo" => "https://psxdigital.com/powersports-marketing-automation/hooks/inventory/DDo/v12",
            "vqk" => "https://psxdigital.com/powersports-marketing-automation/hooks/inventory/vQK/v12",
        );

        $columns = array('Address', 'Address2', 'Beam', 'Boatname', 'Builder', 'Category', 'City', 'Class'
            , 'Condition', 'Description', 'Draft', 'Headline', 'Height', 'Length', 'Make', 'Mileage', 'Model'
            , 'Msrp', 'Price', 'Horsepower', 'State', 'Stocknumber', 'Unique', 'Vin', 'Width', 'Year', 'Zipcode'
            , 'Fuel', 'Phone', 'Photo1', 'Photo2', 'Photo3', 'Photo4', 'Photo5', 'Photo6', 'Photo7', 'Photo8'
            , 'Photo9', 'Photo10', 'Photo11', 'Photo12', 'Photo13', 'Photo14', 'Photo15', 'Photo16'
            , 'Photo17', 'Photo18', 'Photo19', 'Photo20', 'Photo21', 'Photo22', 'Specifications');

        $header = array('Address', 'Address2', 'Beam', 'Boatname', 'Builder', 'Category', 'City', 'Class'
            , 'Condition', 'Description', 'Draft', 'Headline', 'Height', 'Length', 'Make', 'Mileage', 'Model'
            , 'Msrp', 'Price', 'Horsepower', 'State', 'Stocknumber', 'Unique', 'Vin', 'Width', 'Year', 'Zipcode'
            , 'Fuel', 'Phone', 'Photos', 'Specifications');
        $fs = fopen(public_path() . '/50227.csv', 'w');
        fputcsv($fs, $header);
        fclose($fs);

        foreach ($list as $raw) {
            $domain = $raw;
            $filexml = simplexml_load_file($domain) or die("feed not loading");
            $node = $filexml->xpath('//unit');
            $this->fetchxmlData($node, $columns);
        }
        $this->sending();
    }
    public function fetchxmlData($node, $columns)
    {
        foreach ($node as $n) {
            $record = array();
            $i = 0;
            $image = "";
            $specifications = "";
            $json = json_encode($n);
            $json = json_decode($json, true);
            foreach ($columns as $col) {
                if (array_key_exists($col, $json)) {
                    if (strpos($col, 'Photo') !== false) {
                        $image = $image . $json[$col] . ',';
                    }
                    if (strpos($col, 'Specification') !== false) {
                        $specifications = str_replace(array('{', '}', '"', '[]'), '', json_encode($json[$col]));
                    }
                    if (is_array($json[$col])) {
                        if ($i < 31) {
                            $record[$i] = str_replace(array('{', '}', '"', '[]'), '', json_encode($json[$col]));
                        }
                    } else {
                        if ($i < 31) {
                            $record[$i] = $json[$col];
                        }
                    }
                } else {
                    if ($i < 31) {
                        $record[$i] = "";
                    }
                }
                $i++;
            }
            $record[30] = $specifications;
            $record[29] = substr_replace($image, "", -1);
            $record = preg_replace('/\s+/', ' ', $record);
            $fs = fopen(public_path() . "/50227.csv", 'a');
            fputcsv($fs, $record);
            fclose($fs);
        }
    }
    public function sending()
    {
        $ftp = ftp_connect('ftp.v12software.com', 21, 200) or die("Cannot login");
        ftp_login($ftp, "webscraping@datain.v12software.com", "SAOffJiKL");
        ftp_set_option($ftp, FTP_USEPASVADDRESS, false);
        ftp_pasv($ftp, true) or die("Cannot switch to passive mode");
        $dest_file = "delamomotorsport/50227.csv";
        $source_file = public_path() . "/50227.csv";
        $source_file = fopen($source_file, 'r');
        if (ftp_fput($ftp, $dest_file, $source_file, FTP_ASCII)) {
            echo 'sent to ftp';
        } else {
            return response()->json(array('msg' => 'faild'), 200);
        }
    }

    public function csv()
    {
        Log::info("Cron is working fine!");
    }
}
