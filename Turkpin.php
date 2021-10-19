<?php
//Turkpin v1.2 by Yasin Timur
//contact : infoyasintimur@gmail.com
//date : 06/2021

class TurkPin
{
    public $kid;
    public $pw;
    
    /**
     * __construct
     *
     * @param  mixed $kid
     * @param  mixed $pw
     * @param  mixed $error
     * @return void
     */
    public function __construct($kid, $pw, $error = true)
    {
        $this->kid = $kid;
        $this->pw = $pw;
        $this->error = $error;

        if ($this->error == false) {
            error_reporting(0);
        }        
        /**
         * curl
         *
         * @param  mixed $xml_data
         * @return void
         */
        function curl($xml_data)
        {

            

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://www.turkpin.net/api.php',
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
        
        /**
         * xml2array
         *
         * @param  mixed $xml_data
         * @return void
         */
        function xml2array($xml_data)
        {
            $xml = simplexml_load_string($xml_data, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, true);

            return $array;
        }
    }    
    /**
     * girisKontrol
     *
     * @return void
     */
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
    /**
     * goldOyunListesi
     *
     * @param  mixed $goldTipi
     * @return void
     */
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
    
    /**
     * sunucuListesi
     *
     * @param  mixed $oyunKodu
     * @param  mixed $goldTipi
     * @return void
     */
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
    
    /**
     * siparisYarat
     *
     * @param  mixed $oyunKodu
     * @param  mixed $urunKodu
     * @param  mixed $adet
     * @param  mixed $character
     * @param  mixed $goldTipi
     * @return void
     */
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
    
    /**
     * siparisDurumu
     *
     * @param  mixed $siparisNo
     * @return void
     */
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
    /**
     * epinOyunListesi
     *
     * @return void
     */
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
    
    /**
     * epinUrunleri
     *
     * @param  mixed $oyunKodu
     * @return void
     */
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
    /**
     * epinSiparisYarat
     *
     * @param  mixed $oyunKodu
     * @param  mixed $urunKodu
     * @param  mixed $sipadet
     * @param  mixed $karakterAdi
     * @return void
     */
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
    
    /**
     * yukletOyunListesi
     *
     * @return void
     */
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
    
    /**
     * yukletUrunListesi
     *
     * @param  mixed $oyunKodu
     * @return void
     */
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
    
    /**
     * yukletSiparisYarat
     *
     * @param  mixed $oyunKodu
     * @param  mixed $urunKodu
     * @param  mixed $adet
     * @param  mixed $aciklama
     * @return void
     */
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
    /**
     * odemeTipleri
     *
     * @return void
     */
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
    /**
     * bankaListesi
     *
     * @param  mixed $paymentMethod
     * @return void
     */
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
    /**
     * bildirimGonder
     *
     * @param  mixed $paymentMethod
     * @param  mixed $bank_id
     * @param  mixed $amount
     * @param  mixed $sender_name
     * @param  mixed $required
     * @param  mixed $date_of_payment
     * @return void
     */
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
    /**
     * bildirimDurumu
     *
     * @param  mixed $bildirim_id
     * @return void
     */
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
    /**
     * balance
     *
     * @return void
     */
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
