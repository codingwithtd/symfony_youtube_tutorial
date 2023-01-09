<?php


namespace App\Utilities;


class PublicIPAddress
{
    public static function getPublicIP() : string
    {
        $realIP = "Invalid IP Address";

        $activeHeaders = [];

        $headers = [
            "HTTP_CLIENT_IP",
            "HTTP_PRAGMA",
            "HTTP_XONNECTION",
            "HTTP_CACHE_INFO",
            "HTTP_XPROXY",
            "HTTP_PROXY",
            "HTTP_PROXY_CONNECTION",
            "HTTP_VIA",
            "HTTP_X_COMING_FROM",
            "HTTP_COMING_FROM",
            "HTTP_X_FORWARDED_FOR",
            "HTTP_X_FORWARDED",
            "HTTP_X_CLUSTER_CLIENT_IP",
            "HTTP_FORWARDED_FOR",
            "HTTP_FORWARDED",
            "ZHTTP_CACHE_CONTROL",
            "REMOTE_ADDR" #this should be the last option
        ];

        #Find active headers
        foreach ($headers as $key)
        {
            if (array_key_exists($key, $_SERVER))
            {
                $activeHeaders[$key] = $_SERVER[$key];
            }
        }

        #Reemove remote address since we got more options to choose from
        if(count($activeHeaders) > 1)
        {
            unset($activeHeaders["REMOTE_ADDR"]);
        }

        #Pick a random item now that we have a secure way.
        #Validate the public IP
        return $activeHeaders[array_rand($activeHeaders)];

    }
}