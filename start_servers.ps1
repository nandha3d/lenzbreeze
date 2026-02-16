# Kill existing processes on port 8000 and 5173
Write-Host "Cleaning up existing processes..." -ForegroundColor Cyan
$ports = @(8000, 5173, 8002)
foreach ($port in $ports) {
    $proc = Get-NetTCPConnection -LocalPort $port -ErrorAction SilentlyContinue | Select-Object -First 1
    if ($proc) {
        Stop-Process -Id $proc.OwningProcess -Force -ErrorAction SilentlyContinue
        Write-Host "Stopped process on port $port" -ForegroundColor Yellow
    }
}

Write-Host "`nStarting PHP Server on http://127.0.0.1:8000..." -ForegroundColor Green
Start-Process php -ArgumentList "-S", "127.0.0.1:8000", "server.php" -NoNewWindow

Write-Host "Starting Vite Dev Server on http://127.0.0.1:5173..." -ForegroundColor Green
Start-Process npm.cmd -ArgumentList "run", "dev", "--", "--host", "127.0.0.1" -NoNewWindow

Write-Host "`nServers are running! Open http://127.0.0.1:8000 in your browser." -ForegroundColor Green
