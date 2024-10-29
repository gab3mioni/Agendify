<?php

const DB_HOST = 'localhost';
const DB_PORT = '5432';
const DB_NAME = 'agendify';
const DB_USER = 'postgres';
const DB_PASS = 'senhapostgres';

try {
    $pdo = new PDO('pgsql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Não foi possível se conectar com o banco de dados: ' . $e->getMessage());
}
