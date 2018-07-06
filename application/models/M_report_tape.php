<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_report_tape extends CI_Model {

    private $table = 'data_record';
    private $key = 'id';


  public function getTapePF_bulan()
  {
      $sql = "SELECT 
 a.tanggal as tanggal, a.jenis as jenis, (case WHEN b.klasifikasi = a.jenis then b.jumlah else '0' end) jumlah
FROM (
 SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.jenis jenis
 FROM 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS a
 CROSS JOIN 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS b
 CROSS JOIN 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS c, (SELECT * FROM klasifikasi) d
) a
LEFT JOIN (SELECT data_tape.start_date, (case when tape_record.rak_after = 'Request' then 'Request' when data_tape.set_tape='New Tape' then 'Available' 
  when data_tape.set_tape='Kosong' then 'Available' 
   else 'Used' end) klasifikasi,
   COUNT(*) as jumlah FROM `data_tape` INNER join tape_record on data_tape.id_tape = tape_record.id_tape 
   where data_tape.start_date between DATE_SUB(CURDATE(), INTERVAL 15 DAY ) AND CURDATE() group by data_tape.start_date, klasifikasi) b on b.start_date=a.tanggal 

WHERE a.tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY ) AND CURDATE()
ORDER BY a.tanggal ASC";
      $result = $this->db->query($sql);
      return $result->result();
  }


public function getTapePF_tanggal($start_date, $end_date)
  {
      $sql = "SELECT 
 a.tanggal as tanggal, a.jenis as jenis, (case WHEN b.klasifikasi = a.jenis then b.jumlah else '0' end) jumlah
FROM (
 SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.jenis jenis
 FROM 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS a
 CROSS JOIN 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS b
 CROSS JOIN 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS c, (SELECT * FROM klasifikasi) d
) a
LEFT JOIN (SELECT data_tape.start_date, (case when tape_record.rak_after = 'Request' then 'Request' when data_tape.set_tape='New Tape' then 'Available' 
  when data_tape.set_tape='Kosong' then 'Available' 
   else 'Used' end) klasifikasi,
   COUNT(*) as jumlah FROM `data_tape` INNER join tape_record on data_tape.id_tape = tape_record.id_tape 
   where data_tape.start_date between '$start_date' AND '$end_date' group by data_tape.start_date, klasifikasi) b on b.start_date=a.tanggal 

WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
ORDER BY a.tanggal ASC";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getTapePF_day()
  {
      $sql = "SELECT (case when data_tape.set_tape='New Tape' then 'Available' when data_tape.set_tape='Kosong' then 'Available' when tape_record.rak_after = 'Request' then 'Request' else 'Used' end) klasifikasi, COUNT(*) as total FROM `data_tape` INNER join tape_record on data_tape.id_tape = tape_record.id_tape group by klasifikasi";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getSizeTapeOF()
  {
      $sql = "SELECT sum(size_usage) as used, sum(size_total) as total, count(id_tape) as total_id FROM data_tape_of";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getTapeOF_tanggal($start_date, $end_date)
  {
      $sql = "SELECT 
 a.tanggal as tanggal, a.nama_app as nama_app, (case WHEN b.hostname = a.nama_app then b.jumlah else '0' end) jumlah
FROM (
 SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.nama_app nama_app
 FROM 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS a
 CROSS JOIN 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS b
 CROSS JOIN 
 (
  SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 
  UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 
  UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 
  UNION ALL SELECT 9
 ) AS c, (SELECT x.nama_app from mdsc.dataaplikasi x) d
) a
LEFT JOIN (SELECT a.tanggal, a.hostname, count(a.hostname) as jumlah FROM osd_portal.content_tape_of a GROUP BY a.hostname) b on b.tanggal=a.tanggal 

WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
ORDER BY a.tanggal ASC";

    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getHostname()
  {
      $sql = "SELECT distinct a.nama_app FROM mdsc.dataaplikasi a";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getAvaibility()
  {
      $sql = "SELECT jenis from klasifikasi";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getHost_tanggal($start_date, $end_date)
  {
      $sql = "SELECT tanggal, count(*) as total from content_tape_of where tanggal between '$start_date' and '$end_date' group by tanggal";
      $result = $this->db->query($sql);
      return $result->result();
  }

}
