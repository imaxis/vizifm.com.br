<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Encoding
 *
 * @author Cledson
 */
class Encoding {
    //put your code here
    
    public function converteUtfToIso($string){
        $string = str_replace("&apos;", "'", $string);
        $string = str_replace("&lt;", "<", $string);
        $string = str_replace("&gt;", ">", $string);
        $string = str_replace("&yen;", "¥", $string);
        $string = str_replace("&brvbar;", "|", $string);
        $string = str_replace("&ndash;", "-", $string);
        $string = str_replace("&copy;", "©", $string);
        $string = str_replace("&quot;", '"', $string);
        $string = str_replace("&ordf;", "ª", $string);
        //$string = str_replace("«", "&laquo;", $string);
        $string = str_replace("&reg;", "®", $string);
        $string = str_replace("&deg;", "°", $string);
        $string = str_replace("&sup1;", "¹", $string);
        $string = str_replace("&sup2;", "²", $string);
        $string = str_replace("&sup3;", "³", $string);
        $string = str_replace("&acute;", "´", $string);
        $string = str_replace("&ordm;", "º", $string);
        //$string = str_replace("»", "&raquo;", $string);
        $string = str_replace("&Agrave;", "À", $string);
        $string = str_replace("&Aacute;", "Á", $string);
        $string = str_replace("&Acirc;", "Â", $string);
        $string = str_replace("&Atilde;", "Ã", $string);
        $string = str_replace("&Auml;", "Ä", $string);
        $string = str_replace("&Ccedil;", "Ç", $string);
        $string = str_replace("&Egrave;", "È", $string);
        $string = str_replace("&Eacute;", "É", $string);
        $string = str_replace("&Ecirc;", "Ê", $string);
        $string = str_replace("&Euml;", "Ë", $string);
        $string = str_replace("&Igrave;", "Ì", $string);
        $string = str_replace("&Iacute;", "Í", $string);
        $string = str_replace("&Icirc;", "Î", $string);
        $string = str_replace("&Iuml;", "Ï", $string);
        $string = str_replace("&Ntilde;", "Ñ", $string);
        $string = str_replace("&Ograve;", "Ò", $string);
        $string = str_replace("&Oacute;", "Ó", $string);
        $string = str_replace("&Ocirc;", "Ô", $string);
        $string = str_replace("&Ouml;", "Ö", $string);
        $string = str_replace("&Ugrave;", "Ù", $string);
        $string = str_replace("&Uacute;", "Ú", $string);
        $string = str_replace("&Ucirc;", "Û", $string);
        $string = str_replace("&Uuml;", "Ü", $string);
        $string = str_replace("&agrave;", "à", $string);
        $string = str_replace("&aacute;", "á", $string);
        $string = str_replace("&acirc;", "â", $string);
        $string = str_replace("&atilde;", "ã", $string);
        $string = str_replace("&auml;", "ä", $string);
        $string = str_replace("&ccedil;", "ç", $string);
        $string = str_replace("&egrave;", "è", $string);
        $string = str_replace("&eacute;", "é", $string);
        $string = str_replace("&ecirc;", "ê", $string);
        $string = str_replace("&euml;", "ë", $string);
        $string = str_replace("&igrave;", "ì", $string);
        $string = str_replace("&iacute;", "í", $string);
        $string = str_replace("&icirc;", "î", $string);
        $string = str_replace("&iuml;", "ï", $string);
        $string = str_replace("&ntilde;", "ñ", $string);
        $string = str_replace("&ograve;", "ò", $string);
        $string = str_replace("&oacute;", "ó", $string);
        $string = str_replace("&ocirc;", "ô", $string);
        $string = str_replace("&ouml;", "ö", $string);
        $string = str_replace("&ugrave;", "ù", $string);
        $string = str_replace("&uacute;", "ú", $string);
        $string = str_replace("&ucirc;", "û", $string);
        $string = str_replace("&uuml;", "ü", $string);

        //$string = str_replace(">", "&gt;", $string);
        $string = str_replace("&yen;", "¥", $string);
        $string = str_replace("&brvbar;", "|", $string);
        //$string = str_replace("?", "&ndash;", $string);
        $string = str_replace("&copy;", "©", $string);
        //$string = str_replace("·", "&middot;", $string);
        $string = str_replace("&ordf;", "ª", $string);
        //$string = str_replace("«", "&laquo;", $string);
        $string = str_replace("&reg;", "®", $string);
        $string = str_replace("&deg;", "°", $string);
        $string = str_replace("&sup1;", "¹", $string);
        $string = str_replace("&sup2;", "²", $string);
        $string = str_replace("&sup3;", "³", $string);
        $string = str_replace("&acute;", "´", $string);
        $string = str_replace("&ordm;", "º", $string);
        //$string = str_replace("»", "&raquo;", $string);
        $string = str_replace("&Agrave;", "À", $string);
        $string = str_replace("&Aacute;", "Á", $string);
        $string = str_replace("&Acirc;", "Â", $string);
        $string = str_replace("&Atilde;", "Ã", $string);
        $string = str_replace("&Auml;", "Ä", $string);
        $string = str_replace("&Ccedil;", "Ç", $string);
        $string = str_replace("&Egrave;", "È", $string);
        $string = str_replace("&Eacute;", "É", $string);
        $string = str_replace("&Ecirc;", "Ê", $string);
        $string = str_replace("&Euml;", "Ë", $string);
        $string = str_replace("&Igrave;", "Ì", $string);
        $string = str_replace("&Iacute;", "Í", $string);
        $string = str_replace("&Icirc;", "Î", $string);
        $string = str_replace("&Iuml;", "Ï", $string);
        $string = str_replace("&Ntilde;", "Ñ", $string);
        $string = str_replace("&Ograve;", "Ò", $string);
        $string = str_replace("&Oacute;", "Ó", $string);
        $string = str_replace("&Ocirc;", "Ô", $string);
        $string = str_replace("&Ouml;", "Ö", $string);
        $string = str_replace("&Ugrave;", "Ù", $string);
        $string = str_replace("&Uacute;", "Ú", $string);
        $string = str_replace("&Ucirc;", "Û", $string);
        $string = str_replace("&Uuml;", "Ü", $string);
        $string = str_replace("&agrave;", "à", $string);
        $string = str_replace("&aacute;", "á", $string);
        $string = str_replace("&acirc;", "â", $string);
        $string = str_replace("&atilde;", "ã", $string);
        $string = str_replace("&auml;", "ä", $string);
        $string = str_replace("&ccedil;", "ç", $string);
        $string = str_replace("&egrave;", "è", $string);
        $string = str_replace("&eacute;", "é", $string);
        $string = str_replace("&ecirc;", "ê", $string);
        $string = str_replace("&euml;", "ë", $string);
        $string = str_replace("&igrave;", "ì", $string);
        $string = str_replace("&iacute;", "í", $string);
        $string = str_replace("&icirc;", "î", $string);
        $string = str_replace("&iuml;", "ï", $string);                   
        $string = str_replace("&ntilde;", "ñ", $string);
        $string = str_replace("&ograve;", "ò", $string);
        $string = str_replace("&oacute;", "ó", $string);
        $string = str_replace("&ocirc;", "ô", $string);
        $string = str_replace("&ouml;", "ö", $string);
        $string = str_replace("&ugrave;", "ù", $string);
        $string = str_replace("&uacute;", "ú", $string);
        $string = str_replace("&ucirc;", "û", $string);
        $string = str_replace("&uuml;", "ü", $string);
        return $string;
    }





}
?>
