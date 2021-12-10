Passport kullanımı

- Projeye ekleme
#composer require laravel/passport

- Daha sonra migrate işlemi yapmamız gerekiyor auth token tablolarının oluşturulması için için
#php artisan migrate

- Daha sonra private keyleri oluşturmak ve veritababınıda clint oluşturmak için
#php artisan passport:install
!not eğer migrate:refresh yaptıysan
php artisan passport:install --force

- Daha sonra bu paketi kullanacağımız modelde yani genelde user modeli olur bu modeli kullanıp sınıfta tanımlamamız gerek
use Laravel\Passport\HasApiTokens; // Passport pakedi
#use HasApiTokens // sınıfta

- Daha sonra hazır olan route ları kullanmak istersen App\Providers\AuthServiceProvider dosyasındaki boot fonksiyonuna Passport::routes bu kodu ekleyerek kullanablirsin bu route ları görmek için route:list komutunu kullanablirisin ha birde tabi bu dosyada passport paketini çağırman lazım use Laravel\Passport\Passport; ama ben burda kendim oluşturup kullandım inşaallah.

- Daha sonra AuthController isminde bir controller dosyası oluşturup register, login fonksiyonlarını yazdım 

- Sonra AuthController daki register, login fonksiyonlarını routes da tanımladım

- Eğer login işlemi başarılı ise token oluşturup döndüm 

- Tabi route kısmıda middleware a gelen auth işlemi için hangi paketi kullanacağımız belirtmemiz gerek bunun için config->auth.php da guards dizisinde
'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],
bunu ekle

- expire süresi için App\Providers\AuthServiceProvider dosyasında boot fonksiyonuna aşağıdaki tanımlamaları ekle tabi use Laravel\Passport\Passport; bunu kullan
 Passport::tokensExpireIn(now()->addHour(2));
        Passport::refreshTokensExpireIn(now()->addHour(2));
        Passport::personalAccessTokensExpireIn(now()->addHour(2));