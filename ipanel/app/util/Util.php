<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Util
 *
 * @author Cledson
 */
class Util {

    //put your code here



    public function addZeros($String, $qtde) {
        $Size = ($qtde - strlen($String));
        for ($i = 0; $i < $Size; $i++) {
            $Zeros.= 0;
        }
        $String = $Zeros . $String;
        return $String;
    }

    public function removeSeparadores($var) {
        $var = str_replace(".", "", $var);
        $var = str_replace(",", "", $var);
        $var = str_replace("(", "", $var);
        $var = str_replace(")", "", $var);
        $var = str_replace(" ", "", $var);
        $barras = str_replace("/", "", $var);
        return str_replace("-", "", $barras);
    }

    public function criptografaId($id) {
        $id = $this->addZeros($id, 6);
        $idrev = strrev($id);
        $string = $this->geraStringAleatoria(6);
        $retorno = "";
        for ($i = 0; $i < 6; $i++) {
            $retorno.= substr($string, $i, 1);
            $retorno.= substr($idrev, $i, 1);
        }
        return $retorno;
    }

    public function descriptografaId($var) {
        for ($i = 0; $i < strlen($var); $i++) {
            $char = substr($var, $i, 1);
            switch ($char) {
                case "1": $retorno.= $char;
                    break;
                case "2": $retorno.= $char;
                    break;
                case "3": $retorno.= $char;
                    break;
                case "4": $retorno.= $char;
                    break;
                case "5": $retorno.= $char;
                    break;
                case "6": $retorno.= $char;
                    break;
                case "7": $retorno.= $char;
                    break;
                case "8": $retorno.= $char;
                    break;
                case "9": $retorno.= $char;
                    break;
                case "0": $retorno.= $char;
                    break;
            }
        }
        $id = (int) strrev($retorno);
        return $id;
    }

    public function geraStringAleatoria($qtdeChars) {
        $consoantes = "BCDFGHJKLMNPQRSTVXZ";
        $vogais = "AEIOU";

        $a = strlen($consoantes) - 2;
        $b = strlen($vogais) - 2;

        $rand0 = rand(0, $a);
        $rand1 = rand(0, $b);
        $rand2 = rand(0, $a);
        $rand3 = rand(0, $a);
        $rand4 = rand(0, $b);
        $rand5 = rand(0, $b);
        $rand6 = rand(0, $b);
        $rand7 = rand(0, $a);

        $str0 = substr($consoantes, $rand, 2);
        $str1 = substr($vogais, $rand1, 2);
        $str2 = substr($consoantes, $rand2, 2);
        $str3 = substr($consoantes, $rand3, 2);
        $str4 = substr($vofgais, $rand4, 2);
        $str5 = substr($consoantes, $rand5, 2);
        $str6 = substr($vogais, $rand6, 2);
        $str7 = substr($consoantes, $rand7, 2);
        $string.= $str0 . $str1 . $str2 . $str3 . $str4 . $str5 . $str6 . $str7;
        return substr($string, 0, $qtdeChars);
    }

    public function getDDD($telefone) {
        return substr($telefone, 0, 2);
    }

    public function getFone($telefone) {
        return substr($telefone, 2, 8);
    }


    /**
     * Retorna a extensao do arquivo atual upload<br>
     *
     * @param <String> $file        Nome original do arquivo
     * @return <String>
     */
    function getFileExtension($file){
        return strtolower(strrchr($file, "."));;
    }
    

    /**
     * Retorna uma string no padrao web para nomes de arquivos<br>
     * Sem acentos, espaços ou caracteres especiais
     *
     * @param <String> $nomeOriginal        Nome original do arquivo
     * @return <String>
     */
    function nameForWeb($nomeOriginal){

        $string = str_replace("á", "a", $nomeOriginal);
        $string = str_replace("à", "a", $string);
        $string = str_replace("ä", "a", $string);
        $string = str_replace("ã", "a", $string);
        $string = str_replace("â", "a", $string);
        $string = str_replace("é", "e", $string);
        $string = str_replace("ë", "e", $string);
        $string = str_replace("è", "e", $string);
        $string = str_replace("ê", "e", $string);
        $string = str_replace("í", "i", $string);
        $string = str_replace("ì", "i", $string);
        $string = str_replace("ï", "i", $string);
        $string = str_replace("ó", "o", $string);
        $string = str_replace("ò", "o", $string);
        $string = str_replace("ô", "o", $string);
        $string = str_replace("ö", "o", $string);
        $string = str_replace("ú", "u", $string);
        $string = str_replace("ù", "u", $string);
        $string = str_replace("û", "u", $string);
        $string = str_replace("ü", "u", $string);
        $string = str_replace("Â", "a", $string);
        $string = str_replace("Á", "a", $string);
        $string = str_replace("À", "a", $string);
        $string = str_replace("Ã", "a", $string);
        $string = str_replace("Ä", "a", $string);
        $string = str_replace("Ê", "e", $string);
        $string = str_replace("É", "e", $string);
        $string = str_replace("È", "e", $string);
        $string = str_replace("Ë", "e", $string);
        $string = str_replace("Î", "i", $string);
        $string = str_replace("Í", "i", $string);
        $string = str_replace("Ì", "i", $string);
        $string = str_replace("Ï", "i", $string);
        $string = str_replace("Ô", "o", $string);
        $string = str_replace("Ó", "o", $string);
        $string = str_replace("Ò", "o", $string);
        $string = str_replace("Õ", "o", $string);
        $string = str_replace("Ö", "o", $string);
        $string = str_replace("Û", "u", $string);
        $string = str_replace("Ú", "u", $string);
        $string = str_replace("Ù", "u", $string);
        $string = str_replace("/", "", $string);
        $string = str_replace("ç", "c", $string);
        $string = str_replace("Ç", "c", $string);
        $string = str_replace(" ", "", $string);
        $string = str_replace("%", "_", $string);
        return $string;
    }

