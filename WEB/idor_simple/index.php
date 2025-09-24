<?php
require_once 'profiles.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';

$flag_id = '2205';          
$FLAG = 'MSEC{1nsecure_d1rect_0bjects} '; 

if (!preg_match('/^\d+$/', $id)) {
    $page_title = "Invalid ID";
    $content = "<div class='alert alert-danger'><i class='fas fa-exclamation-triangle'></i> ID không hợp lệ. Vui lòng dùng số (ví dụ: ?id=1).</div>";
    $content_type = "error";
} else {
    if ($id === $flag_id) {
        $page_title = "Private Profile (ID: " . htmlspecialchars($id) . ")";
        $content = "<div class='profile-card private'>";
        $content .= "<div class='profile-header'>";
        $content .= "<i class='fas fa-user-secret'></i>";
        $content .= "<h2>🔒 Private Information</h2>";
        $content .= "</div>";
        $content .= "<div class='flag-container'>";
        $content .= "<div class='flag-label'>🎉 FLAG FOUND:</div>";
        $content .= "<div class='flag-value'>" . htmlspecialchars($FLAG) . "</div>";
        $content .= "</div>";
        $content .= "<div class='success-message'>";
        $content .= "<i class='fas fa-trophy'></i> Chúc mừng! Bạn đã tìm được flag.";
        $content .= "</div>";
        $content .= "</div>";
        $content_type = "success";
    } else {
        $profile = get_profile($id);
        $page_title = "User Profile (ID: " . htmlspecialchars($id) . ")";
        if ($profile) {
            $content = "<div class='profile-card'>";
            $content .= "<div class='profile-header'>";
            $content .= "<div class='profile-avatar'>";
            $content .= "<i class='fas fa-user'></i>";
            $content .= "</div>";
            $content .= "<h2>" . htmlspecialchars($profile['name']) . "</h2>";
            $content .= "<span class='profile-id'>ID: " . htmlspecialchars($id) . "</span>";
            $content .= "</div>";
            $content .= "<div class='profile-details'>";
            $content .= "<div class='detail-item'>";
            $content .= "<i class='fas fa-envelope'></i>";
            $content .= "<span class='label'>Email:</span>";
            $content .= "<span class='value'>" . htmlspecialchars($profile['email']) . "</span>";
            $content .= "</div>";
            $content .= "<div class='detail-item'>";
            $content .= "<i class='fas fa-info-circle'></i>";
            $content .= "<span class='label'>About:</span>";
            $content .= "<span class='value'>" . htmlspecialchars($profile['about']) . "</span>";
            $content .= "</div>";
            $content .= "</div>";
            $content .= "<div class='profile-note'>";
            $content .= "<i class='fas fa-exclamation-circle'></i>";
            $content .= "<em>Note: Data may be incomplete.</em>";
            $content .= "</div>";
            $content .= "</div>";
        } else {
            $junks = [
                "Loves collecting rare stamps.",
                "Favourite food: instant noodles.",
                "Practices ukulele on weekends.",
                "Occasionally writes haikus about servers.",
                "Has 3 cats, 2 plants, 1 dream."
            ];
            shuffle($junks);
            $content = "<div class='profile-card anonymous'>";
            $content .= "<div class='profile-header'>";
            $content .= "<div class='profile-avatar anonymous'>";
            $content .= "<i class='fas fa-user-ninja'></i>";
            $content .= "</div>";
            $content .= "<h2>Anonymous User</h2>";
            $content .= "<span class='profile-id'>ID: " . htmlspecialchars($id) . "</span>";
            $content .= "</div>";
            $content .= "<div class='profile-details'>";
            $content .= "<div class='detail-item'>";
            $content .= "<i class='fas fa-envelope'></i>";
            $content .= "<span class='label'>Email:</span>";
            $content .= "<span class='value'>user" . htmlspecialchars($id) . "@example.com</span>";
            $content .= "</div>";
            $content .= "<div class='detail-item'>";
            $content .= "<i class='fas fa-info-circle'></i>";
            $content .= "<span class='label'>About:</span>";
            $content .= "<span class='value'>" . htmlspecialchars($junks[0]) . "</span>";
            $content .= "</div>";
            $content .= "</div>";
            $content .= "<div class='profile-note warning'>";
            $content .= "<i class='fas fa-question-circle'></i>";
            $content .= "<em>Thông tin có thể là giả.</em>";
            $content .= "</div>";
            $content .= "</div>";
        }
        $content_type = "normal";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?> | IDOR Challenge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 800px;
            width: 100%;
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header .subtitle {
            color: #7f8c8d;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        .search-form {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }

        .form-group label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1em;
        }

        .form-group input[type="text"] {
            flex: 1;
            min-width: 200px;
            padding: 12px 20px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1em;
            transition: all 0.3s ease;
            background: white;
        }

        .form-group input[type="text"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .btn-submit {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .content-area {
            margin: 30px 0;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .profile-card.private {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            border: none;
        }

        .profile-card.anonymous {
            background: linear-gradient(135deg, #74b9ff, #0984e3);
            color: white;
            border: none;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 2em;
            color: white;
        }

        .profile-avatar.anonymous {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
        }

        .profile-header h2 {
            font-size: 1.8em;
            margin-bottom: 5px;
        }

        .profile-id {
            background: rgba(0, 0, 0, 0.1);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
        }

        .profile-details {
            margin: 25px 0;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 8px;
        }

        .detail-item i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }

        .detail-item .label {
            font-weight: 600;
            margin-right: 10px;
            min-width: 60px;
        }

        .detail-item .value {
            flex: 1;
        }

        .flag-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin: 20px 0;
            border: 2px dashed rgba(255, 255, 255, 0.5);
        }

        .flag-label {
            font-size: 1.2em;
            font-weight: 700;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .flag-value {
            font-family: 'Courier New', monospace;
            font-size: 1.5em;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.3);
            padding: 15px;
            border-radius: 10px;
            word-break: break-all;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            }
            to {
                text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            }
        }

        .success-message {
            margin-top: 20px;
            font-size: 1.1em;
            font-weight: 600;
        }

        .success-message i {
            margin-right: 10px;
            font-size: 1.2em;
        }

        .profile-note {
            margin-top: 20px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            font-style: italic;
        }

        .profile-note.warning {
            background: rgba(255, 193, 7, 0.2);
        }

        .profile-note i {
            margin-right: 8px;
        }

        .alert {
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .alert i {
            margin-right: 15px;
            font-size: 1.2em;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
        }

        .hint-section {
            background: linear-gradient(135deg, #fdcb6e, #e17055);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
        }

        .hint-section h3 {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .hint-section h3 i {
            margin-right: 10px;
        }

        .hint-section p {
            line-height: 1.6;
            opacity: 0.9;
        }

        .examples {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
        }

        .example-link {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-family: monospace;
        }

        .example-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 20px;
            }

            .header h1 {
                font-size: 2em;
            }

            .form-group {
                flex-direction: column;
                align-items: stretch;
            }

            .form-group input[type="text"] {
                min-width: unset;
                width: 100%;
            }

            .examples {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-shield-alt"></i> IDOR Challenge</h1>
            <p class="subtitle">Profile Viewer Security Test</p>
        </div>

        <div class="search-form">
            <form method="get" action="">
                <div class="form-group">
                    <label for="id"><i class="fas fa-search"></i> User ID:</label>
                    <input 
                        id="id" 
                        name="id" 
                        type="text" 
                        placeholder="Enter user ID (e.g., 1, 999999...)"
                        value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>" 
                    />
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-search"></i> View Profile
                    </button>
                </div>
            </form>
        </div>

        <div class="content-area">
            <?php echo $content; ?>
        </div>

        <div class="hint-section">
            <h3><i class="fas fa-lightbulb"></i> Challenge Information</h3>
            <p>
                Tại sao bạn không thử các <code>id</code> bên dưới xem?
            </p>
            <div class="examples">
                <a href="?id=1" class="example-link">?id=1</a>
                <a href="?id=100" class="example-link">?id=100</a>
                <a href="?id=1337" class="example-link">?id=1337</a>
                <a href="?id=9999" class="example-link">?id=9999</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const idInput = document.getElementById('id');
            if (idInput && !idInput.value) {
                idInput.focus();
            }

            idInput?.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.target.form.submit();
                }
            });

            const exampleLinks = document.querySelectorAll('.example-link');
            exampleLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const url = new URL(this.href);
                    const id = url.searchParams.get('id');
                    document.getElementById('id').value = id;
                });
            });
        });
    </script>
</body>
</html>