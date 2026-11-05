const fs = require('fs');

const indexCode = fs.readFileSync('index.php', 'utf8');
const modernBody = fs.readFileSync('scratch/modern_body.php', 'utf8');

const nextSectionMarker = '<div class="elementor-element elementor-element-d644d31';
const nextSecIdx = indexCode.indexOf(nextSectionMarker);

const footerMarker = '<footer class="footer-two">';
const footerIdx = indexCode.indexOf(footerMarker);

if (nextSecIdx === -1 || footerIdx === -1) {
    console.error('Markers not found! nextSecIdx:', nextSecIdx, 'footerIdx:', footerIdx);
    process.exit(1);
}

const topPart = indexCode.substring(0, nextSecIdx);
const bottomPart = indexCode.substring(footerIdx);

const newIndex = topPart + '\n' + modernBody + '\n</div><!-- #content -->\n\n' + bottomPart;
fs.writeFileSync('index.php', newIndex, 'utf8');
console.log('SUCCESS: index.php modernized below hero!');
