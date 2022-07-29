@component('mail::message')
<center style="color: #320777; font-size:35px;">Dear User,</center>

<span style="color: #320777; font-size:23px; align:center">


### Hi {{ $user->username }}

### Congratulations from Star Multinational Services
   
### Your account has been updated to Member on Star Multinational.com .We are so glad to have you.


### Keep working hard with Star Multinational
### We look forward to providing you with the ultimate learning and Earning experience of Digital working

### With best wishes,
### www.starmultinational55@gmail.com
### www.Starmultinational.com



</span>

@component('mail::button', ['url' => route('login')])
Your Login Here
@endcomponent


{{ config('app.name') }}
@endcomponent