<?php
/*
 * PDOext class'ını burada başlatıyoruz ve PDO'ya extends ediyoruz.
*/
class PDOext extends \PDO
{
    /*
     * Veritabanı bağlantı olayını oluşturduk.
     * Alacağı Değerler::
     * 1. host     ( localhost önerilir )
     * 2. db       ( Veritabanı adı buraya gelecek )
     * 3. name     ( Veritabanı kullanıcı adı buraya gelicek )
     * 4. password ( Veritabanı şifresi varsa buraya gelicek )
     * 5. charset  ( Karakter seti belirlenmezsek utf8 otomatik seçili gelicektir )
    */
    public function __construct($host, $db, $name, $password, $charset = 'utf8')
    {
        parent::__construct('mysql:host=' . $host . ';dbname=' . $db, $name, $password);
    }
    /*
     * Select sınıfı::
     * Bu sınıf şu anda 2 parametre alabilir
     * Alacağı Değerler::
     * 1. tableName ( Veritabanı içindeki seçilecek tablo örnek :: uyeler )
     * 2. where ( Eğer sorgu yapmak istersek mesela :: uye_id = 1 gibi ikinci parametre olarak sorgu girilir )
    */
    public function select($tableName, $type = false, $valueSQL = false)
    {
        if ($type == false || $valueSQL == false)
        {
            $sql = "SELECT * FROM " . $tableName;
            return $this->query($sql);
        }
        else
        {
            $sql = "SELECT * FROM " . $tableName . " $type " . " $valueSQL";
            return $this->query($sql);
        }
    }
    /*
     * Insert sınıfı::
     * Bu sınıf 2 adet parametre almalıdır.
     * Alacağı değerler::
     * 1. type ( işlemin tipini belirledik ' )
     * 2. sql  ( Buraya insert kodlarımızı gireceğiz. sadece INSERT INTO yazmıyacağız yoksa sistem buglu çalışıyor )
    */
    public function insert($sql)
    {
        return $this->query("INSERT INTO " . $sql);
    }
    /*
     * Update sınıfı::
     * Bu sınıf 2 adet parametre almalıdır.
     * Alacağı değerler::
     * 1. type ( işlemin tipini belirledik ' )
     * 2. sql  ( Buraya update kodlarımızı gireceğiz. sadece UPDATE yazmıyacağız yoksa sistem buglu çalışıyor )
    */
    public function update($sql,$where)
    {
        return $this->query("UPDATE " . $sql . "WHERE " . $where);
    }
    /*
     * delete sınıfı::
     * Bu sınıf 3 adet parametre almalıdır.
     * Alacağı değerler::
     * 1. tableName ( Hangi tablodan veri sileceğimiz seçtik )
     * 2. where     ( Hangi verinin silineceğine dair bir sorgu yapıyoruz )
     * 3. limit     ( İşlemin durumuna göre limit belirliyebiliriz )
    */
    public function delete($tableName,$where,$limit = false)
    {
        if ($limit == true)
        {
            $sql = "DELETE FROM $tableName WHERE $where LIMIT $limit";
        }
        else
        {
            $sql = "DELETE FROM $tableName WHERE $where";
        }
        return $this->query($sql);
    }
}
