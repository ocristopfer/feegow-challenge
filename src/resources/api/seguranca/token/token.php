<?php

class Token
{

    function __construct($conSql)
    {
    }

    /**
     * Função exemplo que seria a validação e geração do token para o usuario
     *
     * @param [type] $login
     * @param [type] $senha
     * @return void
     */
    public static function getToken($login = '', $senha = '')
    {
        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJmZWVnb3ciLCJhdWQiOiJwdWJsaWNhcGkiLCJpYXQiOiIxNy0wOC0yMDE4IiwibGljZW5zZUlEIjoiMTA1In0.UnUQPWYchqzASfDpVUVyQY0BBW50tSQQfVilVuvFG38';
    }
}
