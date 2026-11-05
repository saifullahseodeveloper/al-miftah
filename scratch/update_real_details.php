<?php
require_once 'admin-panel/db.php';

// 1. Update Causes with real uploaded photo assets
$causes = [
    [
        'id' => 1,
        'title' => 'Ek Charitable School Kholo, Taleem Ka Noor Phelao',
        'category' => 'School Construction',
        'goal_amount' => 500000.00,
        'raised_amount' => 185000.00,
        'image_url' => 'wp-content/uploads/2026/04/3D-View-01.jpg-1-scaled.jpeg',
        'description' => 'Ranipur, Haidergarh mein Al-Miftah Educational and Social Charitable Trust ke tehat ghareeb aur mustahiq bachchon ke liye muft charitable school building aur smart classrooms ki tameer ka project. Aapka har rupaya aane wali nasal ki taleem aur Sadaqah Jariyah banta hai.'
    ],
    [
        'id' => 2,
        'title' => 'Free Islamic & Modern Education for Underprivileged Children',
        'category' => 'Child Education',
        'goal_amount' => 350000.00,
        'raised_amount' => 120000.00,
        'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.02-PM-scaled.jpeg',
        'description' => 'Yateem aur be-sahara bachchon ko Hifz-e-Quran, Deeni taleem ke sath sath Computer, Science aur English modern syllabus bilkul muft faraham kiya jata hai. Isme school bag, books aur stationery shamil hain.'
    ],
    [
        'id' => 3,
        'title' => 'Monthly Dry Ration & Family Food Support Drive',
        'category' => 'Community Relief',
        'goal_amount' => 200000.00,
        'raised_amount' => 95000.00,
        'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.04-PM-scaled.jpeg',
        'description' => 'Ghareeb, bewa aur majboor parivaaron ke liye mahina-waar zaroori rashan (atta, daal, chawal, tel) ki direct distribution taaki koi bhi parivaar bhookha na soye.'
    ]
];

$upd_cause = $pdo->prepare("UPDATE custom_causes SET title = ?, category = ?, goal_amount = ?, raised_amount = ?, image_url = ?, description = ? WHERE id = ?");
foreach ($causes as $c) {
    $upd_cause->execute([$c['title'], $c['category'], $c['goal_amount'], $c['raised_amount'], $c['image_url'], $c['description'], $c['id']]);
}
echo "Causes updated with real trust assets.\n";

// 2. Update Events with real trust location and real photos
$events = [
    [
        'id' => 1,
        'title' => 'Annual Admission & Educational Awareness Camp 2026',
        'location' => 'Ranipur, Haidergarh, Barabanki (UP)',
        'event_date' => '2026-11-20 10:00:00',
        'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.03-PM-scaled.jpeg',
        'description' => 'Ghareeb bachchon ke dakhila muhim aur muft taleemi kit distribution par khususi ijlas. Ulema aur education experts ki janib se rehnumai aur registration.'
    ],
    [
        'id' => 2,
        'title' => 'Winter Uniform & Study Supplies Distribution Drive',
        'location' => 'Al-Miftah Trust Campus, Ranipur Haidergarh',
        'event_date' => '2026-12-10 11:30:00',
        'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.06-PM-scaled.jpeg',
        'description' => 'Mustahiq bachchon mein sardiyon ke sweater, shoes, school bag aur syllabus kitabein baantne ki khusoosi drive.'
    ]
];

$upd_event = $pdo->prepare("UPDATE custom_events SET title = ?, location = ?, event_date = ?, image_url = ?, description = ? WHERE id = ?");
foreach ($events as $e) {
    $upd_event->execute([$e['title'], $e['location'], $e['event_date'], $e['image_url'], $e['description'], $e['id']]);
}
echo "Events updated with real trust assets.\n";

// 3. Update Blogs with real trust photos
$blogs = [
    [
        'id' => 1,
        'title' => 'Islam Mein Sadaqah Jariyah Ki Fazilat Aur Taleemi Khidmat',
        'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.05-PM-scaled.jpeg',
        'content' => 'Sadaqah Jariyah wo neki hai jiska sawab insan ke marne ke baad bhi hamesha jari rehta hai. Jab aap kisi ghareeb bachche ko taleem dilwate hain ya school / madarse ki building mein hissa lete hain, to wo jab tak padhega aur aage naslon ko sikhayega, uska ajar aapko milta rahega. Al-Miftah Educational Trust is amanat ko poori imandari ke sath zarooratmand bachon tak pahunchata hai.'
    ],
    [
        'id' => 2,
        'title' => 'Ghareeb Bachchon Ko Taleem Se Aaraasta Karna Hum Sab Ka Farz Hai',
        'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.07-PM-scaled.jpeg',
        'content' => 'Taleem har bachche ka bunyadi haq hai. Al-Miftah Educational Trust ka maqsad har us bachche tak noor-e-ilm pahunchana hai jo maali tangi ki wajah se school nahi ja pa rahe hain. Hamara mission rural ilaqon mein charitable schooling ke zariye har bachche ko aage badhne ka barabar mauqa dena hai.'
    ]
];

$upd_blog = $pdo->prepare("UPDATE custom_blogs SET title = ?, image_url = ?, content = ? WHERE id = ?");
foreach ($blogs as $b) {
    $upd_blog->execute([$b['title'], $b['image_url'], $b['content'], $b['id']]);
}
echo "Blogs updated with real trust assets.\n";

// 4. Update Gallery with real trust photos
$gallery = [
    ['id' => 1, 'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.02-PM-scaled.jpeg', 'caption' => 'Al-Miftah Educational Trust Community Drive'],
    ['id' => 2, 'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.03-PM-scaled.jpeg', 'caption' => 'Students & Community Assembly Session'],
    ['id' => 3, 'image_url' => 'wp-content/uploads/2026/04/3D-View-01.jpg-1-scaled.jpeg', 'caption' => 'Proposed Charitable School Building Architecture'],
    ['id' => 4, 'image_url' => 'wp-content/uploads/2026/04/WhatsApp-Image-2026-04-07-at-7.58.06-PM-scaled.jpeg', 'caption' => 'Ration & Relief Support Distribution']
];

$upd_gal = $pdo->prepare("UPDATE custom_gallery SET image_url = ?, caption = ? WHERE id = ?");
foreach ($gallery as $g) {
    $upd_gal->execute([$g['image_url'], $g['caption'], $g['id']]);
}
echo "Gallery updated with real trust assets.\n";
