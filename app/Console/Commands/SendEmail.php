<?php

namespace App\Console\Commands;

use App\Models\OfficeMail;
use App\Providers\OfficeEmailProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SendEmail extends Command
{
    private $provider;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:office {num=100}';

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

    private function data()
    {
        $data =  [
            "token_type" => "Bearer",
            "expires_in" => 3599,
            "ext_expires_in" => 3599,
            "expires_on" => 1645863367,
            "not_before" => 1645859467,
            "resource" => "https://graph.microsoft.com/",
            "access_token" => "eyJ0eXAiOiJKV1QiLCJub25jZSI6InFrSERPNWlEU2ZKSVI0dnNxXzdXbW5kUTZfaXo3T1ZkUGowNEd4YVg4ZEUiLCJhbGciOiJSUzI1NiIsIng1dCI6Ik1yNS1BVWliZkJpaTdOZDFqQmViYXhib1hXMCIsImtpZCI6Ik1yNS1BVWliZkJpaTdOZDFqQmViYXhib1hXMCJ9.eyJhdWQiOiJodHRwczovL2dyYXBoLm1pY3Jvc29mdC5jb20vIiwiaXNzIjoiaHR0cHM6Ly9zdHMud2luZG93cy5uZXQvMDgzNGRmMWQtMzhlZS00NzQ4LTk1ZTItNTViZTY0NGU0ZmYzLyIsImlhdCI6MTY0NTg1OTQ2NywibmJmIjoxNjQ1ODU5NDY3LCJleHAiOjE2NDU4NjMzNjcsImFpbyI6IkUyWmdZREN0aStaemJmeXRJU1N4WWgzRGpiUHNBQT09IiwiYXBwX2Rpc3BsYXluYW1lIjoiUFVTT0UiLCJhcHBpZCI6ImY0MWZhNmNjLWE4Y2EtNDViNC05Mzc2LTgwYzMxZmI0ZWJmOCIsImFwcGlkYWNyIjoiMSIsImlkcCI6Imh0dHBzOi8vc3RzLndpbmRvd3MubmV0LzA4MzRkZjFkLTM4ZWUtNDc0OC05NWUyLTU1YmU2NDRlNGZmMy8iLCJpZHR5cCI6ImFwcCIsIm9pZCI6IjJlNzQyZTBiLWY2MmEtNGNhYy04MGNjLWIzNjFjYTU0NGVkOCIsInJoIjoiMC5BVlVBSGQ4MENPNDRTRWVWNGxXLVpFNVA4d01BQUFBQUFBQUF3QUFBQUFBQUFBQ0lBQUEuIiwicm9sZXMiOlsiVXNlci5SZWFkLkFsbCIsIk1haWwuU2VuZCJdLCJzdWIiOiIyZTc0MmUwYi1mNjJhLTRjYWMtODBjYy1iMzYxY2E1NDRlZDgiLCJ0ZW5hbnRfcmVnaW9uX3Njb3BlIjoiQVMiLCJ0aWQiOiIwODM0ZGYxZC0zOGVlLTQ3NDgtOTVlMi01NWJlNjQ0ZTRmZjMiLCJ1dGkiOiJ6Z1I5Unl1Z1hrNkl6V1ctLW1WSUFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyIwOTk3YTFkMC0wZDFkLTRhY2ItYjQwOC1kNWNhNzMxMjFlOTAiXSwieG1zX3RjZHQiOjE2NDMzNjExMzR9.OOrIW_kBNc3-hlFWBL6mqIk7DszBCtgWFHnmjoPjMUQ2IHlkZsJieAWFk7iOBzVlGn7KN7E7yWgPoANCAKJfhkJeqlTzjlN-fpnwJHI8LBYc7WHxHrb-hzAqDx7f_v44FvkVWCTx0besvUE1Qob_Gjol7TbKWt8xt7PsgcHL5D5Rrbx4Nkr6jsamc-UlaRbf49_ilUUnXp_UQSVRvg7Ag6-l7ylSwjcwQMMDCZ43OgpBV2T3Uxc20QggrODac4ECPJw45u6XXaUEqBGXA6RkXnKI2aKr1cA8SC804PU80NPv42OF4BiRGp_geHrYJyg1Jl1AxKg-Vi_AGIF7SZ7jmw"
        ];

        file_put_contents(storage_path('data.json'), json_encode($data));
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $time1=time();
        $sent = [];
        $blocked = [];
        $mails = DB::table('office_mails')->where('sent', 0)->where('pulled', 0)->take($this->argument('num'))->get();
        if ($mails->count() > 0) {

            OfficeMail::where('id', '<=', $mails->max('id'))->update(['pulled' => 1]);
            $this->provider = new OfficeEmailProvider();
            foreach ($mails as $key => $mail) {
                // dd($mail);
                try {
                    if ($this->provider->send($mail)) {
                        array_push($sent, $mail->id);
                    } else {
                        array_push($blocked, $mail->id);
                    }
                } catch (\Throwable $th) {
                    array_push($blocked, $mail->id);
                    echo "Error: ".$th->getMessage();
                }
            }
            if(count($blocked)>0){
                DB::table('office_mails')->whereIn('id', $blocked)->update([
                    'sent'=>0,
                    'pulled'=>0
                ]);
            }
            if(count($sent)>0){
                DB::table('office_mails')->whereIn('id', $sent)->update([
                    'sent'=>1,
                    'pulled'=>1
                ]);
            }
            
        }

        // echo "took ".time()-$time1 ." Seconds to complete";
        return 0;
    }
}