    public function removeHtml($html) {
        $html = str_replace('SIZE="10"', "", $html);
        $html = str_replace('SIZE="12"', "", $html);
        $html = str_replace('COLOR="#000000"', "", $html);

        return $html;
    }

    /**
     * Formata um número Double em Reais
     *
     * @param <Double> $numero
     * @return Real  Valor monetário tabulado
     */
    function formatReal($numero)
    {
        return number_format($numero, 2, ',', '.');
    }

    /**
     * Formata um número Formatado em Double
     *
     * @param <String> $numero
     * @return Double  Valor monetário double
     */
    function formatFloat($numero)
    {
        $numero = str_replace(".", "", $numero);
        return str_replace(",", ".", $numero);
    }
    

    function formatarCpfCnpj($campo, $formatado = true){
        //retira formato
      //  $codigoLimpo = preg_match("[' '-./ t]",$campo);
        $codigoLimpo = $this->removeSeparadores($campo);

        // pega o tamanho da string menos os digitos verificadores
        $tamanho = (strlen($codigoLimpo) -2);

        //verifica se o tamanho do código informado é válido
        if ($tamanho != 9 && $tamanho != 12){
            return false;
        }

        if ($formatado){
            // seleciona a máscara para cpf ou cnpj
            $mascara = ($tamanho == 9) ? '###.###.###-##' : '##.###.###/####-##';

            $indice = -1;
            for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $codigoLimpo[++$indice];
            }
            //retorna o campo formatado
            $retorno = $mascara;

        }else{
            //se não quer formatado, retorna o campo limpo
            $retorno = $codigoLimpo;
        }

