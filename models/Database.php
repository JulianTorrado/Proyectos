<?php
// class Database
// {
//     public static function StartUp()
//     {
//         $pdo = new PDO('mysql:host=localhost;dbname=recursossnu_proyectos;charset=utf8', 'recursossnu_proyectos', 'pe5@8@S3L4--SL9M');
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         // Desactiva ONLY_FULL_GROUP_BY para esta sesiÃ³n
//         $pdo->exec("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

//         return $pdo;
//     }
// }


class Database
{
    /* === Config de Cloud SQL === */
    private const HOST = '104.198.16.124';
    private const PORT = 3306;
    private const DB   = 'recursos_proyectos';
    private const USER = 'recursos';              // o 'recursos' si lo creaste en Cloud SQL
    private const PASS = 'AlexsanderO311.';

    // Rutas a los certificados (fuera de public_html)
    private const SSL_CA   = '/home/recursos/cloudsql-certs/server-ca.pem';
    private const SSL_CERT = '/home/recursos/cloudsql-certs/client-cert.pem';
    private const SSL_KEY  = '/home/recursos/cloudsql-certs/client-key.pem';

    public static function StartUp(): PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
            self::HOST, self::PORT, self::DB
        );

        // Opciones PDO + SSL (verificaci¨®n de CA; no verifica hostname porque usamos IP)
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_TIMEOUT            => 10,

            PDO::MYSQL_ATTR_SSL_CA       => self::SSL_CA,
            PDO::MYSQL_ATTR_SSL_CERT     => self::SSL_CERT,
            PDO::MYSQL_ATTR_SSL_KEY      => self::SSL_KEY,
        ];

        // Algunas builds de PHP requieren desactivar la verificaci¨®n del hostname
        if (defined('PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT')) {
            $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
        }

        $pdo = new PDO($dsn, self::USER, self::PASS, $options);

        // Asegurar charset y modo SQL
        $pdo->exec("SET NAMES utf8mb4");
        $pdo->exec("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

        return $pdo;
    }
}
