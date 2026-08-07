<?php

namespace App\Database\Connectors;

use Illuminate\Database\Connectors\PostgresConnector;

class NeonPostgresConnector extends PostgresConnector
{
    protected function getDsn(array $config): string
    {
        $dsn = parent::getDsn($config);

        if (! empty($config['neon_endpoint_id'])) {
            $endpointId = rawurlencode($config['neon_endpoint_id']);
            $dsn .= ";options=-c%20endpoint%3D{$endpointId}";
        }

        return $dsn;
    }
}
