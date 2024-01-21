<?php 


$kelas_id = 1;
$sql = "SELECT data_santri.*
        FROM data_santri
        JOIN paket_tagihan_data ON data_santri.id = paket_tagihan_data.santri_id
        WHERE data_santri.kelas_id = " . $kelas_id . "
        AND paket_tagihan_data.status_tagihan = 'lunas';
        ";
