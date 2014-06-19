<?php

/**
 * Acts as client for query auth
 *
 * @author jacob
 */
class ClientController extends BaseController {

    function getIndex() {
       
        $factory = new QueryAuth\Factory();
        $client = $factory->newClient();
        $key = 'API_KEY';
        $secret = 'API_SECRET';
        $method = 'GET';
        $host = 'http://localhost';
        $path = '/sandbox/query_auth/api_auth/public/server/index';
        $params = array('type' => 'vehicles');
        $signedParameters = $client->getSignedRequestParams($key, $secret, $method, $host, $path, $params);
        $n_client = new Guzzle\Http\Client($host);
        $res=$n_client->get($path);
        $res->getQuery()->set('data', $signedParameters);
        
        $resp=$res->send();
        dd($resp->getBody(true));
        return $res->getBody();
    }

}
