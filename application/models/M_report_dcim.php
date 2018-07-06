<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_report_dcim extends CI_Model {


    function getall()
    {
        $sql = "SELECT x.Name, x.Administrator, a.Location, a.Model, a.CabinetHeight, count(b.Cabinet) as jumlah_device, count(c.DeviceID) as jumlah_host, COUNT(d.HostID) as jumlah_aplikasi from dcim.fac_Cabinet a 
        left join dcim.fac_DataCenter x on x.DataCenterID = a.DataCenterID
        left join dcim.fac_Device b on a.CabinetID = b.Cabinet 
        left join dcim.fac_Host c on b.DeviceID = c.DeviceID 
        left join dcim.fac_Application d on c.HostID = d.HostID 
        GROUP BY a.DataCenterID";
       $result = $this->db->query($sql);
       return $result->result();
    }

    function getNotBy_SerialLocation($dc)
    {
        $sql = "SELECT a.Location, a.Model, a.CabinetHeight, count(b.Cabinet) as jumlah_device, count(c.DeviceID) as jumlah_host, COUNT(d.HostID) as jumlah_aplikasi from dcim.fac_Cabinet a left join dcim.fac_Device b on a.CabinetID = b.Cabinet left join dcim.fac_Host c on b.DeviceID = c.DeviceID left join dcim.fac_Application d on c.HostID = d.HostID where a.DataCenterID = '$dc' GROUP BY a.CabinetID";
       $result = $this->db->query($sql);
       return $result->result();
    }

    function getByLocation($location, $dc)
    {
        $sql = "SELECT b.Label, b.SerialNo, b.PrimaryIP, count(c.DeviceID) as jumlah_host, COUNT(d.HostID) as jumlah_aplikasi, b.WarrantyCo, b.WarrantyExpire from dcim.fac_Cabinet a 
                left join dcim.fac_Device b on a.CabinetID = b.Cabinet 
                left join dcim.fac_Host c on b.DeviceID = c.DeviceID 
                left join dcim.fac_Application d on c.HostID = d.HostID 
                where a.DataCenterID = '$dc' and a.Location = '$location'
                GROUP BY c.HostID";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getByNoSerial($no_serial)
    {
        $sql = "SELECT c.ServerName, c.IPServer, c.OS, c.TotalHardisk, COUNT(d.HostID) as jumlah_aplikasi, d.ApplicationName, d.ApplicationType from dcim.fac_Cabinet a 
                left join dcim.fac_Device b on a.CabinetID = b.Cabinet
                left join dcim.fac_Host c on b.DeviceID = c.DeviceID
                left join dcim.fac_Application d on c.HostID = d.HostID
                where b.SerialNo = '$no_serial'
                GROUP BY d.ApplicationID";
        $result = $this->db->query($sql);
        return $result->result();
    }

    function getDataDevice($no_serial)
    {
        $sql = "SELECT * from dcim.fac_Device where dcim.fac_Device.SerialNo = '$no_serial'";
        $result = $this->db->query($sql);
        return $result->result();
    }
    
}