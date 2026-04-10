@component('mail::message')
# Introduction

The body of your message.

| Pont bascule  | Nombre total de pesée de type 1 | A facturer  | Cash classique |
| ------------- |:--------------------------------:-------------:----------------|
| Col 2 is      | Centered      | $10             |    35       |                |
| Col 3 is      | Right-Aligned | $20             |             |                |

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
