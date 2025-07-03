<div wire:ignore.self class="flashmessgae">
  
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block " id="hideDiv">
            <button type="button" class="close ml-2" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
         
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block " id="hideDiv1">
            <button type="button" class="close ml-2" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif  

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block" id="hideDiv2">
            <button type="button" class="close ml-2" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif
    

    @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block" id="hideDiv3">
            <button type="button" class="close ml-2" data-dismiss="alert">×</button>    
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($errors->any())
        <div class="alert alert-danger" id="hideDiv4">
            <button type="button" class="close ml-2" data-dismiss="alert">×</button>    
            Please check the form below for errors
        </div>
    @endif

</div>


@push('scripts')
<script>
$(document).ready(function () {
    // Set a timeout to execute a function after a 4-second delay
    setInterval(function () {
        $('#hideDiv').fadeOut();
        $('#hideDiv2').fadeOut();
        $('#hideDiv3').fadeOut();
        $('#hideDiv4').fadeOut();
    }, 4000);
});
</script>
@endpush