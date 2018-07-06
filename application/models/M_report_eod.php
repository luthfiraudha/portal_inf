<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_report_eod extends CI_Model {

    private $table = 'data_record';
    private $key = 'id';


  public function getTrxLast()
  {
      $sql = "SELECT a.tanggal tanggal, a.jenis jenis, (case when b.jumlah > 0 then b.jumlah else 0 end) jumlah from(
SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.job_nama jenis
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
 ) AS c, (SELECT DISTINCT job_nama from data_daily) d
) a

left join data_daily b on b.tanggal=a.tanggal  and a.jenis=b.job_nama

WHERE a.tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY ) AND CURDATE()
ORDER BY a.tanggal ASC";
      $result = $this->db->query($sql);
      return $result->result();
  }


public function getTrx_Tanggal($start_date, $end_date)
  {
    $sql = "SELECT a.tanggal tanggal, a.jenis jenis, (case when b.jumlah > 0 then b.jumlah else 0 end) jumlah from(
    SELECT 
      CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.job_nama jenis
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
     ) AS c, (SELECT DISTINCT job_nama from data_daily) d
    ) a

      left join data_daily b on b.tanggal=a.tanggal  and a.jenis=b.job_nama

    WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
    ORDER BY a.tanggal ASC";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getBe4_Last($job = "")
  {
    $sql = "SELECT a.tanggal tanggal, (case when b.jam_mulai > 0 then b.jam_mulai else '00:00' end) jam_mulai from(
SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal
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
 ) AS c
) a

left join data_daily b on b.tanggal=a.tanggal and b.job_nama='$job'

WHERE a.tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY ) AND CURDATE()
ORDER BY a.tanggal ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getAfter_Last($job = "")
  {
    $sql = "SELECT a.tanggal tanggal, (case when b.jam_selesai > 0 then b.jam_selesai else '00:00' end) jam_selesai from(
SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal
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
 ) AS c
) a

left join data_daily b on b.tanggal=a.tanggal and b.job_nama='$job'

WHERE a.tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY ) AND CURDATE()
ORDER BY a.tanggal ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getBe4_Tanggal($start_date, $end_date, $job = "")
  {
    $sql = "SELECT a.tanggal tanggal, (case when b.jam_mulai > 0 then b.jam_mulai else '00:00' end) jam from(
SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal
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
 ) AS c
) a

left join data_daily b on b.tanggal=a.tanggal and b.job_nama='$job'

WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
ORDER BY a.tanggal ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getAfter_Tanggal($start_date, $end_date, $job = "")
  {
    $sql = "SELECT a.tanggal tanggal, (case when b.jam_mulai > 0 then b.jam_selesai else '00:00' end) jam from(
SELECT 
  CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal
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
 ) AS c
) a

left join data_daily b on b.tanggal=a.tanggal and b.job_nama='$job'

WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
ORDER BY a.tanggal ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getElapsed_Last()
  {
    $sql = "SELECT a.tanggal tanggal, a.jenis job_nama, (case when b.jam_selisih > '00:00' then b.jam_selisih else '00:00' end) jam_selisih from(
    SELECT 
      CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.job_nama jenis
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
     ) AS c, (SELECT DISTINCT job_nama from data_daily where kategori_id = 46) d
    ) a

    left join data_daily b on b.tanggal=a.tanggal
    WHERE a.tanggal BETWEEN DATE_SUB(CURDATE(), INTERVAL 15 DAY ) AND CURDATE()
   
    ORDER BY a.tanggal, b.job_nama ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getElapsed_Tanggal($start_date="", $end_date="")
  {
    $sql = "SELECT a.tanggal tanggal, a.jenis job_nama, (case when b.jam_selisih > '00:00' then b.jam_selisih else '00:00' end) jam_selisih from(
    SELECT 
      CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal, d.job_nama jenis
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
     ) AS c, (SELECT DISTINCT job_nama from data_daily where kategori_id=46) d
    ) a

      left join data_daily b on b.tanggal=a.tanggal and kategori_id=46

     WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
    ORDER BY a.tanggal, b.job_nama ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }


  public function getElapsed_Tanggal_Job($start_date="", $end_date="", $job_nama = "")
  {
    $sql = "SELECT a.tanggal tanggal, b.job_nama nama_job, (case when b.jam_selisih > '00:00' then b.jam_selisih else '00:00' end) jam_selisih from(
    SELECT 
      CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal
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
     ) AS c
    ) a

      left join data_daily b on b.tanggal=a.tanggal and b.job_nama = '$job_nama'

     WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
    ORDER BY a.tanggal, b.job_nama ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getElapsed_Tanggal_Job_0($start_date="", $end_date="", $job_nama = "")
  {
    $sql = "SELECT a.tanggal tanggal, b.job_nama nama_job, (case when b.jam_selisih > '00:00' then b.jam_selisih else '00:00' end) jam_selisih from(
    SELECT 
      CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS tanggal
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
     ) AS c
    ) a

      left join data_daily b on b.tanggal=a.tanggal and b.job_nama = '$job_nama'

     WHERE a.tanggal BETWEEN '$start_date' AND '$end_date'
    ORDER BY a.tanggal, b.job_nama ASC";
    $result = $this->db->query($sql);
    return $result->result();
  }

  public function getJob()
  {
      $sql = "SELECT distinct job_nama FROM data_daily";
      $result = $this->db->query($sql);
      return $result->result();
  }

  public function getJobTrx()
  {
      $sql = "SELECT distinct job_nama FROM data_daily where kategori_id = '46'";
      $result = $this->db->query($sql);
      return $result->result();
  }

}
