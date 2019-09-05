<?php

//namespace Mike42\Escpos\PrintConnectors;
namespace Bundle\TicketBundle\Services\Escpos\PrintConnectors;

class UriPrintConnector
{
    const URI_ASSEMBLER_PATTERN = "~^(.+):/{2}(.+?)(?::(\d{1,4}))?$~";

    public static function get($uri)
    {
        // Parse URI
        $is_uri = preg_match(self::URI_ASSEMBLER_PATTERN, $uri, $uri_parts);
        if ($is_uri !== 1) {
            throw new \InvalidArgumentException("Malformed connector URI: {$uri}");
        }
        // Extract parts
        $protocol = $uri_parts[1];
        $printer = $uri_parts[2];
        $port = isset($uri_parts[3]) ? $uri_parts[3] : 9100;
        // Initialise the most applicable print connector
        switch ($protocol) {
            case "file":
                return new FilePrintConnector($printer);
            case "tcp":
                return new NetworkPrintConnector($printer, $port);
            case "smb":
                return new WindowsPrintConnector($uri);
        }
        // Fallthrough
        throw new \InvalidArgumentException("URI sheme is not supported: {$protocol}://");
    }
}
