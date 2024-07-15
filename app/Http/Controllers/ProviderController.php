<?php

namespace App\Exceptions;

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Scrape;
use App\Traits\DataFormatter;
use App\Traits\FtpTrait;
use App\Traits\TokenTrait;
use App\Traits\XmltoCsv;
use ElephantIO\Client as Elephant;
use ElephantIO\Engine\SocketIO\Version2X;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Symfony\Component\Panther\Client as Panther;
use WebScraper\ApiClient\Client;
use WebScraper\ApiClient\WebScraperApiException;

// use React\Http\Response;
// use React\Http\Server;

class ProviderController extends Controller
{
    //
    use TokenTrait, DataFormatter, FtpTrait, XmltoCsv;
    public $scrapingJobId;
    public $apiToken = "ZfTkabsWGkNtNLgTPXITy64SODdtzh4h4ecoAdgNIVT7dSgvsYJzCLwd91KA";
    public $client;
    public $url;
    public $functionname;
    public $scrapper;
    public $crawler;
    public function __construct()
    {
        $this->client = new Client([
            'token' => $this->apiToken,
        ]);
    }

    public function sendMessage(Request $request)
    {
        Event::fire(new MessageNotification($request->all()));

    }
    public function test(Request $request)
    {

        $this->scrapper = Panther::createChromeClient(base_path("drivers/chromedriver"), null, ["port" => 9559]);
        // $string = "Description CERTIFIED  - 4X4 - MANUAL - A/C - 2 DOOR - SOFT TOP - IMMACULATE CONDITION MUST SEE!!Â DETAILED AND READY TO GOO!!";
        // $string = preg_replace('/-{2,}/', '', $string);
        // $string = preg_replace('/\s+/', ' ', $string);
        // $string = str_replace("Â", "", $string);

        // dd(utf8_decode($string));
        //         $url = "https://shopee.co.id/shop/127192295/search";
        //         $url = "https://www.journeychryslerdodgejeepram.com/en/used-inventory/jeep/wrangler/2013-jeep-wrangler-id27051618?quoteId=a3ba8ca4-8812-4022-afca-e949c8d9b975";
        //         //         $scapper= Panther::createChromeClient();
        //         $this->crawler = $this->scrapper->request('GET', $url); // Yes, this website is 100% written in JavaScript
        //         $this->crawler = $this->scrapper->waitForVisibility('#sts_7233600420715103 iframe');
        //         $myFrame = $this->scrapper->findElement(WebDriverBy::cssSelector('#sts_7233600420715103 iframe'));

//         //     // $crawler = $this->scrapper->request('GET', $url);
        //         $nbrimage = count($this->crawler->filter('#sts_7233600420715103 iframe')->outerHtml());

// dd($nbrimage);
$this->getDatafromxml();
      

        // $httpClient = new Guzzle();
        // $response = $httpClient->get('localhost:3000');
        // $htmlString = (string) $response->getBody();
        // dd($htmlString);
        // return 'test';

        // $Elephant = new Elephant(new Version2X('http://localhost:3000', [
        //     'headers' => [
        //         'X-My-Header: websocket rocks',
        //         'Authorization: Bearer 12b3c4d5e6f7g8h9i'
        //     ]
        // ]));
        // $Elephant->initialize();
        // $Elephant->emit('newpost', ['message' => 'test','userid' => csrf_token()]);
        // $Elephant->close();
        // return response()->json(['status' => 'started', 'msg' => 'msg']);
        // Storage::disk('local')->put('somefile.txt', 'finished');
        // Event::dispatch(new MessageNotification($request->all()));

        //   $str= $this->getimages('[{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p1.jpg?v=1657288993513"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p2.jpg?v=1657288993513"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p3.jpg?v=1657288993513"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p4.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p5.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p6.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p7.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p8.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p9.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p10.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p11.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p12.jpg?v=1657288993514"},{"photo urls":"","photo urls-href":"/images.aspx/id-557076581-w-640-h-480/2014-gmc-sierra-2500hd-581-p13.jpg?v=1657288993514"}]');
        //      return $str = implode(',',array_unique(explode(',', $str)));
        //      dd($str);
        $this->scrapingJobId = $request->scrapingJobId;
        $userid = $request->userid;
        $provider = $request->provider;
        $this->url = $request->starturl;
        $this->functionname = $provider;
        $tmpfile = storage_path() . "/excel/{$provider}.csv";
        $records = Reader::createFromPath($tmpfile, 'r+');
        Storage::disk('excel')->put($userid . ".csv", '');
        $outputFile = storage_path() . "/excel/{$userid}.csv";
        $file_pointer = fopen($outputFile, 'r+');
        $csvheader = include_once storage_path() . "/app/header.php";
        $i = 0;
        foreach ($records as $record) {
            if ($i == 0) {
                $record = $csvheader;
            } else {
                // $url =trim($record[19]);
                // $this->crawler = $this->scrapper->request('GET', $url);
                // $record[19] = $this->sm36($record);
                $record = $this->getraw($record, $userid);
                $record = str_replace(array("\r", "\n"), '', $record);
                $record = str_replace("Â", ' ', $record);
                $record = preg_replace('/\s+/', ' ', $record);
                $record = preg_replace('/-{2,}/', '', $record);
            }
            $i++;
            fputcsv($file_pointer, $record);
        }
        return 'finished';
    }
    public function index()
    {
        $scrape = new Scrape;
        $data = $scrape::orderBy('id', 'desc')->get();
        return view('send', ['scrapes' => $data]);
    }
    public function createsitemap(Request $request)
    {
        $exist = false;
        $userid = $request->userid;
        $starturl = $request->starturl;
        $provider = $request->provider;
        $schedule = $request->schedule;
        $sitemapJSON = @file_get_contents(storage_path() . "/" . $provider . ".json");
        if ($sitemapJSON === false) {
            return response()->json(array('msg' => 'error'));
        }
        $getjsondata = json_decode($sitemapJSON, true);
        $sitemapIterator = $this->client->getSitemaps();
        foreach ($sitemapIterator as $sitemap) {
            if ($sitemap['name'] === $provider) {
                $exist = true;
                $jobid = $this->getdata($sitemap['id'], $starturl, $provider, $schedule, $userid);
                return response()->json(array('msg' => 'started', 'scrapingJobId' => $jobid, 'userid' => $userid, 'provider' => $provider), 200);
            }
        }
        if (!$exist) {
            $getjsondata['_id'] = $provider;
            $getjsondata['startUrl'][0] = $starturl;
            try {
                $response = $this->client->createSitemap($getjsondata);
                $jobid = $this->getdata($response['id'], $starturl, $provider, $schedule, $userid);
                return response()->json(array('msg' => 'started', 'scrapingJobId' => $jobid, 'userid' => $userid, 'provider' => $provider), 200);
            } catch (WebScraperApiException $e) {
                return response()->json(array('msg' => "error"));
            }
        }

    }
    public function getdata($sitemapId, $starturl, $provider, $schedule, $userid)
    {
        $createScrapingJob = $this->client->createScrapingJob([
            'sitemap_id' => $sitemapId,
            'driver' => 'fulljs', // 'fast' or 'fulljs'
            'page_load_delay' => 2000,
            'request_interval' => 2000,
            'proxy' => 0, // optional. 0 - no proxy, 1 - use proxy. Or proxy id for Scale plan users
            'start_urls' => [ // optional, if set, will overwrite sitemap start URLs
                $starturl,
            ],
            'custom_id' => (string) $userid, // optional, will be included in webhook notification
        ]);
        $scrape = new Scrape;
        $scrape->provider = $provider;
        $scrape->url = $starturl;
        $scrape->schedule = $schedule;
        $scrape->date = date("Y.m.d");
        $scrape->user_id = $userid;
        $scrape->jobid = $sitemapId;
        $scrape->save();
        return $createScrapingJob['id'];
    }

    public function csv(Request $request)
    {
        $this->scrapingJobId = $request->scrapingJobId;
        $provider = $request->provider;
        $contents = Storage::disk('local')->get($provider . '/status.txt');
        if ($contents == "finished") {
            return response()->json(array('msg' => 'finished', 'scrapingJobId' => $this->scrapingJobId), 200);
        } else {
            return response()->json(array('msg' => 'loading'), 200);
        }
    }
    public function notifications(Request $request)
    {
        $options = [
            'context' => [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                ],
            ],
        ];

        $Elephant = new Elephant(new Version2X('http://localhost:3000', $options));
        $Elephant->initialize();
        $Elephant->emit('broadcast', ['foo' => $request->provider]);
        $Elephant->close();
    }

}
