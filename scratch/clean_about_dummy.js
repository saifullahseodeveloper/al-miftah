const fs = require('fs');
const path = require('path');

const aboutPath = path.join(__dirname, '..', 'about-us.php');
let content = fs.readFileSync(aboutPath, 'utf8');

// Replace external dummy demo links
content = content.replace(/https:\/\/charifundwp\.wowtheme7\.com\/about-us\//g, 'about-us.php');
content = content.replace(/https:\/\/charifundwp\.wowtheme7\.com\/causes\//g, 'causes.php');
content = content.replace(/https:\/\/charifundwp\.wowtheme7\.com\/team\//g, 'about-us.php');
content = content.replace(/https:\/\/charifundwp\.wowtheme7\.com\/all-team\/[a-z0-9-]+\//g, 'about-us.php');

// Replace dummy phone number
content = content.replace(/\+236 \(456\) 896 22/g, '+91 8840432382');
content = content.replace(/tel:01-793-7938/g, 'tel:+918840432382');

// Replace dummy team members with real organizational roles
content = content.replace(/Michel Fokluz/g, 'Trust Patron &amp; Scholar');
content = content.replace(/Arian Drobloas/g, 'Education Director');
content = content.replace(/Jara Klintof/g, 'Relief &amp; Welfare Lead');
content = content.replace(/Aiden Markram/g, 'Community Coordinator');

// Replace dummy review/author
content = content.replace(/Michel Smith/g, 'Community Donor');
content = content.replace(/Cloth Store Inc\./g, 'Barabanki, UP');

fs.writeFileSync(aboutPath, content, 'utf8');
console.log('Successfully cleaned dummy links, phones, and team members from about-us.php!');
