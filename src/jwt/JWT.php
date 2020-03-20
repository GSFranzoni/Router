<?php 

class JWT {

    private const EXPIRES_IN = 86400;

    public static function encode(array $payload, string $secret) {
        $payload['iat'] = (new DateTime())->getTimestamp();
        $payload['exp'] = (new DateTime())->getTimestamp() + self::EXPIRES_IN;
        $header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode(array('typ' => 'JWT','alg' => 'HS256'))));
        $payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));
        $sign = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(self::SHA256("$header.$payload", $secret)));
        return "$header.$payload.$sign";
    }

    public static function decode(string $token, string $secret) {

    }

    private function SHA256(string $content, string $secret) {
        return hash_hmac('sha256', $content, $secret, true);
    }

}
