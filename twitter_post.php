<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'];
    $link = $_POST['link'];

    if (!empty($content) && !empty($link)) {
        $message = $content . '|' . $link;
        send_to_samp_server($message);
        echo 'OK';
    } else {
        http_response_code(400);
        echo 'Bad Request';
    }
}

function send_to_samp_server($message) {
    $samp_server_ip = '192.168.1.37'; // Replace with your SA-MP server IP
    $samp_server_port = 7777; // Replace with your SA-MP server listening port

    $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    socket_sendto($sock, $message, strlen($message), 0, $samp_server_ip, $samp_server_port);
    socket_close($sock);
}
?>
