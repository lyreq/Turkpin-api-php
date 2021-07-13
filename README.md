
# turkpinapi
**Not : Bu sınıf Turkpin geliştiricileri tarafından yazılmamıştır. Gayri resmi bir çalışmadır.
Projelerinizde kullanırken lütfen bunu göz önünde bulundurunuz.**


Bu sınıf sayesinde PHP ile Turkpin API kullanabileceksiniz.

Aşağıdaki aynı bilgileri kendime ait blog sitemde de bulabilirsiniz.
https://yasintimur.site/post/php-ile-turkpin-api-kullanimi-9.

iletişim adresim : infoyasintimur@gmail.com

## Kullanım

    include  "Turkpin.php";
    $turkpin =  new  TurkPin("TURKPİN_BAYİ_MAIL", "TURKPİN_BAYİ_SİFRE",false);

> Eğer hata kodları gösterilsin istiyorsanız kullanımı bu şekildedir.

    include  "Turkpin.php";
    $turkpin =  new  TurkPin("TURKPİN_BAYİ_MAIL", "TURKPİN_BAYİ_SİFRE", true);

>Bayi Mail Ve Şifre Kontrolü

Şifreyi kontrol eder, doğruysa true döndürür.

    $girisKontrol= $turkpin->girisKontrol();

>goldOyunListesi

Bu API metodu Gold siparişi verilebilecek oyunları listelemenize yarar.Fonksiyona gold tipi gönderilmediği takdirde 1 geçerli olacaktır. Sonuç olarak dizi dönecektir.

    $goldOyunListesi= $turkpin->goldOyunListesi($goldTipi);
    

> sunucuListesi

Bu API metodu Gold siparişi verilebilecek sunucuları listelemeye yarar. Sipariş verirken bu methoda cevap olarak gelen listedeki min_order ve max_order değerleri dikkate alınmalıdır. max_order değeri 0 geldiği taktirde herhangi bir sınırlandırma olmadığı anlamına gelir. Fonksiyona sunucu listesini almak istediğiniz oyunun kodu ve gold tipi (gönderilmediği takdirde 1 geçerli olacaktır) gönderilmelidir.Sonuç olarak dizi dönecektir.

    $sunucuListesi= $turkpin->sunucuListesi($oyunKodu,$goldTipi);

> siparisYarat

Bu API metodu Gold siparişi yaratmanızı sağlar.Fonksiyona Turkpin üzerinden aldığınız oyun kodu, urun kodu , adet sayısı,Sipariş Veren Adı ve gold tipi gönderilmelidir. Gold tipi gönderilmediği takdirde 1 olarak geçerli olacaktır. Sonuç olarak dizi dönecektir.

    $siparisYarat = $turkpin->siparisYarat($oyunKodu, $urunKodu, $adet, $character, $goldTipi = 1);

> siparisDurumu

Bu API metodu Gold/Epin/Yüklet siparişlerinizin durumunu sorgulamanızı sağlar. Fonksiyona siparisYarat metodu sonucu size dönülen sipariş numarasını göndermelisiniz. Sonuç olarak dizi dönecektir.

    $siparisDurumu= $turkpin->siparisDurumu($siparisNo);

>epinOyunListesi

Bu API metodu Epin siparişi verilebilecek oyunları listelemeye yarar. Fonksiyonu kullanırken herhangi bir parametre göndermenize gerek yoktur. Sonuç olarak dizi dönecektir

    $epinOyunListesi = $turkpin->epinOyunListesi();

>epinUrunleri

Bu API methodu E-pin siparişi verilebilecek ürünleri listelemeye yarar. Sipariş verirken bu methoda cevap olarak gelen listedeki min_order ve max_order değerleri dikkate alınmalıdır. max_order değeri 0 geldiği taktirde herhangi bir sınırlandırma olmadığı anlamına gelir. Fonksiyona E-pin ürünlerini listelemek istediğiniz oyun kodunu göndermelisiniz. Sonuç olarak dizi dönecektir.

    $epinUrunleri = $turkpin->epinUrunleri($oyunKodu);
>epinSiparisYarat

Bu API metodu Epin siparişi yaratmanızı sağlar. Fonksiyona oyun kodu , urun kodu , sipariş adeti , satın alan kişi adı gönderilmelidir. Sonuç olarak dizi dönecektir.

     $epinSiparisYarat =  $turkpin->epinSiparisYarat($oyunKodu, $urunKodu, $sipadet, $karakterAdi);

