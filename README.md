### Laravel JWT Starter
A custom starter build for jwt api authentication.

##### Why JWT?
JWT or jsonwebtoken is very good for microservices because of its self contained privilege capability.

#### Packages
- [firebase/php-jwt](https://packagist.org/packages/firebase/php-jwt)
- [phpseclib/phpseclib](https://packagist.org/packages/phpseclib/phpseclib)

#### Structure
- app/Dto - Parse all data before passing to services
- app/Libs - Hold all customize function for libraries
- app/Services - Holds the application base logics

#### Versioning
- app/Dto/v1
- app/Http/controller/v1
- app/Http/Request/v1
- app/Services/Traits/v1

Always separate files

Example:  

New File ```routes/apiv1.php```

app/Http/Providers/RouteServiceProvider.php
```php
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/apiv1.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
```

New File ```App/Services/Apiv1.php```
App/Services/Apiv1.php
```php
    <?php

    namespace App\Services;

    use App\Services\Traits\v1\Admin;
    use App\Services\Traits\v1\User;

    class Apiv1
    {
        use User, Admin;
    }
```

app/Services/Base
```php
   <?php

    namespace App\Services;

    use App\Services\Apiv1;

    class Base extends Apiv1 {} 
```

app/Http/Controllers/v1/AuthController.php
```php
<?php

namespace App\Http\Controllers\v1;

use App\Dto\v1\Auth as AuthDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\v1\LoginRequest;
use App\Services\Base;
use Exception;

class AuthController extends Controller
{
    private $service;

    public function __construct(Base $service)
    {
        $this->service = $service;
    }

    /**
     * User's login
     * @param LoginRequest $request
     * @return mixed
     */
    public function user(LoginRequest $request): mixed
    {
        try {
            return $this->service->v1LoginUser(
                AuthDto::fromRequest($request),
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Admin's login
     */
    public function admin(LoginRequest $request)
    {
        try {
            return $this->service->v1LoginAdmin(
                AuthDto::fromRequest($request),
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
```
