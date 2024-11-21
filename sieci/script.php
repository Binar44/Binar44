<?php

$adres = $_POST['adres'];
$maska = $_POST['maska'];

$ips = explode(".", $adres);
$ip1 = $ips[0];
$ip2 = $ips[1];
$ip3 = $ips[2];
$ip4 = $ips[3];

if($ip1 >= 1 && $ip1 < 128){
    $klasa = 'A';
} elseif($ip1 >= 128 && $ip1 < 192){
    $klasa = 'B';
} elseif($ip1 >= 192 && $ip1 < 224){
    $klasa = 'C';
} elseif($ip1 >= 224 && $ip1 < 240){
    $klasa = 'D';
} elseif($ip1 >= 240){
    $klasa = 'E';
} else {
    $klasa = '-';
}

$adresy = 4294967296 / (pow(2, $maska));
$hosty = $adresy - 2;

$podsieci = 4294967296 / $adresy;

echo '<br />Podany Adres: '.$adres.'/'.$maska;
echo '<br />Klasa Adresu: '.$klasa;
echo '<br />';
echo '<br />Ilość Adresów: '.$adresy;
echo '<br />Ilość Hostów: '.$hosty;
echo '<br />Ilość Podsieci: '.$podsieci;
echo '<br />';

if($maska >= 24){
    for($i = 0; $i < 256; $i += 0){
        if($i < $ip4){
            $ip4s = $i;
            $i += $adresy;
        } else {
            break;
        }
    }
    $ip4r = $ip4s + $adresy - 1;
    echo '<br />Adres Podsieci: '.$ip1.'.'.$ip2.'.'.$ip3.'.'.$ip4s;
    echo '<br />Adres Rozgłoszeniowy: '.$ip1.'.'.$ip2.'.'.$ip3.'.'.$ip4r;
} elseif($maska >= 16 && $maska < 24){
    $ip3s = 0;
    for($i = 0; $i < 256; $i += 0){
        if($i < $ip3){
            $ip3s = $i;
            $i += $adresy / 256;
        } else {
            break;
        }
    }
    $ip3r = $ip3s + ($adresy / 256) - 1;
    echo '<br />Adres Podsieci: '.$ip1.'.'.$ip2.'.'.$ip3s.'.0';
    echo '<br />Adres Rozgłoszeniowy: '.$ip1.'.'.$ip2.'.'.$ip3r.'.255';
} elseif($maska >= 8 && $maska < 16){
    $ip2s = 0;
    for($i = 0; $i < 256; $i += 0){
        if($i < $ip2){
            $ip2s = $i;
            $i += $adresy / 256 / 256;
        } else {
            break;
        }
    }
    $ip2r = $ip2s + ($adresy / 256 / 256) - 1;
    echo '<br />Adres Podsieci: '.$ip1.'.'.$ip2s.'.0.0';
    echo '<br />Adres Rozgłoszeniowy: '.$ip1.'.'.$ip2r.'.255.255';
} elseif($maska < 8){
    $ip1s = 0;
    for($i = 0; $i < 256; $i += 0){
        if($i < $ip1){
            $ip1s = $i;
            $i += $adresy / 256 / 256 / 256;
        } else {
            break;
        }
    }
    $ip1r = $ip1s + ($adresy / 256 / 256 / 256) - 1;
    echo '<br />Adres Podsieci: '.$ip1s.'.0.0.0';
    echo '<br />Adres Rozgłoszeniowy: '.$ip1r.'.255.255.255';
}

?>