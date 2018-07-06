<?php

function tanggal_indo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;        
    return($result);
}
 
function tanggal_indo2($date){
    $BulanIndo = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . "-" . $BulanIndo[(int)$bulan-1] . "-". $tahun;        
    return($result);
}

function tanggal_en($date){
    $BulanEN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . " " . $BulanEN[(int)$bulan-1] . " ". $tahun;        
    return($result);
}

function tanggal_en2($date){
    $BulanEN = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
 
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);
 
    $result = $tgl . "-" . $BulanEN[(int)$bulan-1] . "-". $tahun;        
    return($result);
}

function bulan_en($bulan){
    $BulanEN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
 
    $bulan = $bulan;    
 
    $result = $BulanEN[(int)$bulan-1];        
    return($result);
}

function format_rupiah($angka)
{
    $jadi = "Rp " . number_format((double)$angka,2,',','.');
    return $jadi;
}

function format_rupiah2($angka)
{
    $jadi = "Rp " . number_format((double)$angka,0,',','.'). ",-";
    return $jadi;
}

function format_harga($angka)
{
    $jadi = number_format((double)$angka,0,',','.');
    return $jadi;
}

function jml_char($char){
    $jadi = strlen(format_harga($char));
    return $jadi;
}

function align_right($max,$nilai)
{
    $length = strlen($nilai);
    $sisa = $max - $length;

    $hasil="";
    for($i=0;$i<$sisa;$i++){
        $hasil.=" ";
    }
    $hasil.=$nilai;
    return $hasil;
}

function Terbilang($satuan){
    $huruf = array("","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas");

    if($satuan < 12)
        return " " . $huruf[$satuan];
    else if($satuan < 20)
        return Terbilang($satuan - 10) . " Belas";
    else if($satuan < 100)
        return Terbilang($satuan / 10) . " Puluh" . Terbilang($satuan % 10);
    else if($satuan < 200)
        return " Seratus" . Terbilang($satuan - 100);
    else if($satuan < 1000)
        return Terbilang($satuan / 100) . " Ratus" . Terbilang($satuan % 100);
    else if($satuan < 2000)
        return " Seribu" . Terbilang($satuan - 1000);
    else if($satuan < 1000000)
        return Terbilang($satuan / 1000) . " Ribu" . Terbilang($satuan % 1000);
    else if($satuan < 1000000000)
        return Terbilang($satuan / 100000000) . " Juta" . Terbilang($satuan % 1000000);
    else if($satuan >= 1000000000)
        echo "Hasil terbilang tidak dapat diproses karena nilai terlalu besar !";
} 

function is_direct()
{
    return (empty($_SERVER['HTTP_REFERER']))?true:false;
}

?>