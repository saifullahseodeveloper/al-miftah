<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require_once 'db.php';

// Handle Add Cause
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $title = trim($_POST['title']);
    $goal_amount = (float)$_POST['goal_amount'];
    $description = trim($_POST['description']);

    if (!empty($title) && $goal_amount > 0) {
        $stmt = $pdo->prepare("INSERT INTO custom_causes (title, goal_amount, description) VALUES (?, ?, ?)");
        $stmt->execute([$title, $goal_amount, $description]);
        header("Location: causes.php?success=1");
        exit();
    }
}

// Handle Delete Cause
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM custom_causes WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: causes.php?deleted=1");
    exit();
}

// Fetch Causes
$causes = [];
try {
    $stmt = $pdo->query("SELECT * FROM custom_causes ORDER BY created_at DESC");
    $causes = $stmt->fetchAll();
} catch (PDOException $e) {}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Causes Manager - CMS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --primary: #4F46E5; --primary-hover: #4338ca; --sidebar-bg: #111827; --sidebar-hover: #1f2937; --text-main: #f9fafb; --text-muted: #9ca3af; --bg-body: #f3f4f6; --card-bg: #ffffff; --text-dark: #1f2937; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { display: flex; min-height: 100vh; background-color: var(--bg-body); }
        
        /* Sidebar */
        .sidebar { width: 260px; background-color: var(--sidebar-bg); color: var(--text-main); display: flex; flex-direction: column; }
        .sidebar-header { padding: 20px; font-size: 24px; font-weight: 700; text-align: center; border-bottom: 1px solid var(--sidebar-hover); display: flex; align-items: center; justify-content: center; gap: 10px; }
        .sidebar-header i { color: var(--primary); }
        .nav-links { flex-grow: 1; padding: 20px 0; list-style: none; }
        .nav-links a { display: flex; align-items: center; gap: 15px; color: var(--text-muted); text-decoration: none; padding: 12px 20px; font-size: 16px; transition: all 0.3s ease; }
        .nav-links a:hover, .nav-links a.active { background-color: var(--sidebar-hover); color: var(--text-main); border-left: 4px solid var(--primary); }
        .nav-links a.active i { color: var(--primary); }
        .logout-btn { margin: 20px; padding: 12px; background-color: rgba(239, 68, 68, 0.1); color: #ef4444; text-align: center; border-radius: 8px; text-decoration: none; font-weight: 600; display: block; transition: 0.3s; }
        
        /* Layout */
        .main-content { flex-grow: 1; display: flex; flex-direction: column; }
        .header { background: var(--card-bg); padding: 20px 40px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center; }
        .header h2 { color: var(--text-dark); font-weight: 600; }
        .container { padding: 40px; }
        .page-head { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .page-head h1 { font-size: 24px; color: var(--text-dark); }
        
        /* Buttons & Table */
        .btn-add { background: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px; font-size: 15px; transition: 0.2s; }
        .btn-add:hover { background: var(--primary-hover); transform: translateY(-1px); }
        .card { background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px 25px; text-align: left; }
        th { background: #f9fafb; color: var(--text-muted); font-weight: 600; font-size: 13px; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; }
        td { border-bottom: 1px solid #e5e7eb; color: #4b5563; font-size: 14px; }
        .actions { display: flex; gap: 10px; }
        .btn-action { padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 500; cursor: pointer; border: none; }
        .btn-delete { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .btn-delete:hover { background: #ef4444; color: white; }

        /* Progress Bar */
        .progress-wrapper { width: 100%; background: #e5e7eb; border-radius: 10px; height: 8px; overflow: hidden; margin-top: 8px; }
        .progress-bar { height: 100%; background: #10b981; border-radius: 10px; }

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
    </style>
</head>
<body>

    <?php include 'sidebar.php'; ?>

    <main class="main-content">
        <header class="header">
            <h2>Causes & Donations Manager</h2>
            <div class="user-info"><span><?= htmlspecialchars($_SESSION['username']); ?></span></div>
        </header>

        <div class="container">
            <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success"><i class="fa-solid fa-check-circle"></i> Cause created successfully!</div>
            <?php endif; ?>
            <?php if(isset($_GET['deleted'])): ?>
                <div class="alert alert-success"><i class="fa-solid fa-trash-can"></i> Cause deleted successfully!</div>
            <?php endif; ?>

            <div class="page-head">
                <h1>Manage Causes</h1>
                <button class="btn-add" onclick="document.getElementById('addModal').classList.add('active')">
                    <i class="fa-solid fa-plus"></i> Add New Cause
                </button>
            </div>

            <div class="card">
                <?php if(empty($causes)): ?>
                <div style="padding:40px; text-align:center; color:#9ca3af;">
                    <i class="fa-solid fa-hand-holding-dollar" style="font-size:48px; margin-bottom:15px; color:#d1d5db;"></i>
                    <h3>No causes found</h3>
                    <p>Create a cause to start accepting donations.</p>
                </div>
                <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Campaign Title</th>
                            <th>Goal Amount</th>
                            <th>Raised / Progress</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($causes as $cause): 
                            $percent = $cause['goal_amount'] > 0 ? min(100, round(($cause['raised_amount'] / $cause['goal_amount']) * 100)) : 0;
                        ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($cause['title']) ?></strong></td>
                            <td>$<?= number_format($cause['goal_amount'], 2) ?></td>
                            <td>
                                $<?= number_format($cause['raised_amount'], 2) ?> <span style="color:#10b981; font-weight:bold; font-size:12px;">(<?= $percent ?>%)</span>
                                <div class="progress-wrapper">
                                    <div class="progress-bar" style="width: <?= $percent ?>%"></div>
                                </div>
                            </td>
                            <td class="actions">
                                <a href="causes.php?delete=<?= $cause['id'] ?>" class="btn-action btn-delete" onclick="return confirm('Delete this cause completely?');"><i class="fa-solid fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Add Cause Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Launch New Cause</h3>
                <button class="close-modal" onclick="document.getElementById('addModal').classList.remove('active')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form method="POST" action="">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label>Cause Title *</label>
                    <input type="text" name="title" required placeholder="e.g. Build a Well in Africa">
                </div>
                <div class="form-group">
                    <label>Financial Goal Amount ($) *</label>
                    <input type="number" step="0.01" name="goal_amount" required placeholder="5000.00">
                </div>
                <div class="form-group">
                    <label>Detailed Description</label>
                    <textarea name="description" rows="5" placeholder="Explain what the charity funds will be used for..."></textarea>
                </div>
                <button type="submit" class="btn-add" style="width: 100%; justify-content: center; margin-top: 10px;">Launch Campaign</button>
            </form>
        </div>
    </div>

</body>
</html>
