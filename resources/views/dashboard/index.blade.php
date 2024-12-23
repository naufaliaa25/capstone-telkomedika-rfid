@if (Auth::user()->role === 'receptionist')
    @include('dashboard.receptionist.index')
@elseif (Auth::user()->role === 'doctor')
    @include('dashboard.doctor.index')
@endif
