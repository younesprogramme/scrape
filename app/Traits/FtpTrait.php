<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

/**
 * Trait TokenApiV2Trait
 * @package App\Http\Traits
 */
trait FtpTrait
{

    /**
     * Encrypt text
     * @param string $crypt
     * @param string $key
     * @return string
     */
    public function sendtoftp($userid, $provider)
    {
        $ftp = ftp_connect('ftp.v12software.com', 21, 200) or die("Cannot login");
        ftp_login($ftp, "webscraping@datain.v12software.com", "SAOffJiKL");
        ftp_set_option($ftp, FTP_USEPASVADDRESS, false);
        ftp_pasv($ftp, true) or die("Cannot switch to passive mode");
        $dest_file = "{$provider}/{$userid}.csv";
        $source_file = storage_path() . "/excel/{$userid}.csv";
        $source_file = fopen($source_file, 'r');
        if (ftp_fput($ftp, $dest_file, $source_file, FTP_ASCII)) {
            return response()->json(array('msg' => 'finished', 'scrapingJobId' => $this->scrapingJobId), 200);
        } else {
            return response()->json(array('msg' => 'started', 'scrapingJobId' => $this->scrapingJobId), 200);
        }
    }

}
