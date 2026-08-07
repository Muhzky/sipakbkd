<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector;

class NeonPostgresConnector extends PostgresConnector
{
    protected function getDsn(array $config): string
    {
        $dsn = parent::getDsn($config);

        $host = $config['host'] ?? '';
        $endpointId = $config['neon_endpoint_id'] ?? '';

        if (empty($endpointId) && preg_match('/^(ep-[a-z0-9-]+)-pooler/', $host, $m)) {
            $endpointId = $m[1];
        }

        if (! empty($endpointId)) {
            $dsn .= ";options=-c endpoint={$endpointId}";
        }

        return $dsn;
    }
}
