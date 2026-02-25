$exclude = @(
    ".git",
    ".vscode",
    "node_modules",
    "vendor",
    "tests",
    "*.zip",
    ".env",
    "package-lock.json"
)

$source = "d:\PROJECTS\WEBSITES\lenzbreeze"
$destination = "d:\PROJECTS\WEBSITES\lenzbreeze\deploy.zip"

Write-Host "Creating deployment package..."
Write-Host "Source: $source"
Write-Host "Destination: $destination"

# Remove old zip if exists
if (Test-Path $destination) {
    Remove-Item $destination
}

# Get files to zip
$files = Get-ChildItem -Path $source -Exclude $exclude

# Create Zip
Compress-Archive -Path $files.FullName -DestinationPath $destination -CompressionLevel Optimal

Write-Host "Package created successfully at $destination"
Write-Host "You can now upload 'deploy.zip' to your server's File Manager and extract it."
