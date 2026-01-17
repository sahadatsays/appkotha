# Security Best Practices for appKotha

## 🔒 Comprehensive Security Guide

This document outlines security best practices specifically implemented for the appKotha Laravel application.

---

## 📋 Table of Contents

1. [Forms Security](#forms-security)
2. [Authentication Security](#authentication-security)
3. [Admin Routes Security](#admin-routes-security)
4. [File Downloads Security](#file-downloads-security)
5. [Environment Setup](#environment-setup)
6. [Additional Security Measures](#additional-security-measures)

---

## 1. Forms Security

### ✅ CSRF Protection

**Status**: ✅ Implemented (Laravel default)

**Best Practices:**

1. **Always use CSRF tokens in forms**
   ```blade
   <form method="POST" action="{{ route('contact.store') }}">
       @csrf
       <!-- form fields -->
   </form>
   ```

2. **AJAX requests must include CSRF token**
   ```javascript
   $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });
   ```

3. **Verify CSRF token in API routes** (if using API)
   ```php
   Route::middleware(['auth:sanctum', 'csrf'])->group(function () {
       // API routes
   });
   ```

### ✅ Input Validation

**Status**: ✅ Using FormRequest classes

**Best Practices:**

1. **Always validate user input**
   ```php
   // app/Http/Requests/ContactFormRequest.php
   public function rules(): array
   {
       return [
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255',
           'message' => 'required|string|max:5000',
           'phone' => 'nullable|string|regex:/^[\d\s\-+()]{7,}$/',
       ];
   }
   ```

2. **Sanitize HTML input** (if allowing HTML)
   ```php
   use Illuminate\Support\Str;

   $clean = strip_tags($request->input('content'));
   // Or use HTMLPurifier for rich text
   ```

3. **Prevent SQL Injection** (Laravel Eloquent handles this)
   ```php
   // ✅ Good - Parameter binding
   User::where('email', $request->email)->first();
   
   // ❌ Bad - Raw queries without binding
   DB::select("SELECT * FROM users WHERE email = '{$request->email}'");
   ```

4. **Validate file uploads**
   ```php
   'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
   'document' => 'required|file|mimes:pdf,doc,docx|max:5120',
   ```

5. **Rate limit form submissions**
   ```php
   // In FormRequest
   public function rules(): array
   {
       return [
           'email' => [
               'required',
               'email',
               Rule::throttle(5, 1), // 5 attempts per minute
           ],
       ];
   }
   ```

### ✅ XSS Prevention

**Status**: ✅ Laravel Blade escapes by default

**Best Practices:**

1. **Always escape output**
   ```blade
   {{-- ✅ Good - Auto-escaped --}}
   {{ $user->name }}
   
   {{-- ⚠️ Only if you trust the content --}}
   {!! $user->bio !!}
   ```

2. **Sanitize user-generated content**
   ```php
   // In controller
   $cleanContent = htmlspecialchars($request->input('content'), ENT_QUOTES, 'UTF-8');
   ```

3. **Content Security Policy (CSP)**
   ```php
   // In middleware or AppServiceProvider
   header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'");
   ```

---

## 2. Authentication Security

### ✅ Password Security

**Status**: ✅ Using Laravel's bcrypt hashing

**Best Practices:**

1. **Strong password requirements**
   ```php
   // In RegisterRequest
   'password' => [
       'required',
       'string',
       'min:12', // Minimum 12 characters
       'regex:/[a-z]/', // At least one lowercase
       'regex:/[A-Z]/', // At least one uppercase
       'regex:/[0-9]/', // At least one number
       'regex:/[@$!%*#?&]/', // At least one special character
       'confirmed',
   ],
   ```

2. **Password hashing** (Already implemented)
   ```php
   // User model
   protected function casts(): array
   {
       return [
           'password' => 'hashed', // Uses bcrypt
       ];
   }
   ```

3. **Password reset security**
   - Tokens expire after 1 hour (default)
   - Tokens are single-use
   - Rate limiting on reset requests

### ✅ Rate Limiting

**Status**: ✅ Implemented in LoginRequest

**Best Practices:**

1. **Login rate limiting** (Already implemented)
   ```php
   // LoginRequest.php
   RateLimiter::tooManyAttempts($this->throttleKey(), 5) // 5 attempts
   ```

2. **Additional rate limiting**
   ```php
   // In routes/web.php
   Route::middleware(['throttle:10,1'])->group(function () {
       Route::post('/contact', [ContactController::class, 'store']);
   });
   ```

3. **IP-based rate limiting**
   ```php
   // Custom middleware
   RateLimiter::for('api', function (Request $request) {
       return Limit::perMinute(60)->by($request->ip());
   });
   ```

### ✅ Session Security

**Status**: ✅ Configured in config/session.php

**Best Practices:**

1. **Secure session configuration**
   ```php
   // config/session.php
   'secure' => env('SESSION_SECURE_COOKIE', true), // HTTPS only
   'http_only' => true, // Prevent JavaScript access
   'same_site' => 'strict', // CSRF protection
   'lifetime' => 120, // 2 hours
   ```

2. **Session regeneration**
   ```php
   // After login (Already implemented)
   $request->session()->regenerate();
   ```

3. **Session timeout**
   ```php
   // Middleware to check session timeout
   if (now()->diffInMinutes(session('last_activity')) > 120) {
       auth()->logout();
       return redirect()->route('login');
   }
   session(['last_activity' => now()]);
   ```

### ✅ Two-Factor Authentication (Recommended)

**Implementation:**

```php
// Install: composer require pragmarx/google2fa-laravel

// In User model
use PragmaRX\Google2FA\Google2FA;

public function generateTwoFactorSecret()
{
    $google2fa = new Google2FA();
    return $google2fa->generateSecretKey();
}

public function verifyTwoFactorCode($code)
{
    $google2fa = new Google2FA();
    return $google2fa->verifyKey($this->two_factor_secret, $code);
}
```

---

## 3. Admin Routes Security

### ✅ Current Implementation

**Status**: ✅ AdminMiddleware exists

**Current Code:**
```php
if (!auth()->check() || !auth()->user()->is_admin) {
    abort(403, 'Unauthorized. Admin access required.');
}
```

### ✅ Enhanced Security Recommendations

1. **IP Whitelisting** (Optional but recommended)
   ```php
   // AdminMiddleware.php
   public function handle(Request $request, Closure $next): Response
   {
       if (!auth()->check() || !auth()->user()->is_admin) {
           abort(403, 'Unauthorized. Admin access required.');
       }

       // IP Whitelist (optional)
       $allowedIPs = config('app.admin_allowed_ips', []);
       if (!empty($allowedIPs) && !in_array($request->ip(), $allowedIPs)) {
           abort(403, 'Access denied from this IP address.');
       }

       return $next($request);
   }
   ```

2. **Admin Activity Logging**
   ```php
   // Log all admin actions
   activity()
       ->causedBy(auth()->user())
       ->withProperties(['ip' => $request->ip()])
       ->log('Admin action: ' . $request->route()->getName());
   ```

3. **Admin Session Timeout** (Shorter for admin)
   ```php
   // In AdminMiddleware
   $lastActivity = session('admin_last_activity');
   if ($lastActivity && now()->diffInMinutes($lastActivity) > 30) {
       auth()->logout();
       return redirect()->route('login')->with('error', 'Session expired.');
   }
   session(['admin_last_activity' => now()]);
   ```

4. **Admin Route Prefix Protection**
   ```php
   // routes/web.php
   Route::middleware([
       'auth',
       'verified',
       'admin',
       'throttle:admin', // Stricter rate limiting
   ])->prefix('admin')->name('admin.')->group(function () {
       // Admin routes
   });
   ```

5. **Admin Password Policy** (Stricter for admins)
   ```php
   // In User model
   public function isAdmin(): bool
   {
       return $this->is_admin === true;
   }

   // In UpdatePasswordRequest
   public function rules(): array
   {
       $rules = [
           'password' => ['required', 'string', 'min:12', 'confirmed'],
       ];

       if (auth()->user()->isAdmin()) {
           $rules['password'][] = 'regex:/[A-Z]/';
           $rules['password'][] = 'regex:/[0-9]/';
           $rules['password'][] = 'regex:/[@$!%*#?&]/';
       }

       return $rules;
   }
   ```

6. **Admin Access Logging**
   ```php
   // Create AdminAccessLog model
   // Log every admin login/logout
   AdminAccessLog::create([
       'user_id' => auth()->id(),
       'action' => 'login',
       'ip_address' => $request->ip(),
       'user_agent' => $request->userAgent(),
   ]);
   ```

---

## 4. File Downloads Security

### ✅ Current Implementation

**Status**: ⚠️ Needs enhancement

**Current Code:**
```php
public function download(Request $request, License $license)
{
    if (!$this->canAccess($license)) {
        abort(403, 'You do not have access to this download.');
    }
    // ...
}
```

### ✅ Enhanced Security Recommendations

1. **Path Traversal Prevention**
   ```php
   private function streamDownload(ProductFile $file): StreamedResponse
   {
       $path = $file->file_path;
       
       // Prevent directory traversal
       $path = str_replace(['../', '..\\', '..'], '', $path);
       $path = ltrim($path, '/');
       
       // Validate path is within storage directory
       $fullPath = Storage::disk('local')->path($path);
       $storagePath = Storage::disk('local')->path('');
       
       if (!str_starts_with($fullPath, $storagePath)) {
           abort(403, 'Invalid file path.');
       }
       
       if (!Storage::disk('local')->exists($path)) {
           abort(404, 'File not found.');
       }
       
       return Storage::disk('local')->download(
           $path,
           $file->file_name,
           [
               'Content-Type' => $file->file_type ?? 'application/octet-stream',
               'Content-Disposition' => 'attachment; filename="' . basename($file->file_name) . '"',
           ]
       );
   }
   ```

2. **Download Rate Limiting**
   ```php
   // In DownloadController
   public function download(Request $request, License $license)
   {
       // Rate limit downloads per user
       $key = 'downloads:' . auth()->id();
       if (RateLimiter::tooManyAttempts($key, 10)) {
           abort(429, 'Too many download attempts. Please try again later.');
       }
       RateLimiter::hit($key, 3600); // 10 downloads per hour
       
       // ... rest of download logic
   }
   ```

3. **File Type Validation**
   ```php
   // In ProductFile model or controller
   private function validateFileType(string $mimeType): bool
   {
       $allowedTypes = [
           'application/zip',
           'application/x-zip-compressed',
           'application/pdf',
           'text/plain',
           'application/json',
       ];
       
       return in_array($mimeType, $allowedTypes);
   }
   ```

4. **Signed URLs for Downloads** (Recommended)
   ```php
   // Generate signed URL with expiration
   $url = URL::temporarySignedRoute(
       'downloads.download',
       now()->addHours(1), // Expires in 1 hour
       ['license' => $license->id]
   );
   ```

5. **Download Logging**
   ```php
   // Log all downloads
   DownloadLog::create([
       'user_id' => auth()->id(),
       'license_id' => $license->id,
       'file_id' => $file->id,
       'ip_address' => $request->ip(),
       'user_agent' => $request->userAgent(),
       'downloaded_at' => now(),
   ]);
   ```

6. **Virus Scanning** (For uploaded files)
   ```php
   // Before allowing download, scan uploaded files
   // Use ClamAV or cloud service
   if ($this->scanFile($file->file_path)) {
       // File is safe
   } else {
       abort(403, 'File failed security scan.');
   }
   ```

---

## 5. Environment Setup

### ✅ .env Security

**Best Practices:**

1. **Never commit .env file**
   ```gitignore
   .env
   .env.backup
   .env.production
   ```

2. **Use .env.example as template**
   ```bash
   # .env.example
   APP_NAME=appKotha
   APP_ENV=local
   APP_KEY=
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   
   # Security
   APP_DEBUG=false
   SESSION_SECURE_COOKIE=true
   SESSION_SAME_SITE=strict
   
   # Database
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=appkotha
   DB_USERNAME=your_db_user
   DB_PASSWORD=strong_random_password
   
   # Mail (use encrypted credentials)
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=null
   MAIL_PASSWORD=null
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="noreply@yourdomain.com"
   MAIL_FROM_NAME="${APP_NAME}"
   
   # Admin Security
   ADMIN_ALLOWED_IPS=
   ADMIN_SESSION_TIMEOUT=30
   
   # File Upload
   FILESYSTEM_DISK=local
   MAX_UPLOAD_SIZE=5120
   ```

3. **Environment-specific configurations**
   ```php
   // config/app.php
   'debug' => env('APP_DEBUG', false),
   
   // Never allow debug in production
   if (app()->environment('production')) {
       config(['app.debug' => false]);
   }
   ```

4. **Secure APP_KEY**
   ```bash
   # Generate new key
   php artisan key:generate
   
   # Never share or commit this key
   ```

### ✅ Server Configuration

1. **PHP Configuration**
   ```ini
   ; php.ini
   expose_php = Off
   display_errors = Off
   log_errors = On
   error_log = /var/log/php_errors.log
   allow_url_fopen = Off
   allow_url_include = Off
   disable_functions = exec,passthru,shell_exec,system
   ```

2. **Web Server Headers**
   ```apache
   # .htaccess (Already implemented)
   Header set X-Content-Type-Options "nosniff"
   Header set X-Frame-Options "SAMEORIGIN"
   Header set X-XSS-Protection "1; mode=block"
   Header set Referrer-Policy "strict-origin-when-cross-origin"
   Header set Permissions-Policy "geolocation=(), microphone=(), camera=()"
   ```

3. **HTTPS Enforcement**
   ```php
   // AppServiceProvider.php
   if (app()->environment('production')) {
       URL::forceScheme('https');
   }
   ```

### ✅ Database Security

1. **Use strong database passwords**
   ```env
   DB_PASSWORD=Complex_P@ssw0rd_With_Special_Chars_123
   ```

2. **Limit database user permissions**
   ```sql
   -- Only grant necessary permissions
   GRANT SELECT, INSERT, UPDATE, DELETE ON appkotha.* TO 'appkotha_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

3. **Use prepared statements** (Laravel does this automatically)
   ```php
   // ✅ Good - Eloquent uses prepared statements
   User::where('email', $email)->first();
   ```

---

## 6. Additional Security Measures

### ✅ Security Headers Middleware

```php
// app/Http/Middleware/SecurityHeaders.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        return $response;
    }
}
```

### ✅ SQL Injection Prevention

**Status**: ✅ Laravel Eloquent prevents this

**Best Practices:**
- Always use Eloquent ORM or Query Builder
- Never use raw queries with user input
- Use parameter binding for raw queries

### ✅ Mass Assignment Protection

**Status**: ✅ Using $fillable/$guarded

```php
// User model
protected $fillable = [
    'name',
    'email',
    'password',
    // Never include 'is_admin' here
];

// Or use $guarded
protected $guarded = ['is_admin', 'id'];
```

### ✅ File Upload Security

```php
// Validation
'file' => [
    'required',
    'file',
    'mimes:pdf,doc,docx',
    'max:5120', // 5MB
    'mimetypes:application/pdf,application/msword',
],

// Store securely
$path = $request->file('document')->store('documents', 'private');
$filename = $request->file('document')->hashName(); // Random filename
```

### ✅ API Security (if using API)

```php
// Use Sanctum or Passport
// Rate limiting
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    // API routes
});
```

### ✅ Logging & Monitoring

```php
// Log security events
Log::warning('Failed login attempt', [
    'email' => $request->email,
    'ip' => $request->ip(),
    'user_agent' => $request->userAgent(),
]);

// Monitor suspicious activity
if ($failedAttempts > 5) {
    // Alert admin
    // Block IP temporarily
}
```

---

## 🔍 Security Checklist

### Forms
- [x] CSRF tokens on all forms
- [x] Input validation using FormRequest
- [x] XSS prevention (Blade escaping)
- [ ] Rate limiting on forms
- [ ] Honeypot fields for spam prevention

### Authentication
- [x] Password hashing (bcrypt)
- [x] Rate limiting on login
- [x] Session regeneration after login
- [ ] Strong password requirements
- [ ] Two-factor authentication
- [ ] Account lockout after failed attempts

### Admin Routes
- [x] AdminMiddleware protection
- [ ] IP whitelisting (optional)
- [ ] Admin activity logging
- [ ] Shorter admin session timeout
- [ ] Admin access logs

### File Downloads
- [x] License verification
- [ ] Path traversal prevention
- [ ] Download rate limiting
- [ ] Signed URLs with expiration
- [ ] Download logging
- [ ] File type validation

### Environment
- [x] .env not committed
- [ ] Strong APP_KEY
- [ ] Debug mode off in production
- [ ] HTTPS enforced
- [ ] Security headers configured
- [ ] Database user with limited permissions

---

## 🚨 Incident Response

### If Security Breach Detected

1. **Immediate Actions**
   - Change all admin passwords
   - Revoke all active sessions
   - Review access logs
   - Check for unauthorized file access

2. **Investigation**
   - Review server logs
   - Check database for unauthorized changes
   - Review file system for new files
   - Check for backdoors

3. **Recovery**
   - Restore from clean backup
   - Update all dependencies
   - Review and fix vulnerabilities
   - Notify affected users if necessary

---

## 📚 Resources

- [Laravel Security Documentation](https://laravel.com/docs/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Best Practices](https://github.com/alexeymezenin/laravel-best-practices)

---

**Last Updated**: {{ date('Y-m-d') }}
