@component('mail::message')
<center style="color: #320777; font-size:35px;">Dear User,</center>

<span style="color: #320777; font-size:23px; align:center">


### Hi {{ $username }}

### Congratulations from Star Multinational Services
   
### Your account has been updated to {{ $account }} on Star Multinational.com .We are so glad to have you.


### Keep working hard with Star Multinational
### We look forward to providing you with the ultimate learning and Earning experience of Digital working

### With best wishes,
### Info@starmultinational.com
### www.Starmultinational.com



</span>

@component('mail::button', ['url' => route('login')])
Your Login Here
@endcomponent


{{ config('app.name') }}
@endcomponent