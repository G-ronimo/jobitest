<?php

namespace App\Service;

use Unirest;

class ApiPoleEmploi
{
    private $token;
    
    function __construct()
    {
        
        $end_point = 'https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=/partenaire';
        $headers = array('Content-Type' => 'application/x-www-form-urlencoded');
        $query = "&grant_type=client_credentials&client_id=PAR_jobitest_565d3113b497ac9342d1c49d6b764b60c5dde8e2dbf132dbb771d498d52d74bb&client_secret=8183fc82f402aee8951f5803f7ef94adb531017f27760d6045aa6eb4d837a367&scope=application_PAR_jobitest_565d3113b497ac9342d1c49d6b764b60c5dde8e2dbf132dbb771d498d52d74bb api_offresdemploiv2 o2dsoffre";
        
        try{
            $response = Unirest\Request::post($end_point,$headers,$query);
            if(isset($response->body->access_token)){
                $this->token = $response->body->access_token;
            }
        } catch(\Exception $e){

        }
    }
    
    public function getNewOffers()
    {
        
        $insee=33063;
        $start=0;
        $limit = 9;
        $range=$start.'-'.($start+$limit);
        $sort=1;
        $distance=0;
        $query = 'commune='.$insee.'&range='.$range.'&sort='.$sort.'&distance='.$distance;
        $end_point = 'https://api.emploi-store.fr/partenaire/offresdemploi/v2/offres/search?'.$query;
        $headers = array('Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer '.$this->token);
        
        try{
            $response = Unirest\Request::get($end_point,$headers,$query);
            if(isset($response->body->resultats)){
                return $response->body->resultats;
            }
        } catch(\Exception $e){

        }
        
        return false;
    }
}
