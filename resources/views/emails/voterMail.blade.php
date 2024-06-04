@component('mail::message')
    @php
    $user = Auth::user(); 
    @endphp
    Hi <b>{{ $user->firstname}}</b>
   
    <p>Thank you for voting .</p>
    <h2 class="text-center">list of your Candidtates and their position</h2>
    @foreach($checkCand as $check)
    <div class="text-center">   
     <h3>{{$check->pname}}: {{$check->canfname}} {{$check->canlname}} </h3>
    </div>
        
    @endforeach
	
    Thanks,<br>
    <p>Voting System</p>

@endcomponent