@if($toastr = session('toastr'))
<script type="text/javascript">
   document.querySelector('script[src="{{ asset("js/app.js") }}"]').onload = function() {
       toastr.{{ $toastr['type'] }}('{{ $toastr["text"] }}');
   }
</script>
@endif
