Click here to confirm your registration:

<a href="{{ $link = url('adprovider/registration/confirm', $adprovider->remember_token).'?email='.urlencode($adprovider->email) }}"> 

{{ $link }} 

</a>
