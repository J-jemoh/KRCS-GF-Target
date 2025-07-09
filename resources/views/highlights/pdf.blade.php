<!DOCTYPE html>
<html>
<head>
    <title>Monthly Regional Highlightts</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1 { text-align: center; }
        .section { margin-bottom: 20px; }
        .section h2 { font-size: 16px; margin-bottom: 10px; }
    </style>
</head>
<body>

<h1>{{$highlight->region}} Monthly Regional Highlight Report</h1>

<div class="section">
    <strong>Month:</strong> {{ $highlight->created_at->format('F Y')}}<br>
    <strong>Region:</strong> {{ $highlight->region }}<br>
    <strong>From:</strong> {{ $highlight->start_date }} - {{ $highlight->end_date }}
</div>

<div class="section">
    <h2><b>Key Highlights</b></h2>
    {!!$highlight->key_highlights!!}
</div>

<div class="section">
    <h2><b>Key Action Points</b></h2>
    {!! $highlight->key_action_points !!}
</div>

<div class="section">
    <h2><b>Support needed from HQ</b></h2>
    {!!$highlight->hq_support!!}
</div>

<div class="section">
    <h2><b>Plans for next month</b></h2>
    {!!$highlight->next_month_plans!!}
</div>

<div class="section">
    <h2><b>Comments from Supervisor</b></h2>
    @foreach($highlight->highlightComments as $comment)
    {!!$comment->comment!!}
    @endforeach
</div>

</body>
</html>
