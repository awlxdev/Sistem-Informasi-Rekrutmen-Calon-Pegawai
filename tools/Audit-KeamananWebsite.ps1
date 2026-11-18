#requires -Version 5.1
<#
.SYNOPSIS
  Audit keamanan statis dan pemeriksaan HTTP ringan untuk proyek Laravel.
.DESCRIPTION
  Read-only terhadap source/config/database. Membuat satu laporan TXT di folder
  yang sama dengan script. Tidak melakukan load test, fuzzing agresif, exploit,
  brute force, atau simulasi DDoS.
.USAGE
  Simpan sebagai tools\Audit-KeamananWebsite.ps1, lalu jalankan dari PowerShell:
    Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
    .\tools\Audit-KeamananWebsite.ps1
  Opsi:
    .\tools\Audit-KeamananWebsite.ps1 -ProjectPath "D:\PENDAFTARAN_CALON_PEGAWAI"
    .\tools\Audit-KeamananWebsite.ps1 -SkipDependencyAudit
    .\tools\Audit-KeamananWebsite.ps1 -BaseUrl "http://pendaftaran-dev.test:8000"
#>

[CmdletBinding()]
param(
    [string]$ProjectPath = (Get-Location).Path,
    [string]$BaseUrl = "",
    [switch]$SkipDependencyAudit
)

Set-StrictMode -Version 2
$ErrorActionPreference = 'Continue'

$script:Findings = New-Object System.Collections.Generic.List[object]
$script:ReportLines = New-Object System.Collections.Generic.List[string]
$script:PassCount = 0
$script:WarnCount = 0
$script:FailCount = 0
$script:InfoCount = 0

function Add-Finding {
    param(
        [ValidateSet('PASS','WARN','FAIL','INFO')]
        [string]$Status,
        [string]$Category,
        [string]$Check,
        [string]$Detail,
        [string]$Recommendation = ''
    )
    $item = [pscustomobject]@{
        Status = $Status
        Category = $Category
        Check = $Check
        Detail = ($Detail -replace '[\r\n]+',' ').Trim()
        Recommendation = ($Recommendation -replace '[\r\n]+',' ').Trim()
    }
    [void]$script:Findings.Add($item)
    switch ($Status) {
        'PASS' { $script:PassCount++ ; $color = 'Green' }
        'WARN' { $script:WarnCount++ ; $color = 'Yellow' }
        'FAIL' { $script:FailCount++ ; $color = 'Red' }
        default { $script:InfoCount++ ; $color = 'Cyan' }
    }
    $line = "[$Status] [$Category] $Check - $($item.Detail)"
    Write-Host $line -ForegroundColor $color
    [void]$script:ReportLines.Add($line)
    if ($Recommendation) {
        $rec = "         Saran: $Recommendation"
        Write-Host $rec -ForegroundColor DarkGray
        [void]$script:ReportLines.Add($rec)
    }
}

function Add-Section {
    param([string]$Name)
    Write-Host "`n===== $Name =====" -ForegroundColor White
    [void]$script:ReportLines.Add("")
    [void]$script:ReportLines.Add("===== $Name =====")
}

function Get-TextFile {
    param([string]$Path)
    if (Test-Path -LiteralPath $Path -PathType Leaf) {
        try { return [System.IO.File]::ReadAllText($Path) } catch { return '' }
    }
    return ''
}

function Test-CommandExists {
    param([string]$Name)
    return [bool](Get-Command $Name -ErrorAction SilentlyContinue)
}

function Get-EnvValue {
    param([string]$Text,[string]$Name)
    $pattern = '(?m)^\s*' + [regex]::Escape($Name) + '\s*=\s*(.*?)\s*$'
    $m = [regex]::Match($Text,$pattern)
    if (-not $m.Success) { return $null }
    $v = $m.Groups[1].Value.Trim()
    if (($v.StartsWith('"') -and $v.EndsWith('"')) -or ($v.StartsWith("'") -and $v.EndsWith("'"))) {
        $v = $v.Substring(1,$v.Length-2)
    }
    return $v
}

function Invoke-SafeHttpCheck {
    param([string]$Url,[string]$Label)
    try {
        $response = Invoke-WebRequest -Uri $Url -Method Get -TimeoutSec 8 -MaximumRedirection 3 -UseBasicParsing -ErrorAction Stop
        return [pscustomobject]@{
            Reachable = $true
            StatusCode = [int]$response.StatusCode
            Headers = $response.Headers
            ContentLength = if ($response.RawContentLength) { [int]$response.RawContentLength } else { 0 }
            Error = ''
        }
    } catch {
        $resp = $_.Exception.Response
        if ($null -ne $resp) {
            try {
                return [pscustomobject]@{
                    Reachable = $true
                    StatusCode = [int]$resp.StatusCode
                    Headers = $resp.Headers
                    ContentLength = 0
                    Error = ''
                }
            } catch {}
        }
        return [pscustomobject]@{
            Reachable = $false
            StatusCode = 0
            Headers = @{}
            ContentLength = 0
            Error = $_.Exception.Message
        }
    }
}