>yukletOyunListesi


Bu API metodu Yüklet siparişi verilebilecek ürünleri listelemeye yarar. Sipariş verirken bu methoda cevap olarak gelen listedeki min_order ve max_order değerleri dikkate alınmalıdır. max_order değeri 0 geldiği taktirde herhangi bir sınırlandırma olmadığı anlamına gelir. Fonksiyonu kullanırken herhangi bir parametre göndermenize gerek yoktur. Sonuç olarak dizi dönecektir
    
    $yukletOyunListesi= $turkpin->$yukletOyunListesi();

>yukletUrunListesi

Bu API metodu Yüklet siparişi verilebilecek ürünleri listelemeye yarar. Sipariş verirken bu methoda cevap olarak gelen listedeki min_order ve max_order değerleri dikkate alınmalıdır. max_order değeri 0 geldiği taktirde herhangi bir sınırlandırma olmadığı anlamına gelir. Fonksiyonu kullanırken oyun kodu gönderilmelidir. Sonuç olarak dizi dönecektir.

    $yukletUrunListesi= $turkpin->yukletUrunListesi($oyunKodu);

>yukletSiparisYarat

Bu API metodu Yüklet siparişi yaratmanızı sağlar. Parametreleri gönderirken açıklama alanına yükleme için gerekecek kullanıcı adı, şifre vb. gibi tüm bilgiler tarafınızdan kullanıcıdan istenip birleştirilerek gönderilmelidir. GSM TL ürünü yükletmek için bu ürüne özel olarak açıklama alanında sadece GSM Numarası gönderilmelidir. GSM No başında 0 olmadan 10 hane olarak girilmelidir. Fonksiyonu kullanırken oyun kodu , urun kodu , adet ve açıklama göndermelisiniz. Sonuç olarak dizi dönecektir.

    $yukletSiparisYarat = $turkpin->yukletSiparisYarat($oyunKodu, $urunKodu, $adet, $aciklama);

>odemeTipleri

Bu API metodu kabul edilen ödeme tiplerini sorgulamanızı sağlar. Bu ödeme tipleri daha sonra banka listeleme methodunda kullanılacaktır. Fonksiyonu kullanırken herhangi bir parametre göndermenize gerek yoktur. Sonuç olarak dizi dönecektir.

    $odemeTipleri = $turkpin->odemeTipleri();
>bankaListesi

Ödeme bildirimi gönderebileceğiniz bankaları, parametre olarak belirtilen ödeme tipine göre listelemeye yarayan API metodudur. Fonksiyonu kullanırken ödeme yöntemi de gönderilmelidir. Sonuç olarak dizi dönecektir.

    $bankaListesi = $turkpin->bankaListesi($paymentMethod);
>bildirimGonder

Fonksiyonu kullanırken ödeme yöntemi ( odemeTipleri metodu sonucu size dönülen ödeme tiplerinden kullanmak istediğinizin idsi ) , banka id, tutar,gönderici adı, required ( bankaListesi metodu sonucu size dönülen ilgili bankaya ait doldurulması zorunlu alan değeri ) ve ödemenin yapıldığı tarih gönderilmelidir.
Sonuç olarak dizi dönecektir.

     $bildirimGonder = $turkpin->bildirimGonder($paymentMethod, $bank_id, $amount, 
     $sender_name, $required, $date_of_payment);

>bildirimDurumu

Ödeme bildirimi gönderebilmeniz için yukarıdaki odemeTipleri metodunu kullanarak bir ödeme tipi belirlemeniz ve ilgili metod için bankaListesi metodu ile geçerli banka listesi ve gönderilecek alan bilgisini almış olmanız gerekmektedir. Fonksiyonu kullanırken bildirimGonder fonksiyonu ile yapılan başarılı bildirime ait bildirim numarası gönderilmelidir. Sonuç olarak dizi dönecektir.

    $bildirimDurumu = $turkpin->bildirimDurumu($bildirim_id);

>balance

Bu API metodu üyeliğinizdeki bakiyenizi listelemeye yarar. Fonksiyonu kullanırken herhangi bir parametre göndermenize gerek yoktur. Sonuç dizi olarak dönecektir.
 

     $balance = $turkpin->balance();


    
