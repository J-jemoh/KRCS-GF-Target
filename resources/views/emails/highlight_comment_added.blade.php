@component('mail::message')
# New Comment on Your Highlight

Hi {{ optional($comment->monthlyHighlight->user)->name ?? 'User' }},

{{ optional($comment->supervisor)->name ?? 'Supervisor' }} just added a comment on your highlight:

"{{ $comment->comment }}"

@component('mail::button', [
    'url' => $comment->monthlyHighlight
        ? route('monthly.show', $comment->monthlyHighlight->id)
        : url('/')
])
View Highlight
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
