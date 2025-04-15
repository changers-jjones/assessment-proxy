<?php
// CORS headers pour accepter les appels JS de n'importe où
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🔐 Identifiants API Assessments24x7
$username = "changers";
$apiKey = "abc6322b-a3fe-44c5-aec6-87166e41cf50";

// 🔑 Auth BASIC
$auth = base64_encode("$username:$apiKey");
$authorizationHeader = "Authorization: Basic $auth";

// 📩 Lecture JSON entrant
$data = json_decode(file_get_contents("php://input"), true);

// 🌐 Requête API
$apiUrl = "https://www.assessments24x7.fr/api/register";
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    $authorizationHeader
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch_
