<?php
class UtilStringUtf8
{

    /**
     * Identifica se já não está no formato UTF 8 Enconde, 
     * se não estiver, então converte para UTF 8 Encode
     *
     * @param string $conteudo
     * @return string
     */
    static public function converter_para_utf8(string $conteudo): string
    {
        if (mb_detect_encoding($conteudo, 'utf-8', true) === false) {
            $conteudo = mb_convert_encoding($conteudo, 'utf-8', 'iso-8859-1');
        }
        return $conteudo;
    }
}
?>