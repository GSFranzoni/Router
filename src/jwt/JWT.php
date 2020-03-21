<?php 

class JWT {

    public static function encode(array $payload, string $secret, int $expires_in = 86400) {
        $payload['exp'] = (new DateTime())->getTimestamp() + $expires_in;
        $header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode(array('typ' => 'JWT','alg' => 'HS256'))));
        $payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));
        $sign = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(self::SHA256("$header.$payload", $secret)));
        return "$header.$payload.$sign";
    }

    public static function decode(string $token, string $secret) {
        $token_array = explode(".", $token);
        $sign = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(self::SHA256($token_array[0].".".$token_array[1], $secret)));
        $payload = json_decode(base64_decode(str_replace(['-', '_', ''], ['+', '/', '='], $token_array[1])), true);
        if($sign == $token_array[2]) {
            if((new DateTime())->getTimestamp() > $payload['exp']) {
                return new Exception('Token expirado!');
            }
            else return $payload;
        }
        else return new Exception('Token inválido!');
    }

    private function SHA256(string $content, string $secret) {
        return hash_hmac('sha256', $content, $secret, true);
    }

}
