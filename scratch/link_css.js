const fs = require('fs');
let c = fs.readFileSync('header.php', 'utf8');
const target = '</head>';
const injection = '    <link rel="stylesheet" href="assets/css/custom-design-system.css">\n</head>';
if (c.includes(target) && !c.includes('custom-design-system.css')) {
    c = c.replace(target, injection);
    fs.writeFileSync('header.php', c, 'utf8');
    console.log('SUCCESS: Linked custom-design-system.css into header.php');
} else {
    console.log('Target not found or already linked');
}
