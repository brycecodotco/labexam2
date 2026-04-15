<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rice Business Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; font-family: 'Inter', sans-serif; }
        .auth-card { border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .auth-side-image { 
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1536633310180-2a2b997792ec?auto=format&fit=crop&q=80&w=1000');
            background-size: cover;
            background-position: center;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100 align-items-center justify-content-center p-3">
            <div class="col-12 col-lg-10 col-xl-8">
                <div class="row auth-card bg-white g-0">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>