$ProjectPath = [System.IO.Path]::GetFullPath($ProjectPath)
if (-not (Test-Path -LiteralPath $ProjectPath -PathType Container)) {
    Write-Error "Folder proyek tidak ditemukan: $ProjectPath"
    exit 2
}
Set-Location -LiteralPath $ProjectPath

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
if (-not $scriptDir) { $scriptDir = $ProjectPath }
$stamp = Get-Date -Format 'yyyyMMdd-HHmmss'
$reportPath = Join-Path $scriptDir "Laporan-Audit-Keamanan-$stamp.txt"

Write-Host "============================================================" -ForegroundColor DarkCyan
Write-Host " AUDIT KEAMANAN WEBSITE LARAVEL (READ-ONLY)" -ForegroundColor Cyan
Write-Host "============================================================" -ForegroundColor DarkCyan
Write-Host "Proyek : $ProjectPath"
Write-Host "Waktu  : $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
Write-Host "Catatan: Tidak ada load test atau simulasi serangan DDoS."
[void]$script:ReportLines.Add("AUDIT KEAMANAN WEBSITE LARAVEL")
[void]$script:ReportLines.Add("Proyek: $ProjectPath")
[void]$script:ReportLines.Add("Waktu: $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')")
[void]$script:ReportLines.Add("Mode: read-only; bukan penetration test atau uji beban.")

# 1. Struktur dan versi runtime
Add-Section '1. STRUKTUR PROYEK DAN RUNTIME'
$artisan = Join-Path $ProjectPath 'artisan'
$composerJsonPath = Join-Path $ProjectPath 'composer.json'
$envPath = Join-Path $ProjectPath '.env'
if ((Test-Path $artisan) -and (Test-Path $composerJsonPath)) {
    Add-Finding PASS 'Project' 'Struktur Laravel' 'artisan dan composer.json ditemukan.'
} else {
    Add-Finding FAIL 'Project' 'Struktur Laravel' 'artisan atau composer.json tidak ditemukan.' 'Pastikan ProjectPath menunjuk ke root proyek Laravel.'
}
if (Test-CommandExists 'php') {
    $phpVersion = (& php -v 2>$null | Select-Object -First 1)
    Add-Finding INFO 'Runtime' 'Versi PHP' "$phpVersion"
} else {
    Add-Finding WARN 'Runtime' 'PHP CLI' 'Perintah php tidak ditemukan di PATH.' 'Tambahkan PHP ke PATH atau jalankan dari terminal yang sudah mengenali PHP.'
}
if (Test-CommandExists 'composer') {
    $composerVersion = (& composer --version 2>$null | Select-Object -First 1)
    Add-Finding INFO 'Runtime' 'Versi Composer' "$composerVersion"
} else {
    Add-Finding WARN 'Runtime' 'Composer' 'Composer tidak ditemukan di PATH.'
}
if (Test-CommandExists 'node') {
    Add-Finding INFO 'Runtime' 'Versi Node.js' ((& node --version 2>$null | Select-Object -First 1))
}
if (Test-CommandExists 'npm') {
    Add-Finding INFO 'Runtime' 'Versi npm' ((& npm --version 2>$null | Select-Object -First 1))
}

