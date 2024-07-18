<?php

namespace App\Exceptions;

namespace App\Http\Controllers;


use App\Scrape;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use WebScraper\ApiClient\Client;
use WebScraper\ApiClient\WebScraperApiException;


class ProviderController extends Controller
{

    public $client;
    public function __construct()
    {
        $this->client = new Client([
            'token' => "token",
        ]);
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
            return response()->json(array('msg' => 'Sitemap json not exit '));
        }
        $getjsondata = json_decode($sitemapJSON, true);
        $sitemapIterator = $this->client->getSitemaps();
        foreach ($sitemapIterator as $sitemap) {
            if ($sitemap->name === $provider) {
                $exist = true;
                $jobid = $this->getdata($sitemap->id, $starturl, $provider, $schedule, $userid);
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
}