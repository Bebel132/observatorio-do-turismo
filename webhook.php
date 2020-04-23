<?php
// verifica se a requisição vem do servidor gitlab
$gitlab_ips = array('192.168.2.31', '172.31.3.8', '172.31.3.48', '127.0.0.1');
if (!in_array($_SERVER['REMOTE_ADDR'], $gitlab_ips)) {
    throw new Exception("Isto não parece uma requisição válida do Gitlab.\n");
}
$log_filepath = '/tmp/debug-webhook-observatorio-do-turismo.log';
$arquivo = fopen($log_filepath, 'w');
fwrite($arquivo, file_get_contents('php://input'));
fclose($arquivo);

if ($payload = file_get_contents('php://input')) {
    try {
        $payload = json_decode($payload);
    } catch (Exception $ex) {
        echo $ex;
        exit(0);
    }

    $refBranch = 'refs/heads/master'; // branch we want here
    $branch = 'master';
    if (isset($_GET["env"]) && $_GET["env"] === "testing") {
        $refBranch = 'refs/heads/develop';
        $branch = 'develop';
    }


    // put the branch you want here
    if ($payload->ref != $refBranch) {
        echo 'cabeçalho errado';
        exit(0);
    }
    
    //put the branch you want here, as well as the directory your site is in
    $op = array();
    exec("cd /var/www/observatorio-do-turismo && git fetch origin && git reset --hard origin/{$branch} && git merge origin/{$branch}", $op);

    $arquivo = fopen($log_filepath, 'a+');
    fwrite($arquivo, "\n-------\n");
    foreach ($op as $value) {
        fwrite($arquivo, $value);
    }
    fclose($arquivo);

} else {
    echo 'requisição falhou';
}
