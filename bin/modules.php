<?php

function fetchGitHubRepos(string $username, string $prefix, string $token): array
{
    $repos = [];
    $page = 1;
    $rateLimitReset = 0;

    do {
        if (time() < $rateLimitReset) {
            sleep($rateLimitReset - time());
        }

        $url = "https://api.github.com/users/{$username}/repos?per_page=100&page={$page}";
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: token {$token}"]);

        $response = curl_exec($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) === 403) {
            $headers = curl_getinfo($ch);
            $rateLimitReset = $headers['retry_after'] ?? 60;
            sleep($rateLimitReset);
            continue;
        }

        curl_close($ch);

        $data = json_decode($response, true);

        foreach ($data as $repo) {
            if (strpos($repo['name'], $prefix) !== false) {
                $repos[] = $repo['name'];
            }
        }

        $page++;
    } while (count($data) === 100);

    return $repos;
}

// Tīmata (Start)
$token = '';
$username = 'sunnysideup';
$prefixes = ['ecommerce', 'payment'];
$matchingRepos = [];

foreach ($prefixes as $prefix) {
    $matchingRepos = array_merge($matchingRepos, fetchGitHubRepos($username, $prefix, $token));
}

print_r($matchingRepos);
