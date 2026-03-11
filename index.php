<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blubuk Laundry API</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #e2e8f0;
            overflow: hidden;
        }

        .bg-glow {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.15;
            pointer-events: none;
        }

        .bg-glow--blue {
            background: #3b82f6;
            top: -100px;
            right: -100px;
        }

        .bg-glow--purple {
            background: #8b5cf6;
            bottom: -100px;
            left: -100px;
        }

        .card {
            position: relative;
            background: rgba(30, 41, 59, 0.6);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            border-radius: 24px;
            padding: 48px 56px;
            text-align: center;
            max-width: 480px;
            width: 90%;
            box-shadow:
                0 0 0 1px rgba(148, 163, 184, 0.05),
                0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: fadeUp 0.8s ease-out;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            font-size: 48px;
            margin-bottom: 8px;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            background: linear-gradient(135deg, #60a5fa, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 24px;
            letter-spacing: -0.5px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.25);
            border-radius: 100px;
            padding: 10px 24px;
            font-size: 15px;
            font-weight: 600;
            color: #4ade80;
            margin-bottom: 32px;
        }

        .status__dot {
            width: 10px;
            height: 10px;
            background: #4ade80;
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
            box-shadow: 0 0 8px rgba(74, 222, 128, 0.6);
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(148, 163, 184, 0.2), transparent);
            margin-bottom: 28px;
        }

        .info {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 32px;
        }

        .info__row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
        }

        .info__label {
            color: #94a3b8;
            font-weight: 500;
        }

        .info__value {
            color: #e2e8f0;
            font-weight: 600;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: #fff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn svg {
            width: 18px;
            height: 18px;
        }

        .footer {
            margin-top: 28px;
            font-size: 12px;
            color: #475569;
        }
    </style>
</head>
<body>

    <div class="bg-glow bg-glow--blue"></div>
    <div class="bg-glow bg-glow--purple"></div>

    <div class="card">
        <div class="logo"><i class="fa-solid fa-shirt"></i></div>
        <h1 class="title">Blubuk Laundry API</h1>

        <div class="status">
            <span class="status__dot"></span>
            API is Online
        </div>

        <div class="divider"></div>

        <div class="info">
            <div class="info__row">
                <span class="info__label">Created by</span>
                <span class="info__value">Bayu Fadayan</span>
            </div>
            <div class="info__row">
                <span class="info__label">Version</span>
                <span class="info__value">2.0.0</span>
            </div>
            <div class="info__row">
                <span class="info__label">Server Time</span>
                <span class="info__value"><?= date('Y-m-d H:i:s') ?></span>
            </div>
        </div>

        <a href="https://github.com/bayufadayan/blubuk-laundry-api" target="_blank" class="btn">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            View Repository
        </a>

        <div class="footer">
            &copy; <?= date('Y') ?> Blubuk Laundry. MIT License.
        </div>
    </div>

</body>
</html>
