<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Action - MCC IGH</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @include('partials.dynamic-styles')
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 2rem 1.25rem;
        }
        .container {
            background: white;
            padding: 3.5rem 2.5rem;
            border-radius: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
            max-width: 480px;
            width: 100%;
            border: 1px solid #e2e8f0;
        }
        .icon {
            font-size: 4.5rem;
            margin-bottom: 2rem;
        }
        .icon-success { color: #22c55e; }
        .icon-info { color: #3b82f6; }
        .icon-error { color: #ef4444; }
        h1 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
        }
        p {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 2rem;
            font-size: 1.05rem;
        }
        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 700;
            transition: all 0.2s;
            box-shadow: 0 4px 12px rgba(255, 122, 0, 0.2);
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(255, 122, 0, 0.3);
            opacity: 0.95;
        }

        @media (max-width: 480px) {
            body { padding: 1.5rem 1rem; }
            .container { padding: 2.5rem 1.5rem; border-radius: 20px; }
            .icon { font-size: 3.5rem; }
            h1 { font-size: 1.4rem; }
            p { font-size: 0.95rem; }
            .btn { width: 100%; padding: 0.85rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        @if(session('error'))
            <div class="icon icon-error" style="color: #ef4444;"><i class="ph-fill ph-x-circle"></i></div>
            <h1>Action Completed</h1>
            <p>{{ session('error') }}</p>
        @elseif(session('success'))
            <div class="icon icon-success"><i class="ph-fill ph-check-circle"></i></div>
            <h1>Action Successful!</h1>
            <p>{{ session('success') }}</p>
        @elseif(session('info'))
            <div class="icon icon-info"><i class="ph-fill ph-info"></i></div>
            <h1>Notice</h1>
            <p>{{ session('info') }}</p>
        @else
            <div class="icon icon-info"><i class="ph-fill ph-hand-palm"></i></div>
            <h1>Processing...</h1>
            <p>Your action is being processed.</p>
        @endif
        
        <a href="{{ route('home') }}" class="btn">Back to Website</a>
    </div>
</body>
</html>
