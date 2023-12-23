<?php


// =======================================================================================================================
// FUNCTION TERBILANG ARABIC
// =======================================================================================================================

function terbilang_arab($number) {
    $arabic = array(
        0 => "صفر",
        1 => "واحد",
        2 => "اثنان",
        3 => "ثلاثة",
        4 => "أربعة",
        5 => "خمسة",
        6 => "ستة",
        7 => "سبعة",
        8 => "ثمانية",
        9 => "تسعة",
        10 => "عشرة",
        11 => "أحد عشر",
        12 => "اثنا عشر",
        20 => "عشرون",
        30 => "ثلاثون",
        40 => "أربعون",
        50 => "خمسون",
        60 => "ستون",
        70 => "سبعون",
        80 => "ثمانون",
        90 => "تسعون",
        100 => "مئة",
        200 => "مئتان",
        300 => "ثلاثمئة",
        400 => "أربعمئة",
        500 => "خمسمئة",
        600 => "ستمئة",
        700 => "سبعمئة",
        800 => "ثمانمئة",
        900 => "تسعمئة"
    );

    if ($number < 13) {
        return $arabic[$number];
    } elseif ($number < 20) {
        return $arabic[$number - 10] . " عشر";
    } elseif ($number < 100) {
        $tens = floor($number / 10) * 10;
        $ones = $number % 10;
        return $arabic[$tens] . ($ones > 0 ? " و" . $arabic[$ones] : "");
    } elseif ($number < 1000) {
        $hundreds = floor($number / 100) * 100;
        $tens = $number % 100;
        return $arabic[$hundreds] . ($tens > 0 ? " و" . terbilang_arab($tens) : "");
    } elseif ($number < 2000) {
        return "ألف" . ($number > 1000 ? " و" . terbilang_arab($number % 1000) : "");
    } elseif ($number < 100000) {
        $thousands = floor($number / 1000);
        $remainder = $number % 1000;
        return terbilang_arab($thousands) . " آلاف" . ($remainder > 0 ? " و" . terbilang_arab($remainder) : "");
    } else {
        return "Angka terlalu besar untuk diubah";
    }
}

// Contoh penggunaan:
$angka = 45678;
echo terbilang_arab($angka); 
// Output: أربعون وخمسمئة وستون ألف وسبعمئة وثمانية وسبعون

// =======================================================================================================================
// FUNCTION CEK IZIN TELAT
// =======================================================================================================================

function cekIzinTelat($sampai)
{
    // Cek Apakah Berupa Waktu 
    if (preg_match("/^\d{1,2}:\d{1,2}:\d{1,2}$/", $sampai) || preg_match("/^\d{1,2}:\d{1,2}$/", $sampai) == true) {

        if ($sampai < date('H:i')) {
            return "bg-red";
        }
    } else {
        if ($sampai < date('Y-m-d')) {
            return "bg-red";
        }
    }
}





// =======================================================================================================================
// FUNCTION CEK TYPE IZIN
// =======================================================================================================================

function cekTypeIzin($print_keluar, $print_pulang, $print_sekolah)
{
    if ($print_keluar == 1) {
        return "Keluar";
    } elseif ($print_pulang == 1) {
        return "Pulang";
    } elseif ($print_sekolah == 1) {
        return "Tidak Sekolah";
    }
}


// =======================================================================================================================
// FORMAT INTEGER KE MATA UANG RUPIAH
// =======================================================================================================================
function cekTanggalAtauWaktu($text)
{
    // Cek apakah teks adalah waktu dalam format HH:MM:SS
    if (preg_match("/^\d{1,2}:\d{1,2}:\d{1,2}$/", $text)) {
        return $text;
    }

    // Cek apakah teks adalah waktu dalam format HH:MM
    if (preg_match("/^\d{1,2}:\d{1,2}$/", $text)) {
        return $text;
    }

    // Cek apakah teks adalah tanggal dalam format Y-m-d H:i:s
    if (DateTime::createFromFormat('Y-m-d H:i:s', $text) !== false) {
        return ubahTanggalKeString($text);
    }

    // Cek apakah teks adalah tanggal dalam format Y-m-d
    if (DateTime::createFromFormat('Y-m-d', $text) !== false) {
        return ubahTanggalKeString($text);
    }


    return "Format tidak dikenali sebagai tanggal atau waktu.";
}
// =======================================================================================================================
// =======================================================================================================================


// =======================================================================================================================
// FORMAT INTEGER KE MATA UANG RUPIAH
// =======================================================================================================================

function formatRupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}
// =======================================================================================================================
// =======================================================================================================================


// =======================================================================================================================
// FORMAT UBAH TANGGAL MENJADI STRING
// =======================================================================================================================

function ubahTanggalKeString($tanggal)
{
    // Tentukan zona waktu ke Waktu Indonesia Barat (WIB)
    date_default_timezone_set('Asia/Jakarta');

    // Set locale ke bahasa Indonesia
    $locale = 'id_ID';
    $formatter = new IntlDateFormatter($locale, IntlDateFormatter::FULL, IntlDateFormatter::FULL, 'Asia/Jakarta', IntlDateFormatter::GREGORIAN, 'EEEE, dd MMMM yyyy');

    // Tanggal dalam format yang diberikan
    $tanggal = $tanggal; // atau $tanggal = "05-10-1999";

    // Ubah format tanggal menjadi format yang diinginkan dengan nama hari dan bulan dalam bahasa Indonesia
    $tanggal_diubah = $formatter->format(strtotime(str_replace('/', '-', $tanggal)));

    // Output hasil konversi
    return $tanggal_diubah; // Output: Kamis, 05 Oktober 1999
}
// =======================================================================================================================
// =======================================================================================================================



// =======================================================================================================================
// MEMBUAT FORMAT NOMOR 10 DIGIT
// =======================================================================================================================


function format_10_Angka($nomor)
{
    $nomor_urutan = $nomor; // Contoh nomor urutan
    $panjang_nomor = 7; // Panjang total yang diinginkan

    // Membuat format angka dengan panjang tetap
    $format_angka = str_pad($nomor_urutan, $panjang_nomor, '0', STR_PAD_LEFT);




    // Gabungkan informasi tanggal, bulan, tahun, dan nomor untuk membuat format 6 digit
    $format_7_digit = substr(date('Y'), -2) . date('m') .  date('d') . str_pad($nomor_urutan, 7, '0', STR_PAD_LEFT);

    // Output format 6 digit
    return $format_7_digit;
}
// =======================================================================================================================
// =======================================================================================================================



// =======================================================================================================================
// FORMAT TERBILANG
// =======================================================================================================================
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return  ucwords(strtolower($hasil)) . ' Rupiah.';
}
// =======================================================================================================================
// =======================================================================================================================