# 2. .env and Laravel security configuration
Add-Section '2. KONFIGURASI LARAVEL DAN FILE RAHASIA'
$envText = Get-TextFile $envPath
if (-not $envText) {
    Add-Finding FAIL 'Config' '.env tersedia' 'File .env tidak ditemukan atau tidak dapat dibaca.' 'Buat konfigurasi environment yang benar; jangan commit file .env.'
} else {
    Add-Finding PASS 'Config' '.env tersedia' 'File .env ditemukan. Nilai rahasia tidak ditampilkan.'
    $appEnv = Get-EnvValue $envText 'APP_ENV'
    $appDebug = Get-EnvValue $envText 'APP_DEBUG'
    $appKey = Get-EnvValue $envText 'APP_KEY'
    $appUrl = Get-EnvValue $envText 'APP_URL'
    $sessionSecure = Get-EnvValue $envText 'SESSION_SECURE_COOKIE'
    $sessionHttpOnly = Get-EnvValue $envText 'SESSION_HTTP_ONLY'
    $sessionSameSite = Get-EnvValue $envText 'SESSION_SAME_SITE'

    if ($appDebug -match '^(?i:true|1|yes)$') {
        Add-Finding FAIL 'Config' 'APP_DEBUG' 'APP_DEBUG aktif; berisiko membocorkan stack trace dan konfigurasi.' 'Matikan APP_DEBUG di server publik (false), lalu jalankan php artisan config:cache.'
    } elseif ($appDebug -match '^(?i:false|0|no)$') {
        Add-Finding PASS 'Config' 'APP_DEBUG' 'APP_DEBUG nonaktif.'
    } else {
        Add-Finding WARN 'Config' 'APP_DEBUG' 'Nilai APP_DEBUG kosong atau tidak dikenali.' 'Tetapkan APP_DEBUG=false untuk lingkungan publik.'
    }
    if ($appEnv -eq 'production') {
        Add-Finding PASS 'Config' 'APP_ENV' 'APP_ENV disetel production.'
    } else {
        Add-Finding WARN 'Config' 'APP_ENV' "APP_ENV bukan production (nilai: $appEnv)." 'Pastikan server publik memakai APP_ENV=production. Untuk localhost, nilai local dapat diterima.'
    }
    if ($appKey -and $appKey -notmatch 'YOUR|CHANGE|GENERATE|^base64:$') {
        Add-Finding PASS 'Config' 'APP_KEY' 'APP_KEY terisi (nilainya disembunyikan).'
    } else {
        Add-Finding FAIL 'Config' 'APP_KEY' 'APP_KEY kosong atau tampak belum dibuat.' 'Jalankan php artisan key:generate hanya setelah memastikan environment yang benar.'
    }
    if ($appUrl -match '^https://') {
        Add-Finding PASS 'Config' 'APP_URL' 'APP_URL menggunakan HTTPS.'
    } elseif ($appUrl -match '^http://(localhost|127\.0\.0\.1|.*\.test)(:\d+)?/?$') {
        Add-Finding INFO 'Config' 'APP_URL' 'APP_URL menggunakan HTTP pada hostname lokal/development.'
    } else {
        Add-Finding WARN 'Config' 'APP_URL' "APP_URL tidak menggunakan HTTPS atau belum terdeteksi: $appUrl" 'Untuk deployment publik, gunakan URL HTTPS.'
    }
    if ($sessionSecure -match '^(?i:true|1)$') {
        Add-Finding PASS 'Session' 'SESSION_SECURE_COOKIE' 'Secure cookie aktif.'
    } else {
        Add-Finding WARN 'Session' 'SESSION_SECURE_COOKIE' 'Secure cookie tidak dipastikan aktif.' 'Aktifkan SESSION_SECURE_COOKIE=true pada HTTPS production. Untuk localhost HTTP, nonaktif sementara dapat diperlukan.'
    }
    if ($sessionHttpOnly -match '^(?i:false|0)$') {
        Add-Finding FAIL 'Session' 'SESSION_HTTP_ONLY' 'HttpOnly cookie dinonaktifkan.' 'Gunakan SESSION_HTTP_ONLY=true.'
    } elseif ($sessionHttpOnly -match '^(?i:true|1)$') {
        Add-Finding PASS 'Session' 'SESSION_HTTP_ONLY' 'HttpOnly cookie aktif.'
    } else {
        Add-Finding INFO 'Session' 'SESSION_HTTP_ONLY' 'Nilai tidak didefinisikan; periksa default config/session.php Laravel.'
    }
    if ($sessionSameSite -match '^(?i:none)$') {
        Add-Finding WARN 'Session' 'SESSION_SAME_SITE' 'SameSite=None memerlukan Secure dan meningkatkan perhatian pada CSRF.' 'Gunakan lax kecuali integrasi lintas situs memang memerlukan none.'
    } else {
        Add-Finding INFO 'Session' 'SESSION_SAME_SITE' "SameSite: $sessionSameSite (atau default Laravel)."
    }
}

$gitignore = Get-TextFile (Join-Path $ProjectPath '.gitignore')
if ($gitignore -match '(?m)^\s*\.env\s*$') {
    Add-Finding PASS 'Secrets' '.env di .gitignore' '.env tercantum di .gitignore.'
} else {
    Add-Finding WARN 'Secrets' '.env di .gitignore' 'Aturan .env tidak ditemukan secara persis di .gitignore.' 'Tambahkan .env ke .gitignore dan periksa riwayat Git jika pernah ter-commit.'
}
foreach ($secretFile in @('.env','auth.json','.htpasswd','id_rsa')) {
    if (Test-Path (Join-Path $ProjectPath $secretFile)) {
        Add-Finding INFO 'Secrets' "File $secretFile" "File $secretFile ada di root proyek; jangan sampai terpublikasi oleh web server."
    }
}
if (Test-Path (Join-Path $ProjectPath 'public\.htaccess')) {
    Add-Finding PASS 'WebServer' '.htaccess public' 'public/.htaccess ditemukan.'
} else {
    Add-Finding WARN 'WebServer' '.htaccess public' 'public/.htaccess tidak ditemukan.' 'Jika menggunakan Apache, pastikan aturan rewrite dan proteksi direktori diterapkan.'
}