        return $retorno;

    }

    function formatarTelefone($telefone) {
      //  $telefone = preg_match("[^0-9]",$telefone);
        $codigo  = substr($telefone, 0, 2);
        $prefixo = substr($telefone, 2, 4);
        $numero  = substr($telefone, 6, 4);
        $resultado = "(".$codigo.") ".$prefixo."-".$numero;
        return($resultado);
    }
    
    function formatarCep($cep) {
      //  $cep = preg_match("[^0-9]",$cep);
        $retorno = substr($cep, 0, 5)."-".substr($cep, 5, 3);
        return($retorno);
    }

    
    function capitalize($string){
        $upper = "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝ";
        $lower = "àáâãäåæçèéêëìíîïðñòóôõöøùúûüý";
        $string = strtolower(strtr($string, $upper, $lower));
        return ucwords($string);
    }


     /**
     * Retorna a descrição do turno
     *
     * @param <String> $turno
     * @return String  Descrição do turno
     */
    function getTurno($turno)
    {
        switch($turno){
            case "M" : return "Manhã"; break;
            case "T" : return "Tarde"; break;
            case "N" : return "Noite"; break;
            case "I" : return "Integral"; break;
        }
    }

    public function getDataSqlFromPagSeguro($string) {
        list($data, $hora) = explode(" ", $string);
        list($d, $m, $y) = explode("/", $data);
        return $y . "-" . $m . "-" . $d;
    }

    public function getHoraFromPagSeguro($string) {
        list($data, $hora) = explode(" ", $string);
        return $hora;
    }


    public function verificaCategoria($ids, $idCategoria){
        $array = explode(",", $ids);
        $status = false;
        for($i=0; $i < count($array); $i++){
            if($array[$i] == $idCategoria){
                $status = true;
            }
        }
        return $status;
    }


    /**
     * Retorna a descrição de acordo com o status informado
     *
     * @param <String> $status
     * @return String  Descrição do status
     */
    function getStatusGeral($status)
    {
        switch($status){
            case "A": return "Ativo";  break;
            case "I": return "Inativo"; break;
        }
    }

    /**
     * Retorna a tamanho do arquivo informado
     *
     * @param <String> $file
     * @return String  Descrição do status
     */
    public function getFileSize($file){
         if(file_exists($file)){
            $size = filesize($file);
            if ($size < 1024) {
                return strval($size).' bytes';
            }
            if ($size < pow(1024,2)){
                return inttostr( $size/1024, 1).' KB';
            }
            if ($size < pow(1024,3)){
                return inttostr($size/pow(1024,2),1).' MB';
            }
            if ($size<pow(1024,4)){
                return inttostr( $size/pow(1024,3),1).' GB';
            }
         }
    }
    
    /**
     * Retorna a descrição do tipo de ensino
     *
     * @param <String> $tipo
     * @return String  Descrição do status
     */
    function getNivelEnsino($tipo)
    {
        switch($tipo){
            case "EM" : return "Ensino Médio"; break;
            case "ES" : return "Educação Superior"; break;
            case "PS" : return "Educação Profissional de Nível Superior"; break;
            case "PM" : return "Educação Profissional de Nível Médio"; break;
        }
    }

    /**
     * Retorna a descrição do tipo de ensino
     *
     * @param <String> $tipo
     * @return String  Descrição do status
     */
    function getEnsino($tipo)
    {
        switch($tipo){
            case "A" : return "Municipal"; break;
            case "B" : return "Estadual"; break;
            case "C" : return "Federal"; break;
            case "D" : return "Particular"; break;
            case "E" : return "Filantrópica"; break;
            case "F" : return "Comunitária"; break;
            case "G" : return "Confessional"; break;
        }
    }


    /**
     * Retorna a descrição do nivel de ensino
     *
     * @param <String> $tipo
     * @return String  Descrição do status
     */
    function getNivel($tipo)
    {
        switch($tipo){
            case "A" : return "Avançado"; break;
            case "B" : return "Básico"; break;
            case "M" : return "Médio"; break;
        }
    }

    /**
     * Retorna a descrição do status da vaga
     *
     * @param <String> $status
     * @return String  Descrição do status
     */
    function getStatusVaga($status)
    {
        switch($status){
            case "A" : return "Aberta"; break;
            case "P" : return "Preenchida"; break;
            case "C" : return "Cancelada"; break;
        }
    }

    /**
     * Retorna a descrição do estado de acordo com a sigla
     *
     * @param <String> $sigla
     * @return String  Nome do estado
     */
    function getUf($sigla)
    {
        switch($sigla){
            case "AL" : return "Alagoas"; break;
            case "AM" : return "Amazonas"; break;
            case "AP" : return "Amapá"; break;
            case "BA" : return "Bahia"; break;
            case "CE" : return "Ceará"; break;
            case "DF" : return "Distrito Federal"; break;
            case "ES" : return "Espírito Santo"; break;
            case "GO" : return "Goiás"; break;
            case "MA" : return "Maranhão"; break;
            case "MG" : return "Minas Gerais"; break;
            case "MS" : return "Mato Grosso do Sul"; break;
            case "MT" : return "Mato Grosso"; break;
            case "PA" : return "Pará"; break;
            case "PB" : return "Paraíba"; break;
            case "PE" : return "Pernambuco"; break;
            case "PI" : return "Piauí"; break;
            case "PR" : return "Paraná"; break;
            case "RJ" : return "Rio de Janeiro"; break;
            case "RN" : return "Rio Grande do Norte"; break;
            case "RO" : return "Rondônia"; break;
            case "RR" : return "Roraima"; break;
            case "RS" : return "Rio Grande do Sul"; break;
            case "SC" : return "Santa Catarina"; break;
            case "SE" : return "Sergipe"; break;
            case "SP" : return "São Paulo"; break;
            case "TO" : return "Tocantins"; break;
        }
    }


    /**
     * Retorna o valor por extenso a partir de um valor numérico
     * @param <Number> $valor
     *
     * @return String
     */
    function valorPorExtenso($valor=0) {
        $singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
        $plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões","quatrilhões");
        $c = array("", "cem", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
        $d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa");
        $d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezesete", "dezoito", "dezenove");
        $u = array("", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove");

        $z=0;
        $valor = number_format($valor, 2, ".", ".");
        $inteiro = explode(".", $valor);
        for($i=0;$i<count($inteiro);$i++)
                for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
                        $inteiro[$i] = "0".$inteiro[$i];

        // $fim identifica onde que deve se dar junção de centenas por "e" ou por "," ;)
        $fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
        for ($i=0;$i<count($inteiro);$i++) {
                $valor = $inteiro[$i];
                $rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
                $rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
                $ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

                $r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd && $ru) ? " e " : "").$ru;
                $t = count($inteiro)-1-$i;
                $r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
                if ($valor == "000")$z++; elseif ($z > 0) $z--;
                if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
                if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) && ($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
        }
        return($rt ? $rt : "zero");
    }

    
}

?>
