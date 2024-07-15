<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Scrape;
use League\Csv\Reader;
use WebScraper\ApiClient\Client;
use WebScraper\ApiClient\WebScraperApiException;


class DailyScrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:daily';

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
        // return 0;
      
        $exist = false;
        $starturl = "https://www.carboyz.ca/used-cars";
        $provider = "autobanny";
        $userid = 28266;
        
        // return response()->json(array('msg' => 'started', 'scrapingJobId' => $jobid, 'userid' => $userid), 200);
                   
       

        
        $id = 73;
        return response()->json(array('msg' => 'started', 'scrapingJobId' => $jobid, 'userid' => $userid), 200);
        $sitemapJSON = '';
        $content = @file_get_contents(storage_path() . "/" . $provider . ".json");
        if ($content === false) {
            $error = ['error' => "provider not exist"];
            return view('send', $error);
        } else {
            $sitemapJSON = file_get_contents(storage_path() . "/" . $provider . ".json");
            $getjsondata = json_decode($sitemapJSON);
            $sitemapIterator = $this->client->getSitemaps();
            foreach ($sitemapIterator as $sitemap) {
                if ($sitemap['name'] === $provider) {
                    $exist = true;
                    $getjsondata->startUrl[0] = $starturl;
                    $jobid = $this->getdata($sitemap['id'], $starturl, $id);
                    return response()->json(array('msg' => 'started', 'scrapingJobId' => $jobid, 'userid' => $userid), 200);

                }
            }
            if (!$exist) {
                $sitemap = json_decode($sitemapJSON, true);
                $getjsondata = json_decode($sitemapJSON);
                $sitemap['_id'] = $provider;
                $sitemap['startUrl'][0] = $starturl;
                try {
                    if (is_array($sitemap)) {
                        $response = $this->client->createSitemap($sitemap);
                        $scrapingJobId = $this->getdata($response['id'], $starturl, $id);
                        return response()->json(array('msg' => 'started', 'scrapingJobId' => $scrapingJobId, 'userid' => $userid), 200);
                    } else {
                        $error = ['error' => "Error fatal"];
                        return view('send', $error);
                    }
                } catch (WebScraperApiException $e) {
                    $error = ['error' => "Error fatal"];
                    return view('send', $error);
                }
                // unset($sitemapJSON);
            }
        }

    }
    public function getdata($sitemapId, $starturl, $id)
    {
        $createScrapingJob = $this->client->createScrapingJob([
            'sitemap_id' => $sitemapId,
            'driver' => 'fast', // 'fast' or 'fulljs'
            'page_load_delay' => 2000,
            'request_interval' => 2000,
            'proxy' => 0, // optional. 0 - no proxy, 1 - use proxy. Or proxy id for Scale plan users
            'start_urls' => [ // optional, if set, will overwrite sitemap start URLs
                $starturl,
            ],
            'custom_id' => 'custom-scraping-job-12', // optional, will be included in webhook notification
        ]);
        $scrape = Scrape::find(73);
        $scrape->jobid = $createScrapingJob['id'];
        $scrape->save();
        return $createScrapingJob['id'];
    }

    public function csv(Request $request)
    {

        $this->scrapingJobId = $request->scrapingJobId;
        $userid = $request->userid;
        // $this->scrapingJobId = "8073423";
        session(['jobid' => $userid]);
        $scrapingJob = $this->client->getScrapingJob($this->scrapingJobId);
        if ($scrapingJob['status'] == 'finished') {
            $outputFile = storage_path() . "/excel/{$userid}.csv";
            $this->client->downloadScrapingJobCSV($this->scrapingJobId, $outputFile);
            $records = Reader::createFromPath($outputFile, 'r+');
            $outputFile = storage_path() . "/excel/{$userid}.csv";
            $file_pointer = fopen($outputFile, 'r+');
            $i = 0;
            $stocknumber = 0;
            foreach ($records as $record) {
                if ($i == 0) {
                    $record = array("Dealer ID", "Stock Number", "Year", "Make", "Model", "Trim", "Vin", "mileage", "Price"
                        , "Color", "Interior Color", "Transmission", "Image", "Description", "Options", "Vehicle Type", "Engine", "Drive-train"
                        , "Fuel Type", "Destination URL", "New/Used", "Certified", "Doors", "MSRP"
                        , "Down-payment", "Fuel city min", "Fuel city max", "Highway city min"
                        , "Highway city max", "Title", "Date added", "Car report");
                } else {
                    $stocknumber = (!empty($record[4])) ? $record[4] : $record[22];
                    $vin = (!empty($record[14])) ? $record[14] : $record[15];
                    $record = array($userid, $stocknumber, $record[5], $record[6], $record[7], "", $vin, $record[16]
                        , explode(' ', trim($record[19]))[0], $record[17], $record[18], $record[10], $this->getimages($record[20]), "description", "Options", $record[23], $record[11], $record[12]
                        , $record[13], $record[3], "Used", "Certified", preg_replace('/[^0-9]/', '', $record[21]), "", "", "", "", "", "", $record[2]
                        , "", "");
                    $replace = ["km", "Km", "$", "vin:", " + Applicable Taxes", "Interior Color:"];
                    $record = str_replace(array("\r", "\n"), '', $record);
                    $record = preg_replace('/\s+/', ' ', $record);
                    $record = str_replace($replace, '', $record);
                }
                fputcsv($file_pointer, $record);
                $i++;
            }
            return $this->sendtoftp($userid);
            // return response()->json(array('msg' => 'finished', 'scrapingJobId' => $this->scrapingJobId), 200);
        } else {
            return response()->json(array('msg' => 'loading'), 200);
        }
           
        Log::info("Cron is working fine!");
    }
}
