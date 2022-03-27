<?php

namespace App\Services;

class TaxPolicy
{
    private $giam_tru_an_trua;
    private $giam_tru_ca_nhan;
    private $giam_tru_phu_thuoc;

    /**
     * @param $giam_tru_an_trua
     * @param $giam_tru_ca_nhan
     * @param $giam_tru_phu_thuoc
     */
    public function __construct($giam_tru_an_trua, $giam_tru_ca_nhan, $giam_tru_phu_thuoc)
    {
        $this->giam_tru_an_trua = $giam_tru_an_trua;
        $this->giam_tru_ca_nhan = $giam_tru_ca_nhan;
        $this->giam_tru_phu_thuoc = $giam_tru_phu_thuoc;
    }

    public function tienAnMienThue($phu_cap_an_trua)
    {
        if($phu_cap_an_trua > $this->giam_tru_an_trua)
        {
            return $this->giam_tru_an_trua;
        } else {
            return $phu_cap_an_trua;
        }
    }

    public function giamTruGiaCanh($so_nguoi_phu_thuoc)
    {
        return $this->giam_tru_ca_nhan + $this->giam_tru_phu_thuoc * $so_nguoi_phu_thuoc;
    }

    public function thueTNCN($thu_nhap_tinh_thue)
    {
        $result = 0;
        if($thu_nhap_tinh_thue < 0)
        {
            $result = 0;
        } else if($thu_nhap_tinh_thue < 5000000)
        {
            $result = $thu_nhap_tinh_thue * 0.05;
        } else if($thu_nhap_tinh_thue < 10000000)
        {
            $result = $thu_nhap_tinh_thue * 0.1 - 250000;
        } else if($thu_nhap_tinh_thue < 18000000)
        {
            $result = $thu_nhap_tinh_thue * 0.15 - 750000;
        } else if($thu_nhap_tinh_thue < 32000000)
        {
            $result = $thu_nhap_tinh_thue * 0.2 - 1650000;
        } else if($thu_nhap_tinh_thue < 52000000)
        {
            $result = $thu_nhap_tinh_thue * 0.25 - 3250000;
        } else if($thu_nhap_tinh_thue < 80000000)
        {
            $result = $thu_nhap_tinh_thue * 0.30 - 5850000;
        } else {
            $result = $thu_nhap_tinh_thue * 0.35 - 9850000;
        }
        return round($result);
    }
}
