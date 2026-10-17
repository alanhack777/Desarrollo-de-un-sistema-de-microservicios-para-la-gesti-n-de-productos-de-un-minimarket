<?php
define('API_URL', 'http://localhost:8081/api/productos');

function apiRequest($method, $url, $data = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    
    if ($data !== null) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Si hay un error en cURL, lo mostramos
    if (curl_errno($ch)) {
        echo 'Error de cURL: ' . curl_error($ch);
    }
    
    // curl_close($ch); // Oculto para evitar el mensaje de Deprecated

    return ['code' => $httpCode, 'body' => json_decode($response, true)];
}
?>