# 3. Source-code pattern checks
Add-Section '3. PEMERIKSAAN POLA SOURCE CODE'
$scanRoots = @('app','routes','resources\views','config')
$extensions = @('*.php','*.blade.php')
$sourceFiles = @()
foreach ($root in $scanRoots) {
    $fullRoot = Join-Path $ProjectPath $root
    if (Test-Path $fullRoot) {
        $sourceFiles += Get-ChildItem -LiteralPath $fullRoot -Recurse -File -ErrorAction SilentlyContinue |
            Where-Object { $_.Extension -eq '.php' -or $_.Name -like '*.blade.php' }
    }
}
$sourceFiles = @($sourceFiles | Sort-Object FullName -Unique)
Add-Finding INFO 'CodeScan' 'Cakupan source scan' "$($sourceFiles.Count) file PHP/Blade pada app, routes, resources/views, config."
$patterns = @(
    [pscustomobject]@{Name='Pemanggilan eval()';Regex='\beval\s*\(';Severity='WARN';Advice='Hapus eval jika tidak benar-benar diperlukan; jangan pernah evaluasi input pengguna.'},
    [pscustomobject]@{Name='Pemanggilan shell berisiko';Regex='\b(shell_exec|exec|system|passthru|popen|proc_open)\s*\(';Severity='WARN';Advice='Pastikan command tidak dibentuk dari input pengguna; gunakan allowlist dan escaping yang tepat.'},
    [pscustomobject]@{Name='Query SQL mentah';Regex='(DB::raw\s*\(|->whereRaw\s*\(|->selectRaw\s*\(|->orderByRaw\s*\()';Severity='WARN';Advice='Audit setiap query mentah; gunakan binding parameter dan whitelist untuk nama kolom/order.'},
    [pscustomobject]@{Name='Output Blade tidak di-escape';Regex='\{!!\s*';Severity='WARN';Advice='Pastikan konten sudah disanitasi; gunakan {{ }} untuk output biasa.'},
    [pscustomobject]@{Name='Mass assignment berpotensi';Regex='(protected\s+\$guarded\s*=\s*\[\s*\]\s*;|->unguard\s*\()';Severity='WARN';Advice='Periksa fillable/guarded dan validasi field yang boleh diubah pengguna.'},
    [pscustomobject]@{Name='Validasi upload perlu ditinjau';Regex='(storeAs\s*\(|move\s*\(|putFileAs\s*\()';Severity='INFO';Advice='Pastikan validasi MIME, ekstensi, ukuran, nama acak, dan penyimpanan di luar public.'},
    [pscustomobject]@{Name='Pengecualian CSRF global';Regex='(except\s*=\s*\[|$except\s*=)';Severity='INFO';Advice='Periksa pengecualian CSRF; jangan mengecualikan login/register tanpa alasan kuat.'}
)
foreach ($pattern in $patterns) {
    $hits = @()
    foreach ($file in $sourceFiles) {
        $lines = Get-Content -LiteralPath $file.FullName -ErrorAction SilentlyContinue
        for ($i=0; $i -lt $lines.Count; $i++) {
            if ($lines[$i] -match $pattern.Regex) {
                $relative = $file.FullName.Substring($ProjectPath.Length).TrimStart('\')
                $hits += "$relative`:$($i+1)"
            }
        }
    }
    if ($hits.Count -gt 0) {
        $sample = ($hits | Select-Object -First 8) -join ', '
        $more = if ($hits.Count -gt 8) { " (dan $($hits.Count-8) lokasi lain)" } else { '' }
        Add-Finding $pattern.Severity 'CodeScan' $pattern.Name "$($hits.Count) kecocokan pola ditemukan: $sample$more" $pattern.Advice
    } else {
        Add-Finding PASS 'CodeScan' $pattern.Name 'Tidak ditemukan pola yang dicari dalam cakupan scan.'
    }
}

# 4. Routes and throttling indicators
Add-Section '4. ROUTE, AUTHENTICATION, CSRF, DAN RATE LIMITING'
$routesText = Get-TextFile (Join-Path $ProjectPath 'routes\web.php')
$authController = Get-TextFile (Join-Path $ProjectPath 'app\Http\Controllers\AuthController.php')
$kernelText = Get-TextFile (Join-Path $ProjectPath 'app\Http\Kernel.php')
$bootstrapText = Get-TextFile (Join-Path $ProjectPath 'bootstrap\app.php')
if ($routesText -match 'throttle\s*[:(]' -or $authController -match 'RateLimiter|tooManyAttempts|throttle') {
    Add-Finding PASS 'RateLimit' 'Indikator throttle' 'Ditemukan penggunaan throttle/rate limiter pada route atau auth controller.'
} else {
    Add-Finding WARN 'RateLimit' 'Indikator throttle' 'Tidak ditemukan indikator throttle pada route/auth controller.' 'Terapkan throttle pada login, register, reset password, CAPTCHA, API, dan endpoint mahal.'
}
if ($routesText -match 'middleware\s*\(\s*[^\)]*auth' -or $routesText -match "'auth'|""auth""") {
    Add-Finding INFO 'Auth' 'Middleware autentikasi' 'Route tampak menggunakan middleware auth; audit route sensitif secara manual.'
} else {
    Add-Finding WARN 'Auth' 'Middleware autentikasi' 'Pola middleware auth tidak terdeteksi pada routes/web.php.' 'Pastikan seluruh halaman/data privat dilindungi middleware auth dan role/permission.'
}
if ((Test-Path (Join-Path $ProjectPath 'resources\views\auth\login.blade.php')) -and
    (Test-Path (Join-Path $ProjectPath 'resources\views\auth\register.blade.php'))) {
    $loginView = Get-TextFile (Join-Path $ProjectPath 'resources\views\auth\login.blade.php')
    $registerView = Get-TextFile (Join-Path $ProjectPath 'resources\views\auth\register.blade.php')
    if ($loginView -match 'h-captcha|g-recaptcha|cf-turnstile' -and $registerView -match 'h-captcha|g-recaptcha|cf-turnstile') {
        Add-Finding PASS 'Captcha' 'Widget CAPTCHA' 'Widget CAPTCHA terdeteksi pada halaman login dan register.'
    } else {
        Add-Finding WARN 'Captcha' 'Widget CAPTCHA' 'Widget CAPTCHA tidak terdeteksi pada kedua halaman login/register.' 'Periksa apakah CAPTCHA memang diwajibkan dan diverifikasi di server.'
    }
    if ($authController -match 'siteverify|verifyHCaptcha|verifyCaptcha|captcha') {
        Add-Finding PASS 'Captcha' 'Verifikasi CAPTCHA server' 'Indikator verifikasi CAPTCHA sisi server ditemukan di AuthController.'
    } else {
        Add-Finding WARN 'Captcha' 'Verifikasi CAPTCHA server' 'Verifikasi CAPTCHA sisi server tidak terdeteksi di AuthController.' 'Validasi token CAPTCHA di server; jangan hanya mengandalkan widget browser.'
    }
}
if ($routesText -match 'VerifyCsrfToken|validateCsrfTokens|withoutMiddleware') {
    Add-Finding INFO 'CSRF' 'Pengecualian/pengaturan CSRF' 'Ada konfigurasi terkait CSRF; tinjau daftar pengecualian secara manual.'
} else {
    Add-Finding INFO 'CSRF' 'CSRF middleware' 'Tidak ditemukan pengecualian CSRF eksplisit di routes/web.php; pastikan middleware web aktif.'
}

# 5. Filesystem, storage, exposed artifacts
Add-Section '5. FILE SENSITIF, STORAGE, DAN PERMISSION'
$publicPath = Join-Path $ProjectPath 'public'
foreach ($relativePath in @('.env','composer.json','composer.lock','package.json','phpunit.xml','artisan','storage','vendor')) {
    $candidate = Join-Path $publicPath $relativePath
    if (Test-Path $candidate) {
        Add-Finding WARN 'Exposure' "public/$relativePath" "Item ditemukan di dalam public/; dapat berpotensi terakses web." 'Pindahkan file/direktori nonpublik keluar dari public/ dan atur document root ke folder public Laravel.'
    }
}
$storageLink = Join-Path $publicPath 'storage'
if (Test-Path $storageLink) {
    Add-Finding INFO 'Storage' 'public/storage' 'public/storage tersedia. Pastikan hanya file yang memang boleh publik yang disimpan di storage/app/public.'
} else {
    Add-Finding INFO 'Storage' 'public/storage' 'Symlink public/storage tidak ditemukan.'
}
$privateStorage = Join-Path $ProjectPath 'storage\app\private'
if (Test-Path $privateStorage) {
    Add-Finding PASS 'Storage' 'Private storage' 'storage/app/private ditemukan; pastikan file sensitif diunduh melalui controller berotorisasi.'
} else {
    Add-Finding INFO 'Storage' 'Private storage' 'storage/app/private tidak ditemukan.'
}
$aclPaths = @('storage','bootstrap\cache')
foreach ($p in $aclPaths) {
    $target = Join-Path $ProjectPath $p
    if (Test-Path $target) {
        try {
            $acl = Get-Acl -LiteralPath $target
            Add-Finding INFO 'Permission' "ACL $p" ("ACL dapat dibaca; pemilik: " + $acl.Owner + '. Perlu tinjauan manual untuk hak Modify/Write.')
        } catch {
            Add-Finding WARN 'Permission' "ACL $p" 'ACL tidak dapat dibaca oleh akun saat ini.'
        }
    }
}
if (Test-Path (Join-Path $ProjectPath '.git')) {
    Add-Finding WARN 'Exposure' 'Folder .git' 'Folder .git ada pada root proyek. Pastikan document root hanya public/ dan request /.git diblokir.'
} else {
    Add-Finding INFO 'Exposure' 'Folder .git' 'Folder .git tidak ditemukan pada root proyek.'
}

# 6. Dependency audits
Add-Section '6. DEPENDENCY DAN KERENTANAN PAKET'
if (-not $SkipDependencyAudit) {
    if ((Test-CommandExists 'composer') -and (Test-Path $composerJsonPath)) {
        Write-Host 'Menjalankan composer audit (memerlukan koneksi internet)...' -ForegroundColor DarkGray
        $composerOutput = & composer audit --no-interaction 2>&1
        $composerExit = $LASTEXITCODE
        $composerText = ($composerOutput | Out-String).Trim()
        if ($composerExit -eq 0) {
            Add-Finding PASS 'Dependency' 'composer audit' 'Composer tidak melaporkan advisory keamanan yang diketahui.'
        } else {
            $safeSummary = ($composerText -split "`r?`n" | Select-Object -First 8) -join ' | '
            Add-Finding WARN 'Dependency' 'composer audit' "Composer audit menemukan advisory atau gagal dijalankan: $safeSummary" 'Periksa detail dengan composer audit, lalu perbarui paket melalui proses pengujian.'
        }
    } else {
        Add-Finding INFO 'Dependency' 'composer audit' 'Dilewati karena Composer/composer.json tidak tersedia.'
    }
    if ((Test-CommandExists 'npm') -and (Test-Path (Join-Path $ProjectPath 'package-lock.json'))) {
        Write-Host 'Menjalankan npm audit --omit=dev (memerlukan koneksi internet)...' -ForegroundColor DarkGray
        $npmOutput = & npm audit --omit=dev --json 2>&1
        $npmExit = $LASTEXITCODE
        $npmText = ($npmOutput | Out-String)
        try {
            $npmData = $npmText | ConvertFrom-Json
            $vuln = $npmData.metadata.vulnerabilities
            $total = [int]$vuln.total
            if ($total -eq 0 -and $npmExit -eq 0) {
                Add-Finding PASS 'Dependency' 'npm audit production' 'Tidak ada kerentanan production yang dilaporkan npm audit.'
            } else {
                Add-Finding WARN 'Dependency' 'npm audit production' ("Jumlah advisory: total=$total, critical=$($vuln.critical), high=$($vuln.high), moderate=$($vuln.moderate), low=$($vuln.low).") 'Tinjau npm audit dan perbarui dependency secara terkontrol.'
            }
        } catch {
            Add-Finding WARN 'Dependency' 'npm audit production' 'npm audit tidak menghasilkan JSON yang dapat dibaca; kemungkinan jaringan/registry atau npm error.' 'Jalankan npm audit --omit=dev secara manual saat koneksi tersedia.'
        }
    } elseif (Test-Path (Join-Path $ProjectPath 'package.json')) {
        Add-Finding INFO 'Dependency' 'npm audit' 'package-lock.json atau npm tidak tersedia; audit npm dilewati.'
    }
} else {
    Add-Finding INFO 'Dependency' 'Audit dependency' 'Dilewati sesuai parameter -SkipDependencyAudit.'
}

# 7. Laravel artisan diagnostics
Add-Section '7. DIAGNOSTIK ARTISAN'
if ((Test-CommandExists 'php') -and (Test-Path $artisan)) {
    $aboutOutput = & php artisan about --only=environment,cache,drivers 2>&1
    if ($LASTEXITCODE -eq 0) {
        Add-Finding PASS 'Laravel' 'php artisan about' 'Perintah artisan about berhasil dijalankan.'
        foreach ($line in ($aboutOutput | Select-Object -First 12)) {
            [void]$script:ReportLines.Add("  $line")
        }
    } else {
        Add-Finding WARN 'Laravel' 'php artisan about' 'Perintah artisan about gagal; periksa konfigurasi dan koneksi layanan.'
    }
    $routeOutput = & php artisan route:list --except-vendor 2>&1
    if ($LASTEXITCODE -eq 0) {
        $routeCount = @($routeOutput | Where-Object { $_ -match '^\s*(GET|POST|PUT|PATCH|DELETE|OPTIONS|HEAD)' }).Count
        Add-Finding INFO 'Laravel' 'Route list' "$routeCount baris route terdeteksi oleh route:list."
    } else {
        Add-Finding WARN 'Laravel' 'Route list' 'php artisan route:list gagal dijalankan.'
    }
} else {
    Add-Finding INFO 'Laravel' 'Artisan diagnostics' 'Dilewati karena PHP/artisan tidak tersedia.'
}

# 8. HTTP checks (safe GET only)
Add-Section '8. PEMERIKSAAN HTTP DAN SECURITY HEADERS'
if (-not $BaseUrl -and $envText) { $BaseUrl = Get-EnvValue $envText 'APP_URL' }
if ($BaseUrl) {
    try { $uri = [uri]$BaseUrl } catch { $uri = $null }
    if ($null -eq $uri -or $uri.Scheme -notin @('http','https')) {
        Add-Finding WARN 'HTTP' 'Base URL' "URL tidak valid atau scheme bukan HTTP/HTTPS: $BaseUrl"
    } else {
        Add-Finding INFO 'HTTP' 'Target HTTP' "Melakukan GET ringan ke $BaseUrl (tanpa autentikasi dan tanpa payload serangan)."
        $homepageCheck = Invoke-SafeHttpCheck $BaseUrl 'Homepage'
        if ($homepageCheck.Reachable) {
            Add-Finding PASS 'HTTP' 'Homepage merespons' "HTTP $($homepageCheck.StatusCode)."
            $headers = $homepageCheck.Headers
            $headerMap = @{}
            try { foreach ($key in $headers.AllKeys) { $headerMap[$key.ToString().ToLowerInvariant()] = [string]$headers[$key] } } catch {}
            $securityHeaders = @(
                @{Key='strict-transport-security';Name='HSTS';Advice='Tambahkan Strict-Transport-Security setelah HTTPS aktif dan valid.'},
                @{Key='content-security-policy';Name='Content-Security-Policy';Advice='Terapkan CSP yang sesuai dengan asset dan integrasi pihak ketiga.'},
                @{Key='x-content-type-options';Name='X-Content-Type-Options';Advice='Set X-Content-Type-Options: nosniff.'},
                @{Key='x-frame-options';Name='X-Frame-Options';Advice='Gunakan frame-ancestors CSP atau X-Frame-Options untuk mencegah clickjacking.'},
                @{Key='referrer-policy';Name='Referrer-Policy';Advice='Atur Referrer-Policy, misalnya strict-origin-when-cross-origin.'},
                @{Key='permissions-policy';Name='Permissions-Policy';Advice='Batasi browser features yang tidak digunakan.'}
            )
            foreach ($h in $securityHeaders) {
                if ($headerMap.ContainsKey($h.Key)) {
                    Add-Finding PASS 'Headers' $h.Name 'Header ditemukan.'
                } else {
                    if ($h.Key -eq 'strict-transport-security' -and $uri.Scheme -eq 'http') {
                        Add-Finding INFO 'Headers' $h.Name 'Tidak dinilai karena target menggunakan HTTP.'
                    } else {
                        Add-Finding WARN 'Headers' $h.Name 'Header tidak terdeteksi pada respons homepage.' $h.Advice
                    }
                }
            }
            if ($headerMap.ContainsKey('server')) {
                Add-Finding INFO 'Headers' 'Server banner' 'Header Server dikirim; pertimbangkan menyembunyikan detail versi server.'
            }
            if ($headerMap.ContainsKey('x-powered-by')) {
                Add-Finding WARN 'Headers' 'X-Powered-By' 'Header teknologi backend terdeteksi.' 'Nonaktifkan X-Powered-By pada konfigurasi PHP/web server.'
            }
        } else {
            Add-Finding WARN 'HTTP' 'Homepage merespons' "Tidak dapat menghubungi target: $($homepageCheck.Error)" 'Pastikan server berjalan dan BaseUrl benar. Pemeriksaan source tetap berjalan.'
        }

        $probePaths = @('/.env','/.git/HEAD','/composer.json','/composer.lock','/package.json','/phpinfo.php','/vendor/')
        foreach ($path in $probePaths) {
            $probe = Invoke-SafeHttpCheck ($BaseUrl.TrimEnd('/') + $path) $path
            if ($probe.Reachable -and $probe.StatusCode -ge 200 -and $probe.StatusCode -lt 300) {
                Add-Finding FAIL 'Exposure' "HTTP $path" "Endpoint mengembalikan HTTP $($probe.StatusCode); berpotensi mengekspos file/direktori." 'Blokir akses ke file tersembunyi, metadata proyek, vendor, dan endpoint diagnostik di web server.'
            } elseif ($probe.Reachable -and $probe.StatusCode -in @(401,403,404,405)) {
                Add-Finding PASS 'Exposure' "HTTP $path" "Tidak terbuka secara langsung (HTTP $($probe.StatusCode))."
            } elseif ($probe.Reachable) {
                Add-Finding INFO 'Exposure' "HTTP $path" "Respons HTTP $($probe.StatusCode); perlu tinjauan."
            } else {
                Add-Finding INFO 'Exposure' "HTTP $path" 'Tidak dapat diperiksa karena target tidak merespons.'
            }
        }
        if ($uri.Scheme -eq 'https') {
            Add-Finding PASS 'Transport' 'HTTPS' 'Target menggunakan HTTPS.'
        } else {
            Add-Finding WARN 'Transport' 'HTTPS' 'Target menggunakan HTTP; sesuai untuk localhost, tidak aman untuk akses publik.' 'Aktifkan TLS/HTTPS sebelum deployment publik.'
        }
    }
} else {
    Add-Finding INFO 'HTTP' 'Pemeriksaan HTTP' 'APP_URL/BaseUrl tidak tersedia; pemeriksaan HTTP dilewati.'
}

# 9. DDoS readiness assessment (configuration indicators only)
Add-Section '9. KESIAPAN MITIGASI DDOS (TANPA SERANGAN)'
$webServerConfig = @()
foreach ($f in @('public\.htaccess','nginx.conf','docker-compose.yml','Caddyfile')) {
    $p = Join-Path $ProjectPath $f
    if (Test-Path $p) { $webServerConfig += (Get-TextFile $p) }
}
$infraText = $webServerConfig -join "`n"
if ($infraText -match 'limit_req|limit_conn|rate_limit|ratelimit|mod_evasive|RequestReadTimeout') {
    Add-Finding PASS 'DDoS' 'Indikator rate limiting server' 'Konfigurasi server mengandung indikator pembatasan request/koneksi.'
} else {
    Add-Finding WARN 'DDoS' 'Indikator rate limiting server' 'Tidak ditemukan konfigurasi rate limit pada file konfigurasi server yang diperiksa.' 'Atur rate limiting di reverse proxy/web server dan batasi endpoint mahal.'
}
if ($infraText -match 'client_max_body_size|LimitRequestBody|post_max_size') {
    Add-Finding INFO 'DDoS' 'Batas ukuran request' 'Ada indikator pembatasan ukuran request pada konfigurasi yang diperiksa.'
} else {
    Add-Finding WARN 'DDoS' 'Batas ukuran request' 'Batas ukuran request server tidak terdeteksi di file konfigurasi yang diperiksa.' 'Atur batas body/upload di web server dan PHP.'
}
if ($infraText -match 'cloudflare|proxy_protocol|real_ip_header|set_real_ip_from') {
    Add-Finding INFO 'DDoS' 'Reverse proxy/CDN' 'Ada indikator reverse proxy/CDN; verifikasi konfigurasi trusted proxy dan firewall origin.'
} else {
    Add-Finding WARN 'DDoS' 'Perlindungan CDN/WAF' 'Indikator CDN/WAF tidak ditemukan pada konfigurasi lokal yang diperiksa.' 'Untuk website publik, gunakan CDN/WAF/DDoS protection dan batasi akses langsung ke origin.'
}
Add-Finding INFO 'DDoS' 'Batas audit DDoS' 'Tidak dilakukan flood, stress test, atau pengiriman trafik masif. Ketahanan DDoS tidak dapat dibuktikan dari audit lokal.' 'Lakukan penilaian kapasitas dan uji beban terjadwal hanya pada lingkungan milik sendiri dengan persetujuan dan batas trafik yang jelas.'

# 10. Summary and report
Add-Section '10. RINGKASAN HASIL'
$total = $script:PassCount + $script:WarnCount + $script:FailCount + $script:InfoCount
$summary = "PASS=$($script:PassCount) | WARN=$($script:WarnCount) | FAIL=$($script:FailCount) | INFO=$($script:InfoCount) | TOTAL=$total"
Write-Host $summary -ForegroundColor Cyan
[void]$script:ReportLines.Add($summary)
if ($script:FailCount -gt 0) {
    Write-Host 'KESIMPULAN: Ada temuan berisiko tinggi yang perlu ditangani terlebih dahulu.' -ForegroundColor Red
    [void]$script:ReportLines.Add('KESIMPULAN: Ada temuan berisiko tinggi yang perlu ditangani terlebih dahulu.')
} elseif ($script:WarnCount -gt 0) {
    Write-Host 'KESIMPULAN: Ada beberapa hal yang perlu ditinjau; hasil ini bukan sertifikasi aman.' -ForegroundColor Yellow
    [void]$script:ReportLines.Add('KESIMPULAN: Ada beberapa hal yang perlu ditinjau; hasil ini bukan sertifikasi aman.')
} else {
    Write-Host 'KESIMPULAN: Tidak ada temuan FAIL/WARN dari pemeriksaan yang dijalankan; bukan jaminan bebas celah.' -ForegroundColor Green
    [void]$script:ReportLines.Add('KESIMPULAN: Tidak ada temuan FAIL/WARN dari pemeriksaan yang dijalankan; bukan jaminan bebas celah.')
}
[void]$script:ReportLines.Add('')
[void]$script:ReportLines.Add('Rincian temuan:')
foreach ($finding in $script:Findings) {
    [void]$script:ReportLines.Add(("[{0}] [{1}] {2} - {3}" -f $finding.Status,$finding.Category,$finding.Check,$finding.Detail))
    if ($finding.Recommendation) { [void]$script:ReportLines.Add("Saran: $($finding.Recommendation)") }
}
try {
    [System.IO.File]::WriteAllLines($reportPath, $script:ReportLines, ([System.Text.UTF8Encoding]::new($false)))
    Write-Host "`nLaporan tersimpan: $reportPath" -ForegroundColor Green
} catch {
    Write-Warning "Gagal menyimpan laporan: $($_.Exception.Message)"
}
Write-Host "`nAudit selesai. Temuan pola source code perlu verifikasi manual; kecocokan bukan bukti celah." -ForegroundColor DarkCyan
