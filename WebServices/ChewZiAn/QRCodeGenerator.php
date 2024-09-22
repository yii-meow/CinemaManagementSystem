<?php

/**
 * @Chew Zi An
 */

use Exception;

class QRCodeGenerator
{
    public function generateQRCode($ticketId)
    {
        $url = 'http://localhost:3000/generate-qr-code';
        $data = array('data' => (string) $ticketId);

        error_log("Attempting to generate QR code for ticket ID: $ticketId");
        error_log("Sending request to: $url");
        error_log("Request data: " . json_encode($data));

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json'
        ));
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        curl_setopt($ch, CURLOPT_FAILONERROR, true); // Fail on HTTP errors

        try {
            $result = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($result === false) {
                error_log("curl_exec failed. Error: " . curl_error($ch));
                throw new \RuntimeException("Error generating QR code: " . curl_error($ch));
            }

            error_log("Received response (HTTP $httpCode): $result");

            $response = json_decode($result, true);

            if ($httpCode == 200 && isset($response['success']) && $response['success']) {
                error_log("Successfully generated QR code");
                return $response['qrCodeUrl'];
            } else {
                error_log("QR code generation failed. Response: " . print_r($response, true));
                throw new \RuntimeException("Failed to generate QR code: " . ($response['message'] ?? 'Unknown error'));
            }
        } catch (\Exception $e) {
            error_log("Exception in QR code generation: " . $e->getMessage());
            return null;
        } finally {
            curl_close($ch);
        }
    }
}
