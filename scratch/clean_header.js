const fs = require('fs');
let h = fs.readFileSync('header.php', 'utf8');
h = h.replace(/\s*<link rel=["']stylesheet["'] href=["']assets\/css\/custom-design-system\.css[^"']*["']>\s*/g, '\n');
fs.writeFileSync('header.php', h, 'utf8');
console.log('Successfully cleaned header.php');
