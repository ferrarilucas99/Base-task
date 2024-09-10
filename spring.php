<?php

class SpringCourier
{
    public function __construct()
    {}

    public function newPackage(array $order, array $params): array
    {
        if (empty($params["apiKey"]) || !$this->validateApiKey($params["apiKey"])) {
            return [
                "code" => 401,
                "message" => "Unauthorized"
            ];
        }

        try {
            $this->validate($order, $params);

            $trackingNumber = $this->generateTrackingNumber();

            return [
                "code" => 200,
                "success" => true,
                "trackingNumber" => $trackingNumber,
            ];
        } catch (\Throwable $th) {
            return [
                "code" => 400,
                "error" => true,
                "message" => $th->getMessage()
            ];
        }
    }

    /**
     * Validation of $order and $params array data
     */
    private function validate(array $order, array $params): void
    {
        $orderValidationRules = [
            'recipientName' => 'Recipient name is required.',
            'recipientAddress' => 'Recipient address is required.',
            'recipientCity' => 'Recipient city is required.',
            'recipientZip' => 'Recipient zip code is required.',
            'senderName' => 'Sender name is required.',
            'senderAddress' => 'Sender address is required.',
            'senderCity' => 'Sender city is required.',
            'senderZip' => 'Sender zip code is required.',
        ];

        $paramsValidationRules = [
            "apiKey" => "API key is required.",
            'service' => 'Service is required.',
            'packageWeight' => 'Weight is required and must be a positive number.',
            'packageLength' => 'Length is required and must be a positive number.',
            'packageWidth' => 'Width is required and must be a positive number.',
            'packageHeight' => 'Height is required and must be a positive number.',
        ];

        foreach ($orderValidationRules as $key => $rule) {
            if (empty($order[$key])) {
                throw new \Exception($rule);
            }
        }

        foreach ($paramsValidationRules as $key => $rule) {
            if (empty($params[$key])) {
                throw new \Exception($rule);
            }
        }
    }

    /**
     * Generate a simple tracking number
     * @return string
     */
    private function generateTrackingNumber($length = 10): string
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }

    /**
     * Validates whether the API key entered is valid
     * To put it simply, there are 5 released tokens, they are low security 64-bit tokens.
     * In a production environment, 256-bit tokens would be used (JWT for example)
     * 
     * @return boolean
     */
    private function validateApiKey($apiKey): bool
    {
        $allowedKeys = [
            "W96lU-9Qdbd13=bcXAZ0xZz0ELETpNR6GB2zOz4V9t=mYYP?wNPy2jVWrOTF2d7a",
            "CTmJAN1KnENgkVz3FfCEWd/jETi4JTgLh1VAC/Be8OEHwsYZioDMbXJEDFC=mfpf",
            "qgchPcZ59no/jstWB=EpGbyYw-bQkRc8ogZ1oXC5BKDxU8niQJIT325-HpmUFBsM",
            "4LgqUiBum0Zsn8AyzMwfPu9kf=QU9Pgs8g195NrBsiq2u1FmotAcg7HlQXVjpEas",
            "XVD/J5!spH1e=vtEGFtawHZmj!Yb4W=wRBQfc8/cXkqAQpk5vXP1m7devxUy9k6k",
        ];

        return in_array($apiKey, $allowedKeys);
    }
}
