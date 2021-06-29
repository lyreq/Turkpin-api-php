<?php
//Turkpin v1.2 by Yasin Timur
//contact : infoyasintimur@gmail.com
//date : 06/2021

class TurkPin
{
    public $kid;
    public $pw;

    public function __construct($kid, $pw, $error = true)
    {
        $this->kid = $kid;
        $this->pw = $pw;
        $this->error = $error;

        if ($this->error == false) {
            error_reporting(0);
        }
        function curl($xml_data)
        {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.turkpin.net/api.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('DATA' => $xml_data),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return $response;
        }

        function xml2array($xml_data)
        {
            $xml = simplexml_load_string($xml_data, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, true);

            return $array;
        }
    }
    public function girisKontrol()
    {

        $xml_data = '<APIRequest>

        <params>

            <cmd>epinOyunListesi</cmd>

            <username>' . $this->kid . '</username>

            <password>' . $this->pw . '</password>

        </params>

        </APIRequest>';

        $content = curl($xml_data);

        $array = xml2array($content);

        if (trim($array['params']['HATA_NO']) == "001") {

            return false;

        } else {

            return true;

        }

    }
    public function goldOyunListesi($goldTipi = 1)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>goldOyunListesi</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <type>' . $goldTipi . '</type>
        </params>
        </APIRequest>';

        $content = curl($xml_data);
        $array = xml2array($content);
        return $array;

    }

    public function sunucuListesi($oyunKodu, $goldTipi = 1)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>sunucuListesi</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <oyunKodu>' . $oyunKodu . '</oyunKodu>
        <type>' . $goldTipi . '</type>
        </params>
        </APIRequest>';

        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }

    public function siparisYarat($oyunKodu, $urunKodu, $adet, $character, $goldTipi = 1)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>siparisYarat</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <oyunKodu>' . $oyunKodu . '</oyunKodu>
        <urunKodu>' . $urunKodu . '</urunKodu>
        <adet>' . $adet . '</adet>
        <character>' . $character . '</character>
        <type>' . $goldTipi . '</type>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);
        return $array;

    }

    public function siparisDurumu($siparisNo)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>siparisDurumu</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <siparisNo>' . $siparisNo . '</siparisNo>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);
        return $array;

    }
    public function epinOyunListesi()
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>epinOyunListesi</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);
        return $array;
    }

    public function epinUrunleri($oyunKodu)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>epinUrunleri</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <oyunKodu>' . $oyunKodu . '</oyunKodu>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
    public function epinSiparisYarat($oyunKodu, $urunKodu, $sipadet, $karakterAdi)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>epinSiparisYarat</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <oyunKodu>' . $oyunKodu . '</oyunKodu>
        <urunKodu>' . $urunKodu . '</urunKodu>
        <adet>' . $sipadet . '</adet>
        <character>' . $karakterAdi . '</character>
        </params>
        </APIRequest>
        ';

        $content = curl($xml_data);
        $array = xml2array($content);
        return $array;

    }

    public function yukletOyunListesi()
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>yukletOyunListesi</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);
        return $array;
    }

    public function yukletUrunListesi($oyunKodu)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>yukletUrunListesi</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <oyunKodu>' . $oyunKodu . '</oyunKodu>
        </params>
        </APIRequest>';

        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }

    public function yukletSiparisYarat($oyunKodu, $urunKodu, $adet, $aciklama)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>yukletSiparisYarat</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <oyunKodu>' . $oyunKodu . '</oyunKodu>
        <urunKodu>' . $urunKodu . '</urunKodu>
        <adet>' . $adet . '</adet>
        <aciklama>' . $aciklama . '</aciklama>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
    public function odemeTipleri()
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>odemeTipleri</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
    public function bankaListesi($paymentMethod)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>bankaListesi</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <paymentMethod>' . $paymentMethod . '</paymentMethod>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
    public function bildirimGonder($paymentMethod, $bank_id, $amount, $sender_name, $required, $date_of_payment)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>bildirimGonder</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <paymentMethod>' . $paymentMethod . '</paymentMethod>
        <bank_id>' . $bank_id . '</bank_id>
        <amount>' . $amount . '</amount>
        <sender_name>' . $sender_name . '</sender_name>
        <required>' . $required . '</required>
        <date_of_payment>' . $date_of_payment . '</date_of_payment>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
    public function bildirimDurumu($bildirim_id)
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>bildirimDurumu</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        <bildirim_id>' . $bildirim_id . '</bildirim_id>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
    public function balance()
    {
        $xml_data = '
        <APIRequest>
        <params>
        <cmd>balance</cmd>
        <username>' . $this->kid . '</username>
        <password>' . $this->pw . '</password>
        </params>
        </APIRequest>
        ';
        $content = curl($xml_data);
        $array = xml2array($content);

        return $array;
    }
}
