<?php

/**
 * Description of ServerController
 *
 * @author jacob
 */
class ServerController extends BaseController {

    function getIndex() {
        $factory = new QueryAuth\Factory();
        $server = $factory->newServer();

        $secret = 'API_SECRET';
        $method = 'GET';
        $host = 'http://localhost';
        $path = '/sandbox/query_auth/api_auth/public/server/index';
// querystring params or request body as an array,
// which includes timestamp, key, and signature params from the client's
// getSignedRequestParams method
        //$params = 'PARAMS_FROM_REQUEST';
        $params=Input::get('data');

        $isValid = $server->validateSignature($secret, $method, $host, $path, $params);
        if($isValid){
            return Response::json(json_encode($params));
        }
        
    }

}
