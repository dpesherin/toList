<?


class Request {
    protected $err;

    public function make(string $method, array $data){
        
        $queryData = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl,[
            CURLOPT_SSL_VERIFYHOST=>0,
            CURLOPT_SSL_VERIFYPEER=>0,
            CURLOPT_POST=>1,
            CURLOPT_HEADER=>0,
            CURLOPT_RETURNTRANSFER=>1,
            CURLOPT_URL=>WEBHOOK.$method,
            CURLOPT_POSTFIELDS=>$queryData,
            CURLOPT_HTTPHEADER=>['Content-Type: application/json'],
        ]);

        $result = curl_exec($curl);
        return $result;
        
    }

    public function getErrors(){
        return $this->err;
    }


}