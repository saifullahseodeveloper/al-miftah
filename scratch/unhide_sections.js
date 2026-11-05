const fs = require('fs');
let code = fs.readFileSync('index.php', 'utf8');

// Unhide Popular Cause section
code = code.replace(/elementor-element-ee65cf3\s+elementor-hidden-desktop\s+elementor-hidden-tablet\s+elementor-hidden-mobile/, 'elementor-element-ee65cf3');

// Unhide 5-Year Vision / Mission section
code = code.replace(/elementor-element-990bcf2\s+elementor-hidden-desktop\s+elementor-hidden-tablet\s+elementor-hidden-mobile/, 'elementor-element-990bcf2');

// Unhide Blog & News section
code = code.replace(/elementor-element-e4212f4\s+elementor-hidden-desktop\s+elementor-hidden-tablet\s+elementor-hidden-mobile/, 'elementor-element-e4212f4');

// Hide duplicate inactive About section d644d31 completely so it leaves 0 gap
code = code.replace(/class="elementor-element elementor-element-d644d31[^"]*"/, 'style="display:none !important;" class="elementor-element elementor-element-d644d31"');

fs.writeFileSync('index.php', code, 'utf8');
console.log('Unhide complete!');
