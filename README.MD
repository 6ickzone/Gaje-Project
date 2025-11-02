# BengkelSempak

**File:** sempak.php  
**Author:** 0x6ick  
**Version:** 1.0  
**Tagline:** Nothing is useless — even underwear can be useful.

## Description
BengkelSempak is a single-file PHP web tool built for fun but with practical functions.  
It can grab domain-like folders, generate file extensions in bulk, and perform mass keyword checking.  
Runs cleanly without any CSS dependency.

## Features
- **Domain Grabber** — scans folders and extracts domain-style names.  
- **EXT Generator** — replaces or appends file extensions in a list of URLs.  
- **Mass Checker** — checks multiple URLs for specific files or keywords (Normal or Fast mode).

## How to Use
1. Upload `sempak.php` to your hosting or local server (XAMPP, VPS, etc).  
2. Access through browser:http://localhost/sempak.php or https://yourdomain.com/sempak.php
### Domain Grabber
Enter a local path (e.g. `/home/user/public_html/`) then click **Grab Domains**.  
Detected domain folders will appear in the textarea.

### EXT Generator
Paste a list of URLs, choose the old and new extensions, then click **Generate**.  
Output will automatically be saved to `ext.txt`.

### Mass Checker
Input target URLs, specify file/path (e.g. `.env`, `admin.php`),  
optionally add a keyword, select mode, then hit **Scan Now**.  
Detected results will be saved in `found.txt`.

## Output Files
- `ext.txt` → results from the extension generator  
- `found.txt` → detected URLs from the mass checker

## Tips
- Use **Fast mode (cURL)** for hundreds of targets.  
- **Normal mode** is slower but more stable.  
- Can be used as a portable internal debugging tool.

## License
Open-source under the MIT License. 
## Quote
"Nothing is useless — even underwear can be useful."
