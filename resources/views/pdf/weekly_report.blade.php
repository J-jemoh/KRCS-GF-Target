<!DOCTYPE html>
<html>
<head>
    <title>Weekly Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        .section { margin-bottom: 20px; }
        .section h2 { font-size: 16px; margin-bottom: 10px; }
    </style>
</head>
<body>

<h1>Weekly Report</h1>

<div class="section">
    <strong>Department:</strong> {{ $weekly->department }}<br>
    <strong>Region:</strong> {{ $weekly->region }}<br>
    <strong>Week:</strong> {{ $weekly->week }}<br>
    <strong>From:</strong> {{ $weekly->start_date }} - {{ $weekly->end_date }}
</div>

<div class="section">
    <h2><b>Achievements This Week</b></h2>
    {!!$weekly->achievements!!}
</div>

<div class="section">
    <h2><b>Work Planned Upcoming Week</b></h2>
    {!! $weekly->work_plan !!}
</div>

<div class="section">
    <h2><b>Key Risks, Issues or Dependencies</b></h2>
    {!!$weekly->key_risks!!}
</div>

<div class="section">
    <h2><b>Other Comments</b></h2>
    {!!$weekly->comments!!}
</div>

<div class="section">
    <h2><b>Urgent Arising Matters Requiring SMT Intervention</b></h2>
    {!!$weekly->matters_arising!!}
</div>

</body>
</html>
