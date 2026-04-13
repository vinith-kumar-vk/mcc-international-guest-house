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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }
        .container {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        .icon {
            font-size: 4rem;
            margin-bottom: 2rem;
        }
        .icon-success { color: #22c55e; }
        .icon-info { color: #3b82f6; }
        h1 {
            font-size: 1.5rem;
            color: #1e293b;
            margin-bottom: 1rem;
        }
        p {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: opacity 0.2s;
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
