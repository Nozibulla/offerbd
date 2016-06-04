Click here to confirm your registration:

<a href="{{ $link = url('adprovider/registration/confirm', array($adprovider->remember_token, urlencode($adprovider->email))) }}"> 

{{ $link }} 

</a>
