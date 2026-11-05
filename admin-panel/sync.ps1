$ftpHost = "93.127.208.222"
$ftpUser = "u425598304.al-miftah.org"
$ftpPass = 'almiftAh@#$12768'
$ftpPath = "/testing/admin-panel/" # Assuming the FTP drops us in public_html, but let's test.

# Test if public_html prefix is needed
$testUpload = curl.exe -s --ftp-create-dirs -T "index.php" "ftp://$ftpUser`:$ftpPass@$ftpHost/public_html/testing/admin-panel/index.php"

if ($LASTEXITCODE -eq 0) {
    Write-Host "Syncing to /public_html/testing/admin-panel/"
    $ftpPath = "/public_html/testing/admin-panel/"
} else {
    Write-Host "Syncing to /testing/admin-panel/"
    $ftpPath = "/testing/admin-panel/"
}

Get-ChildItem -Path . -File | ForEach-Object {
    $file = $_.Name
    Write-Host "Uploading $file..."
    curl.exe -s --ftp-create-dirs -T "$file" "ftp://$ftpUser`:$ftpPass@$ftpHost$ftpPath$file"
}
Write-Host "Sync Complete!"
