<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Charts\CovidChart;

use GuzzleHttp\Client;

class CovidChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = new Client(['verify' => 'C:\xampp\php\extras\ssl\cacert.pem']);
    	$response = $client->request('GET', 'http://pomber.github.io/covid19/timeseries.json');
    	$statusCode = $response->getStatusCode();
    	$body = $response->getBody()->getContents();

        $data = json_decode($body, true);

        array_keys($data);
        return view('welcome')->with('options' , array_keys($data));
    }

    public function show(Request $request)
    {
        $client = new Client(['verify' => 'C:\xampp\php\extras\ssl\cacert.pem']);
    	$response = $client->request('GET', 'http://pomber.github.io/covid19/timeseries.json');
    	$statusCode = $response->getStatusCode();
    	$body = $response->getBody()->getContents();

        $data = json_decode($body, true);

        $last = last($data[$request->input('country')]);

        $covidChart = new CovidChart;
        $x = $request->input('chart');
        $borderColors = [
            "rgba(255, 205, 86, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 99, 132, 1.0)",
        ];
        $fillColors = [
            "rgba(255, 205, 86, 2.0)",
            "rgba(22,160,133, 2.0)",
            "rgba(255, 99, 132, 2.0)",
        ];

        $covidChart->labels(['confirmed','recovered','deaths']);
        $covidChart->dataset('Covid19', $x, [$last['confirmed'],$last['recovered'],$last['deaths']])
            ->color($borderColors)
            ->backgroundcolor($fillColors);

        return view('welcome', [ 'covidChart' => $covidChart ])->with('options' , array_keys($data));;
    }

}
