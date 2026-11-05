<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Create uploads directory if it doesn't exist
$upload_dir = 'uploads/gallery/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

// Handle Add Image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $caption = trim($_POST['caption']);
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = basename($_FILES['image']['name']);
        
        // Secure File Upload handling
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        if (in_array($ext, $allowed)) {
            $new_filename = uniqid('img_', true) . '.' . $ext;
            $destination = $upload_dir . $new_filename;
            
            if (move_uploaded_file($tmp_name, $destination)) {
                $stmt = $pdo->prepare("INSERT INTO custom_gallery (image_path, caption) VALUES (?, ?)");
                $stmt->execute([$destination, $caption]);
                header("Location: gallery.php?success=1");
                exit();
            }
        } else {
            $error = "Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.";
        }
    }
}

// Handle Delete Image
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // First, fetch the file path so we can delete the actual file
    $stmt = $pdo->prepare("SELECT image_path FROM custom_gallery WHERE id = ?");
    $stmt->execute([$id]);
    $img = $stmt->fetch();
    
    if ($img && file_exists($img['image_path'])) {
        unlink($img['image_path']);
    }
    
    $stmt = $pdo->prepare("DELETE FROM custom_gallery WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: gallery.php?deleted=1");
    exit();
}

$gallery = [];
try {
    $stmt = $pdo->query("SELECT * FROM custom_gallery ORDER BY created_at DESC");
    $gallery = $stmt->fetchAll();
} catch (PDOException $e) {}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Manager - CMS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #4F46E5; --primary-hover: #4338ca; --sidebar-bg: #111827; --sidebar-hover: #1f2937; --text-main: #f9fafb; --text-muted: #9ca3af; --bg-body: #f3f4f6; --card-bg: #ffffff; --text-dark: #1f2937; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: var(--bg-body); }
        
        /* Sidebar */
        .sidebar { width: 260px; background-color: var(--sidebar-bg); color: var(--text-main); display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-header { padding: 20px; font-size: 24px; font-weight: 700; text-align: center; border-bottom: 1px solid var(--sidebar-hover); display: flex; align-items: center; justify-content: center; gap: 10px; }
        .sidebar-header i { color: var(--primary); }
        .nav-links { flex-grow: 1; padding: 20px 0; list-style: none; }
        .nav-links a { display: flex; align-items: center; gap: 15px; color: var(--text-muted); text-decoration: none; padding: 12px 20px; font-size: 16px; transition: all 0.3s ease; }
        .nav-links a:hover, .nav-links a.active { background-color: var(--sidebar-hover); color: var(--text-main); border-left: 4px solid var(--primary); }
        .nav-links a.active i { color: var(--primary); }
        .logout-btn { margin: 20px; padding: 12px; background-color: rgba(239, 68, 68, 0.1); color: #ef4444; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600; display: block; transition: 0.3s; }
        
        /* Layout */
        .main-content { flex-grow: 1; display: flex; flex-direction: column; overflow-x: hidden; }
        .header { background: var(--card-bg); padding: 20px 40px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .header h2 { color: var(--text-dark); font-weight: 600; }
        .container { padding: 40px; }
        .page-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-head h1 { font-size: 24px; color: var(--text-dark); }
        
        /* Buttons & Grid */
        .btn-add { background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 15px; transition: 0.2s; }
        .btn-add:hover { background: var(--primary-hover); transform: translateY(-1px); }
        
        .gallery-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
        .gallery-card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden; position: relative; transition: 0.3s; }
        .gallery-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
        .img-wrapper { width: 100%; height: 200px; overflow: hidden; background: #e5e7eb; }
        .img-wrapper img { width: 100%; height: 100%; object-fit: cover; }
        .card-details { padding: 15px; display: flex; justify-content: space-between; align-items: center; }
        .card-details p { font-size: 14px; color: #4b5563; margin: 0; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 75%; }
        
        .actions { display: flex; gap: 10px; }
        .btn-delete { background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; cursor: pointer; border: none; }
        .btn-delete:hover { background: #ef4444; color: white; }

        /* Modal Overlay */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); align-items: center; justify-content: center; }
        .modal.active { display: flex; }
        .modal-content { background: white; padding: 30px; border-radius: 12px; width: 100%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 15px; margin-bottom: 20px; }
        .modal-header h3 { font-size: 20px; color: var(--text-dark); }
        .close-modal { background: none; border: none; font-size: 20px; color: var(--text-muted); cursor: pointer; transition: 0.2s; }
        .close-modal:hover { color: #ef4444; }
        
        /* Form Inputs */
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-size: 14px; font-weight: 600; color: #374151; margin-bottom: 5px; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; color: #1f2937; outline: none; transition: 0.2s; }
        .form-group input:focus, .form-group textarea:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1); }
        
        /* Alerts */
        .alert { padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; font-weight: 500; }
        .alert-success { background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
        .alert-error { background: #fee2e2; color: #dc2626; border: 1px solid #fecaca; }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <main class="main-content">
        <header class="header"><h2>Gallery Manager</h2><div class="user-info"><span><?= htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span></div></header>
        <div class="container">
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> Image uploaded successfully!</div>
            <?php endif; ?>
            <?php if(isset($_GET['deleted'])): ?>
                <div class="alert alert-success"><i class="fa-solid fa-trash-can"></i> Image deleted successfully!</div>
            <?php endif; ?>
            <?php if(isset($error)): ?>
                <div class="alert alert-error"><i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <div class="page-head">
                <h1>Media Gallery</h1>
                <button class="btn-add" onclick="document.getElementById('addModal').classList.add('active')">
                    <i class="fa-solid fa-upload"></i> Upload Image
                </button>
            </div>
            
            <?php if(empty($gallery)): ?>
            <div style="background:white; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); padding:60px; text-align:center; color:#9ca3af;">
                <i class="fa-regular fa-image" style="font-size:58px; margin-bottom:15px; color:#d1d5db;"></i>
                <h3>Your gallery is empty</h3>
                <p>Upload photos from your recent causes and events to showcase your work.</p>
            </div>
            <?php else: ?>
            <div class="gallery-grid">
                <?php foreach($gallery as $img): ?>
                <div class="gallery-card">
                    <div class="img-wrapper">
                        <img src="<?= htmlspecialchars($img['image_path']) ?>" alt="Gallery Image">
                    </div>
                    <div class="card-details">
                        <p><?= htmlspecialchars($img['caption'] ?: 'No Caption') ?></p>
                        <a href="gallery.php?delete=<?= $img['id'] ?>" class="btn-delete" onclick="return confirm('Delete this image permanently?');"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Upload Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Upload New Image</h3>
                <button class="close-modal" onclick="document.getElementById('addModal').classList.remove('active')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                
                <div class="form-group" style="border: 2px dashed #d1d5db; padding: 30px; text-align: center; border-radius: 8px; margin-bottom: 20px; background: #f9fafb;">
                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 30px; color: var(--primary); margin-bottom: 10px;"></i><br>
                    <input type="file" name="image" required accept="image/*" style="border: none; background: transparent; box-shadow: none;">
                </div>

                <div class="form-group">
                    <label>Image Caption (Optional)</label>
                    <input type="text" name="caption" placeholder="e.g. Food distribution in Delhi">
                </div>
                <button type="submit" class="btn-add" style="width: 100%; justify-content: center; margin-top: 10px;">Upload to Gallery</button>
            </form>
        </div>
    </div>
</body>
</html>
