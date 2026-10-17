<?php
require 'config.php';
$id = $_GET['id'];
apiRequest('DELETE', API_URL . "/$id");
header('Location: index.php');